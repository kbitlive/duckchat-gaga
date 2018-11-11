<?php
/**
 * Describe :upgrade 1.0.13(10013) to 1.0.14(10014)
 * Author: SAM<an.guoyue254@gmail.com>
 * Date: 2018/11/11
 * Time: 6:58 PM
 */

class Upgrade_From10013To10014 extends Upgrade_Version
{

    protected function doUpgrade()
    {
        return true;
    }

    protected function upgrade_DB_mysql()
    {
        return $this->executeMysqlScript();
    }

    protected function upgrade_DB_Sqlite()
    {
        return $this->executeSqliteScript();
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