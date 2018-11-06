<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 06/11/2018
 * Time: 10:43 AM
 */

class Manage_SecurityController  extends Manage_CommonController
{

    public function doRequest()
    {
        $page = isset($_GET['page']) ? $_GET['page'] : "index";
        $params = ["lang" => $this->language];
        switch ($page) {
            case "index":
                $this->toPageIndex($params);
                break;
            case "quick":
                $this->toPageQuickConfig($params);
                break;

            case "normal":
                $this->toPageNormalConfig($params);
                break;
            default:
                $this->toPageIndex($params);
        }

        return;
    }

    /**
     * @param array $params
     */
    private function toPageIndex($params)
    {
        $loginConfig = $this->ctx->Site_Custom->getLoginAllConfig();

        $passwordErrorNumConfig = $loginConfig[LoginConfig::PASSWORD_ERROR_NUM];
        $passwordErrorNum = isset($passwordErrorNumConfig['configValue']) ? $passwordErrorNumConfig['configValue'] : "5" ;
        $params['passwordErrorNum'] = $passwordErrorNum;
        echo $this->display("manage_security_index", $params);
    }


    private function toPageQuickConfig($params)
    {
        $loginConfig = $this->ctx->Site_Custom->getLoginAllConfig();

        $pwdContainCharacterTypeConfig = $loginConfig[LoginConfig::PASSWORD_CONTAIN_CHARACTER_TYPE];
        $pwdContainCharacterType = isset($pwdContainCharacterTypeConfig['configValue']) ? $pwdContainCharacterTypeConfig['configValue'] : "pwd_default" ;
        $params['pwdContainCharacterType'] = $pwdContainCharacterType;
        echo $this->display("manage_security_quick", $params);
    }

    private function toPageNormalConfig($params)
    {
        $loginConfig = $this->ctx->Site_Custom->getLoginAllConfig();

        $loginNameMinLengthConfig = isset($loginConfig[LoginConfig::LOGINNAME_MINLENGTH]) ? $loginConfig[LoginConfig::LOGINNAME_MINLENGTH] : "";
        $loginNameMinLength = isset($loginNameMinLengthConfig['configValue']) ? $loginNameMinLengthConfig['configValue'] : 5 ;
        $params['loginNameMinLength'] = $loginNameMinLength;

        $loginNameMaxLengthConfig = isset($loginConfig[LoginConfig::LOGINNAME_MAXLENGTH]) ? $loginConfig[LoginConfig::LOGINNAME_MAXLENGTH] : "";
        $loginNameMaxLength= isset($loginNameMaxLengthConfig['configValue']) ? $loginNameMaxLengthConfig['configValue'] : 32 ;
        $params['loginNameMaxLength'] = $loginNameMaxLength;

        $pwdMinLengthConfig = isset( $loginConfig[LoginConfig::PASSWORD_MINLENGTH] )?  $loginConfig[LoginConfig::PASSWORD_MINLENGTH] : "";
        $pwdMinLength = isset($pwdMinLengthConfig['configValue']) ? $pwdMinLengthConfig['configValue'] : 6 ;
        $params['passwordMinLength'] = $pwdMinLength;

        $pwdMaxLengthConfig = isset($loginConfig[LoginConfig::PASSWORD_MAXLENGTH]) ? $loginConfig[LoginConfig::PASSWORD_MAXLENGTH] : "";
        $pwdMaxLength = isset($pwdMaxLengthConfig['configValue']) ? $pwdMaxLengthConfig['configValue'] : 32 ;
        $params['passwordMaxLength'] = $pwdMaxLength;

        $pwdContainCharactersConfig = isset($loginConfig[LoginConfig::PASSWORD_CONTAIN_CHARACTERS]) ? $loginConfig[LoginConfig::PASSWORD_CONTAIN_CHARACTERS] : "";
        $pwdContainCharacters = isset($pwdContainCharactersConfig['configValue']) ? $pwdContainCharactersConfig['configValue'] : "" ;
        $params['passwordContainCharacters'] = $pwdContainCharacters;

        echo $this->display("manage_security_normal", $params);
    }


}