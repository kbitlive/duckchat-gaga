<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 12/11/2018
 * Time: 2:06 PM
 */

class MiniProgram_Search_IndexController extends MiniProgram_BaseController
{

    private $gifMiniProgramId = 200;
    private $title = "核武搜索";

    public function getMiniProgramId()
    {
        return $this->gifMiniProgramId;
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

        if($method == "post") {

        }else {
            $for = isset($_GET['for']) ? $_GET['for'] : "index";
            switch ($for) {
                case "search":
                    echo $this->display("miniProgram_search_searchList", $params);
                    break;
                case "user":
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