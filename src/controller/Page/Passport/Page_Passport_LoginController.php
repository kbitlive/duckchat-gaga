<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 23/08/2018
 * Time: 11:18 AM
 */

class Page_Passport_LoginController extends  HttpBaseController
{

    public function index()
    {
        $cookieStr = isset($_SERVER['HTTP_COOKIE']) ? $_SERVER['HTTP_COOKIE'] : "";
        $isDuckchat = 0;
        if(strpos($cookieStr, "duckchat_sessionid") !== false) {
            $isDuckchat = 1;
        }
        echo $this->display("passport_login", ['isDuckchat' => $isDuckchat]);
        return;
    }
}