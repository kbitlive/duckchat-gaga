<?php
/**
 * check current version need to upgrade
 * User: anguoyue
 * Date: 13/10/2018
 * Time: 3:54 PM
 */

abstract class Page_VersionController extends HttpBaseController
{
    protected $versions = [
        10011 => "1.0.11",

        10012 => "1.0.12"
    ];

    abstract function doRequest();

    public function index()
    {
        $this->initUpgradeVersion();

        $this->doRequest();
    }

    protected function initUpgradeVersion()
    {
        $siteVersion = [
            "versionCode" => 10011,
            "versionName" => "",
            "upgradeErrCode" => "",
            "upgradeErrInfo" => "",
        ];

        $fileName = dirname(__FILE__) . "/../../version.php";
        $contents = var_export($siteVersion, true);
        file_put_contents($fileName, "<?php\n return {$contents};\n ");
    }

    protected function getUpgradeVersion()
    {
        $fileName = dirname(__FILE__) . "/../../version.php";
        if (file_exists($fileName)) {
            $this->initUpgradeVersion();
        }
        $versionArrays = require($fileName);

        return $versionArrays;
    }

    /**
     * @param $versionCode
     * @param $versionName
     * @param $upgradeErrCode success/doing/error
     * @param $upgradeErrInfo
     */
    protected function setUpgradeVersion($versionCode, $versionName, $upgradeErrCode, $upgradeErrInfo)
    {
        $siteVersion = [
            "versionCode" => $versionCode,
            "versionName" => $versionName,
            "upgradeErrCode" => $upgradeErrCode,
            "upgradeErrInfo" => $upgradeErrInfo,
        ];

        $fileName = dirname(__FILE__) . "/../../version.php";
        $contents = var_export($siteVersion, true);
        file_put_contents($fileName, "<?php\n return {$contents};\n ");
    }

}