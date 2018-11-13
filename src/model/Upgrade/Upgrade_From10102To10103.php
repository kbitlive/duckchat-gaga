<?php
/**
 * Describe :upgrade 1.1.2(10102) to 1.1.3(10103)
 * Author: SAM<an.guoyue254@gmail.com>
 * Date: 2018/11/10
 * Time: 2:54 PM
 */

class Upgrade_From10102To10103 extends Upgrade_Version
{

    protected function doUpgrade()
    {
        return $this->updatePlugin();
    }

    protected function upgrade_DB_sqlite()
    {
        $this->dropSiteCustomItemTable();
        return $this->executeSqliteScript();
    }

    protected function upgrade_DB_mysql()
    {
        return $this->executeMysqlScript();
    }

    private function updatePlugin()
    {

        return true;
    }

    private function dropSiteCustomItemTable()
    {
        $this->dropDBTable("siteCustomItem");
    }

}