<?php
/**
 * Created by PhpStorm.
 * User: anguoyue
 * Date: 15/08/2018
 * Time: 4:44 PM
 */

class Site_Config
{

    private $ctx;

    public function __construct(BaseCtx $ctx)
    {
        $this->ctx = $ctx;
    }


    /**
     * @param $configKey
     * @param null $defaultValue
     * @return null
     */
    public function getConfigValue($configKey, $defaultValue = null)
    {
        $configValues = $this->ctx->SiteConfigTable->selectSiteConfig($configKey);
        if ($configValues) {
            return $configValues[$configKey];
        }
        return $defaultValue;
    }

    public function updateConfigValue($configKey, $configValue)
    {
        return $this->ctx->SiteConfigTable->updateSiteConfig($configKey, $configValue);
    }

    public function getFileSizeConfig()
    {
        return $this->getConfigValue(SiteConfig::SITE_FILE_SIZE, 10);
    }

    public function getAllConfig()
    {
        return $this->ctx->SiteConfigTable->selectSiteConfig();
    }

    /**
     * get administrator,site has just one administrator
     * @return null
     */
    public function getSiteOwner()
    {
        $adminValue = $this->ctx->SiteConfigTable->selectSiteConfig(SiteConfig::SITE_OWNER);

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

        $managersValue = $this->ctx->SiteConfigTable->selectSiteConfig(SiteConfig::SITE_MANAGERS);

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
        return $this->ctx->SiteConfigTable->selectSiteConfig([SiteConfig::SITE_DEFAULT_FRIENDS, SiteConfig::SITE_DEFAULT_GROUPS]);
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


    public function addDefaultGroup($groupId, $siteManagerString = false)
    {
        if (!$siteManagerString) {
            $siteManagerString = $this->getSiteManagerString();
        }

        $siteManagerString = $this->buildAddDefaultString($groupId, $siteManagerString);
        return $this->updateConfigValue(SiteConfig::SITE_DEFAULT_GROUPS, $siteManagerString);
    }

    public function removeDefaultGroup($groupId, $siteManagerString = false)
    {
        if (!$siteManagerString) {
            $siteManagerString = $this->getSiteManagerString();
        }

        $siteManagerString = $this->buildRemoveDefaultString($groupId, $siteManagerString);

        if (empty($siteManagerString)) {
            return true;
        }

        return $this->updateConfigValue(SiteConfig::SITE_DEFAULT_GROUPS, $siteManagerString);
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