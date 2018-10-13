<?php
/**
 * check current version need to upgrade
 * User: anguoyue
 * Date: 13/10/2018
 * Time: 3:54 PM
 */

class Page_Version_PasswordController extends Page_VersionController
{

    function doRequest()
    {
        $password = $_POST["password"];

        //check password for upgrade

        $fileName = $this->getPasswordFileName();

        $passwordFileName = dirname(__FILE__) . "/../../../" . $fileName;

        $this->logger->error("==================", $passwordFileName);

        $serverPassword = file_get_contents($passwordFileName);

        if ($password == $serverPassword) {
            setcookie("upgradePassword", sha1($serverPassword));
            echo "success";
        } else {
            echo "error";
        }

        return;
    }

}