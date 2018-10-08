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
        $cookieStr = $_SERVER['HTTP_COOKIE'];
        $isDuckchat = 0;
        if(strpos($cookieStr, "token") !== false) {
            $isDuckchat = 1;
        }
        echo $this->display("passport_login", ['isDuckchat' => $isDuckchat]);
        return;
    }
}