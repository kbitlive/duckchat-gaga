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
        $currentVersionCode = $_POST["versionCode"];

        if (empty($currentVersionCode)) {
            $currentVersionCode = 10011;
        }

        switch ($currentVersionCode) {
            case 10011:
                break;
            case 10012:
                break;
        }

    }

    private function upgrade_10011_10012()
    {

    }
}