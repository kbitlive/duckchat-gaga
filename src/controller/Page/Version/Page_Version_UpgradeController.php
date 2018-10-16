<?php
/**
 * check current version need to upgrade
 * User: anguoyue
 * Date: 13/10/2018
 * Time: 3:54 PM
 */

class Page_Version_UpgradeController extends Page_VersionController
{
    private $versionCode;
    private $versionName;

    private $upgradeErrCode = "error";
    private $upgradeErrInfo;

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

            $result = false;

            if ($currentVersionCode <= 10011) {
                $this->versionCode = 10012;
                $this->versionName = "1.0.12";

                $result = $this->upgrade_10011_10012();
            } elseif ($currentVersionCode == 10012) {
                $this->versionCode = 10013;
                $this->versionName = "1.0.13";
                $result = $this->upgrade_10012_10013();

                //最新版本审计完成以后，删除升级文件
                $this->deleteUpgradePasswordFile();
            }

            //update cache if exists
            if (function_exists("opcache_reset")) {
                opcache_reset();
            }

            $this->setUpgradeVersion($this->versionCode, $this->versionName, $this->upgradeErrCode, $this->upgradeErrInfo);

            if ($result) {
                $this->updateSiteConfigAsUpgrade($this->versionCode, $this->versionName);
            }

        } catch (Exception $e) {
            $this->logger->error("page.version.upgrade", $e);
            $this->setUpgradeVersion($this->versionCode, $this->versionName, "error", $e->getMessage() . " " . $e->getTraceAsString());
        }

        return;
    }


    private function checkUpgradePassword()
    {
        $upgradePassword = $_COOKIE['upgradePassword'];

        $fileName = $this->getPasswordFileName();

        $passwordFileName = dirname(__FILE__) . "/../../../" . $fileName;

        $this->logger->error("page.version.upgrade", "fileName=" . $passwordFileName);

        $serverPassword = file_get_contents($passwordFileName);

        if ($upgradePassword != sha1($serverPassword)) {
            throw new Exception("upgrade gaga-server by error password");
        }

        return true;
    }

    // upgrade from 1.0.11 to 1.0.12
    private function upgrade_10011_10012()
    {
        $dbType = $this->ctx->dbType;

        if ($dbType == "mysql") {
            $this->executeMysqlScript();
            return $this->upgrade_10011_10012_mysql();
        } else {
            //sqlite
            return $this->upgrade_10011_10012_sqlite();
        }
    }

    private function upgrade_10012_10013()
    {
        $dbType = $this->ctx->dbType;

        if ($dbType == "mysql") {
            $this->executeMysqlScript();
            return $this->upgrade_10012_10013_mysql();
        } else {
            return $this->upgrade_10012_10013_sqlite();
        }
    }

    private function upgrade_10011_10012_mysql()
    {
        $tag = __CLASS__ . "->" . __FUNCTION__;
        $sql = "alter table sitePlugin ADD COLUMN management TEXT;";

        $prepare = $this->ctx->db->prepare($sql);

        $flag = $prepare->execute();

        $errCode = $prepare->errorCode();

        if ($flag && $errCode == "00000") {
            $this->upgradeErrCode = "success";
            return true;
        }

        $this->upgradeErrCode = "error";
        $this->upgradeErrInfo = var_export($prepare->errorInfo(), true);
        $this->logger->error("page.version.upgrade", "upgrade result=" . var_export($prepare->errorInfo(), true));
        return false;
    }

    private function upgrade_10011_10012_sqlite()
    {
        $tag = __CLASS__ . "->" . __FUNCTION__;

        $sql = "drop table sitePlugin_temp_10011";
        $this->ctx->db->exec($sql);

        $sql = "alter table sitePlugin rename to sitePlugin_temp_10011";
        $result = $this->ctx->db->exec($sql);
        $this->logger->error($tag, "rename table sitePlugin to sitePlugin_temp_10011 result=" . $result);

        $this->executeSqliteScript();
        $this->logger->error($tag, "upgrade sqlite,execute sqlite script");

        //migrate data to new table
        $insertSql = "insert into sitePlugin(id,pluginId,name,logo,sort,landingPageUrl,landingPageWithProxy,usageType,loadingType,permissionType,authKey,addTime) 
          select id,pluginId,name,logo,sort,landingPageUrl,landingPageWithProxy,usageType,loadingType,permissionType,authKey,addTime from sitePlugin_temp_10011";

        $prepare = $this->ctx->db->prepare($insertSql);
        $flag = $prepare->execute();
        $errCode = $prepare->errorCode();

        if ($flag && $errCode == "00000") {
            $this->upgradeErrCode = "success";
            return true;
        }

        $this->upgradeErrCode = "error";
        $this->upgradeErrInfo = var_export($prepare->errorInfo(), true);
        $this->logger->error("page.version.upgrade", "upgrade result=" . var_export($prepare->errorInfo(), true));
        return false;
    }

    private function upgrade_10012_10013_mysql()
    {
        $tag = __CLASS__ . "->" . __FUNCTION__;
        //config add enableAddFriendInGroup = true;
        $this->addEnableAddFriendInGroupConfig();


        //add siteGroup canAddFriend column
        $sql = "alter table siteGroup add column canAddFriend BOOLEAN default true";
        $prepare = $this->ctx->db->prepare($sql);

        $flag = $prepare->execute();

        if ($flag && $prepare->errorCode() == "00000") {
            $this->upgradeErrCode = "success";
            return true;
        }

        $this->upgradeErrCode = "error";
        $this->upgradeErrInfo = var_export($prepare->errorInfo(), true);
        return false;
    }

    private function upgrade_10012_10013_sqlite()
    {
        $tag = __CLASS__ . "->" . __FUNCTION__;
        //config add enableAddFriendInGroup = true;
        $this->addEnableAddFriendInGroupConfig();


        //add siteGroup canAddFriend column
        //drop temp table
        $sql = "drop table siteGroup_temp_10012";
        $this->ctx->db->exec($sql);

        //rename table
        $sql = "alter table siteGroup rename to siteGroup_temp_10012";
        $result = $this->ctx->db->exec($sql);
        $this->logger->error($tag, "rename table siteGroup to siteGroup_temp_10012 result=" . $result);

        //execute all table
        $this->executeSqliteScript();

        //migrate data to new table
        $sql = "insert into 
                  siteGroup(id,groupId,name,nameInLatin,owner,avatar,description,descriptionType,permissionJoin,canGuestReadMessage,canAddFriend,speakers,maxMembers,status,isWidget,timeCreate) 
                select 
                  id,groupId,name,nameInLatin,owner,avatar,description,descriptionType,permissionJoin,canGuestReadMessage,1 as canAddFriend,speakers,maxMembers,status,isWidget,timeCreate
                from siteGroup_temp_10012";
        $prepare = $this->ctx->db->prepare($sql);
        $flag = $prepare->execute();

        if ($flag && $prepare->errorCode() == "00000") {
            $this->upgradeErrCode = "success";
            return true;
        }

        $this->upgradeErrCode = "error";
        $this->upgradeErrInfo = var_export($prepare->errorInfo(), true);
        return false;
    }

    private function addEnableAddFriendInGroupConfig()
    {
        $tag = __CLASS__ . "->" . __FUNCTION__;

        $sql = "select site";

        $sql = "insert into siteConfig(configKey,configValue) values('enableAddFriendInGroup',1)";
        $prepare = $this->ctx->db->prepare($sql);

        $flag = $prepare->execute();

        $this->logger->error("================", "result=" . $flag);
        $this->logger->error("================", "errCode=" . $prepare->errorCode());

        if (($flag && $prepare->errorCode() == "00000") || $prepare->errorCode() == "23000") {
            return true;
        }

        throw new Exception(var_export($prepare->errorInfo(), true));
    }

}