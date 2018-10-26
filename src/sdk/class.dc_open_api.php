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
    private $bodyFormat = "pb";

    public function __construct()
    {
        $this->zalyAes = new DCZalyAES();
    }

    /**
     *
     * check from site ,if sessionid is valid return user's profile
     *
     * @param $siteAddress
     * @param $duckchatSessionId
     * @param $miniProgramId
     * @param $miniProgramAuthKey
     * @return Zaly\Proto\Core\PublicUserProfile
     * @throws Exception
     */
    public function checkDuckChatSessionProfile($siteAddress, $duckchatSessionId, $miniProgramId, $miniProgramAuthKey)
    {
        $tag = __CLASS__ . "-" . __FUNCTION__;
        try {

            $requestData = new Zaly\Proto\Plugin\DuckChatSessionProfileRequest();
            $requestData->setEncryptedSessionId($duckchatSessionId);

            $response = $this->duckChatMiniProgramRequest($siteAddress,
                $miniProgramId, $miniProgramAuthKey, "duckchat.session.profile", $requestData);

            $this->logger->info($tag, "session profile response=" . $response->serializeToJsonString());

            if (empty($response)) {
                throw new Exception("get empty response by duckchat_sessionid error");
            }

            $userProfile = $response->getProfile();
            return $userProfile->getPublic();
        } catch (Exception $ex) {
            $this->logger->error($tag, "error msg =" . $ex);
            throw $ex;
        }
    }


    /**
     *
     * request site's MiniProgram Api
     *
     * @param $siteAddress http://192.168.3.4
     * @param $miniProgramId
     * @param $action
     * @param $requestProtoData
     * @param $miniProgramAuthKey
     * @return \Google\Protobuf\Internal\Message
     * @throws Exception
     */
    public function duckChatMiniProgramRequest($siteAddress, $miniProgramId,
                                               $miniProgramAuthKey, $action, $requestProtoData)
    {
        $requestUrl = $siteAddress . "/?action=" . $action . "&body_format=" . $this->bodyFormat . "&miniProgramId=" . $miniProgramId;

        $this->logger->info($action, "http request url =" . $requestUrl);

        $requestTransportDataString = $this->buildRequestTransportData($action, $requestProtoData);

        //加密发送
        $encryptedTransportData = $this->zalyAes->encrypt($requestTransportDataString, $miniProgramAuthKey);

        $encryptedHttpTransportResponse = $this->doCurlSiteRequest($encryptedTransportData, $requestUrl, 'POST');

        //解密结果
        $httpResponse = $this->zalyAes->decrypt($encryptedHttpTransportResponse, $miniProgramAuthKey);

        return $this->buildResponseTransportData($action, $httpResponse);
    }

    /**
     * build request transportdata
     * @param $action
     * @param $requestBody
     * @return string
     * @throws Exception
     */
    private function buildRequestTransportData($action, $requestBody)
    {
        $anyBody = new \Google\Protobuf\Any();
        $anyBody->pack($requestBody);

        $transportData = new \Zaly\Proto\Core\TransportData();
        $transportData->setAction($action);
        $transportData->setBody($anyBody);
        $transportData->setTimeMillis($this->getTimeMillis());

        switch ($this->bodyFormat) {
            case "json":
                return $transportData->serializeToJsonString();
            case "pb":
                return $transportData->serializeToString();
            case "base64pb":
                $realData = base64_encode($transportData->serializeToString());
                return $realData;
            default:
                throw new Exception("error http url body_format");
        }
    }

    /**
     * @param $action
     * @param $httpResponse
     * @return \Google\Protobuf\Internal\Message
     * @throws Exception
     */
    private function buildResponseTransportData($action, $httpResponse)
    {
        $responseTransportData = new Zaly\Proto\Core\TransportData();
        switch ($this->bodyFormat) {
            case "json":
                $responseTransportData->mergeFromJsonString($httpResponse);
                break;
            case "pb":
                $responseTransportData->mergeFromString($httpResponse);
                break;
            case "base64pb":
                $realData = base64_decode($httpResponse);
                $responseTransportData->mergeFromString($realData);
                break;
        }

        if ($action != $responseTransportData->getAction()) {
            throw new Exception("response with error action");
        }

        $responseHeader = $responseTransportData->getHeader();

        if (empty($responseHeader)) {
            throw new Exception("response with empty header");
        }

        $errCode = $this->getHeaderValue($responseHeader, TransportDataHeaderKey::HeaderErrorCode);

        if ("success" == $errCode) {
            $responseMessage = $responseTransportData->getBody()->unpack();
            return $responseMessage;
        } else {
            $errInfo = $this->getHeaderValue($responseHeader, TransportDataHeaderKey::HeaderErrorInfo);
            throw new Exception($errInfo);
        }

    }

    private function getHeaderValue($header, $key)
    {
        if (empty($header)) {

        }
        return $header['_' . $key];
    }


    private function doCurlSiteRequest($params, $url, $method)
    {
        $tag = __CLASS__ . '-' . __FUNCTION__;
        try {
            $_curlObj = curl_init();
//            $this->_getRequestParams($params);
//            $this->_setHeader($headers);
//            $this->setRequestMethod($method);
            curl_setopt($_curlObj, CURLOPT_URL, $url);
            curl_setopt($_curlObj, CURLOPT_TIMEOUT, 3);//3s timeout
            curl_setopt($_curlObj, CURLOPT_NOBODY, false);
            curl_setopt($_curlObj, CURLOPT_POST, true);
            curl_setopt($_curlObj, CURLOPT_POSTFIELDS, $params);
            curl_setopt($_curlObj, CURLOPT_RETURNTRANSFER, true);

            if (($resp = curl_exec($_curlObj)) === false) {
                $this->logger->error('when run Router, unexpected error :', curl_error($_curlObj));
                throw new Exception(curl_error($_curlObj));
            }
            curl_close($_curlObj);
            return $resp;
        } catch (\Exception $e) {
            $message = sprintf("msg:%s file:%s:%d", $e->getMessage(), $e->getFile(), $e->getLine());
            $this->logger->error($tag, 'when run Router, unexpected error :', $message);
            throw new Exception($e->getMessage());
        }
    }

    public function getTimeMillis()
    {
        list($msec, $sec) = explode(' ', microtime());
        $msectime = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
        return $msectime;
    }
}