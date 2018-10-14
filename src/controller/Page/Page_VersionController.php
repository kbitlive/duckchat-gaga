<?php
/**
 * check current version need to upgrade
 * User: anguoyue
 * Date: 13/10/2018
 * Time: 3:54 PM
 */

abstract class Page_VersionController extends HttpBaseController
{

    protected $versions = [
        10011 => "1.0.11",

        10012 => "1.0.12"
    ];

    abstract function doRequest();

    public function index()
    {
        $this->initUpgradeVersion();
        $this->doRequest();
    }

    protected function initUpgradeVersion()
    {
        $siteVersion = [
            "versionCode" => 10011,
            "versionName" => "",
            "upgradeErrCode" => "",
            "upgradeErrInfo" => "",
            "passwordFileName" => $this->setPasswordFileName(),//升级口令文件名称
        ];

        $fileName = dirname(__FILE__) . "/../../upgrade.php";

        if (!file_exists($fileName)) {
            $contents = var_export($siteVersion, true);
            file_put_contents($fileName, "<?php\n return {$contents};\n ");

            $passwordFileName = dirname(__FILE__) . "/../../" . $siteVersion['passwordFileName'];
            file_put_contents($passwordFileName, ZalyHelper::generateNumberKey());
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

    private function setPasswordFileName()
    {
        $dateDir = date("Ymd");
        $fileName = ZalyHelper::generateStrKey(10) . "-" . $dateDir . ".upgrade";

        return $fileName;
    }

    protected function getPasswordFileName()
    {
        $versionInfos = $this->getUpgradeVersion();

        $fileName = $versionInfos['passwordFileName'];
        return $fileName;
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

    protected function executeMysqlScript()
    {
        $tag = __CLASS__ . "->" . __FUNCTION__;
        $mysqlScriptPath = dirname(__DIR__) . "/../model/database-sql/site_mysql.sql";

        $this->logger->error("site.install.db", "mysql script=" . $mysqlScriptPath);

        $_sqlContent = file_get_contents($mysqlScriptPath);//写自己的.sql文件
        $_sqlArr = explode(';', $_sqlContent);

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
}