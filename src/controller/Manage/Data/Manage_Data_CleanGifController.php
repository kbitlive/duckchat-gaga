<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 09/11/2018
 * Time: 1:29 PM
 */

class Manage_Data_CleanGifController extends Manage_CommonController
{

    private $defaultLimit = 200;
    public function doRequest()
    {
        $params = ["lang" => $this->language];

        $method = strtolower($_SERVER['REQUEST_METHOD']);
        if($method == "post") {
            try{
                $gifIds = isset($_POST['delGifIds']) ?  $_POST['delGifIds'] : [];
                if($gifIds) {
                    $this->ctx->SiteUserGifTable->deleteGif($gifIds);
                }
                $result["errCode"] = "success";
            }catch (Exception $ex) {
                $result["errCode"] = "failed";
                $result["errInfo"] = $this->language == 1 ? "删除失败" : "Delete failed";
            }
            echo json_encode($result);
            return;
        }
        $page = isset($_GET['page']) ?  $_GET['page'] : 1;
        $offset = ($page-1)*($this->defaultLimit);
        $results = $this->ctx->SiteUserGifTable->getGifListFromSiteGif($offset, $this->defaultLimit);
        $params['gifs'] = json_encode($results);
        echo $this->display("manage_data_cleanGif", $params);
        return;
    }
}