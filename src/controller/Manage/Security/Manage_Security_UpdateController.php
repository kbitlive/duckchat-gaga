<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 06/11/2018
 * Time: 10:52 AM
 */

class Manage_Security_UpdateController extends Manage_CommonController
{
    private $pwdMinLength = 6;
    private $pwdMaxLength = 6;

    public function doRequest()
    {

        $result = [
            'errCode' => "error.alert",
            'errInfo' => "",
        ];

        try {
            $key = $_POST['key'];
            $pwdType = isset($_POST['pwd_type']) ? $_POST['pwd_type']: "pwd_default";
            if($pwdType) {
                $pwdMinLength = 6;
                $pwdMaxLength = 32;
                $pwdErrorNum = 5;
                $pwdContainCharaters = "letter,number";
                switch ($pwdType) {
                    case "pwd_convenience":
                        $pwdContainCharaters = "";
                        $pwdErrorNum = 10;
                        break;
                    case "pwd_security":
                        $pwdContainCharaters = "letter,number,special_characters";
                        $pwdErrorNum = 3;
                        break;
                }
                $resPwdMin = $this->ctx->Site_Custom->updateLoginConfig(LoginConfig::PASSWORD_MINLENGTH, $pwdMinLength, "", $this->userId);
                $resPwdMax = $this->ctx->Site_Custom->updateLoginConfig(LoginConfig::PASSWORD_MAXLENGTH, $pwdMaxLength, "", $this->userId);
                $resPwdErrorNum = $this->ctx->Site_Custom->updateLoginConfig(LoginConfig::PASSWORD_ERROR_NUM, $pwdErrorNum, "", $this->userId);
                $resPwdContainCharaters = $this->ctx->Site_Custom->updateLoginConfig(LoginConfig::PASSWORD_CONTAIN_CHARACTERS, $pwdContainCharaters, "", $this->userId);
                $resPwdContainCharatersType = $this->ctx->Site_Custom->updateLoginConfig(LoginConfig::PASSWORD_CONTAIN_CHARACTER_TYPE, $pwdType, "", $this->userId);

                if($resPwdMin && $resPwdMax && $resPwdErrorNum && $resPwdContainCharaters && $resPwdContainCharatersType) {
                    $result["errCode"] = "success";
                }
                echo json_encode($result);
                return;
            }
            $value = "";
            switch ($key) {
                case LoginConfig::LOGINNAME_MINLENGTH:
                    $loginNameMinLength = $_POST['login_name_min_length'];
                    $value = $loginNameMinLength;
                    $this->checkLoginNameLength();
                    break;
                case LoginConfig::LOGINNAME_MAXLENGTH:
                    $loginNameMaxLength = $_POST['login_name_max_length'];
                    $value = $loginNameMaxLength;
                    $this->checkLoginNameLength();
                    break;
                case LoginConfig::PASSWORD_MINLENGTH:
                    $pwdMinLength = $_POST['pwd_min_length'];
                    $value = $pwdMinLength;
                    $this->checkPwdLength();
                    break;
                case LoginConfig::LOGINNAME_MAXLENGTH:
                    $pwdMaxLength = $_POST['pwd_max_length'];
                    $value = $pwdMaxLength;
                    $this->checkPwdLength();
                    break;
                case LoginConfig::PASSWORD_ERROR_NUM:
                    $value = (int)$_POST['value'];
                    break;
            }
            $res = $this->ctx->Site_Custom->updateLoginConfig($key, $value, "", $this->userId);
            if ($res) {
                $result["errCode"] = "success";
            }

        } catch (Throwable $e) {
            $this->logger->error("manage.security.update", $e);
            $result["errInfo"] = $e->getMessage();
        }

        echo json_encode($result);
        return;
    }

    private function checkLoginNameLength( )
    {
        $loginNameMinLength = $_POST['login_name_min_length'];
        $loginNameMaxLength = $_POST['login_name_max_length'];
        if($loginNameMaxLength<$loginNameMinLength) {
            $info = ZalyText::getText('text.loginName.MaxLengthLessThanMinLength', $this->language);
            throw new Exception($info);
        }
    }

    private function checkPwdLength()
    {
        $pwdMinLength = $_POST['pwd_min_length'];
        $pwdMaxLength = $_POST['pwd_max_length'];
        if($pwdMinLength < $this->pwdMinLength) {
            $info = ZalyText::getText('text.pwd.minLength', $this->language);
            throw new Exception($info);
        }

        if ($pwdMaxLength > $this->pwdMaxLength) {
            $info = ZalyText::getText('text.pwd.maxLength', $this->language);
            throw new Exception($info);
        }

        if($pwdMaxLength<$pwdMinLength) {
            $info = ZalyText::getText('text.pwd.MaxLengthLessThanMinLength', $this->language);
            throw new Exception($info);
        }

    }
}