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
        $result = $this->executeSqliteScript();
        $result = $this->insertDefaultCustomItem() && $result;
        return $result;
    }

    protected function upgrade_DB_mysql()
    {
        $result = $this->executeSqliteScript();
        $result = $this->insertDefaultCustomItem() && $result;
        return $result;
    }

    private function updatePlugin()
    {

        return true;
    }

    private function insertDefaultCustomItem()
    {
        $tag = __CLASS__ . "->" . __FUNCTION__;
        $customs = [
            0 => [
                "customKey" => "phoneId",
                "keyName" => "手机号码",
                "keyDesc" => "手机号码",
                "keyType" => Zaly\Proto\Core\CustomType::CustomTypeUser,
                "keySort" => 1,
                "keyConstraint" => "",
                "isRequired" => false,
                "isOpen" => 1,
                "status" => Zaly\Proto\Core\UserCustomStatus::UserCustomNormal,
//                "dataType" => "",
                "dataVerify" => "",
                "addTime" => ZalyHelper::getMsectime(),
            ],
            1 => [
                "customKey" => "email",
                "keyName" => "邮箱",
                "keyDesc" => "邮箱",
                "keyType" => Zaly\Proto\Core\CustomType::CustomTypeUser,
                "keySort" => 2,
                "keyConstraint" => "",
                "isRequired" => false,
                "isOpen" => 1,
                "status" => Zaly\Proto\Core\UserCustomStatus::UserCustomNormal,
//                "dataType" => "",
                "dataVerify" => "",
                "addTime" => ZalyHelper::getMsectime(),
            ],
        ];

        $result = true;
        foreach ($customs as $customArray) {
            try {
                $result = $this->ctx->SiteCustomItemTable->insertUserCustomKeys($customArray) && $result;
            } catch (Exception $e) {
                $this->logger->error($tag, $e);
            }
        }

        return true;
    }

    private function dropSiteCustomItemTable()
    {
        $this->dropDBTable("siteCustomItem");
    }

}