<!DOCTYPE html>

<html lang="ZH">

<head>
    <meta charset="UTF-8">
    <title><?php echo $miniProgramName ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <link rel="stylesheet" href="../../public/jquery/weui.min.css"/>
    <link rel="stylesheet" href="../../public/jquery/jquery-weui.min.css"/>

    <link rel="stylesheet" href="../../public/manage/config.css"/>
</head>

<body>

<div class="wrapper" id="wrapper">

    <div class="layout-all-row">

        <div class="list-item-center">

            <div class="item-row">
                <div class="item-body">
                    <div class="item-body-display loginMiniProgram">
                        <?php if ($lang == "1") { ?>
                            <div class="item-body-desc">登陆小程序ID</div>
                        <?php } else { ?>
                            <div class="item-body-desc">Login MiniProgram ID</div>
                        <?php } ?>

                        <div class="item-body-tail">
                            <div class="item-body-value" id="loginMiniProgramId"> <?php echo $loginPluginId; ?></div>
                            <div class="item-body-value">
                                <img class="more-img" src="../../public/img/manage/more.png"/>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="division-line"></div>

            <div class="item-row">
                <div class="item-body">
                    <div class="item-body-display loginNameAlias" onclick="showLoginNameAlias()">
                        <?php if ($lang == "1") { ?>
                            <div class="item-body-desc">登录名别名</div>
                        <?php } else { ?>
                            <div class="item-body-desc">Alias For LoginName</div>
                        <?php } ?>

                        <div class="item-body-tail">
                            <div class="item-body-value" id="loginNameAliasId"> <?php echo $loginNameAlias; ?></div>
                            <div class="item-body-value">
                                <img class="more-img" src="../../public/img/manage/more.png"/>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="division-line"></div>


            <div class="item-row">
                <div class="item-body">
                    <div class="item-body-display passwordResetWay" onclick="showPasswordResetWay()">
                        <?php if ($lang == "1") { ?>
                            <div class="item-body-desc">密码找回别称</div>
                        <?php } else { ?>
                            <div class="item-body-desc">Password Recovery Alias</div>
                        <?php } ?>

                        <div class="item-body-tail">
                            <div class="item-body-value" id="passwordResetWayId"> <?php echo $passwordResetWay; ?></div>
                            <div class="item-body-value">
                                <img class="more-img" src="../../public/img/manage/more.png"/>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="division-line"></div>

            <div class="item-row">
                <div class="item-body">
                    <div class="item-body-display">
                        <?php if ($lang == "1") { ?>
                            <div class="item-body-desc">密码找回必填</div>
                        <?php } else { ?>
                            <div class="item-body-desc">Password Recovery Required</div>
                        <?php } ?>

                        <div class="item-body-tail">
                            <?php if ($passwordResetRequired == 1) { ?>
                                <input id="passwordResetRequiredSwitch" class="weui_switch" type="checkbox" checked>
                            <?php } else { ?>
                                <input id="passwordResetRequiredSwitch" class="weui_switch" type="checkbox">
                            <?php } ?>
                        </div>
                    </div>

                </div>
            </div>
            <div class="division-line"></div>


            <div class="item-row">
                <div class="item-body">
                    <div class="item-body-display">
                        <?php if ($lang == "1") { ?>
                            <div class="item-body-desc">登陆开启邀请码</div>
                        <?php } else { ?>
                            <div class="item-body-desc">Login By Invite Code</div>
                        <?php } ?>

                        <div class="item-body-tail">
                            <?php if ($enableInvitationCode == 1) { ?>
                                <input id="enableUicSwitch" class="weui_switch" type="checkbox" checked>
                            <?php } else { ?>
                                <input id="enableUicSwitch" class="weui_switch" type="checkbox">
                            <?php } ?>
                        </div>
                    </div>

                </div>
            </div>
            <div class="division-line"></div>

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
            <input type="text" class="popup-group-input" placeholder="please input">
        </div>

        <div class="line"></div>

        <div class="" style="text-align:center;">
            <?php if ($lang == "1") { ?>
                <button id="updatePopupButton" type="button" class="create_button" key-value=""
                        onclick="updateDataValue();">确认
                </button>
            <?php } else { ?>
                <button id="updatePopupButton" type="button" class="create_button" key-value=""
                        onclick="updateDataValue();">Confirm
                </button>
            <?php } ?>
        </div>

    </div>

</div>

<script type="text/javascript" src="../../public/jquery/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../../public/manage/native.js"></script>

<script>

    function showLoginNameAlias() {
        var title = $(".loginNameAlias").find(".item-body-desc").html();
        var inputBody = $("#loginNameAliasId").html();

        showWindow($(".config-hidden"));

        $(".popup-group-title").html(title);
        $(".popup-group-input").val(inputBody);
        $("#updatePopupButton").attr("key-value", "loginNameAlias");
    }

    function showPasswordResetWay() {
        var title = $(".passwordResetWay").find(".item-body-desc").html();
        var inputBody = $("#passwordResetWayId").html();

        showWindow($(".config-hidden"));

        $(".popup-group-title").html(title);
        $(".popup-group-input").val(inputBody);
        $("#updatePopupButton").attr("key-value", "passwordResetWay");
    }

    function showWindow(jqElement) {
        jqElement.css("visibility", "visible");
        $(".wrapper-mask").css("visibility", "visible").append(jqElement);
    }


    function removeWindow(jqElement) {
        jqElement.remove();
        $(".popup-template").append(jqElement);
        $(".wrapper-mask").css("visibility", "hidden");
    }


    $(".wrapper-mask").mouseup(function (e) {
        var targetId = e.target.id;
        var targetClassName = e.target.className;

        if (targetId == "wrapper-mask") {
            var wrapperMask = document.getElementById("wrapper-mask");
            var length = wrapperMask.children.length;
            var i;
            for (i = 0; i < length; i++) {
                var node = wrapperMask.children[i];
                node.remove();
                // addTemplate(node);
                $(".popup-template").append(node);
                $(".popup-template").hide();
            }
            $(".popup-group-input").val("");
            $("#updatePopupButton").attr("data", "");
            wrapperMask.style.visibility = "hidden";
        }
    });

    function updateDataValue() {

        var key = $("#updatePopupButton").attr("key-value");

        var url = "index.php?action=miniProgram.admin.updateLogin";

        var value = $.trim($(".popup-group-input").val());

        var data = {
            'key': key,
            'value': value,
        };

        zalyjsCommonAjaxPostJson(url, data, updateResponse);

        // close
        removeWindow($(".config-hidden"));
    }

    function updateResponse(url, data, result) {
        var res = JSON.parse(result);
        if ("success" == res.errCode) {
            window.location.reload();
        } else {
            alert("error : " + res.errInfo);
        }
    }

    $("#passwordResetRequiredSwitch").change(function () {
        var isChecked = $(this).is(':checked');

        var url = "index.php?action=miniProgram.admin.updateLogin";

        var data = {
            'key': 'passwordResetRequired',
            'value': isChecked ? 1 : 0,
        };

        zalyjsCommonAjaxPostJson(url, data, enableSwitchResponse);
    });

    //update uic
    $("#enableUicSwitch").change(function () {
        var isChecked = $(this).is(':checked');
        var url = "index.php?action=manage.config.update&key=enableInvitationCode";

        var data = {
            'key': 'enableInvitationCode',
            'value': isChecked ? 1 : 0,
        };

        zalyjsCommonAjaxPostJson(url, data, enableSwitchResponse);

    });

    function enableSwitchResponse(url, data, result) {
        if (result) {

            var res = JSON.parse(result);

            if ("success" != res.errCode) {
                var errInfo = res.errInfo;
                var errMsg = (getLanguage() == 1 ? "操作失败,原因：" : "update error, cause:") + errInfo;
                alert(errMsg);
            }

        } else {
            alert(getLanguage() == 1 ? "操作失败" : "update error");
        }
    }

    // loginMiniProgramId item-body-value
    $(".loginMiniProgram").click(function () {
        var miniProgramId = $(this).find("#loginMiniProgramId").html();
        var url = "index.php?action=manage.miniProgram.profile&lang=" + getLanguage() + "&pluginId=" + miniProgramId;
        zalyjsCommonOpenPage(url);
    });

</script>

</body>

</html>