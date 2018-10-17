<!DOCTYPE html>
<html>

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

    <!--  site basic config  -->
    <div class="layout-all-row">

        <div class="list-item-center">

            <div class="item-row" id="site-name" onclick="showSiteName()">
                <div class="item-body">
                    <div class="item-body-display">

                        <?php if ($lang == "1") { ?>
                            <div class="item-body-desc">登陆页欢迎文案</div>
                        <?php } else { ?>
                            <div class="item-body-desc">Login Page Introduction</div>
                        <?php } ?>

                        <div class="item-body-tail">
                            <div class="item-body-value"><?php echo $name; ?></div>
                            <div class="item-body-value"><img class="more-img"
                                                              src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAnCAYAAAAVW4iAAAABfElEQVRIS8WXvU6EQBCAZ5YHsdTmEk3kJ1j4HDbGxMbG5N7EwkIaCy18DxtygMFopZ3vAdkxkMMsB8v+XqQi2ex8ux/D7CyC8NR1fdC27RoRszAMv8Ux23ccJhZFcQoA9wCQAMAbEd0mSbKxDTzM6wF5nq+CIHgGgONhgIi+GGPXURTlLhDstDRN8wQA5zOB3hljFy66sCzLOyJaL6zSSRdWVXVIRI9EdCaDuOgavsEJY+wFEY8WdmKlS5ZFMo6xrj9AF3EfukaAbcp61TUBdJCdn85J1yzApy4pwJeuRYAPXUqAqy4tgIsubYCtLiOAjS5jgKkuK8BW1w0APCgOo8wKMHcCzoA+AeDSGKA4AXsOEf1wzq/SNH01AtjUKG2AiZY4jj9GXYWqazDVIsZT7sBGizbAVosWwEWLEuCqZRHgQ4sU4EvLLMCnlgnAt5YRYB9aRoD/7q77kivWFlVZ2R2XdtdiyTUNqpNFxl20bBGT7ppz3t12MhctIuwXEK5/O55iCBQAAAAASUVORK5CYII="/>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="division-line"></div>

            <div class="item-row" id="site-name" onclick="showSiteName()">
                <div class="item-body">
                    <div class="item-body-display">

                        <?php if ($lang == "1") { ?>
                            <div class="item-body-desc">登陆页背景颜色</div>
                        <?php } else { ?>
                            <div class="item-body-desc">Login Background Color</div>
                        <?php } ?>

                        <div class="item-body-tail">
                            <div class="item-body-value"><?php echo $name; ?></div>
                            <div class="item-body-value"><img class="more-img"
                                                              src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAnCAYAAAAVW4iAAAABfElEQVRIS8WXvU6EQBCAZ5YHsdTmEk3kJ1j4HDbGxMbG5N7EwkIaCy18DxtygMFopZ3vAdkxkMMsB8v+XqQi2ex8ux/D7CyC8NR1fdC27RoRszAMv8Ux23ccJhZFcQoA9wCQAMAbEd0mSbKxDTzM6wF5nq+CIHgGgONhgIi+GGPXURTlLhDstDRN8wQA5zOB3hljFy66sCzLOyJaL6zSSRdWVXVIRI9EdCaDuOgavsEJY+wFEY8WdmKlS5ZFMo6xrj9AF3EfukaAbcp61TUBdJCdn85J1yzApy4pwJeuRYAPXUqAqy4tgIsubYCtLiOAjS5jgKkuK8BW1w0APCgOo8wKMHcCzoA+AeDSGKA4AXsOEf1wzq/SNH01AtjUKG2AiZY4jj9GXYWqazDVIsZT7sBGizbAVosWwEWLEuCqZRHgQ4sU4EvLLMCnlgnAt5YRYB9aRoD/7q77kivWFlVZ2R2XdtdiyTUNqpNFxl20bBGT7ppz3t12MhctIuwXEK5/O55iCBQAAAAASUVORK5CYII="/>
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
                            <div class="item-body-desc">登陆页 Logo</div>
                        <?php } else { ?>
                            <div class="item-body-desc">Login Page Logo</div>
                        <?php } ?>


                        <div class="item-body-tail">
                            <div class="item-body-value" id="site-logo-fileid">
                                <img class="site-logo-image" onclick="uploadFile('upload-site-logo')"
                                     src="/_api_file_download_/?fileId=<?php echo $logo ?>"
                                     onerror="src='../../public/img/manage/site_default.png'">

                                <input id="upload-site-logo" type="file" onchange="uploadImageFile(this)"
                                       accept="image/gif,image/jpeg,image/jpg,image/png,image/svg"
                                       style="display: none;">
                            </div>
                            <div class="item-body-value"><img class="more-img"
                                                              src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAnCAYAAAAVW4iAAAABfElEQVRIS8WXvU6EQBCAZ5YHsdTmEk3kJ1j4HDbGxMbG5N7EwkIaCy18DxtygMFopZ3vAdkxkMMsB8v+XqQi2ex8ux/D7CyC8NR1fdC27RoRszAMv8Ux23ccJhZFcQoA9wCQAMAbEd0mSbKxDTzM6wF5nq+CIHgGgONhgIi+GGPXURTlLhDstDRN8wQA5zOB3hljFy66sCzLOyJaL6zSSRdWVXVIRI9EdCaDuOgavsEJY+wFEY8WdmKlS5ZFMo6xrj9AF3EfukaAbcp61TUBdJCdn85J1yzApy4pwJeuRYAPXUqAqy4tgIsubYCtLiOAjS5jgKkuK8BW1w0APCgOo8wKMHcCzoA+AeDSGKA4AXsOEf1wzq/SNH01AtjUKG2AiZY4jj9GXYWqazDVIsZT7sBGizbAVosWwEWLEuCqZRHgQ4sU4EvLLMCnlgnAt5YRYB9aRoD/7q77kivWFlVZ2R2XdtdiyTUNqpNFxl20bBGT7ppz3t12MhctIuwXEK5/O55iCBQAAAAASUVORK5CYII="/>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="division-line"></div>

        </div>

    </div>


    <!-- part 2  register && login plugin-->
    <div class="layout-all-row">

        <div class="list-item-center">

            <div class="item-row">
                <div class="item-body">
                    <div class="item-body-display loginMiniProgram">
                        <?php if ($lang == "1") { ?>
                            <div class="item-body-desc">登陆页背景图片</div>
                        <?php } else { ?>
                            <div class="item-body-desc">Login Page Backgroud-image</div>
                        <?php } ?>

                        <div class="item-body-tail">
                            <div class="item-body-value" id="loginMiniProgramId"> <?php echo $loginPluginId; ?></div>
                            <div class="item-body-value"><img class="more-img"
                                                              src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAnCAYAAAAVW4iAAAABfElEQVRIS8WXvU6EQBCAZ5YHsdTmEk3kJ1j4HDbGxMbG5N7EwkIaCy18DxtygMFopZ3vAdkxkMMsB8v+XqQi2ex8ux/D7CyC8NR1fdC27RoRszAMv8Ux23ccJhZFcQoA9wCQAMAbEd0mSbKxDTzM6wF5nq+CIHgGgONhgIi+GGPXURTlLhDstDRN8wQA5zOB3hljFy66sCzLOyJaL6zSSRdWVXVIRI9EdCaDuOgavsEJY+wFEY8WdmKlS5ZFMo6xrj9AF3EfukaAbcp61TUBdJCdn85J1yzApy4pwJeuRYAPXUqAqy4tgIsubYCtLiOAjS5jgKkuK8BW1w0APCgOo8wKMHcCzoA+AeDSGKA4AXsOEf1wzq/SNH01AtjUKG2AiZY4jj9GXYWqazDVIsZT7sBGizbAVosWwEWLEuCqZRHgQ4sU4EvLLMCnlgnAt5YRYB9aRoD/7q77kivWFlVZ2R2XdtdiyTUNqpNFxl20bBGT7ppz3t12MhctIuwXEK5/O55iCBQAAAAASUVORK5CYII="/>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="division-line"></div>

            <div class="item-row">
                <div class="item-body" id="image-display-type" data="<?php echo $pushType ?>">
                    <div class="item-body-display">
                        <?php if ($lang == "1") { ?>
                            <div class="item-body-desc">登陆页背景图片模式</div>
                        <?php } else { ?>
                            <div class="item-body-desc">Login Page backgroud display mode</div>
                        <?php } ?>

                        <div class="item-body-tail">
                            <div class="item-body-value" id="image-display-type-text">
                                <?php if ($pushType == "0") { ?>
                                    <?php if ($lang == "1") { ?> 水平剧种<?php } else { ?> X-Center <?php } ?>
                                <?php } else if ($pushType == "1") { ?>
                                    <?php if ($lang == "1") { ?> 顶部对齐<?php } else { ?> Top <?php } ?>
                                <?php } else if ($pushType == "2") { ?>
                                    <?php if ($lang == "1") { ?> 不重复<?php } else { ?> No Repeat <?php } ?>
                                <?php } ?>
                            </div>
                            <div class="item-body-value"><img class="more-img"
                                                              src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAnCAYAAAAVW4iAAAABfElEQVRIS8WXvU6EQBCAZ5YHsdTmEk3kJ1j4HDbGxMbG5N7EwkIaCy18DxtygMFopZ3vAdkxkMMsB8v+XqQi2ex8ux/D7CyC8NR1fdC27RoRszAMv8Ux23ccJhZFcQoA9wCQAMAbEd0mSbKxDTzM6wF5nq+CIHgGgONhgIi+GGPXURTlLhDstDRN8wQA5zOB3hljFy66sCzLOyJaL6zSSRdWVXVIRI9EdCaDuOgavsEJY+wFEY8WdmKlS5ZFMo6xrj9AF3EfukaAbcp61TUBdJCdn85J1yzApy4pwJeuRYAPXUqAqy4tgIsubYCtLiOAjS5jgKkuK8BW1w0APCgOo8wKMHcCzoA+AeDSGKA4AXsOEf1wzq/SNH01AtjUKG2AiZY4jj9GXYWqazDVIsZT7sBGizbAVosWwEWLEuCqZRHgQ4sU4EvLLMCnlgnAt5YRYB9aRoD/7q77kivWFlVZ2R2XdtdiyTUNqpNFxl20bBGT7ppz3t12MhctIuwXEK5/O55iCBQAAAAASUVORK5CYII="/>
                            </div>
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
            <input type="text" class="popup-group-input"
                   data-local-placeholder="enterGroupNamePlaceholder" placeholder="please input">
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
<script type="text/javascript" src="../../public/jquery/jquery-weui.min.js"></script>
<script type="text/javascript" src="../../public/js/jquery-confirm.js"></script>

<script type="text/javascript" src="../../public/manage/native.js"></script>

<script type="text/javascript">

    function uploadFile(obj) {
        $("#" + obj).val("");
        $("#" + obj).click();
    }


    function uploadImageFile(obj) {

        if (obj) {
            if (obj.files) {
                var formData = new FormData();

                formData.append("file", obj.files.item(0));
                formData.append("fileType", "FileImage");
                formData.append("isMessageAttachment", false);

                var src = window.URL.createObjectURL(obj.files.item(0));

                uploadFileToServer(formData, src);

                //上传以后本地展示的
                $(".site-logo-image").attr("src", src);
            }
            return obj.value;
        }

    }

    function uploadFileToServer(formData, src) {

        var url = "./index.php?action=http.file.uploadWeb";

        if (isMobile()) {
            url = "/_api_file_upload_/?fileType=1";  //fileType=1,表示文件
        }

        $.ajax({
            url: url,
            type: "post",
            data: formData,
            contentType: false,
            processData: false,
            success: function (imageFileIdResult) {

                if (imageFileIdResult) {
                    var fileId = imageFileIdResult;
                    if (isMobile()) {
                        var res = JSON.parse(imageFileIdResult);
                        fileId = res.fileId;
                    }
                    updateSiteLogo(fileId);
                } else {
                    alert(getLanguage() == 1 ? "上传返回结果空 " : "empty response");
                }

            },
            error: function (err) {
                alert("update image error");
                return false;
            }
        });
    }

    function updateSiteLogo(imageFileId) {
        var url = "index.php?action=manage.config.update";
        var data = {
            'key': 'logo',
            'value': imageFileId,
        };
        zalyjsCommonAjaxPostJson(url, data, updateLogoResponse);
    }

    function updateLogoResponse(url, data, result) {
        var res = JSON.parse(result);

        if (res.errCode) {
            var fileId = data.value;
            // showSiteLogo(fileId);
        } else {
            alert("errorInfo:" + res.errInfo);
        }
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

        var url = "index.php?action=manage.config.update&key=" + key;

        var value = $.trim($(".popup-group-input").val());

        var data = {
            'key': key,
            'value': value,
        };

        zalyjsCommonAjaxPostJson(url, data, updateConfigResponse);

        // close
        removeWindow($(".config-hidden"));
    }

    function updateConfigResponse(url, data, result) {
        var res = JSON.parse(result);
        if ("success" == res.errCode) {
            window.location.reload();
        } else {
            alert("error : " + res.errInfo);
        }
    }

    function showSiteName() {
        var title = $("#site-name").find(".item-body-desc").html();
        var inputBody = $("#site-name").find(".item-body-value").html();

        showWindow($(".config-hidden"));

        $(".popup-group-title").html(title);
        $(".popup-group-input").val(inputBody);
        $("#updatePopupButton").attr("key-value", "name");
    }

    $("#group-max-members").click(function () {
        var title = $(this).find(".item-body-desc").html();
        var inputBody = $(this).find(".item-body-value").html();

        showWindow($(".config-hidden"));

        $(".popup-group-title").html(title);
        $(".popup-group-input").val(inputBody);
        $("#updatePopupButton").attr("key-value", "maxGroupMembers");
    });


    //loginMiniProgramId item-body-value
    $(".loginMiniProgram").click(function () {
        var miniProgramId = $(this).find("#loginMiniProgramId").html();
        var url = "index.php?action=manage.miniProgram.profile&lang=" + getLanguage() + "&pluginId=" + miniProgramId;
        zalyjsCommonOpenPage(url);
    });


    $("#image-display-type").click(function () {
        var language = getLanguage();

        /**
         * 0:禁止推送
         * 1:只推送通知
         * 2:推送文本
         */
        $.actions({
            title: "",
            onClose: function () {
                console.log("close");
            },
            actions: [{
                text: language == 0 ? "Show Content" : "显示文本内容",
                className: "select-color-primary",
                onClick: function () {
                    $("#image-display-type-text").html(language == 0 ? "Show Content" : "显示文本内容");
                    $("#image-display-type").attr("data", "2");
                    updateImageDisplayType(2);
                }
            }, {
                text: language == 0 ? "Hide Content" : "不显示文本内容",
                className: "select-color-primary",
                onClick: function () {
                    $("#image-display-type-text").html(language == 0 ? "Hide Content" : "不显示文本内容");
                    $("#image-display-type").attr("data", "1");
                    updateImageDisplayType(1);
                }
            }, {
                text: language == 0 ? "Push Disable" : "禁止推送通知",
                className: "select-color-primary",
                onClick: function () {
                    $("#image-display-type-text").html(language == 0 ? "Push Disable" : "禁止推送通知");
                    $("#image-display-type").attr("data", "0");

                    updateImageDisplayType(0);
                }
            }]
        });
    });

    //update push notice type
    function updateImageDisplayType(pushTypeValue) {
        var url = "index.php?action=manage.config.update";

        var data = {
            'key': 'pushType',
            'value': pushTypeValue,
        };

        zalyjsCommonAjaxPostJson(url, data, updatePushTypeResponse);
    }


    function updatePushTypeResponse(url, data, result) {
        if (result) {

            var res = JSON.parse(result);

            if (!"success" == res.errCode) {
                alert(getLanguage() == 1 ? "操作失败" : "update error");
            }

        } else {
            alert(getLanguage() == 1 ? "操作失败" : "update error");
        }
    }

</script>


</body>
</html>




