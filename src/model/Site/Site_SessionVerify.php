<?php
/**
 * api.session.verify 接口的本地实现方式
 *
 * 1.API接口，api.session.verify
 * 2.DB接口，Site_SessionVerify
 *
 * User: anguoyue
 * Date: 2018/11/7
 * Time: 5:20 PM
 */

class Site_SessionVerify
{

    private $ctx;
    private $logger;

    public function __construct(BaseCtx $ctx)
    {
        $this->ctx = $ctx;
        $this->logger = $ctx->getLogger();
    }

    public function doVerify($preSessionId)
    {
        $preSessionId = trim($preSessionId);

        if (!$preSessionId) {
            throw new Exception("preSessionId is 404 ");
        }

        $userInfo = $this->ctx->PassportPasswordPreSessionTable->getInfoByPreSessionId($preSessionId);

        if (!$userInfo || !$userInfo['userId']) {
            throw new Exception("user info is empty by preSessionId");
        }

        $loginProfile = $this->buildLoginUserProfile($userInfo);

        $this->deletePreSession($preSessionId);

        return $loginProfile;
    }


    /**
     * @param $userInfo
     * @return \Zaly\Proto\Platform\LoginUserProfile
     * @throws Exception
     */
    private function buildLoginUserProfile($userInfo)
    {
        $tag = __CLASS__ . "-" . __FUNCTION__;
        try {
            $sitePubkPem = base64_decode($userInfo['sitePubkPem']);
            $nickname = $userInfo['nickname'];

            $userId = sha1($userInfo['userId'] . "@" . $sitePubkPem);
            $userProfile = new \Zaly\Proto\Platform\LoginUserProfile();
            $userProfile->setUserId($userId);
            $userProfile->setLoginName($userInfo['loginName']);
            $userProfile->setNickName($nickname);
            $userProfile->setInvitationCode($userInfo['invitationCode']);

            $this->ctx->Wpf_Logger->info("site: api.session.verify", "proto profile=" . $userProfile->serializeToJsonString());
            return $userProfile;
        } catch (Exception $ex) {
            $this->ctx->Wpf_Logger->info($tag, $ex);
            throw $ex;
        }
    }

    private function deletePreSession($preSessionId)
    {
        $tag = __CLASS__ . "->" . __FUNCTION__;
        try {
            return $this->ctx->PassportPasswordPreSessionTable->delInfoByPreSessionId($preSessionId);
        } catch (Exception $e) {
            $this->logger->error($tag, $e);
        }
    }

}