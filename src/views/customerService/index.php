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
    <style>
        html,body {
            height:100%;
            width:100%;
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
            /*display: none;*/
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
            kkkk
        </div>
        <div class="chat_line"></div>
        <div class="chat_box">
            <img class="send_msg" src="./public/img/service/send.png">
            <div class="chat_bottom_line"></div>
            <div id="msgImage"></div>
            <textarea class="input-box-text msg_content" placeholder="输入消息…."data-local-placeholder="enterMsgContentPlaceholder"  id="msg_content"></textarea>
        </div>
    </div>
</div>

<input type="hidden" data='cd0582bb-fb67-463d-85fe-01f462f8a51b' class="session_id">
<input type="hidden" value='<?php echo $siteAddress;?>' class="siteAddress">
<?php include(dirname(__DIR__) . '/customerService/template_service.php'); ?>

<script src="./public/js/zalyjsHelper.js?_version=<?php echo $versionCode?>"></script>
<script src="./public/js/im/zalyAction.js?_version=<?php echo $versionCode?>"></script>
<script src="./public/js/im/zalyClient.js?_version=<?php echo $versionCode?>"></script>
<script src="./public/js/im/zalyBaseWs.js?_version=<?php echo $versionCode?>"></script>
<script src="./public/js/im/zalyIm.js?_version=<?php echo $versionCode?>"></script>
<script src="./public/js/im/zalyGroupMsg.js"></script>
<script src="./public/js/im/zalyMsg.js"></script>
<script src="./public/js/service/zalyService.js"></script>

<script>
    $(".close_chat").on("click", function(){
        $(".chat_dialog_div").attr("type", "display");
        $(".chat_dialog_div")[0].style.display = "block";
    });

    $(".close_chat_png").on("click", function () {
       var type = $(".chat_dialog_div").attr("type");
       if(type == "hide") {
           $(".chat_dialog_div").attr("type", "display");
           $(".chat_dialog_div")[0].style.display = "block";
       } else {
           $(".chat_dialog_div").attr("type", "hide");
           $(".chat_dialog_div")[0].style.display = "none";
       }
    });


    function getNotMsgImgUrl(avatarImgId) {
       try{
           var filePaths = avatarImgId.split('-');
           var path = "./attachment/"+filePaths[0]+"/"+filePaths[1];
           if(avatarImgId) {
               return  path;
           }
           return false;
       }catch (error) {
           return false;
       }
    }


    localStorage.setItem(chatTypeKey, ServiceChat);
    var roomId = "c7419b68eded7aa30f6af182b2d1f06fd3a0f84c";
    localStorage.setItem(chatSessionIdKey, roomId);
    localStorage.setItem(roomId, U2_MSG);
    getMsgFromRoom(roomId);


</script>
</body>
</html>
