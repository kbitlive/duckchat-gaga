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

            } elseif ($currentVersionCode == 10013) {
                $this->versionCode = 10014;
                $this->versionName = "1.0.14";
                $result = $this->upgrade_10013_10014();
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

        $passwordContent = file_get_contents($passwordFileName);
        $serverPassword = trim($passwordContent);

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
        $this->upgradeSitePluginFor10013();
        if ($dbType == "mysql") {
            $this->executeMysqlScript();
            return $this->upgrade_10012_10013_mysql();
        } else {
            return $this->upgrade_10012_10013_sqlite();
        }
    }

    private function upgrade_10013_10014()
    {
        $dbType = $this->ctx->dbType;
        $phpErrorLog = ZalyHelper::generateStrKey(16) . '_php_errors.log';;
        $config = [
            "errorLog" => $phpErrorLog,
        ];
        $this->updateSiteConfig($config);

        if ($dbType == "mysql") {
            return $this->upgrade_10013_10014_mysql();
        } else {
            return $this->upgrade_10013_10014_sqlite();
        }
    }

    private function upgrade_10011_10012_mysql()
    {
        $tag = __CLASS__ . "->" . __FUNCTION__;
        $sql = "alter table sitePlugin ADD COLUMN management TEXT;";

        $prepare = $this->ctx->db->prepare($sql);

        $flag = $prepare->execute();

        $errCode = $prepare->errorCode();

        if (($flag && $errCode == "00000") || "42S21" == $errCode) {
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

        $this->dropDBTable('sitePlugin_temp_10011');

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
            $this->dropDBTable('sitePlugin_temp_10011');
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

        $dbErrCode = $prepare->errorCode();
        $flag = (($flag && "00000" == $dbErrCode) || "42S21" == $dbErrCode);

        $flag = $flag && $this->upgradePasswordTableFrom10012_10013("mysql");

        if ($flag) {
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

        //upgrade siteGroup table
        $flag = $this->upgradeSiteGroupTableFrom10012_10013();
        //upgrade passportPassword table
        $flag = $flag && $this->upgradePasswordTableFrom10012_10013("sqlite");

        if ($flag) {
            $this->upgradeErrCode = "success";
            return true;
        }

        return false;
    }

    private function upgradeSiteGroupTableFrom10012_10013()
    {
        $tag = __CLASS__ . '->' . __FUNCTION__;

        $this->dropDBTable("siteGroup_temp_10012");

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
            $this->dropDBTable("siteGroup_temp_10012");
            return true;
        }

        $this->upgradeErrCode = "error";
        $this->upgradeErrInfo = var_export($prepare->errorInfo(), true);
        return false;

    }

    private function upgradePasswordTableFrom10012_10013($dbType)
    {
        $tag = __CLASS__ . "->" . __FUNCTION__;

        $this->dropDBTable('passportPassword_temp_10012');

        //rename table
        $sql = "alter table passportPassword rename to passportPassword_temp_10012";
        $result = $this->ctx->db->exec($sql);
        $this->logger->error($tag, "rename table passportPassword to passportPassword_temp_10012 result=" . $result);

        if ("mysql" == $dbType) {
            $this->executeMysqlScript();
        } else {
            //execute all table
            $this->executeSqliteScript();
        }


        //migrate data to new table
        $sql = "insert into 
                  passportPassword(id ,userId ,loginName ,nickname ,password ,email ,invitationCode ,timeReg) 
                select 
                  id ,userId ,loginName ,nickname ,password,email ,invitationCode ,timeReg
                from passportPassword_temp_10012";
        $prepare = $this->ctx->db->prepare($sql);
        $flag = $prepare->execute();

        if ($flag && $prepare->errorCode() == "00000") {
            $this->upgradeErrCode = "success";
            $this->dropDBTable('passportPassword_temp_10012');
            return true;
        }

        $this->upgradeErrCode = "error";
        $this->upgradeErrInfo = var_export($prepare->errorInfo(), true);
        return false;
    }

    private function upgradeSitePluginFor10013()
    {
        $tag = __CLASS__ . "->" . __FUNCTION__;

        $data = [
            'pluginId' => 105,
            'name' => "账户密码管理",
            'logo' => "",
            'sort' => 105,
            'landingPageUrl' => "index.php?action=miniProgram.passport.account",
            'landingPageWithProxy' => 1,
            'usageType' => Zaly\Proto\Core\PluginUsageType::PluginUsageAccountSafe,
            'loadingType' => Zaly\Proto\Core\PluginLoadingType::PluginLoadingNewPage,
            'permissionType' => Zaly\Proto\Core\PluginPermissionType::PluginPermissionAll,
            'authKey' => "",
            'management' => "",
        ];

        try {
            $where = [
                "pluginId" => 105,
            ];
            $this->ctx->SitePluginTable->updateProfile($data, $where);
        } catch (Exception $e) {
            $this->logger->error($tag, "ignore insert 105:" . $e->getMessage());
        }


        try {
            $data["pluginId"] = 105;
            $this->ctx->SitePluginTable->insertMiniProgram($data);
        } catch (Exception $e) {
            $this->logger->error($tag, "ignore update 105:" . $e->getMessage());
        }

        //update miniProgram management
        try {
            $data2 = [
                'management' => "index.php?action=miniProgram.admin.passwordLogin",
            ];
            $where2 = [
                "pluginId" => 102,
            ];
            $this->ctx->SitePluginTable->updateProfile($data2, $where2);
        } catch (Exception $e) {
            $this->logger->error($tag, "update 102 :" . $e->getMessage());
        }
    }

    private function addEnableAddFriendInGroupConfig()
    {
        $tag = __CLASS__ . "->" . __FUNCTION__;

        $sql = "insert into siteConfig(configKey,configValue) values('enableAddFriendInGroup',1)";
        $prepare = $this->ctx->db->prepare($sql);

        $flag = $prepare->execute();

        if (($flag && $prepare->errorCode() == "00000") || $prepare->errorCode() == "23000") {
            return true;
        }

        throw new Exception(var_export($prepare->errorInfo(), true));
    }

    private function upgrade_10013_10014_mysql()
    {
        $tag = __CLASS__ . "->" . __FUNCTION__;

        try {
            $this->executeMysqlScript();
            $this->upgradeErrCode = "success";
            return true;
        } catch (Exception $ex) {
            $this->upgradeErrCode = "error";
            $this->logger->error($tag, $ex);
            throw new Exception(var_export($ex->getMessage(), true));
        }
    }

    private function upgrade_10013_10014_sqlite()
    {
        $tag = __CLASS__ . "->" . __FUNCTION__;
        try {
            $this->executeSqliteScript();
            $this->upgradeErrCode = "success";
            return true;
        } catch (Exception $ex) {
            $this->upgradeErrCode = "error";
            $this->logger->error($tag, $ex);
            throw new Exception(var_export($ex->getMessage(), true));
        }
    }
}