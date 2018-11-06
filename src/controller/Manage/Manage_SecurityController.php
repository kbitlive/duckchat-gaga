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
        echo $this->display("manage_security_quick", $params);
    }

    private function toPageNormalConfig($params)
    {
        echo $this->display("manage_security_normal", $params);
    }


}