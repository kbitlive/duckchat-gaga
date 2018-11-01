<?php
/**
 * Created by PhpStorm.
 * User: anguoyue
 * Date: 15/08/2018
 * Time: 4:44 PM
 */

class Site_Config
{
    //写入缓存文件
    private static $siteConfigCache;

    private $cacheFile;
    private $ctx;

    public function __construct(BaseCtx $ctx)
    {
        $this->ctx = $ctx;
        $cacheKey = ZalyConfig::getConfig("cacheKey");

        if (empty($cacheKey)) {
            ZalyConfig::updateConfig("cacheKey", ZalyHelper::generateStrKey('16'));
        }

        $fileName = "cache-" . $cacheKey . ".php";
        $this->cacheFile = dirname(__FILE__) . "/../../" . $fileName;
    }

    private function updateSiteConfigCache()
    {
        self::$siteConfigCache = $this->ctx->SiteConfigTable->selectSiteConfig();
        $contents = var_export(self::$siteConfigCache, true);
        file_put_contents($this->cacheFile, "<?php\n return {$contents};\n ");
        if (function_exists("opcache_reset")) {
            opcache_reset();
        }
        return true;
    }

    public function getAllConfig()
    {
        if (file_exists($this->cacheFile)) {
            if (empty(self::$siteConfigCache)) {
                self::$siteConfigCache = require($this->cacheFile);
                return self::$siteConfigCache;
            } else {
                return self::$siteConfigCache;
            }
        } else {
            $this->updateSiteConfigCache();
        }
        return $this->ctx->SiteConfigTable->selectSiteConfig();
    }

    /**
     * @param $configKey
     * @param null $defaultValue
     * @return null
     */
    public function getConfigValue($configKey, $defaultValue = null)
    {
        if (empty(self::$siteConfigCache)) {
            $this->getAllConfig();
        }

        $value = self::$siteConfigCache[$configKey];

        if (isset($value)) {
            return $value;
        }
        return $defaultValue;
    }

    public function updateConfigValue($configKey, $configValue)
    {
        $result = $this->ctx->SiteConfigTable->updateSiteConfig($configKey, $configValue);
        if ($result) {
            $this->updateSiteConfigCache();
        }
        return $result;
    }

    public function getFileSizeConfig()
    {
        return $this->getConfigValue(SiteConfig::SITE_FILE_SIZE, 10);
    }

    /**
     * get administrator,site has just one administrator
     * @return null
     */
    public function getSiteOwner()
    {
        $adminValue = $this->getConfigValue(SiteConfig::SITE_OWNER);
        if (isset($adminValue)) {
            return $adminValue[SiteConfig::SITE_OWNER];
        }
        return null;
    }


    public function isSiteOwner($userId)
    {
        $siteOwner = $this->getSiteOwner();
        if (empty($userId) || empty($siteOwner)) {
            return false;
        }

        if ($userId == $siteOwner) {
            return true;
        }
        return false;
    }

    /**
     * get managers ,site has many managers
     *
     * @return array
     */
    public function getSiteManagers()
    {
        $managers = [];

        $admin = $this->getSiteOwner();

        if (isset($admin)) {
            $managers[] = $admin;
        }

        $managersValue = $this->getConfigValue(SiteConfig::SITE_MANAGERS);

        if ($managersValue) {
            $managersValueStr = isset($managersValue['managers']) ? $managersValue['managers'] : "";
            $managersArray = explode(",", $managersValueStr);
            if (!empty($managersArray)) {
                $managers = array_merge($managers, $managersArray);
            }

        }

        return $managers;
    }

    public function isManager($userId)
    {
        if (empty($userId)) {
            return false;
        }

        if (in_array($userId, $this->getSiteManagers())) {
            return true;
        }

    }

    public function getSiteDefaultFriendsAndGroups()
    {

        $siteDefaultFriendList = $this->getConfigValue(SiteConfig::SITE_DEFAULT_FRIENDS);
        $siteDefaultGroupsList = $this->getConfigValue(SiteConfig::SITE_DEFAULT_GROUPS);

        $defaultList = array_merge($siteDefaultFriendList, $siteDefaultGroupsList);

        return $defaultList;
    }

    public function getSiteManagerString($siteConfig = false)
    {
        if (!$siteConfig) {
            $siteConfig = $this->getAllConfig();
        }

        return $siteConfig[SiteConfig::SITE_MANAGERS];
    }

    public function getSiteDefaultFriendString($siteConfig = false)
    {
        if (!$siteConfig) {
            $siteConfig = $this->getAllConfig();
        }

        return $siteConfig[SiteConfig::SITE_DEFAULT_FRIENDS];
    }

    public function getSiteDefaultGroupString($siteConfig = false)
    {

        if (!$siteConfig) {
            $siteConfig = $this->getAllConfig();
        }

        return $siteConfig[SiteConfig::SITE_DEFAULT_GROUPS];
    }

    public function addSiteManager($userId, $siteManagerString = false)
    {
        if (!$siteManagerString) {
            $siteManagerString = $this->getSiteManagerString();
        }

        $siteManagerString = $this->buildAddDefaultString($userId, $siteManagerString);

        return $this->updateConfigValue(SiteConfig::SITE_MANAGERS, $siteManagerString);
    }

    public function removeSiteManager($userId, $siteManagerString = false)
    {
        if (!$siteManagerString) {
            $siteManagerString = $this->getSiteManagerString();
        }

        $siteManagerString = $this->buildRemoveDefaultString($userId, $siteManagerString);

        if (empty($siteManagerString)) {
            return true;
        }

        return $this->updateConfigValue(SiteConfig::SITE_MANAGERS, $siteManagerString);
    }

    public function removeDefaultFriend($userId, $siteDefaultFriendString = false)
    {
        if (!$siteDefaultFriendString) {
            $siteDefaultFriendString = $this->getSiteDefaultFriendString();
        }

        $siteDefaultFriendString = $this->buildRemoveDefaultString($userId, $siteDefaultFriendString);

        if (empty($siteDefaultFriendString)) {
            return true;
        }

        return $this->updateConfigValue(SiteConfig::SITE_DEFAULT_FRIENDS, $siteDefaultFriendString);
    }

    public function addDefaultFriend($userId, $siteDefaultFriendString = false)
    {
        if (!$siteDefaultFriendString) {
            $siteDefaultFriendString = $this->getSiteDefaultFriendString();
        }

        $siteDefaultFriendString = $this->buildAddDefaultString($userId, $siteDefaultFriendString);

        return $this->updateConfigValue(SiteConfig::SITE_DEFAULT_FRIENDS, $siteDefaultFriendString);
    }


    public function addDefaultGroup($groupId, $siteGroupString = false)
    {
        if (!$siteGroupString) {
            $siteGroupString = $this->getSiteDefaultGroupString();
        }

        $siteGroupString = $this->buildAddDefaultString($groupId, $siteGroupString);
        return $this->updateConfigValue(SiteConfig::SITE_DEFAULT_GROUPS, $siteGroupString);
    }

    public function removeDefaultGroup($groupId, $siteGroupString = false)
    {
        if (!$siteGroupString) {
            $siteGroupString = $this->getSiteDefaultGroupString();
        }

        $siteGroupString = $this->buildRemoveDefaultString($groupId, $siteGroupString);

        if (empty($siteGroupString)) {
            return true;
        }

        return $this->updateConfigValue(SiteConfig::SITE_DEFAULT_GROUPS, $siteGroupString);
    }

    private function buildAddDefaultString($addString, $defaultString)
    {
        if (empty($defaultString)) {
            $defaultString = $addString;
        } else {
            $defaultList = explode(",", $defaultString);
            if (!in_array($addString, $defaultList)) {
                $defaultList[] = $addString;
            }
            $defaultString = implode(",", $defaultList);
        }

        return $defaultString;
    }

    private function buildRemoveDefaultString($removeString, $defaultString)
    {
        if (!empty($defaultString)) {
            $defaultList = explode(",", $defaultString);

            if (in_array($removeString, $defaultList)) {
                $defaultList = array_diff($defaultList, [$removeString]);
            }

            $defaultString = implode(",", $defaultList);

        } else {
            $defaultString = "";
        }

        return $defaultString;
    }

}