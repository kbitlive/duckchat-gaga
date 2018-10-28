<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 28/10/2018
 * Time: 11:18 AM
 */

class Api_Passport_PasswordBase extends BaseController
{
    private $classNameForRequest;
    private $maxErrorNum = 5;

    public function rpcRequestClassName()
    {
        return $this->classNameForRequest;
    }

    public function rpc(\Google\Protobuf\Internal\Message $request, \Google\Protobuf\Internal\Message $transportData)
    {
        parent::rpc($request, $transportData);
    }

    public function checkPasswordErrorNum($userId)
    {
        $operateDate = date("Y-m-d", time());
        $count = $this->ctx->PassportPasswordCountLogTable->getCountLogByUserId($userId, $operateDate);

        $loginConfig = $this->ctx->Site_Custom->getLoginAllConfig();
        $passwordErrorNumConfig = isset($loginConfig[LoginConfig::PASSWORD_ERROR_NUM]) ? $loginConfig[LoginConfig::PASSWORD_ERROR_NUM] : "";
        $passwordErrorNum = isset($passwordErrorNumConfig["configValue"]) ? $passwordErrorNumConfig["configValue"] : $this->maxErrorNum;

        if($count>=$passwordErrorNum) {
            $errorInfo = ZalyText::getText("text.pwd.exceedNum", $this->language);
            $this->setRpcError("error.alert", $errorInfo);
            throw new Exception("loginName password is not match");
        }
    }

    public function  insertPassportPasswordLog($user, $type)
    {

        $opreateDate = date("Y-m-d", time());
        $opreateTime = ZalyHelper::getMsectime();
        $userId = $user['userId'];
        $loginName = $user['loginName'];
        $countLogData = [
            "userId" => $userId,
            "num" => 1,
            "operateDate" => $opreateDate,
            "operateTime" => $opreateTime,
        ];
        $updateCountData = [
            "userId" => $userId,
            "operateDate" => $opreateDate,
        ];
        $logData = [
            "userId"      => $userId,
            "loginName"   => $loginName,
            "operateDate" => $opreateDate,
            "operation"   => $type,
            "ip"          => ZalyHelper::getIp(),
            "operateTime" => ZalyHelper::getMsectime(),
        ];

        $this->ctx->PassportPasswordCountLogTable->insertCountLogData($countLogData, $updateCountData, $logData);
    }

}