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

        $versionCode = $_POST["versionCode"];

        $oldVersionCode = ZalyConfig::getConfig(ZalyConfig::$configSiteVersionCodeKey);

        if (!is_numeric($oldVersionCode)) {
            $oldVersionCode = 10011;
        }

        if (empty($versionCode)) {
            //给所有的版本
            $newVersionCode = ZalyConfig::getSampleConfig(ZalyConfig::$configSiteVersionCodeKey);
            $this->logger->error("==================", "oldVersion=" . $oldVersionCode . " to newVersion=" . $newVersionCode);

            $versions = [];

            foreach ($this->versions as $code => $name) {
                if ($oldVersionCode >= $code) {
                    $versions[] = [$code => $name];
                }
            }

            echo json_encode($versions);
        } else {
            //检测当前版本是否已经升级完
            $upgradeInfo = $this->getUpgradeVersion();

            $this->logger->error("==================", var_export($upgradeInfo, true));

            echo json_encode($upgradeInfo);
        }

        return;
    }


}