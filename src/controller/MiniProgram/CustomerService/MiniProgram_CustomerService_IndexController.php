<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 21/11/2018
 * Time: 11:09 AM
 */

class MiniProgram_CustomerService_IndexController extends MiniProgram_BaseController
{

    private $gifMiniProgramId = 107;
    private $title = "客服小程序";
    private $defaltGreeting = "您好，很高兴为您服务。";
    private $defaltChatTitle = "客服系统";

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
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $tag = __CLASS__ . "-" . __FUNCTION__;
        $url = ZalyHelper::getRequestAddressPath().'/?action=page.customerService.index';
        $customerServiceCode = <<<CODE
<div style="width:380px;position: fixed; top:0; bottom:0;right:0px;z-index:9000;">
    <iframe src="$url" frameborder="no" height="100%" width="100%">
</div>
CODE;

        if($method == 'get') {
            $settingConfig = $this->getCustomerServiceSetting();
            $settingConfig['lang'] = $this->language;
            $settingConfig['code'] = $customerServiceCode;
            echo $this->display("miniProgram_customerService_index", $settingConfig);
        } else {
            $operation = $_POST['operation'];
            $key = $_POST['key'];
            $value = $_POST['value'];
            switch ($operation) {
                case "update":
                    $flag = $this->updateCustomerServiceSetting($key, $value);
                    echo $flag ? json_encode(['errCode' => 'success']):  json_encode(['errCode' => 'fail']);
                    break;
            }
        }
    }

    protected function getCustomerServiceSetting()
    {
        $settingConfig = [
            MiniProgram_CustomerService_ConfigController::ENABLE_CUSTOMER_SERVICE => "",
            MiniProgram_CustomerService_ConfigController::CHAT_TITLE => $this->defaltChatTitle,
            MiniProgram_CustomerService_ConfigController::GREETING => $this->defaltGreeting,
        ];
        $setting = $this->ctx->SiteCustomerServiceSettingTable->getCustomerServiceSettingLists();
        if($setting) {
            $settingCustomerServiceConfig = array_column($setting, 'serviceValue', 'serviceKey');
            $settingConfig = array_merge($settingConfig, $settingCustomerServiceConfig);
        }
        return $settingConfig;
    }

    protected function updateCustomerServiceSetting($key, $value)
    {
        $flag = false;
        try{
            $info = [
                'serviceKey' => $key,
                'serviceValue' => $value,
            ];
            $flag = $this->ctx->SiteCustomerServiceSettingTable->insertCustomerServiceSettingData($info);
        }catch (Exception $error) {
            $where = [
                'serviceKey' => $key,
            ];
            $data = [
                'serviceValue' => $value,
            ];
            $flag = $this->ctx->SiteCustomerServiceSettingTable->updateCustomerServiceData($where, $data);
        }
        return $flag;
    }
}