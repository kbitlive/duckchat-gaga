<?php
/**
 * check current version need to upgrade
 * User: anguoyue
 * Date: 13/10/2018
 * Time: 3:54 PM
 */

class Page_Version_CheckController extends Page_VersionController
{

    public function doRequest()
    {

        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'GET') {
            //给所有的版本

            $fileName = $this->getPasswordFileName();
            $params["passwordFileName"] = $fileName;
            //tell client if need upgrade
            $params["needUpgrade"] = $this->needUpgrade;

            //显示界面
            echo $this->display("upgrade_upgrade", $params);

        } elseif ($method == 'POST') {
            //检测当前版本是否已经升级完
            $upgradeInfo = $this->getUpgradeVersion();

            $this->logger->error("page.version.check", var_export($upgradeInfo, true));

            echo json_encode($upgradeInfo);
        }

        return;
    }

}