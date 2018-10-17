<?php
/**
 * Created by PhpStorm.
 * User: anguoyue
 * Date: 17/10/2018
 * Time: 6:55 PM
 */

class Manage_Custom_PageController extends Manage_CommonController
{

    /**
     * 处理正式的请求逻辑，比如跳转界面，post获取信息等
     */
    protected function doRequest()
    {

        $params['lang'] = $this->language;

        echo $this->display("manage_custom_index", $params);

        return;
    }
}