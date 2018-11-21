<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>安装</title>
    <!-- Latest compiled and minified CSS -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<!--    <link rel=stylesheet href="../../public/css/zaly_msg.css" />-->
    <link rel=stylesheet href="../../public/css/loading.css" />

    <script type="text/javascript" src="./public/js/jquery.min.js"></script>
    <script src="./public/js/im/zalyKey.js?_version=<?php echo $versionCode?>"></script>
    <script src="./public/js/template-web.js?_version=<?php echo $versionCode?>"></script>
    <script src="./public/js/fingerprint2.js"></script>
    <script src="./public/js/zalyjsHelper.js?_version=<?php echo $versionCode?>"></script>
    <script src="./public/js/im/zalyAction.js?_version=<?php echo $versionCode?>"></script>
    <script src="./public/js/service/zalyServiceClient.js?_version=<?php echo $versionCode?>"></script>

    <script src="./public/js/im/zalyBaseWs.js?_version=<?php echo $versionCode?>"></script>
    <script src="./public/js/service/zalyServiceIm.js?_version=<?php echo $versionCode?>"></script>
    <script src="./public/js/service/zalyService.js"></script>

    <style>
        html,body {
            height:100%;
            width:100%;
            font-size: 10.66px;
        }
        .container {
            height:100%;
            width:100%;
            position:relative;
            z-index:99999;
            display: flex;
            align-items: center;
        }
        .box {
            position: absolute;
            right:0px;
            top:0px;
            bottom:0px;
            margin:auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .msg-avatar img {
            width: 4rem;
            height: 4rem;
            border-radius: 10%;
        }
        .close_chat {
            width:40px;
            height:182px;
            background:rgba(52,54,60,1);
            position: relative;
            cursor: pointer;
        }
        .line {
            width:40px;
            height:1px;
            background:rgba(255,255,255,1);
            position: absolute;
            top:40px;
        }
        .chat_png_div {
            display: flex;
            justify-content: center;
            align-items: center;
            width:40px;
            height:44px;
        }
        .chat_png_div img {
            width:24px;
            height:24px;
        }
        .chat_tip {
            margin-top: 8px;
            font-size:14px;
            font-family:PingFangSC-Regular;
            font-weight:400;
            color:rgba(255,255,255,1);
            text-align: center;
        }
        .chat_dialog_div{
            width:320px;
            height:500px;
            background:rgba(255,255,255,1);
            box-shadow:0px 2px 16px 0px rgba(223,223,223,1);
            border-radius:10px 10px 0px 0px;
            position: absolute;
            right:60px;
            bottom:0px;
            margin:0 auto ;
            display: none;
        }
        .chat_title {
            width:320px;
            height:60px;
            background:rgba(52,54,60,1);
            border-radius:10px 10px 0px 0px;
            font-size:20px;
            font-family:PingFangSC-Medium;
            font-weight:500;
            color:rgba(255,255,255,1);
            line-height: 60px;
            text-align: center;
            position: relative;
        }
        .close_chat_png {
            width: 14px;
            height:14px;
            position: absolute;
            top:10px;
            right:10px;
            margin:auto;
            cursor: pointer;
        }
        .right-chatbox {
            width: 100%;
            height:386px;
            flex-grow: 1;
            flex-shrink: 1;
            overflow-y: scroll;
            height: 1;
            overflow-x: hidden;
        }
        .chat_line {
            width:100%;
            height:1px;
            background:rgba(223,223,223,1);
        }
        .chat_bottom_line {
            width:260px;
            height:1px;
            background:rgba(201,201,201,1);
            position: absolute;
            bottom:5px;
            left: 10px;
            margin:auto;
        }
        .chat_box {
            position: relative;
            height:50px;
        }
        .send_msg {
            width: 35px;
            height:35px;
            position: absolute;
            right:10px;
            top:10px;
            margin: 0;
        }
        .msg_content {
            outline: none;
            resize: none;
            border: none;
            flex-grow: 1;
            font-size:14px;
            line-height:20px;
            padding-top: 20px;
            margin-left: 10px;
            height:20px;
            width:260px;
        }
        .msg_status {
            display: flex;
            flex-direction: row-reverse;
        }
        .msg-right .msg-content {
            color: #FFFFFF;
            background: rgba(92,72,207,1);
            border-radius:4px 0px 4px 4px;
        }
        .msg-content {
            font-size: 14px;
            color: #141030;
            width: auto;
            display: inline-block;
            padding: 10px;
            background: rgba(244,244,249,1);
            border-radius:0px 4px 4px 4px;
        }
        .showbox {
            position: relative;
            margin-right: 30px;
        }

        .msg_status_img {
            position: relative;
            display: none;
        }
        .msg-row {
            margin-top: 20px;
            display: flex;
            flex-direction: row;
        }
        .msg-right {
            display: flex;
            flex-direction: row-reverse;
            padding-right: 10px;
            margin-bottom: 20px;
        }
        .text-align-left, .text-align-right {
            text-align: left;
            position: relative;
            word-break: break-all;
            cursor: pointer;
        }

        .text-align-left-text pre, .text-align-right-text pre {
            margin: 0px;
            padding: 0px;
            display: inline;
            white-space: pre-wrap;
        }

        .msg-avatar img {
            width: 40px;
            height: 40px;
            border-radius: 10%;
        }

        .text-align-right {
            text-align: right;
            word-break: break-all;
        }

        .msg-body, .right-msg-body {
            flex-grow: 1;
            padding: 0 10px;
        }

        .msg-left {
            padding-left: 10px;
            padding-right: 10px;
            margin-bottom: 20px;
        }

        msg_status_img {
            position: relative;
            display: none;
        }
        .msg_status_img img {
            position: absolute;
            bottom:0;
            right:1rem;
        }

    </style>
</head>
<body>
<div class="container">
    <div class="box">
        <div class="close_chat">
            <div class="chat_png_div"> <img src="./public/img/service/chat.png"></div>
            <div class="line"></div>
            <div class="chat_tip">在<br>线<br>客<br>服<br>咨<br>询</div>
        </div>
    </div>
    <div class="chat_dialog_div">
        <div class="chat_title">运营团队工作群<img src="./public/img/service/close.png" class="close_chat_png" type="hide"/></div>
        <div class="right-chatbox">
        </div>
        <div class="chat_line"></div>
        <div class="chat_box">
            <img class="send_msg" src="./public/img/service/send.png">
            <div class="chat_bottom_line"></div>
            <div id="msgImage"></div>
            <textarea class="input-box-text msg_content" onkeydown="sendMsgByKeyDown(event)"  placeholder="输入消息…."data-local-placeholder="enterMsgContentPlaceholder"  id="msg_content"></textarea>
        </div>
    </div>
</div>


<input type="hidden" value='<?php echo $thirdLoginKey;?>' class="thirdLoginKey">
<input type="hidden" data='' class="service_token">
<input type="hidden" data='' class="service_self_avatar">
<input type="hidden" data='' class="service_loginName">
<input type="hidden" data='' class="service_nickname">
<input type="hidden" data='' class="service_session_id">
<input type="hidden" value='<?php echo $siteAddress;?>' class="siteAddress">
<?php include(dirname(__DIR__) . '/customerService/template_service.php'); ?>





<script type="text/javascript">

    var serviceSessionKey = "serviceSessionKey";
    var tokenKey    = "tokenKey";
    var avatarKey   = 'avatarKey';
    var nicknameKey = "nicknameKey";
    var fingerPrintVal = "";

    var thirdPartyKey  = $(".thirdLoginKey").val();

    Fingerprint2.get({
        preprocessor: function(key, value) {
            if (key == "canvas") {
                fingerPrintVal = value;
            }
        }
    },function(components) {
       // user_agent component will contain string processed with our function. For example: Windows Chrome
   });
   // var b64 = fingerPrintVal.toDataURL().replace("data:image/png;base64,","");
   var fingerPrintValBase64 = fingerPrintVal[1].replace("canvas fp:data:image/png;base64,", "");
   var bin = atob(fingerPrintValBase64);
   var loginName = bin2hex(bin.slice(-16,-10));
   var binLoginName = loginName;

   var sessionLoginNameKey = "sessionLoginName";

   var sessionLoginName = localStorage.getItem(sessionLoginNameKey);
   var isRegister = false;
   if(sessionLoginName == false || sessionLoginName == undefined || sessionLoginName == null) {
       localStorage.setItem(sessionLoginNameKey, loginName);
       sessionLoginName = loginName;
       isRegister = true;
   } else {
       loginName = sessionLoginName;
   }

   function bin2hex (bin) {
       var i = 0, l = bin.length, chr, hex = '';
       for (i; i < l; ++i) {
           chr = bin.charCodeAt(i).toString(16);
           hex += chr.length < 2 ? '0' + chr : chr
       }
       return hex;
   }


    function getSelfInfoByClassName()
    {
        token = $('.service_token').attr("data");
        nickname = $(".service_nickname").attr("data");
        loginName=$(".service_loginName").attr("data");
        avatar = $(".service_self_avatar").attr("data");
    }


    var token = localStorage.getItem(tokenKey);
    if(token) {
        $(".service_token").attr('data', token);
    }

    var sessionId = localStorage.getItem(serviceSessionKey);

    if(sessionId) {
        $(".service_session_id").attr("data", sessionId);
    }

    var avatar = localStorage.getItem(avatarKey);

    if(avatar) {
        $(".service_avatar").attr("data", avatar);
    }
    var nickname = loginName;
    $(".service_loginName").attr("data", loginName );
    $(".service_nickname").attr("data", nickname );


    $(".close_chat").on("click", function(){
        $(".close_chat_png").click();
    });

    $(".close_chat_png").on("click", function () {
       var type = $(this).attr("type");
       if(type == "hide") {
           showLoading($(".chat_dialog_div"));
           $(this).attr("type", "display");
           $(".chat_dialog_div")[0].style.display = "block";
           createCustomerServiceAccount();
       } else {
           $(this).attr("type", "hide");
           $(".chat_dialog_div")[0].style.display = "none";
       }
    });

    function getMsgForCustomer()
    {
        var chatSessionId = localStorage.getItem(chatSessionIdKey);

        if(chatSessionId == false || chatSessionId == undefined || chatSessionId == null) {
            var requestUrl = "./index.php?action=page.customerService.index";
            token = $(".service_token").attr('data');
            var data = {
                "customerId":token,
                "operation" :'addFriend'
            }
            ajaxPost(requestUrl, data, handleAddCustomerService);
            return;
        }
        getStartChat(chatSessionId);
    }


    function getStartChat(chatSessionId) {
        localStorage.setItem(chatTypeKey, ServiceChat);
        getSelfInfoByClassName();
        $(".right-chatbox").attr("chat-session-id", chatSessionId);
        hideLoading();
        getMsgFromRoom(chatSessionId);
        getSelfInfo();
    }

   function  handleAddCustomerService(result) {
        try{
            hideLoading();
            var result = JSON.parse(result);
            var chatSessionId = result['customerServiceId'];
            localStorage.removeItem(roomKey+chatSessionId);
            localStorage.setItem(chatSessionIdKey, chatSessionId);
            localStorage.setItem(chatSessionId, U2_MSG);
            getStartChat(chatSessionId);
        }catch (error) {
            closeChatDialog();
        }
   }

    function createCustomerServiceAccount()
    {
        var chatSessionId = localStorage.getItem(chatSessionIdKey);
        if(chatSessionId == undefined || chatSessionId == null && chatSessionId ==false) {
            var operation = isRegister == true ? 'create' : "login";
            if(operation == 'create' && sessionLoginName.length>12) {
                sessionLoginName = binLoginName;
            }
            var requestUrl = "./index.php?action=page.customerService.index";
            var data = {
                "loginName":sessionLoginName,
                "operation" :operation
            }

            ajaxPost(requestUrl, data, handleCreateCustomerServiceAccount);
            return;
        }
        getStartChat(chatSessionId);
    }

   function handleCreateCustomerServiceAccount(result)
   {
        var result = JSON.parse(result);
       if(result['errorCode'] == 'success') {
           zalyjsApiSiteLogin(result['preSessionId'], result['loginName']);
       } else {
           alert("链接失败，请稍候再试");
       }
   }

    function getLanguage() {
        var nl = navigator.language;
        if ("zh-cn" == nl || "zh-CN" == nl) {
            return "1";
        }
        return "0";
    }

    function zalyjsApiSiteLogin(preSessionId, loginName) {
       var refererUrl = "./index.php";
       var body = {
           "@type":  "type.googleapis.com/site.ApiSiteLoginRequest",
           "preSessionId":preSessionId,
           "loginName":loginName,
           "isRegister":true,
           "thirdPartyKey":thirdPartyKey,
       };

       var header = {};
       header[HeaderHostUrl] = refererUrl;
       header[HeaderUserClientLang] = getLanguage();
       header[HeaderUserAgent] = navigator.userAgent;
       var packageId = localStorage.getItem("packageId");

       var transportData = {
           "action" : "api.site.login",
           "body": body,
           "header" : header,
           "packageId" : Number(packageId),
       };

       var transportDataJson = JSON.stringify(transportData);
       if (refererUrl.indexOf("?") > -1) {
           var url = refererUrl + "&action=api.site.login&body_format=json";
       } else {
           var url = refererUrl + "?action=api.site.login&body_format=json";
       }

       var http = new XMLHttpRequest();
       http.open('POST', url, true);

       //Send the proper header information along with the request
       http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

       http.onreadystatechange = function() {//Call a function when the state changes.
           if(http.readyState == 4 && http.status == 200) {
               var results = JSON.parse(http.responseText);
               if(results.hasOwnProperty("header") && results.header[HeaderErrorCode] == "success") {
                   var sessionId = results.body['sessionId'];
                   $(".service_session_id").attr("data", sessionId);

                   token = results.body.profile.public['userId'];
                   avatar = results.body.profile.public['avatar'];
                   loginName = results.body.profile.public['loginName'];
                   nickname  = results.body.profile.public['nickname'];

                   localStorage.setItem(serviceSessionKey, sessionId);
                   localStorage.setItem(tokenKey, token);
                   localStorage.setItem(avatarKey,avatar);
                   localStorage.setItem(nicknameKey, nickname);

                   $(".service_token").attr('data', token);
                   $(".service_self_avatar").attr("data",avatar );
                   $(".service_loginName").attr("data", loginName );
                   $(".service_nickname").attr("data", nickname );

                   getMsgForCustomer();
               } else {
                   closeChatDialog();
               }
           }
       }
       http.send(transportDataJson);
   }
    
   function closeChatDialog() {
       localStorage.removeItem(sessionLoginNameKey);
       localStorage.removeItem(serviceSessionKey);
       localStorage.removeItem(tokenKey);
       localStorage.removeItem(avatarKey);
       localStorage.removeItem(nicknameKey);
       alert("请稍候再试");
       hideLoading();
       $(".close_chat_png").click();
   }

    function ajaxPost(requestUrl, data, callback){
        $.ajax({
            method: "POST",
            url:requestUrl,
            data: data,
            success:function (resp, status, request) {
                callback(resp);
            }
        });
    }



</script>
</body>
</html>
