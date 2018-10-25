<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>zalyjs测试工具</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <script type="text/javascript" src="../../../public/js/jquery.min.js"></script>
    <script src="../../../public/sdk/zalyjsNative.js"></script>


    <style>

        .test-tools {
            width: 100%;
            text-align: center;
        }

        .test-button {
            margin-top: 10px;
            width: 80%;
            height: 40px;
            border-width: 0;
            border-radius: 3px;
        }

        #clostButton {
            margin-top: 20px;
            margin-bottom: 20px;
            background-color: red;
            color: white;
        }

        .img-button {
            width: 100%;
            height: 100px;
        }

        .test-img {
            width: 100px;
            height: 100px;
            cursor: pointer;
        }

    </style>
</head>

<body>

<div class="test-tools">

    <button class="test-button" onclick="gotoPage();">跳转url</button>

    <button class="test-button" onclick="gotoNewPage()">打开新页面</button>


    <button class="test-button" onclick="backPage()">返回</button>

    <button class="test-button" id="clostButton" onclick="closePage()">关闭页面</button>

    <!--  上传图片  -->

    <div class="img-button" onclick="uploadImage();">
        <img class="test-img"
             src="http://img.zcool.cn/community/01b6be58fd7f7da8012160f750ebae.JPG@900w_1l_2o_100sh.jpg">
    </div>


    <div style="margin-top: 20px">测试GotoClient工具 Goto：</div>

    <button class="test-button" id="gotoHome" onclick="gotoTest('home','')">Goto首页</button>

    <button class="test-button" id="gotoChats" onclick="gotoTest('chats','')">聊天列表</button>

    <button class="test-button" id="gotoU2Profile" onclick="gotoTest('u2Profile','<?php echo $friendUserId ?>')">用户资料
    </button>

    <button class="test-button" id="gotoU2Msg" onclick="gotoTest('u2Msg','<?php echo $friendUserId ?>')">二人聊天页面</button>

    <button class="test-button" id="gotoGroupProfile" onclick="gotoTest('groupProfile','<?php echo $groupId ?>')">
        群组资料页
    </button>

    <button class="test-button" id="gotoGroupMsg" onclick="gotoTest('groupMsg','<?php echo $groupId ?>')">群组聊天界面
    </button>

    <button class="test-button" id="gotoContracts" onclick="gotoTest('contracts','')">通讯录列表</button>

    <button class="test-button" id="gotoNewFriend" onclick="gotoTest('newFriend','')">新朋友</button>

    <button class="test-button" id="gotoGroups" onclick="gotoTest('groups','')">群组列表</button>


    <button class="test-button" id="gotoAddFriend" onclick="gotoTest('addFriend','<?php echo $applyUserId ?>')">申请添加好友
    </button>

    <button class="test-button" id="gotoMe" onclick="gotoTest('me','')">个人帧</button>

    <button class="test-button" id="gotoMiniProgram" onclick="gotoTest('miniProgram','<?php echo $applyUserId ?>')">
        跳转到小程序首页
    </button>

    <button class="test-button" id="gotoMiniProgramAdmin" onclick="gotoTest('miniProgramAdmin','')">跳转到小程序管理页</button>


</div>

<script>

    function gotoPage() {
        var url = "./index.php?action=miniProgram.test.tools";
        zalyjsOpenPage(url);
    }

    function gotoNewPage() {

        var url = "./index.php?action=miniProgram.test.tools";
        zalyjsOpenNewPage(url);
    }

    function backPage() {
        zalyjsBackPage();
    }

    function closePage() {
        zalyjsClosePage();
    }


    function uploadImage() {

        alert("上传图片");
        zalyjsImageUpload(uploadImageResult);

    }

    function uploadImageResult(result) {
        alert(result.fileId);
        var fileId = result;

        var imageSrc = "./_api_file_download_/test?fileId=" + fileId;
        $(".test-img").attr("src", imageSrc);
    }

    function gotoTest(page, xarg) {
        alert("page=" + page + " xarg=" + xarg);
        zalyjsGoto(page, xarg);
    }

</script>

</body>

</html>
