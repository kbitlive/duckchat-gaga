<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 12/11/2018
 * Time: 2:06 PM
 */

class MiniProgram_Search_IndexController extends MiniProgram_BaseController
{

    private $miniProgramId = 200;
    private $defaultPageSize = 200;
    private $title = "核武搜索";
    private $cookieTimeOut = 2592000;//30天 单位s

    public function getMiniProgramId()
    {
        return $this->miniProgramId;
    }

    public function requestException($ex)
    {
        $this->showPermissionPage();
    }

    public function preRequest()
    {
    }

    public function doRequest()
    {
        header('Access-Control-Allow-Origin: *');
        $method = $_SERVER['REQUEST_METHOD'];
        $tag = __CLASS__ . "-" . __FUNCTION__;
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $params['title'] = $this->title;
        $params['loginName'] = $this->loginName;

        if($method == "post") {

        }else {
            $for = isset($_GET['for']) ? $_GET['for'] : "index";
            $key = isset($_GET['key']) ?  $_GET['key'] : "";
            $search['loginName'] = $key;
            $page = isset($_GET['page'] )?$_GET['page']  : 1;
            switch ($for) {
                case "search":
                    $userList = $this->ctx->Manual_User->search($this->userId, $search, 1, 3);
                    $params['users'] = $userList;
                    $params['key'] = $key;
                    echo $this->display("miniProgram_search_searchList", $params);
                    break;
                case "user":
                    $userList = $this->ctx->Manual_User->search($this->userId, $search, $page, $this->defaultPageSize);
                    $params['users'] = $userList;
                    $params['key'] = $key;
                    $this->ctx->Manual_User->search($this->userId, $search, $pageNum = 1, $pageSize = 200);
                    echo $this->display("miniProgram_search_userList", $params);
                    break;
                case "group":
                    echo $this->display("miniProgram_search_groupList", $params);
                    break;
                default:
                    $config = require(dirname(__FILE__)."/recommend.php");
                    $params['recommend_groupids'] = json_encode($config);
                    echo $this->display("miniProgram_search_index", $params);
            }
        }
    }


}