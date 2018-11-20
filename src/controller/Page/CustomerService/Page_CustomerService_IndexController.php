<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 20/11/2018
 * Time: 10:26 AM
 */

class Page_CustomerService_IndexController extends CustomerServiceController {

    public function index()
    {
        header('Access-Control-Allow-Origin: *');
        echo $this->display("customerService_index");
    }

}