<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 06/08/2018
 * Time: 11:45 PM
 */

class Site_Login
{
    private $ctx;
    private $zalyError;
    private $sessionVerifyAction = "api.session.verify";
    private $pinyin;
    private $timeOut = 10;
    private $logger;

    public function __construct(BaseCtx $ctx)
    {
        $this->ctx = $ctx;
        $this->logger = $ctx->getLogger();
        $this->zalyError = $this->ctx->ZalyErrorZh;
        $this->pinyin = new \Overtrue\Pinyin\Pinyin();
    }

    /**
     * @param $thirdPartyKey loginKey to choose loginWay
     * @param $preSessionId
     * @param $devicePubkPem
     * @param $clientType
     * @param $userCustomArray
     * @return array|void
     * @throws Exception
     */
    public function doLogin($thirdPartyKey, $preSessionId, $devicePubkPem, $clientType, $userCustomArray)
    {

        if (empty($thirdPartyKey)) {
            //do site passport login
            return $this->loginBySitePassport($preSessionId, $devicePubkPem, $clientType);
        }

        //get third login by thirdPartyKey
        return $this->loginByThirdPary($preSessionId, $devicePubkPem, $clientType);
    }

    //site passport login【本地登陆】
    private function loginBySitePassport($preSessionId, $devicePubkPem, $clientSideType = Zaly\Proto\Core\UserClientType::UserClientMobileApp)
    {
        //实现本地api.session.verify 逻辑
        $loginUserProfile = $this->ctx->Site_SessionVerify->doVerify($preSessionId);

        $this->logger->error("============", "loginUserProfile=" . $loginUserProfile->serializeToJsonString());

        //get intivation first
        $uicInfo = $this->getIntivationCode($loginUserProfile->getInvitationCode());

        $this->logger->error("----------", "uicInfo=" . json_encode($uicInfo, true));

        $userProfile = $this->doSiteLoginAction($loginUserProfile, $devicePubkPem, $uicInfo, $clientSideType, "");

        $this->logger->error("----------===-", "userProfile=" . var_export($userProfile, true));

        return $userProfile;
    }

    /**
     * third party login【第三方登陆】
     *
     * @param $thirdPartyLoginKey
     * @param $preSessionId
     * @param string $devicePubkPem
     * @param int $clientSideType
     * @return array
     * @throws Exception
     */
    public function loginByThirdPary($thirdPartyLoginKey, $preSessionId, $devicePubkPem = "", $clientSideType = Zaly\Proto\Core\UserClientType::UserClientMobileApp)
    {

        try {
            //get site config::publicKey
            $sitePriKeyPem = $this->getSiteConfigPriKeyFromDB();

            $sessionVerifyUrl = ZalyLogin::getVerifyUrl($thirdPartyLoginKey);

            //get userProfile from platform
            $loginUserProfile = $this->getUserProfileFromThirdParty($preSessionId, $sitePriKeyPem, $sessionVerifyUrl);

            //get intivation first
            $uicInfo = $this->getIntivationCode($loginUserProfile->getInvitationCode());

            $userProfile = $this->doSiteLoginAction($loginUserProfile, $devicePubkPem, $uicInfo, $clientSideType, $thirdPartyLoginKey);

            return $userProfile;
        } catch (Exception $ex) {
            $tag = __CLASS__ . "-" . __FUNCTION__;
            $this->ctx->Wpf_Logger->error($tag, " errorMsg = " . $ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }

    /**
     * 获取站点设置
     * @return string
     */
    private function getSiteConfigPriKeyFromDB()
    {
        try {
            $prikKeyPem = $this->ctx->Site_Config->getConfigValue(SiteConfig::SITE_ID_PRIK_PEM);
            return $prikKeyPem;
        } catch (Exception $ex) {
            $tag = __CLASS__ . "-" . __FUNCTION__;
            $this->ctx->Wpf_Logger->error($tag, "errorMsg = " . $ex->getMessage());
            return '';
        }
    }

    private function getUserProfileFromThirdParty($preSessionId, $sitePrikPem, $sessionVerifyUrl)
    {
        $tag = __CLASS__ . '-' . __FUNCTION__;
        try {
            $sessionVerifyRequest = new \Zaly\Proto\Platform\ApiSessionVerifyRequest();
            $sessionVerifyRequest->setPreSessionId($preSessionId);

//            $sessionVerifyUrl = ZalyConfig::getSessionVerifyUrl($pluginId);
            $sessionVerifyUrl = ZalyHelper::getFullReqUrl($sessionVerifyUrl);

            $response = $this->ctx->ZalyCurl->httpRequestByAction('POST', $sessionVerifyUrl, $sessionVerifyRequest, $this->timeOut);

            ///获取数据
            $key = $response->getKey();

            $aesData = $response->getEncryptedProfile();
            $randomKey = $this->ctx->ZalyRsa->decrypt($key, $sitePrikPem);

            $serialize = $this->ctx->ZalyAes->decrypt($aesData, $randomKey);

            //获取LoginUserProfile
            $loginUserProfile = unserialize($serialize);

            return $loginUserProfile;
        } catch (Exception $ex) {
            $errorCode = $this->zalyError->errorSession;
            $errorInfo = $this->zalyError->getErrorInfo($errorCode);
            $this->ctx->Wpf_Logger->error($tag, "api.site.login error=" . $ex);
            throw new Exception($errorInfo);
        }
    }

    /**
     * 处理站点登陆具体逻辑
     *
     * @param Zaly\Proto\Platform\LoginUserProfile $loginUserProfile
     * @param $devicePubkPem
     * @param $uicInfo
     * @param $clientSideType
     * @param $loginKeyId
     * @return array
     * @throws Exception
     */
    private function doSiteLoginAction($loginUserProfile, $devicePubkPem, $uicInfo, $clientSideType, $loginKeyId)
    {
        if (!$loginUserProfile) {
            $errorCode = $this->zalyError->errorSession;
            $errorInfo = $this->zalyError->getErrorInfo($errorCode);
            throw new Exception($errorInfo);
        }
        $nameInLatin = $this->pinyin->permalink($loginUserProfile->getNickName(), "");

        $countryCode = $loginUserProfile->getPhoneCountryCode();

        if (!$countryCode) {
            $countryCode = "86";
        }

        $userProfile = [
            "userId" => $loginUserProfile->getUserId(),
            "loginName" => $loginUserProfile->getLoginName(),
            "nickname" => $loginUserProfile->getNickname(),
            "countryCode" => $countryCode,
            "loginNameLowercase" => strtolower($loginUserProfile->getLoginName()),
            "nicknameInLatin" => $nameInLatin,
            "phoneId" => $loginUserProfile->getPhoneNumber(),
            "timeReg" => $this->ctx->ZalyHelper->getMsectime(),
        ];

        $user = $this->checkUserExists($userProfile);
        if (!$user) {
            //no user ,register new user
            //check user invitation code and realName for phonenumber
            $this->verifyUicAndRealName($loginUserProfile->getUserId(), $loginUserProfile->getPhoneNumber(), $uicInfo);

            //save profile to db
            $userProfile['availableType'] = \Zaly\Proto\Core\UserAvailableType::UserAvailableNormal;
            $userProfile['avatar'] = ZalyAvatar::getRandomAvatar();

            $result = $this->insertSiteUserProfile($userProfile);

            if ($result) {
                $this->ctx->Site_Default->addDefaultFriendsAndGroups($userProfile['userId']);
            } else {
                // #TODO exception
                throw new Exception("insert user profile to db error");
            }
        } else {
            $userProfile['avatar'] = $user['avatar'];
        }

        //这里
        $sessionInfo = $this->insertOrUpdateUserSession($userProfile, $devicePubkPem, $clientSideType, $loginKeyId);
        $userProfile['sessionId'] = $sessionInfo['sessionId'];
        $userProfile['deviceId'] = $sessionInfo['deviceId'];
        return $userProfile;
    }

    private function getIntivationCode($invitationCode)
    {
        if (empty($invitationCode)) {
            return false;
        }
        return $this->ctx->SiteUicTable->queryUicByCode($invitationCode);
    }

    private function checkUserExists($userProfile)
    {
        try {
            $user = $this->ctx->SiteUserTable->getUserByUserId($userProfile["userId"]);
            return $user;
        } catch (Exception $ex) {
            throw new Exception("check user is fail");
        }
    }

    /**
     * @param $userId
     * @param $phoneNumber
     * @param $uicInfo
     * @throws Exception
     */
    private function verifyUicAndRealName($userId, $phoneNumber, $uicInfo)
    {
        $configKeys = [SiteConfig::SITE_ENABLE_INVITATION_CODE, SiteConfig::SITE_ENABLE_REAL_NAME];
        $config = $this->ctx->SiteConfigTable->selectSiteConfig($configKeys);

        if ($config[SiteConfig::SITE_ENABLE_INVITATION_CODE]) {

            if (empty($uicInfo) || $uicInfo['status'] == 0 || $uicInfo['userId']) {
                $errorCode = $this->zalyError->errorInvitationCode;
                $errorInfo = $this->zalyError->getErrorInfo($errorCode);
                throw new Exception($errorInfo);
            }

            //update uic used
            $this->ctx->SiteUicTable->updateUicUsed($uicInfo['code'], $userId);
        }

        if ($config[SiteConfig::SITE_ENABLE_REAL_NAME]) {
            if (!$phoneNumber || !ZalyHelper::isPhoneNumber($phoneNumber)) {
                throw new Exception("phone number is error");
            }
        }
    }

    /**
     * save user profile
     *
     * @param $userProfile
     * @return bool
     * @throws Exception
     */
    private function insertSiteUserProfile($userProfile)
    {
        try {
            return $this->ctx->SiteUserTable->insertUserInfo($userProfile);
        } catch (Exception $e) {
            throw new Exception("insert user is fail");
        }
    }

    /**
     * 更新站点session
     *
     * @param $userProfile
     * @param $devicePubkPem
     * @param $clientSideType
     * @param $loginKeyId
     * @return array
     */
    private function insertOrUpdateUserSession($userProfile, $devicePubkPem, $clientSideType, $loginKeyId)
    {
        $sessionId = $this->ctx->ZalyHelper->generateStrId();
        $deviceId = sha1($devicePubkPem);
        //add session
        $userId = $userProfile["userId"];

        if (!empty($devicePubkPem)) {
            //get session by deviceId
            $this->ctx->SiteSessionTable->deleteSessionByDeviceId($deviceId);
        } else {
            $this->ctx->SiteSessionTable->deleteSessionByUserIdAndDeviceId($userId, $deviceId);
        }

        try {
            $sessionInfo = [
                "sessionId" => $sessionId,
                "userId" => $userId,
                "deviceId" => $deviceId,
                "devicePubkPem" => $devicePubkPem,
                "timeWhenCreated" => $this->ctx->ZalyHelper->getMsectime(),
                "ipActive" => ZalyHelper::getIp(),
                "timeActive" => $this->ctx->ZalyHelper->getMsectime(),
                "ipActive" => ZalyHelper::getIp(),
                "clientSideType" => $clientSideType,
                "loginPluginId" => $loginKeyId,//thirdParty key=loginKey=loginId, same meaning
            ];
            $this->ctx->SiteSessionTable->insertSessionInfo($sessionInfo);
        } catch (Exception $ex) {
            //update session
            $userId = $userProfile["userId"];
            $sessionInfo = [
                "sessionId" => $sessionId,
                "timeActive" => $this->ctx->ZalyHelper->getMsectime(),
                "ipActive" => ZalyHelper::getIp(),
                "clientSideType" => $clientSideType,
                "loginPluginId" => $loginKeyId,
            ];
            $where = [
                "userId" => $userId,
                "deviceId" => $deviceId,
            ];
            $this->ctx->SiteSessionTable->updateSessionInfo($where, $sessionInfo);
        }

        $sessionInfo['sessionId'] = $sessionId;
        $sessionInfo['deviceId'] = $deviceId;
        return $sessionInfo;
    }

}