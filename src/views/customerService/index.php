<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>安装</title>
    <!-- Latest compiled and minified CSS -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <script type="text/javascript" src="./public/js/jquery.min.js"></script>
    <script src="./public/js/template-web.js?_version=<?php echo $versionCode?>"></script>
    <script src="./public/js/jquery.i18n.properties.min.js?_version=<?php echo $versionCode?>"></script>
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
    </div>
</div>


<input type="hidden" value='<?php echo $siteAddress;?>' class="siteAddress">

<script src="./public/js/zalyjsHelper.js?_version=<?php echo $versionCode?>"></script>

<script>
    $(".close_chat").on("click", function(){
        $(".chat_dialog_div").attr("type", "display");
        $(".chat_dialog_div")[0].style.display = "block";
    });

    $(".close_chat_png").on("click", function () {
       var type = $(this).attr("type");
       if(type == "hide") {
           $(".chat_dialog_div").attr("type", "display");
           $(".chat_dialog_div")[0].style.display = "block";
       } else {
           $(".chat_dialog_div").attr("type", "hide");
           $(".chat_dialog_div")[0].style.display = "none";
       }
    });
</script>
</body>
</html>
