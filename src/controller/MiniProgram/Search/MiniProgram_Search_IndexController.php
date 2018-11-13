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
    private $defaultPageSize = 30;
    private $title = "核武搜索";

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
        $for = isset($_GET['for']) ? $_GET['for'] : "index";
        $loginName = isset($_GET['key']) ?  $_GET['key'] : "";
        $params['key'] = $loginName;

        if($method == "post") {
            $page = isset($_POST['page']) ? $_POST['page']:1;
            switch ($for) {
                case "user":
                    $userList = $this->ctx->Manual_User->search($this->userId, $loginName, $page, $this->defaultPageSize);
                    echo json_encode(["data" => $userList]);
                    break;
                case "group":
                    break;
            }
        }else {
            switch ($for) {
                case "search":
                    $userList = $this->ctx->Manual_User->search($this->userId, $loginName, 1, 3);
                    $params['users'] = $userList;
                    echo $this->display("miniProgram_search_searchList", $params);
                    break;
                case "user":
                    $userList = $this->ctx->Manual_User->search($this->userId, $loginName, 1, $this->defaultPageSize);
                    $params['users'] = $userList;
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