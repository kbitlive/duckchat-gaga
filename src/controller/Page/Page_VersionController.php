<?php
/**
 * check current version need to upgrade
 * User: anguoyue
 * Date: 13/10/2018
 * Time: 3:54 PM
 */

abstract class Page_VersionController extends UpgradeController
{
    protected $needUpgrade = false;
    protected $versions = [
        10011 => "1.0.11",
        10012 => "1.0.12",
        10013 => "1.0.13",
        10014 => "1.0.14",
    ];

    abstract function doRequest();

    public function index()
    {

        //set is latest version
        $currentVersionCode = ZalyConfig::getConfig(ZalyConfig::$configSiteVersionCodeKey);
        if (!is_numeric($currentVersionCode)) {
            $currentVersionCode = 10011;
        }
        $latestVersionCode = ZalyConfig::getSampleConfig(ZalyConfig::$configSiteVersionCodeKey);
        //check if need upgrade
        if ($currentVersionCode < $latestVersionCode) {
            $this->needUpgrade = true;
        } else {

            $method = $_SERVER['REQUEST_METHOD'];
            if ($method == 'GET') {
                $upgradeUrl = './index.php';
                header("Location:" . $upgradeUrl);
                exit;
            }
        }

        $this->initUpgradeVersion();
        $this->doRequest();
    }

    protected function initUpgradeVersion()
    {
        $siteVersion = [
            "versionCode" => 10011, //默认第一个版本，从1.0.11版本开始支持升级
            "versionName" => "",
            "upgradeErrCode" => "",
            "upgradeErrInfo" => "",
            "passwordFileName" => $this->generatePasswordFileName(),//升级口令文件名称
        ];

        $fileName = dirname(__FILE__) . "/../../upgrade.php";

        if (!file_exists($fileName)) {
            $contents = var_export($siteVersion, true);
            file_put_contents($fileName, "<?php\n return {$contents};\n ");

            $passwordFileName = dirname(__FILE__) . "/../../" . $siteVersion['passwordFileName'];
            file_put_contents($passwordFileName, ZalyHelper::generateNumberKey() . "\n");
        } else {
            //upgrade.php 存在，但是 ***.upgrade 不存在
            $passwordFilePath = $this->getPasswordFilePath();

            if (!file_exists($passwordFilePath)) {
                $newPasswordFileName = $this->generatePasswordFileName();
                $passwordFilePath = dirname(__FILE__) . "/../../" . $newPasswordFileName;
                file_put_contents($passwordFilePath, ZalyHelper::generateNumberKey() . "\n");
                //update upgrade.php
                $this->updateUpgradePasswordFileName($newPasswordFileName);
            }

        }

    }

    protected function getUpgradeVersion()
    {
        $fileName = dirname(__FILE__) . "/../../upgrade.php";
        if (!file_exists($fileName)) {
            $this->initUpgradeVersion();
        }
        $versionArrays = require($fileName);

        return $versionArrays;
    }

    private function generatePasswordFileName()
    {
        $dateDir = date("Ymd");
        $fileName = ZalyHelper::generateStrKey(10) . "-" . $dateDir . ".upgrade";

        return $fileName;
    }

    protected function getPasswordFilePath()
    {
        $versionInfos = $this->getUpgradeVersion();

        $fileName = $versionInfos['passwordFileName'];

        $filePath = dirname(__FILE__) . "/../../" . $fileName;
        return $filePath;
    }

    protected function getPasswordFileName()
    {
        $versionInfos = $this->getUpgradeVersion();

        $fileName = $versionInfos['passwordFileName'];
        return $fileName;
    }

    protected function deleteUpgradePasswordFile()
    {
        $fileName = $this->getPasswordFileName();

        $passwordFileName = dirname(__FILE__) . "/../../" . $fileName;

        $result = unlink($passwordFileName);
    }

    /**
     * @param $versionCode
     * @param $versionName
     * @param $upgradeErrCode success/doing/error
     * @param $upgradeErrInfo
     */
    protected function setUpgradeVersion($versionCode, $versionName, $upgradeErrCode, $upgradeErrInfo)
    {
        $siteVersion = [
            "versionCode" => $versionCode,
            "versionName" => $versionName,
            "upgradeErrCode" => $upgradeErrCode,
            "upgradeErrInfo" => $upgradeErrInfo,
            "passwordFileName" => $this->getPasswordFileName(),//升级口令文件名称
        ];

        $fileName = dirname(__FILE__) . "/../../upgrade.php";
        $contents = var_export($siteVersion, true);
        file_put_contents($fileName, "<?php\n return {$contents};\n ");
    }


    protected function setUpgradeErrInfo($upgradeErrCode, $upgradeErrInfo)
    {
        $currentVersion = $this->getUpgradeVersion();

        $siteVersion = [
            "versionCode" => $currentVersion["versionCode"],
            "versionName" => $currentVersion['versionName'],
            "upgradeErrCode" => $upgradeErrCode,
            "upgradeErrInfo" => $upgradeErrInfo,
            "passwordFileName" => $this->getPasswordFileName(),//升级口令文件名称
        ];

        $fileName = dirname(__FILE__) . "/../../upgrade.php";
        $contents = var_export($siteVersion, true);
        file_put_contents($fileName, "<?php\n return {$contents};\n ");
    }

    protected function updateUpgradePasswordFileName($passwordFileName)
    {
        $versionInfos = $this->getUpgradeVersion();

        $versionInfos['passwordFileName'] = $passwordFileName;

        $fileName = dirname(__FILE__) . "/../../upgrade.php";
        $contents = var_export($versionInfos, true);
        file_put_contents($fileName, "<?php\n return {$contents};\n ");
    }

    protected function executeMysqlScript()
    {
        $tag = __CLASS__ . "->" . __FUNCTION__;
        $mysqlScriptPath = dirname(__DIR__) . "/../model/database-sql/site_mysql.sql";

        $_sqlContent = file_get_contents($mysqlScriptPath);//写自己的.sql文件
        $_sqlArr = explode(';', $_sqlContent);
        $_sqlArr = array_filter($_sqlArr);

        try {
            $this->ctx->db->beginTransaction();
            foreach ($_sqlArr as $sql) {
                $this->ctx->db->exec($sql);
            }
            $this->ctx->db->commit();
        } catch (Throwable $e) {
            $this->ctx->db->rollBack();
            $this->logger->error($tag, $e);
            throw $e;
        }

    }

    protected function executeSqliteScript()
    {
        $tag = __CLASS__ . "->" . __FUNCTION__;
        $mysqlScriptPath = dirname(__DIR__) . "/../model/database-sql/site_sqlite.sql";
        $_sqlContent = file_get_contents($mysqlScriptPath);//写自己的.sql文件
        $_sqlArr = explode(';', $_sqlContent);
        $_sqlArr = array_filter($_sqlArr);

        try {
            $this->ctx->db->beginTransaction();
            foreach ($_sqlArr as $sql) {
                $this->ctx->db->exec($sql);
            }
            $this->ctx->db->commit();
        } catch (Exception $e) {
            $this->ctx->db->rollBack();
            $this->ctx->logger->error($tag, $e);
            throw $e;
        }

    }

    protected function updateSiteConfigAsUpgrade($newVersionCode, $newVersionName)
    {
        $siteConfig = ZalyConfig::getAllConfig();
        $siteConfig["siteVersionCode"] = $newVersionCode;
        $siteConfig["siteVersionName"] = $newVersionName;
        ZalyConfig::updateConfigFile($siteConfig);
    }

    protected function updateSiteConfig($config)
    {
        if (!is_array($config)) {
            return false;
        }
        $siteConfig = ZalyConfig::getAllConfig();
        $siteConfig = array_merge($siteConfig, $config);
        ZalyConfig::updateConfigFile($siteConfig);
        ZalyConfig::getAllConfig();
    }

    protected function dropDBTable($tableName)
    {
        $sql = "drop table $tableName";
        $this->ctx->db->exec($sql);
    }
}