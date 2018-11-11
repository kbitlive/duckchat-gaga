<?php
/**
 * Describe :upgrade 1.1.1(10101) to 1.1.2(10102)
 * Author: SAM<an.guoyue254@gmail.com>
 * Date: 2018/11/10
 * Time: 2:54 PM
 */

class Upgrade_From10101To10102 extends Upgrade_Version
{

    protected function doUpgrade()
    {
        $tag = __CLASS__ . '::' . __FUNCTION__;

        try {
            // set login management to empty
            $this->updateLoginPluginManagementEmpty();

            //update config.php key to new value
            $newConfig = [
                'apiPagePassportLogin' => "./index.php?action=page.passport.login"
            ];
            return $this->updateConfigPhp($newConfig);
        } catch (Exception $e) {
            $this->printAndThrowException($tag, $e);
        }
    }

    protected function upgrade_DB_sqlite()
    {
        return $this->executeSqliteScript();
    }

    protected function upgrade_DB_mysql()
    {
        return $this->executeMysqlScript();
    }

    private function updateLoginPluginManagementEmpty()
    {
        $data = [
            'management' => "",
        ];
        $where = [
            "pluginId" => 102,
        ];
        return $this->ctx->SitePluginTable->updateProfile($data, $where);
    }
}