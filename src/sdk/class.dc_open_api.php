<?php

use Zaly\Proto\Core\TransportDataHeaderKey;

/**
 *
 * DuckChat小程序开放接口SDK
 *
 * v1.0.14
 *
 * User: anguoyue
 * Date: 11/09/2018
 * Time: 5:43 PM
 */
class DC_Open_Api
{

    private $zalyAes;
    private $bodyFormat = "json";

    public function __construct()
    {
        $this->zalyAes = new DC_Zaly_AES();
    }


    public function getSessionProfile($duckchatSessionId)
    {
        $requestAction = "duckchat.session.profile";
        $requestData = array(
            "action" => $requestAction,
            "body" => array(
                "@type" => "type.googleapis.com/plugin.DuckChatSessionProfileRequest",
                "encryptedSessionId" => $duckchatSessionId
            ),
            "timeMillis" => $this->getTimeMillis(),
        );


        $response = $this->duckChatRequest($requestAction, $requestData);

        if (empty($response)) {
            throw new Exception("get empty response by duckchat_sessionid error");
        }

        //这里需要处理
        $profile = $response;
        return $profile;

    }

    public function getUserProfile($userId)
    {
        $requestAction = "duckchat.user.profile";

        $requestData = array(
            "action" => $requestAction,
            "body" => array(
                "@type" => "type.googleapis.com/plugin.DuckChatUserProfileRequest",
                "userId" => $userId,
            ),
            "timeMillis" => $this->getTimeMillis(),
        );

        $response = $this->duckChatRequest($requestAction, $requestData);

        return $response;
    }

    //get two user relation
    public function getUserRelation($userId, $oppositeUserId)
    {
        $requestAction = "duckchat.user.relation";

        $requestData = array(
            "action" => $requestAction,
            "body" => array(
                "@type" => "type.googleapis.com/plugin.DuckChatUserRelationRequest",
                "userId" => $userId,
                "oppositeUserId" => $oppositeUserId,
            ),
            "timeMillis" => $this->getTimeMillis(),
        );

        $response = $this->duckChatRequest($requestAction, $requestData);

        return $response;
    }

    //send proxy text message
    public function sendTextMessage($isGroup, $fromUserId, $toId, $textBody)
    {
        $requestAction = "duckchat.message.send";

        $requestData = array(
            "action" => $requestAction,
            "body" => array(
                "@type" => "type.googleapis.com/plugin.DuckChatMessageSendRequest",
                "message" => array(
                    "msgId" => $this->buildMessageId($fromUserId),
                    "fromUserId" => $fromUserId,
                    "toUserId" => $isGroup ? "" : $toId,
                    "toGroupId" => $isGroup ? $toId : "",
                    "type" => "MessageText",
                    "roomType" => $isGroup ? "MessageRoomGroup" : "MessageRoomU2",
                    "text" => array(
                        "body" => $textBody,
                    ),
                    "timeServer" => $this->getTimeMillis(),
                ),
            ),
            "timeMillis" => $this->getTimeMillis(),
        );

        $response = $this->duckChatRequest($requestAction, $requestData);

        return true;
    }

    //send notice message
    public function sendNoticeMessage($isGroup, $fromUserId, $toId, $noticeBody)
    {
        $requestAction = "duckchat.message.send";

        $requestData = array(
            "action" => $requestAction,
            "body" => array(
                "@type" => "type.googleapis.com/plugin.DuckChatMessageSendRequest",
                "message" => array(
                    "msgId" => $this->buildMessageId($fromUserId),
                    "fromUserId" => $fromUserId,
                    "toUserId" => $isGroup ? "" : $toId,
                    "toGroupId" => $isGroup ? $toId : "",
                    "type" => "MessageNotice",
                    "roomType" => $isGroup ? "MessageRoomGroup" : "MessageRoomU2",
                    "notice" => array(
                        "body" => $noticeBody,
                    ),
                    "timeServer" => $this->getTimeMillis(),
                ),
            ),
            "timeMillis" => $this->getTimeMillis(),
        );

        $response = $this->duckChatRequest($requestAction, $requestData);

        return true;
    }

    //send web message
    public function sendWebMessage($isGroup, $fromUserId, $toId, $title, $webHtmlCode, $width, $height)
    {
        $requestAction = "duckchat.message.send";

        $requestData = array(
            "action" => $requestAction,
            "body" => array(
                "@type" => "type.googleapis.com/plugin.DuckChatMessageSendRequest",
                "message" => array(
                    "msgId" => $this->buildMessageId($fromUserId),
                    "fromUserId" => $fromUserId,
                    "toUserId" => $isGroup ? "" : $toId,
                    "toGroupId" => $isGroup ? $toId : "",
                    "type" => "MessageWeb",
                    "roomType" => $isGroup ? "MessageRoomGroup" : "MessageRoomU2",
                    "web" => array(
                        "title" => $title,
                        "code" => $webHtmlCode,
                        "width" => $width,
                        "height" => $height,
                    ),
                    "timeServer" => $this->getTimeMillis(),
                ),
            ),
            "timeMillis" => $this->getTimeMillis(),
        );

        $response = $this->duckChatRequest($requestAction, $requestData);

        return true;

    }

    //send web notice message
    public function sendWebNoticeMessage($isGroup, $fromUserId, $toId, $title, $noticeHtmlCode, $height)
    {
        $requestAction = "duckchat.message.send";

        $requestData = array(
            "action" => $requestAction,
            "body" => array(
                "@type" => "type.googleapis.com/plugin.DuckChatMessageSendRequest",
                "message" => array(
                    "msgId" => $this->buildMessageId($isGroup, $fromUserId),
                    "fromUserId" => $fromUserId,
                    "toUserId" => $isGroup ? "" : $toId,
                    "toGroupId" => $isGroup ? $toId : "",
                    "type" => "MessageWebNotice",
                    "roomType" => $isGroup ? "MessageRoomGroup" : "MessageRoomU2",
                    "webNotice" => array(
                        "title" => $title,
                        "code" => $noticeHtmlCode,
                        "height" => $height,
                    ),
                    "timeServer" => $this->getTimeMillis(),
                ),
            ),
            "timeMillis" => $this->getTimeMillis(),
        );

        $response = $this->duckChatRequest($requestAction, $requestData);

        return true;

    }

    protected function duckChatRequest($action, $request)
    {
        $requestUrl = DC_SERVER_ADDRESS . "/?action=" . $action . "&body_format=json&miniProgramId=" . DC_MINI_PROGRAM_ID;

        //json_encode, turn array to string
        $request = json_encode($request);

        //加密发送
        $encryptedRequestData = $this->zalyAes->encrypt($request, DC_MINI_PROGRAM_SECRET_KEY);

        $encryptedResponse = $this->doCurlRequest($encryptedRequestData, $requestUrl, 'POST');

        //解密结果
        $httpResponse = $this->zalyAes->decrypt($encryptedResponse, DC_MINI_PROGRAM_SECRET_KEY);

        return $this->buildResponseData($action, $httpResponse);
    }


    /**
     * @param $action
     * @param $httpResponse
     * @return \Google\Protobuf\Internal\Message
     * @throws Exception
     */
    private function buildResponseData($action, $httpResponse)
    {


        //return reponse json string
        return "";
    }

    private function getHeaderValue($header, $key)
    {
        if (empty($header)) {

        }
        return $header['_' . $key];
    }


    private function doCurlRequest($params, $url, $method)
    {
        $tag = __CLASS__ . '-' . __FUNCTION__;
        try {
            $_curlObj = curl_init();

            curl_setopt($_curlObj, CURLOPT_URL, $url);
            curl_setopt($_curlObj, CURLOPT_TIMEOUT, DC_CURLOPT_TIMEOUT);//3s timeout
            curl_setopt($_curlObj, CURLOPT_NOBODY, false);
            curl_setopt($_curlObj, CURLOPT_POST, true);
            curl_setopt($_curlObj, CURLOPT_POSTFIELDS, $params);
            curl_setopt($_curlObj, CURLOPT_RETURNTRANSFER, true);

            if (($resp = curl_exec($_curlObj)) === false) {
                throw new Exception(curl_error($_curlObj));
            }
            curl_close($_curlObj);
            return $resp;
        } catch (\Exception $e) {
            $this->print_errorLog($tag, $e);
        }
    }


    /******************** tools function ****************/

    /**
     * @param $isGroup 是否是群组消息
     * @param $fromUserId 发送者的userId
     * @return string
     */
    public function buildMessageId($isGroup, $fromUserId)
    {
        $messageId = "U2-";
        if ($isGroup) {
            $messageId = "GP-";
        }

        if (!empty($fromUserId)) {
            $messageId .= substr($fromUserId, 0, 8);
        } else {
            $randomStr = $this->generateStrKey(8);
            $messageId .= $randomStr;
        }

        $messageId .= "-" . $this->getTimeMillis();
        return $messageId;
    }

    /**
     * get current time (ms)
     * @return float
     */
    public function getTimeMillis()
    {
        list($msec, $sec) = explode(' ', microtime());
        $msectime = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
        return $msectime;
    }

    private function print_errorLog($tag, $e)
    {
        error_log($tag . " " . $e->getMessage() . " " . $e->getTraceAsString());
    }

    private function generateStrKey($length = 16, $strParams = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        if (!is_int($length) || $length < 0) {
            $length = 16;
        }

        $str = '';
        for ($i = $length; $i > 0; $i--) {
            $str .= $strParams[mt_rand(0, strlen($strParams) - 1)];
        }

        return $str;
    }
}