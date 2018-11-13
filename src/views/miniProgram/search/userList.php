<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?php if ($lang == "1") { ?>群组管理<?php } else { ?>Group Management<?php } ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="../../public/manage/config.css"/>
    <link rel="stylesheet" href="../../public/manage/search.css"/>

    <style>
        .item-row-title {
            /*width: 100%;*/
            height: 20px;
            font-size: 14px;
            font-family: PingFangSC-Medium;
            font-weight: 500;
            color: rgba(153, 153, 153, 1);
            line-height: 20px;
            margin: 17px 0px 7px 10px;
        }

        .item-row {
            cursor: pointer;
        }
        #search-group-div {
            text-align: center;
        }
        .show_all_tip {
            height:12px;
            font-size:12px;
            font-family:PingFangSC-Regular;
            font-weight:400;
            color:rgba(127,118,180,1);
            line-height:12px;

        }


        .item-body-display, .item-body-desc, .item-body, .item-row {
            height:56px;
            line-height: 56px;
        }
        .item-header {
            width: 50px;
            height: 56px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .user-avatar-image {
            width:40px;
            height:40px;
        }
        .applyButton, .chatButton  {
            height:28px;
            background:rgba(76,59,177,1);
            border-radius:2px;
            font-size:12px;
            font-family:PingFangSC-Regular;
            font-weight:400;
            color:rgba(255,255,255,1);
            line-height: 28px;
            cursor: pointer;
            outline: none;
            border:1px solid;
        }
    </style>

</head>

<body>

<div class="wrapper" id="wrapper">

    <div class="layout-all-row">

        <div class="list-item-center" style="margin-top: 20px;">
            <div class="item-row-list">

                <?php if(count($users)): ?>
                    <?php foreach ($users as $user):?>
                <div class="item-row">
                    <div class="item-header">
                        <img class="user-avatar-image" avatar="<?php echo $user['avatar'] ?>"
                             src=""
                             onerror="this.src='../../public/img/msg/default_user.png'"/>
                    </div>
                    <div class="item-body">
                        <div class="item-body-display">
                            <div class="item-body-desc" onclick="showUserChat('<?php echo $user["userId"] ?>')">
                                <?php echo $user['loginName']; ?>
                            </div>

                            <div class="item-body-tail">
                                <?php if($user['isFllow']):?>
                                    <button class="chatButton" userId="">
                                        发起会话
                                    </button>
                                <?php else: ?>
                                    <button class="addButton applyButton" userId="">
                                        添加好友
                                    </button>

                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="division-line"></div>
            <?php endforeach;?>
                <?php endif;?>

            </div>
        </div>

    </div>

</div>


<div class="wrapper-mask" id="wrapper-mask" style="visibility: hidden;"></div>

<div class="popup-template" style="display:none;">

    <div class="config-hidden" id="popup-group">

        <div class="flex-container">
            <div class="header_tip_font popup-group-title"></div>
        </div>

        <div class="" style="text-align: center">
            <input type="text" class="popup-group-input"
                   data-local-placeholder="enterGroupNamePlaceholder" placeholder="please input">
        </div>

        <div class="line"></div>

        <div class="" style="text-align:center;">
            <?php if ($lang == "1") { ?>
                <button id="update-user-button" type="button" class="create_button" data=""
                        onclick="sendRequest();">发送
                </button>
            <?php } else { ?>
                <button id="update-user-button" type="button" class="create_button" data=""
                        onclick="sendRequest();">Send
                </button>
            <?php } ?>
        </div>

    </div>

</div>
<input type="hidden" value="<?php echo $loginName;?>" id="myUserId">


<script type="text/javascript" src="../../public/jquery/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../../public/manage/native.js"></script>
<script type="text/javascript">

    var currentPageNum = 1;
    var loading = true;

    $(window).scroll(function () {
        //判断是否滑动到页面底部
        if ($(window).scrollTop() === $(document).height() - $(window).height()) {

            if (!loading) {
                return;
            }

            loadMoreUsers();
        }
    });

    function loadMoreUsers() {

        var data = {
            'pageNum': ++currentPageNum,
        };

        var url = "index.php?action=manage.group";
        zalyjsCommonAjaxPostJson(url, data, loadMoreResponse)
    }

    function showWindow(jqElement) {
        jqElement.css("visibility", "visible");
        $(".wrapper-mask").css("visibility", "visible").append(jqElement);
    }
    function removeWindow(jqElement) {
        jqElement.remove();
        $(".popup-template").append(jqElement);
        $(".wrapper-mask").css("visibility", "hidden");
        $("#update-user-button").attr("data", "");
        $(".popup-group-input").val("");
        $(".popup-template").hide();
    }

    $(".applyButton").on("click", function () {
        var lang = getLanguage();
        var myNickname = $("#myUserId").val();
        var title = lang == 1 ? "申请好友" : "Apply Friend";
        var inputBody = "I'm " + myNickname + ",apply for friend";

        if (lang == 1) {
            inputBody = "我是 " + myNickname + ",申请添加好友";
        }

        var friendId = $(this).attr("userId");

        $("#update-user-button").attr("data", friendId);
        showWindow($(".config-hidden"));

        $(".popup-group-title").html(title);
        $(".popup-group-input").val(inputBody);
    });


    function sendRequest() {
        var friendUserId = $("#update-user-button").attr("data");
        var applyInfo = $(".popup-group-input").val();

        var data = {
            'friendId': friendUserId,
            'greeting': applyInfo
        };

        var url = "index.php?action=miniProgram.search.apply";
        zalyjsCommonAjaxPostJson(url, data, applyResponse)

        removeWindow($(".config-hidden"));
    }


    function applyResponse(url, data, result) {
        var res = JSON.parse(result);

        if (res.errCode != "success") {
            alert(res.errInfo);
        }
    }

    $(".user-avatar-image").each(function () {
        var avatar = $(this).attr("avatar");
        var src = " /_api_file_download_/?fileId=" + avatar;
        if (!isMobile()) {
            src = "./index.php?action=http.file.downloadFile&fileId=" + avatar + "&returnBase64=0";
        }
        $(this).attr("src", src);
    });


</script>




</body>
</html>




