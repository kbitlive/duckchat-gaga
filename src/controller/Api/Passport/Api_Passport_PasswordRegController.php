<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 23/08/2018
 * Time: 2:46 PM
 */

class Api_Passport_PasswordRegController extends BaseController
{
    private $classNameForRequest = '\Zaly\Proto\Site\ApiPassportPasswordRegRequest';
    private $classNameForResponse = '\Zaly\Proto\Site\ApiPassportPasswordRegResponse';

    public function rpcRequestClassName()
    {
        return $this->classNameForRequest;
    }

    /**
     * @param \Zaly\Proto\Site\ApiPassportPasswordRegRequest $request
     * @param \Google\Protobuf\Internal\Message $transportData
     */
    public function rpc(\Google\Protobuf\Internal\Message $request, \Google\Protobuf\Internal\Message $transportData)
    {
        $tag = __CLASS__ . '-' . __FUNCTION__;
        try {
            $loginName = $request->getLoginName();
            $email     = $request->getEmail();
            $password  = $request->getPassword();
            $nickname  = $request->getNickname();
            $sitePubkPem = $request->getSitePubkPem();
            $invitationCode = $request->getInvitationCode();
            $loginConfig = $this->ctx->Site_Custom->getLoginAllConfig();


            $loginNameMinLengthConfig = isset($loginConfig[LoginConfig::LOGINNAME_MINLENGTH]) ? $loginConfig[LoginConfig::LOGINNAME_MINLENGTH] : "";
            $loginNameMinLength = isset($loginNameMinLengthConfig["configValue"]) ? $loginNameMinLengthConfig["configValue"] : 1;

            $loginNameMaxLengthConfig = isset($loginConfig[LoginConfig::LOGINNAME_MAXLENGTH]) ? $loginConfig[LoginConfig::LOGINNAME_MAXLENGTH] : "";
            $loginNameMaxLength = isset($loginNameMaxLengthConfig["configValue"]) ? $loginNameMaxLengthConfig["configValue"] : 24;

            $pwdMaxLengthConfig = isset($loginConfig[LoginConfig::PASSWORD_MAXLENGTH]) ? $loginConfig[LoginConfig::PASSWORD_MAXLENGTH] : "";
            $pwdMaxLength = isset($pwdMaxLengthConfig["configValue"]) ? $pwdMaxLengthConfig["configValue"] : 32;

            $pwdMinLengthConfig = isset($loginConfig[LoginConfig::PASSWORD_MINLENGTH]) ? $loginConfig[LoginConfig::PASSWORD_MINLENGTH] : "";
            $pwdMinLength = isset($pwdMinLengthConfig["configValue"]) ? $pwdMinLengthConfig["configValue"] : 6;

            $pwdContainCharactersConfig = isset($loginConfig[LoginConfig::PASSWORD_CONTAIN_CHARACTERS]) ? $loginConfig[LoginConfig::PASSWORD_CONTAIN_CHARACTERS] : "";
            $pwdContainCharacters = isset($pwdContainCharactersConfig["configValue"]) ? $pwdContainCharactersConfig["configValue"] : "";

            $loginName = trim($loginName);
            if(!$loginName || mb_strlen($loginName)>$loginNameMaxLength || mb_strlen($loginName) < $loginNameMinLength ) {
                $errorCode = $this->zalyError->errorLoginNameLength;
                $errorInfo = $this->zalyError->getErrorInfo($errorCode);
                throw new Exception($errorInfo);
            }

            if(!$password || (strlen($password) > $pwdMaxLength) || (strlen($password) < $pwdMinLength)) {
                $errorCode = $this->zalyError->errorPassowrdLength;
                $errorInfo = $this->zalyError->getErrorInfo($errorCode);
                throw new Exception($errorInfo);
            }

            $flag = ZalyHelper::isPassword($password, $pwdContainCharacters);
            if(!$flag) {
                $errorInfo = ZalyText::getText("text.pwd.type", $this->language);
                throw new Exception($errorInfo);
            }
            $nickname = trim($nickname);
            if(!$nickname) {
                $errorCode = $this->zalyError->errorNicknameLength;
                $errorInfo = $this->zalyError->getErrorInfo($errorCode);
                throw new Exception($errorInfo);
            }

            if(!$sitePubkPem || strlen($sitePubkPem) < 0) {
                $errorCode = $this->zalyError->errorSitePubkPem;
                $errorInfo = $this->zalyError->getErrorInfo($errorCode);
                throw new Exception($errorInfo);
            }

            $passwordResetRequiredConfig = isset($loginConfig[LoginConfig::PASSWORD_RESET_REQUIRED]) ? $loginConfig[LoginConfig::PASSWORD_RESET_REQUIRED] : "";
            $passwordResetRequired = isset($passwordResetRequiredConfig["configValue"]) ? $passwordResetRequiredConfig["configValue"] : "";
            $passwordResetWayConfig = isset($loginConfig[LoginConfig::PASSWORD_RESET_WAY]) ? $loginConfig[LoginConfig::PASSWORD_RESET_WAY] : "";
            $passwordRestWay = isset($passwordResetWayConfig["configValue"]) ? $passwordResetWayConfig["configValue"] : "email ";

            if($passwordResetRequired == 1 && mb_strlen(trim($email))<1) {
                $tip = ZalyText::getText("text.param.void", $this->language);
                $errorInfo = $passwordRestWay." " .$tip;
                $this->setRpcError("error.alert", $errorInfo);
                throw new Exception("$errorInfo  is  not exists");
            }

            $this->checkLoginName($loginName);
            $preSessionId = $this->registerUserForPassport($loginName, $email, $password, $nickname, $invitationCode, $sitePubkPem);
            $response = new \Zaly\Proto\Site\ApiPassportPasswordRegResponse();
            $response->setPreSessionId($preSessionId);
            $this->setRpcError($this->defaultErrorCode, "");
            $this->rpcReturn($transportData->getAction(), $response);
        } catch (Exception $ex) {
            $this->ctx->Wpf_Logger->error($tag, "error_msg=" . $ex);
            $this->setRpcError("error.alert", $ex->getMessage());
            $this->rpcReturn($transportData->getAction(), new $this->classNameForResponse());
        }
    }

    private function checkLoginName($loginName)
    {
        $user = $this->ctx->PassportPasswordTable->getUserByLoginName($loginName);
        if($user){
            $errorCode = $this->zalyError->errorExistLoginName;
            $errorInfo = $this->zalyError->getErrorInfo($errorCode);
            throw new Exception($errorInfo);
        }
    }

    private function registerUserForPassport($loginName, $email, $password, $nickname, $invitationCode, $sitePubkPem)
    {
       try{
           $tag = __CLASS__ . '-' . __FUNCTION__;

           $this->ctx->BaseTable->db->beginTransaction();
           $userId   = ZalyHelper::generateStrId();
           $userInfo = [
               "userId"    => $userId,
               "loginName" => $loginName,
               "email"     => $email,
               "password"  => password_hash($password, PASSWORD_BCRYPT),
               "nickname"  => $nickname,
               "invitationCode" => $invitationCode,
               "timeReg" => ZalyHelper::getMsectime()
           ];
           $this->ctx->PassportPasswordTable->insertUserInfo($userInfo);
           $preSessionId = ZalyHelper::generateStrId();

           $preSessionInfo = [
               "userId" => $userId,
               "preSessionId" => $preSessionId,
               "sitePubkPem" => base64_encode($sitePubkPem)
           ];
           $this->ctx->PassportPasswordPreSessionTable->insertPreSessionData($preSessionInfo);

           $this->ctx->BaseTable->db->commit();
           return $preSessionId;
       }catch (Exception $ex) {
           $this->ctx->Wpf_Logger->error($tag, "error_msg=" . $ex);
           $this->ctx->BaseTable->db->rollback();
           throw new Exception($ex);
       }
    }

}