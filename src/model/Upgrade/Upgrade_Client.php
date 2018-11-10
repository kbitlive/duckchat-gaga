<?php
/**
 * Created by PhpStorm.
 * User: SAM<an.guoyue254@gmail.com>
 * Date: 2018/11/10
 * Time: 2:54 PM
 */

class Upgrade_Client
{

    public static function doUpgrade($oldVersionCode, $newVersionCode)
    {
        $fileName = "Upgrade_From" . $oldVersionCode . "To" . $newVersionCode . ".php";
        $phpPath = WPF_ROOT_DIR . "/model/Upgrade/" . $fileName;
        error_log("======upgrade file=" . $phpPath);
        include_once($phpPath);
        $upgrade = new $fileName();
        return $upgrade->upgrade();
    }

}