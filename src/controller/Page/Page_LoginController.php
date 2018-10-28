<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 17/08/2018
 * Time: 3:42 PM
 */

class Page_LoginController extends HttpBaseController
{
    public  $headers;

    public function index()
    {
        $tag = __CLASS__.'->'.__FUNCTION__;
        try{
            $this->checkUserCookie();
            if($this->userId) {
                $apiPageIndex = ZalyConfig::getApiIndexUrl();
                header("Location:" . $apiPageIndex);
                exit();
            }
        } catch (Exception $ex) {
            $this->logger->error($tag, $ex);
        }
        echo $this->display("login_login");
        return;
    }
}