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
    }

}