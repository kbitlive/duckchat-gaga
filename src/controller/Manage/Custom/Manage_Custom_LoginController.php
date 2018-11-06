<?php
/**
 * Created by PhpStorm.
 * User: anguoyue
 * Date: 17/10/2018
 * Time: 6:55 PM
 */

class Manage_Custom_LoginController extends Manage_CommonController
{

    /**
     * 处理正式的请求逻辑，比如跳转界面，post获取信息等
     */
    protected function doRequest()
    {
        $params['lang'] = $this->language;

        //2.loginConfig
        $loginConfig = $this->ctx->Site_Custom->getLoginAllConfig();

        $loginWelcomeTextConfig = $loginConfig[LoginConfig::LOGIN_PAGE_WELCOME_TEXT];
        $loginWelcomeText = $loginWelcomeTextConfig["configValue"];

        $loginBackgroundColorConfig = $loginConfig[LoginConfig::LOGIN_PAGE_BACKGROUND_COLOR];
        $loginBackgroundColor = $loginBackgroundColorConfig["configValue"];

        $loginBackgroundImageConfig = $loginConfig[LoginConfig::LOGIN_PAGE_BACKGROUND_IMAGE];
        $loginBackgroundImage = $loginBackgroundImageConfig["configValue"];

        $loginBackgroundImageDisplayConfig = $loginConfig[LoginConfig::LOGIN_PAGE_BACKGROUND_IMAGE_DISPLAY];
        $loginBackgroundImageDisplay = $loginBackgroundImageDisplayConfig["configValue"];

        $params['loginWelcomeText'] = $loginWelcomeText;
        $params['loginBackgroundColor'] = $loginBackgroundColor;
        $params['loginBackgroundImage'] = $loginBackgroundImage;

        if (isset($loginBackgroundImageDisplay)) {
            $params['loginBackgroundImageDisplay'] = $loginBackgroundImageDisplay;
        } else {
            $params['loginBackgroundImageDisplay'] = 0;
        }
        
        echo $this->display("manage_custom_login", $params);

        return;
    }
}