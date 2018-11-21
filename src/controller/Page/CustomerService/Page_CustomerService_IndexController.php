<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 20/11/2018
 * Time: 10:26 AM
 */

class Page_CustomerService_IndexController extends CustomerServiceController
{
    protected  $thirdLoginKey = 'DuckChat_CustomerService';
    public function index()
    {
        header('Access-Control-Allow-Origin: *');
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        if($method == "post") {
            error_log("loginName-----_POST-----".json_encode($_POST));

            $operation = $_POST['operation'];
            switch ($operation) {
                case "create":
                    $this->createCustomerAccount();
                    break;
                case "login":
                    $this->getLoginGetPreSessionId();
                    break;
                case "addFriend":
                    $this->addCustomerServiceForFriend();
                    break;
            }
            return;
        }
        $params['thirdLoginKey'] = $this->thirdLoginKey;
        echo $this->display("customerService_index", $params);
    }

    //create customer account
    protected function createCustomerAccount()
    {
        try{
            $userId = ZalyHelper::generateStrId();
            $loginName = $_POST['loginName'];
            $userInfo = $this->ctx->PassportCustomerServiceTable->getUserByLoginName($loginName, false);
            if($userInfo) {
                $preSessionId = $this->getPreSessionId($userInfo['userId']);
                if($preSessionId) {
                    echo json_encode(['errorCode' => 'success', 'preSessionId' => $preSessionId, 'loginName' => $loginName]);
                    return;
                }
            } else {
                $userInfo = [
                    'userId'    => $userId,
                    'loginName' => $loginName,
                    'password'  => password_hash($userId, PASSWORD_BCRYPT),
                    'timeReg'   => ZalyHelper::getMsectime(),
                ];
                $this->ctx->PassportCustomerServiceTable->insertUserInfo($userInfo);
                $preSessionId = $this->getPreSessionId($userId);
                if($preSessionId) {
                    echo json_encode(['errorCode' => 'success', 'preSessionId' => $preSessionId, 'loginName' => $loginName]);
                    return;
                }
            }

            echo json_encode(['errorCode' => 'failed']);
        }catch (Exception $ex) {
            echo json_encode(['errorCode' => 'failed']);
        }
    }

    protected function getLoginGetPreSessionId()
    {
        $tag = __CLASS__.'->'.__FUNCTION__;

        try{
            $loginName = $_POST['loginName'];
            $userInfo = $this->ctx->PassportCustomerServiceTable->getUserByLoginName($loginName, false);
            if($userInfo) {
                $flag =  password_verify($userInfo['userId'], $userInfo['password']);
                error_log("password=====".$userInfo['password']."=====userId=====".$userInfo['userId'].'---flag---'.$flag);
                if($flag) {
                    $preSessionId = $this->getPreSessionId($userInfo['userId']);
                    if($preSessionId) {
                        echo json_encode(['errorCode' => 'success', 'preSessionId' => $preSessionId, 'loginName' => $loginName]);
                        return;
                    }
                    echo json_encode(['errorCode' => 'failed']);
                    return;
                }
            }
            $this->createCustomerAccount();
        }catch (Exception $ex) {
            $this->ctx->getLogger()->error($tag, $ex);
            echo json_encode(['errorCode' => 'failed']);
        }
    }
    //generat preSessionId
    protected function getPreSessionId($userId)
    {
        $tag = __CLASS__.'->'.__FUNCTION__;
        try{
            $this->ctx->PassportCustomerServicePreSessionTable->delInfoByUserId($userId);

            $info = [
                "userId" => $userId,
                "preSessionId" => ZalyHelper::generateStrId(),
            ];
            $this->ctx->PassportCustomerServicePreSessionTable->insertPreSessionData($info);
            return $info['preSessionId'];
        }catch (Exception $ex) {
            $this->ctx->getLogger()->error($tag, $ex);
            return '';
        }
    }

    public function addCustomerServiceForFriend()
    {
        $customerServiceId = $this->getCustomerServiceId();
        $customerId = $_POST['customerId'];
        $tag = __CLASS__.'->'.__FUNCTION__;
        try{
            $greetings = '您好，很高兴为您服务';
            $this->ctx->Manual_Friend->addFriend($customerId, $customerServiceId,  $greetings);
            echo json_encode(['customerServiceId' => $customerServiceId]);
        }catch (Exception $ex) {
            $this->ctx->getLogger()->error($tag, $ex);
        }
    }

    public function getCustomerServiceId()
    {
        $results = $this->ctx->CustomerServiceTable->getCustomerServiceLists();
        $serviceId = "";
        if($results) {
            $serviceInfo = $results[0];
            $where = [
                'userId' => $serviceInfo['userId'],
            ];
            $data  = [
               'serviceTime' => ZalyHelper::getMsectime()
            ];
            $this->ctx->CustomerServiceTable->updateCustomerServiceData($where, $data);
            $serviceId = $serviceInfo['userId'];
        }
        return $serviceId;
    }
}