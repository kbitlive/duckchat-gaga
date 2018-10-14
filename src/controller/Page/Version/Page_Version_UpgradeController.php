<?php
/**
 * check current version need to upgrade
 * User: anguoyue
 * Date: 13/10/2018
 * Time: 3:54 PM
 */

class Page_Version_UpgradeController extends Page_VersionController
{

    function doRequest()
    {



        try {
            //校验upgradePassword
            if (!$this->checkUpgradePassword()) {
                throw new Exception("error upgrade password");
            }
            $currentVersionCode = $_POST["versionCode"];
            if (empty($currentVersionCode)) {
                $currentVersionCode = 10011;
            }
            switch ($currentVersionCode) {
                case 10011:
                    $this->upgrade_10011_10012();
                    break;
                case 10012:
                    break;
            }
        } catch (Exception $e) {
            $this->logger->error("page.version.upgrade", "");
            $this->setUpgradeVersion("error", $e);
        }

        return;
    }


    private function checkUpgradePassword()
    {
        $upgradePassword = $_COOKIE['upgradePassword'];

        $fileName = $this->getPasswordFileName();

        $passwordFileName = dirname(__FILE__) . "/../../../" . $fileName;

        $this->logger->error("=============", "fileName=" . $passwordFileName);

        $serverPassword = file_get_contents($passwordFileName);

        if ($upgradePassword != sha1($serverPassword)) {
            throw new Exception("error upgrade password");
        }

        return true;
    }

    // upgrade from 1.0.11 to 1.0.12
    private function upgrade_10011_10012()
    {
        $this->logger->error("=============", "upgrade version");

        $dbType = $this->ctx->dbType;

        if ($dbType == "mysql") {
            //执行一次脚本
            $this->executeMysqlScript();
            //mysql
            $this->upgrade_10011_10012_mysql();
        } else {
            //sqlite
            $this->upgrade_10011_10012_sqlite();
        }

    }

    private function upgrade_10011_10012_mysql()
    {
        $tag = __CLASS__ . "->" . __FUNCTION__;
        $sql = "alter table sitePlugin ADD COLUMN IF NOT EXISTS management TEXT;";

        $this->ctx->db->exec($sql);
    }

    private function upgrade_10011_10012_sqlite()
    {
        $tag = __CLASS__ . "->" . __FUNCTION__;

        $sql = "alter table sitePlugin rename to temp_10011_sitePlugin";
        $prepare = $this->ctx->db->exec($sql);

        $this->executeSqliteScript();

        $insertSql = "insert into sitePlugin(id,pluginId,name,logo,sort,landingPageUrl,landingPageWithProxy,usageType,loadingType,permissionType,authKey,addTime) 
          select id,pluginId,name,logo,sort,landingPageUrl,landingPageWithProxy,usageType,loadingType,permissionType,authKey,addTime from temp_10011_sitePlugin";

        $prepare = $this->ctx->db->prepare($insertSql);
        $prepare->execute($prepare);

        $this->logger->error("=========", "upgrade result=" . var_export($prepare->errorInfo(), true));
    }


}