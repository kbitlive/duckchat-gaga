<!DOCTYPE html>

<html lang="ZH">

<head>
    <meta charset="UTF-8">
    <title><?php if ($lang == "1") { ?>站点设置<?php } else { ?>Site Config<?php } ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

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
                            <div class="item-body-desc">Login Mini Program ID</div>
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

            <!--            <div class="item-row">-->
            <!--                <div class="item-body">-->
            <!--                    <div class="item-body-display">-->
            <!--                        --><?php //if ($lang == "1") { ?>
            <!--                            <div class="item-body-desc">是否开启手机号</div>-->
            <!--                        --><?php //} else { ?>
            <!--                            <div class="item-body-desc">Enable Phone Number</div>-->
            <!--                        --><?php //} ?>
            <!---->
            <!---->
            <!--                        <div class="item-body-tail">-->
            <!--                            <div class="item-body-value">-->
            <!--                                --><?php //if ($enableRealName == 1) { ?>
            <!--                                    <input id="enableRealNameSwitch" class="weui_switch" type="checkbox" checked>-->
            <!--                                --><?php //} else { ?>
            <!--                                    <input id="enableRealNameSwitch" class="weui_switch" type="checkbox">-->
            <!--                                --><?php //} ?>
            <!--                            </div>-->
            <!--                        </div>-->
            <!---->
            <!--                    </div>-->
            <!---->
            <!--                </div>-->
            <!--            </div>-->
            <!--            <div class="division-line"></div>-->

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


<script type="text/javascript" src="../../public/jquery/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../../public/manage/native.js"></script>
<script>

    //update uic
    $("#enableUicSwitch").change(function () {
        var isChecked = $(this).is(':checked');
        var url = "index.php?action=manage.config.update&key=enableInvitationCode";

        var data = {
            'key': 'enableInvitationCode',
            'value': isChecked ? 1 : 0,
        };

        zalyjsCommonAjaxPostJson(url, data, enableUicResponse);

    });

    function enableUicResponse(url, data, result) {
        if (result) {

            var res = JSON.parse(result);

            if (!"success" == res.errCode) {
                alert(getLanguage() == 1 ? "操作失败" : "update error");
            }

        } else {
            alert(getLanguage() == 1 ? "操作失败" : "update error");
        }
    }

    //loginMiniProgramId item-body-value
    $(".loginMiniProgram").click(function () {
        var miniProgramId = $(this).find("#loginMiniProgramId").html();
        var url = "index.php?action=manage.miniProgram.profile&lang=" + getLanguage() + "&pluginId=" + miniProgramId;
        zalyjsCommonOpenPage(url);
    });

</script>

</body>

</html>