<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?php if ($lang == "1") { ?>小程序资料<?php } else { ?>Mini Program Profile<?php } ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="../../public/jquery/weui.min.css"/>
    <link rel="stylesheet" href="../../public/jquery/jquery-weui.min.css"/>
    <link rel="stylesheet" href="../../public/manage/config.css"/>

    <style>

        .site-image {
            width: 30px;
            height: 30px;
            margin-top: 12px;
            /*margin-bottom: 7px;*/
            cursor: pointer;
        }

        .item-body-value {
            margin-right: 5px;
        }

        .select-color-primary {
            color: #4C3BB1;
        }

    </style>

</head>

<body>

<div class="wrapper-mask" id="wrapper-mask" style="visibility: hidden;"></div>

<div class="wrapper" id="wrapper">

    <!--  site basic config  -->
    <div class="layout-all-row">

        <div class="list-item-center">


            <div class="item-row" id="mini-program-id" data="<?php echo $pluginId ?>">
                <div class="item-body">
                    <div class="item-body-display">

                        <div class="item-body-desc">ID</div>

                        <div class="item-body-tail" style="margin-right: 20px">
                            <?php echo $pluginId ?>
                        </div>

                    </div>

                </div>
            </div>
            <div class="division-line"></div>

            <!--      part1: site name      -->
            <div class="item-row" id="mini-program-name" data="<?php $name ?>">
                <div class="item-body">
                    <div class="item-body-display">

                        <?php if ($lang == "1") { ?>
                            <div class="item-body-desc">名称</div>
                            <div class="item-body-tail">
                                <input id="mini-program-name-text" type="text" class="plugin-add-input"
                                       placeholder="请输入小程序名称" value="<?php echo $name ?>">
                            </div>
                        <?php } else { ?>
                            <div class="item-body-desc">Name</div>
                            <div class="item-body-tail">
                                <input id="mini-program-name-text" type="text" class="plugin-add-input"
                                       placeholder="input mini program name" value="<?php echo $name ?>">
                            </div>
                        <?php } ?>


                    </div>

                </div>
            </div>
            <div class="division-line"></div>

            <div class="item-row">
                <div class="item-body">
                    <div class="item-body-display">

                        <?php if ($lang == "1") { ?>
                            <div class="item-body-desc">图标</div>
                        <?php } else { ?>
                            <div class="item-body-desc">Icon</div>
                        <?php } ?>


                        <div class="item-body-tail">
                            <div class="item-body-value" id="mini-program-img-id" fileId="<?php echo $logo ?>">
                                <img id="mini-program-img" class="site-image"
                                     onclick="uploadFile('mini-program-img-input')"
                                     src="/_api_file_download_/?fileId=<?php echo $logo ?>"
                                     onerror="src='../../public/img/manage/plugin_default.png'">

                                <input id="mini-program-img-input" type="file" onchange="uploadImageFile(this)"
                                       accept="image/gif,image/jpeg,image/jpg,image/png,image/svg"
                                       style="display: none;">
                            </div>
                            <img class="more-img"
                                 src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAnCAYAAAAVW4iAAAABfElEQVRIS8WXvU6EQBCAZ5YHsdTmEk3kJ1j4HDbGxMbG5N7EwkIaCy18DxtygMFopZ3vAdkxkMMsB8v+XqQi2ex8ux/D7CyC8NR1fdC27RoRszAMv8Ux23ccJhZFcQoA9wCQAMAbEd0mSbKxDTzM6wF5nq+CIHgGgONhgIi+GGPXURTlLhDstDRN8wQA5zOB3hljFy66sCzLOyJaL6zSSRdWVXVIRI9EdCaDuOgavsEJY+wFEY8WdmKlS5ZFMo6xrj9AF3EfukaAbcp61TUBdJCdn85J1yzApy4pwJeuRYAPXUqAqy4tgIsubYCtLiOAjS5jgKkuK8BW1w0APCgOo8wKMHcCzoA+AeDSGKA4AXsOEf1wzq/SNH01AtjUKG2AiZY4jj9GXYWqazDVIsZT7sBGizbAVosWwEWLEuCqZRHgQ4sU4EvLLMCnlgnAt5YRYB9aRoD/7q77kivWFlVZ2R2XdtdiyTUNqpNFxl20bBGT7ppz3t12MhctIuwXEK5/O55iCBQAAAAASUVORK5CYII="/>
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

            <div class="item-row" id="mini-program-landing-page" data="<?php echo $landingPageUrl ?>">
                <div class="item-body">
                    <div class="item-body-display">
                        <?php if ($lang == "1") { ?>
                            <div class="item-body-desc">落地页URL</div>
                            <div class="item-body-tail">
                                <input id="mini-program-landing-text" type="text" class="plugin-add-input"
                                       placeholder="纯网页小程序请填写页面完整URL" value="<?php echo $landingPageUrl ?>">
                            </div>
                        <?php } else { ?>
                            <div class="item-body-desc">Home Page Url</div>
                            <div class="item-body-tail">
                                <input id="mini-program-landing-text" type="text" class="plugin-add-input"
                                       placeholder="http or proxy url" value="<?php echo $landingPageUrl ?>">
                            </div>
                        <?php } ?>

                    </div>

                </div>
            </div>
            <div class="division-line"></div>

            <!--            <div class="item-row">-->
            <!--                <div class="item-body">-->
            <!--                    <div class="item-body-display">-->
            <!--                        --><?php //if ($lang == "1") { ?>
            <!--                            <div class="item-body-desc">是否开启站点代理请求</div>-->
            <!--                        --><?php //} else { ?>
            <!--                            <div class="item-body-desc">Open Site HTTP Proxy</div>-->
            <!--                        --><?php //} ?>
            <!---->
            <!--                        <div class="item-body-tail">-->
            <!--                            --><?php //if ($landingPageWithProxy == "1") { ?>
            <!--                                <input id="openProxySwitch-text" class="weui_switch" type="checkbox" checked>-->
            <!--                            --><?php //} else { ?>
            <!--                                <input id="openProxySwitch-text" class="weui_switch" type="checkbox">-->
            <!--                            --><?php //} ?>
            <!--                        </div>-->
            <!--                    </div>-->
            <!---->
            <!--                </div>-->
            <!--            </div>-->
            <!--            <div class="division-line"></div>-->

        </div>

    </div>

    <!--   part 3  -->
    <div class="layout-all-row">

        <div class="list-item-center">
            <div class="item-row">
                <div class="item-body">
                    <div class="item-body-display mini-program-usage" data="<?php echo $usageType ?>"
                         onclick="selectMiniProgramUsage();">
                        <?php if ($lang == "1") { ?>
                            <div class="item-body-desc">小程序使用类别</div>
                        <?php } else { ?>
                            <div class="item-body-desc">Mini Program Usage</div>
                        <?php } ?>

                        <div class="item-body-tail">
                            <div id="mini-program-usage-text" style="margin-right: 4px">
                                <?php if ($usageType == "1") { ?>
                                    <?php if ($lang == "1") { ?> 首页小程序<?php } else { ?> Home Mini Program <?php } ?>
                                <?php } else if ($usageType == "2") { ?>
                                    <?php if ($lang == "1") { ?> 登陆小程序<?php } else { ?>  "Login Mini Program" <?php } ?>
                                <?php } else if ($usageType == "3") { ?>
                                    <?php if ($lang == "1") { ?> 二人聊天小程序<?php } else { ?> U2 Chat Mini Program <?php } ?>
                                <?php } else if ($usageType == "4") { ?>
                                    <?php if ($lang == "1") { ?> 临时会话小程序<?php } else { ?> Tmp Chat Mini Program <?php } ?>
                                <?php } else if ($usageType == "5") { ?>
                                    <?php if ($lang == "1") { ?>群组聊天小程序<?php } else { ?> Group Chat Mini Program <?php } ?>
                                <?php } else if ($usageType == "6") { ?>
                                    <?php if ($lang == "1") { ?>账户安全小程序<?php } else { ?> Account Mini Program <?php } ?>
                                <?php } else { ?>
                                    <?php if ($lang == "1") { ?>无效小程序<?php } else { ?> Invalid Mini Program <?php } ?>
                                <?php } ?>
                            </div>
                            <img class="more-img"
                                 src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAnCAYAAAAVW4iAAAABfElEQVRIS8WXvU6EQBCAZ5YHsdTmEk3kJ1j4HDbGxMbG5N7EwkIaCy18DxtygMFopZ3vAdkxkMMsB8v+XqQi2ex8ux/D7CyC8NR1fdC27RoRszAMv8Ux23ccJhZFcQoA9wCQAMAbEd0mSbKxDTzM6wF5nq+CIHgGgONhgIi+GGPXURTlLhDstDRN8wQA5zOB3hljFy66sCzLOyJaL6zSSRdWVXVIRI9EdCaDuOgavsEJY+wFEY8WdmKlS5ZFMo6xrj9AF3EfukaAbcp61TUBdJCdn85J1yzApy4pwJeuRYAPXUqAqy4tgIsubYCtLiOAjS5jgKkuK8BW1w0APCgOo8wKMHcCzoA+AeDSGKA4AXsOEf1wzq/SNH01AtjUKG2AiZY4jj9GXYWqazDVIsZT7sBGizbAVosWwEWLEuCqZRHgQ4sU4EvLLMCnlgnAt5YRYB9aRoD/7q77kivWFlVZ2R2XdtdiyTUNqpNFxl20bBGT7ppz3t12MhctIuwXEK5/O55iCBQAAAAASUVORK5CYII="/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="division-line"></div>

            <div class="item-row" id="mini-program-order">
                <div class="item-body">
                    <div class="item-body-display mini-program-order">
                        <?php if ($lang == "1") { ?>
                            <div class="item-body-desc">排序</div>
                        <?php } else { ?>
                            <div class="item-body-desc">Order</div>
                        <?php } ?>

                        <div class="item-body-tail">
                            <input id="mini-program-order-text" class="plugin-add-input" type="text"
                                   value="<?php echo $sort ?>">
                        </div>
                    </div>

                </div>
            </div>
            <div class="division-line"></div>

            <div class="item-row">
                <div class="item-body">
                    <div class="item-body-display mini-program-display" data="<?php echo $loadingType ?>"
                         onclick="selectMiniProgramDisplay();">
                        <?php if ($lang == "1") { ?>
                            <div class="item-body-desc">打开方式</div>
                        <?php } else { ?>
                            <div class="item-body-desc">Display Mode</div>
                        <?php } ?>

                        <div class="item-body-tail">
                            <div id="mini-program-display-text" style="margin-right: 4px">
                                <?php if ($loadingType == "0") { ?>
                                    <?php if ($lang == "1") { ?> 新页面打开<?php } else { ?> New Page <?php } ?>
                                <?php } else if ($loadingType == "1") { ?>
                                    <?php if ($lang == "1") { ?> 悬浮打开<?php } else { ?> Float Page <?php } ?>
                                <?php } else if ($loadingType == "2") { ?>
                                    <?php if ($lang == "1") { ?> Mask打开<?php } else { ?> Mask Page <?php } ?>
                                <?php } else if ($loadingType == "3") { ?>
                                    <?php if ($lang == "1") { ?> Chatbox打开<?php } else { ?> Chatbox Page <?php } ?>
                                <?php } else if ($loadingType == "4") { ?>
                                    <?php if ($lang == "1") { ?> 全屏打开<?php } else { ?> Full Screen <?php } ?>
                                <?php } ?>
                            </div>

                            <img class="more-img"
                                 src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAnCAYAAAAVW4iAAAABfElEQVRIS8WXvU6EQBCAZ5YHsdTmEk3kJ1j4HDbGxMbG5N7EwkIaCy18DxtygMFopZ3vAdkxkMMsB8v+XqQi2ex8ux/D7CyC8NR1fdC27RoRszAMv8Ux23ccJhZFcQoA9wCQAMAbEd0mSbKxDTzM6wF5nq+CIHgGgONhgIi+GGPXURTlLhDstDRN8wQA5zOB3hljFy66sCzLOyJaL6zSSRdWVXVIRI9EdCaDuOgavsEJY+wFEY8WdmKlS5ZFMo6xrj9AF3EfukaAbcp61TUBdJCdn85J1yzApy4pwJeuRYAPXUqAqy4tgIsubYCtLiOAjS5jgKkuK8BW1w0APCgOo8wKMHcCzoA+AeDSGKA4AXsOEf1wzq/SNH01AtjUKG2AiZY4jj9GXYWqazDVIsZT7sBGizbAVosWwEWLEuCqZRHgQ4sU4EvLLMCnlgnAt5YRYB9aRoD/7q77kivWFlVZ2R2XdtdiyTUNqpNFxl20bBGT7ppz3t12MhctIuwXEK5/O55iCBQAAAAASUVORK5CYII="/>
                        </div>
                    </div>

                </div>
            </div>
            <div class="division-line"></div>

            <div class="item-row">
                <div class="item-body">
                    <div class="item-body-display mini-program-permission" data="<?php echo $permissionType ?>"
                         onclick="selectMiniProgramPermission();">
                        <?php if ($lang == "1") { ?>
                            <div class="item-body-desc">使用权限</div>
                        <?php } else { ?>
                            <div class="item-body-desc">Use Permission</div>
                        <?php } ?>

                        <div class="item-body-tail">

                            <div id="mini-program-permission-text" style="margin-right: 4px">
                                <?php if ($permissionType == "0") { ?>
                                    <?php if ($lang == "1") { ?> 站点管理员可用<?php } else { ?>Site Managers Available<?php } ?>
                                <?php } else if ($permissionType == "1") { ?>
                                    <?php if ($lang == "1") { ?> 所有人可用<?php } else { ?> All Users Available<?php } ?>
                                <?php } else if ($permissionType == "2") { ?>
                                    <?php if ($lang == "1") { ?> 群管理员可用<?php } else { ?> Group Managers Available<?php } ?>
                                <?php } ?>
                            </div>

                            <img class="more-img"
                                 src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAnCAYAAAAVW4iAAAABfElEQVRIS8WXvU6EQBCAZ5YHsdTmEk3kJ1j4HDbGxMbG5N7EwkIaCy18DxtygMFopZ3vAdkxkMMsB8v+XqQi2ex8ux/D7CyC8NR1fdC27RoRszAMv8Ux23ccJhZFcQoA9wCQAMAbEd0mSbKxDTzM6wF5nq+CIHgGgONhgIi+GGPXURTlLhDstDRN8wQA5zOB3hljFy66sCzLOyJaL6zSSRdWVXVIRI9EdCaDuOgavsEJY+wFEY8WdmKlS5ZFMo6xrj9AF3EfukaAbcp61TUBdJCdn85J1yzApy4pwJeuRYAPXUqAqy4tgIsubYCtLiOAjS5jgKkuK8BW1w0APCgOo8wKMHcCzoA+AeDSGKA4AXsOEf1wzq/SNH01AtjUKG2AiZY4jj9GXYWqazDVIsZT7sBGizbAVosWwEWLEuCqZRHgQ4sU4EvLLMCnlgnAt5YRYB9aRoD/7q77kivWFlVZ2R2XdtdiyTUNqpNFxl20bBGT7ppz3t12MhctIuwXEK5/O55iCBQAAAAASUVORK5CYII="/>
                        </div>
                    </div>

                </div>
            </div>
            <div class="division-line"></div>

            <div class="item-row">
                <div class="item-body">
                    <div class="item-body-display mini-program-secret-key">
                        <?php if ($lang == "1") { ?>
                            <div class="item-body-desc">安全秘钥</div>
                        <?php } else { ?>
                            <div class="item-body-desc">Secret Key</div>
                        <?php } ?>

                        <div class="item-body-tail" style="margin-right: 25px">
                            <?php echo $authKey ?>
                        </div>
                    </div>

                </div>
            </div>
            <div class="division-line"></div>

        </div>

    </div>

    <div class="layout-all-row">

        <div class="list-item-center">
            <div class="item-row">
                <div class="item-body">
                    <div class="item-body-display">

                        <?php if ($lang == "1") { ?>
                            <div class="item-body-desc">小程序管理</div>
                            <div class="item-body-tail">
                                <input id="mini-program-management-text" type="text" class="plugin-add-input"
                                       placeholder="请输入小程序管理地址" value="<?php echo $management ?>">
                            </div>
                        <?php } else { ?>
                            <div class="item-body-desc">Management</div>
                            <div class="item-body-tail">
                                <input id="mini-program-management-text" type="text" class="plugin-add-input"
                                       placeholder="miniProgram management url" value="<?php echo $management ?>">
                            </div>
                        <?php } ?>


                    </div>
                </div>
            </div>

            <div class="division-line"></div>

        </div>
    </div>

    <div class="layout-all-row">

        <div class="list-item-center">

            <div class="item-row">
                <div class="item-body">
                    <div class="item-body-display" onclick="deleteMiniProgram();">
                        <?php if ($lang == "1") { ?>
                            <div class="item-body-desc">删除小程序</div>
                        <?php } else { ?>
                            <div class="item-body-desc">Delte Mini Program</div>
                        <?php } ?>

                        <div class="item-body-tail">
                            <img class="more-img"
                                 src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAnCAYAAAAVW4iAAAABfElEQVRIS8WXvU6EQBCAZ5YHsdTmEk3kJ1j4HDbGxMbG5N7EwkIaCy18DxtygMFopZ3vAdkxkMMsB8v+XqQi2ex8ux/D7CyC8NR1fdC27RoRszAMv8Ux23ccJhZFcQoA9wCQAMAbEd0mSbKxDTzM6wF5nq+CIHgGgONhgIi+GGPXURTlLhDstDRN8wQA5zOB3hljFy66sCzLOyJaL6zSSRdWVXVIRI9EdCaDuOgavsEJY+wFEY8WdmKlS5ZFMo6xrj9AF3EfukaAbcp61TUBdJCdn85J1yzApy4pwJeuRYAPXUqAqy4tgIsubYCtLiOAjS5jgKkuK8BW1w0APCgOo8wKMHcCzoA+AeDSGKA4AXsOEf1wzq/SNH01AtjUKG2AiZY4jj9GXYWqazDVIsZT7sBGizbAVosWwEWLEuCqZRHgQ4sU4EvLLMCnlgnAt5YRYB9aRoD/7q77kivWFlVZ2R2XdtdiyTUNqpNFxl20bBGT7ppz3t12MhctIuwXEK5/O55iCBQAAAAASUVORK5CYII="/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="division-line"></div>

        </div>

    </div>

</div>


<div class="popup-template" style="display:none;">

    <div class="config-hidden" id="popup-group">

        <div class="flex-container">
            <div class="header_tip_font popup-group-title" data-local-value="createGroupTip">创建群组</div>
        </div>

        <div class="" style="text-align: center">
            <input type="text" class="popup-group-input" placeholder="please input">
        </div>

        <div class="line"></div>

        <div class="" style="text-align:center;">
            <?php if ($lang == "1") { ?>
                <button type="button" class="create_button" url-value="">保存</button>
            <?php } else { ?>
                <button type="button" class="create_button" url-value="">Save</button>
            <?php } ?>
        </div>

    </div>

</div>

<script type="text/javascript" src="../../public/jquery/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../../public/jquery/jquery-weui.min.js"></script>
<script type="text/javascript" src="../../public/js/jquery-confirm.js"></script>
<script type="text/javascript" src="../../public/manage/native.js"></script>

<script type="text/javascript" src="../../public/sdk/zalyjsNative.js"></script>

<script type="text/javascript">

    function uploadFile(obj) {

        if (isAndroid()) {
            zalyjsImageUpload(uploadImageResult);
        } else {
            $("#" + obj).val("");
            $("#" + obj).click();
        }

    }

    function uploadImageResult(result) {

        var fileId = result.fileId;

        //update server image
        updateMiniProgramProfile("logo", fileId);

        var newSrc = "/_api_file_download_/?fileId=" + fileId;

        $(".site-image").attr("src", newSrc);
    }

    downloadFileUrl = "./index.php?action=http.file.downloadFile";

    function uploadImageFile(obj) {
        if (obj) {
            if (obj.files) {
                var formData = new FormData();

                formData.append("file", obj.files.item(0));
                formData.append("fileType", "FileImage");
                formData.append("isMessageAttachment", false);

                var src = window.URL.createObjectURL(obj.files.item(0));

                uploadFileToServer(formData, src);

                //直接放图片
                $("#mini-program-img").attr("src", src);
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
                    updateMiniProgramProfile("logo", fileId);
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

    function showImage(fileId, htmlImgId) {
        var requestUrl = "./_api_file_download_/test?fileId=" + fileId;


        if (!isMobile()) {
            requestUrl = downloadFileUrl + "&fileId=" + fileId + "&returnBase64=0";
        }

        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && (this.status == 200 || this.status == 304)) {
                var blob = this.response;
                var src = window.URL.createObjectURL(blob);

                $("#" + htmlImgId).attr("src", src);
            }
        };
        xhttp.open("GET", requestUrl, true);
        xhttp.responseType = "blob";
        // xhttp.setRequestHeader('Cache-Control', "max-age=2592000, public");
        xhttp.send();
    }

    $(function () {
        var fileId = $("#mini-program-img-id").attr("fileId");
        showImage(fileId, 'mini-program-img');
    });

    $("#mini-program-name-text").blur(function () {
        var name = $(this).val();
        updateMiniProgramProfile("name", name);
    });


    $("#mini-program-landing-text").blur(function () {
        var value = $(this).val();
        updateMiniProgramProfile("landingPageUrl", value);
    });

    $("#mini-program-order-text").blur(function () {
        var value = $(this).val();
        updateMiniProgramProfile("sort", value);
    });

    $("#mini-program-management-text").blur(function () {
        var value = $(this).val();
        updateMiniProgramProfile("management", value);
    });

    //enable tmp chat
    $("#openProxySwitch-text").change(function () {
        var isChecked = $(this).is(':checked')

        var value = 0;
        if (isChecked) {
            value = 1;
        }

        updateMiniProgramProfile("landingPageWithProxy", value);
    });


    function selectMiniProgramUsage() {
        // PluginUsageIndex = 0; 禁用
        // PluginUsageIndex = 1;
        // PluginUsageLogin = 2;
        //
        // PluginUsageU2Message = 3;
        // PluginUsageTmpMessage = 4;
        // PluginUsageGroupMessage = 5;
        var language = getLanguage();
        var url = "index.php?action=manage.miniProgram.update&type=usageType&lang=" + language;
        $.actions({
            title: language == 0 ? "select mini program type" : "请选择小程序类别",
            onClose: function () {
                console.log("close");
            },
            actions: [{
                text: language == 0 ? "Home Mini Program" : "首页小程序",
                className: "select-color-primary",
                onClick: function () {
                    $("#mini-program-usage-text").html(language == 0 ? "Home Page" : "首页小程序");
                    $(".mini-program-usage").attr("data", "1");
                    updateMiniProgramProfile("usageType", "1");
                }
            }, {
                text: language == 0 ? "U2 Chat Mini Program" : "二人聊天小程序",
                className: "select-color-primary",
                onClick: function () {
                    $("#mini-program-usage-text").html(language == 0 ? "U2 Chat Mini Program" : "二人聊天小程序");
                    $(".mini-program-usage").attr("data", "3");
                    updateMiniProgramProfile("usageType", "3");
                }
            },
                // {
                //     text: language == 0 ? "Tmp Chat Mini Program" : "临时会话小程序",
                //     className: "select-color-primary",
                //     onClick: function () {
                //         $("#mini-program-usage-text").html(language == 0 ? "Tmp Chat Mini Program" : "临时会话小程序");
                //         $(".mini-program-usage").attr("data", "4");
                //         updateMiniProgramProfile("usageType", "4");
                //     }
                // },
                {
                    text: language == 0 ? "Group Chat Mini Program" : "群组聊天小程序",
                    className: "select-color-primary",
                    onClick: function () {
                        $("#mini-program-usage-text").html(language == 0 ? "Chat Page Bottom" : "聊天界面底部");
                        $(".mini-program-usage").attr("data", "5");
                        updateMiniProgramProfile("usageType", "5");
                    }
                }, {
                    text: language == 0 ? "Login Mini Program" : "登陆小程序",
                    className: "select-color-primary",
                    onClick: function () {
                        $("#mini-program-usage-text").html(language == 0 ? "Login Mini Program" : "登陆小程序");
                        $(".mini-program-usage").attr("data", "2");
                        updateMiniProgramProfile("usageType", "2");
                    }
                }, {
                    text: language == 0 ? "Account Mini Program" : "账户安全小程序",
                    className: "select-color-primary",
                    onClick: function () {
                        $("#mini-program-usage-text").html(language == 0 ? "Account Mini Program" : "账户安全小程序");
                        $(".mini-program-usage").attr("data", "6");
                        updateMiniProgramProfile("usageType", "6");
                    }
                }, {
                    text: language == 0 ? "Invalid Mini Program" : "无效小程序",
                    className: "select-color-primary",
                    onClick: function () {
                        $("#mini-program-usage-text").html(language == 0 ? "Invalid Mini Program" : "无效小程序");
                        $(".mini-program-usage").attr("data", "0");
                        updateMiniProgramProfile("usageType", "0");
                    }
                }]
        });
    }

    function selectMiniProgramDisplay() {
        var language = getLanguage();
        // PluginLoadingNewPage = 0;
        // PluginLoadingFloat   = 1;
        // PluginLoadingMask    = 2;
        // PluginLoadingChatbox = 3;
        // PluginLoadingFullScreen = 4;

        $.actions({
            title: language == 0 ? "select mini program open way" : "请选择小程序打开方式",
            onClose: function () {
                console.log("close");
            },
            actions: [{
                text: language == 0 ? "New Page" : "新页面打开",
                className: "select-color-primary",
                onClick: function () {
                    $("#mini-program-display-text").html(language == 0 ? "New Page" : "新页面打开");
                    $(".mini-program-display").attr("data", "0");
                    updateMiniProgramProfile("loadingType", "0");
                }
            }, {
                text: language == 0 ? "Float Page" : "悬浮打开",
                className: "select-color-primary",
                onClick: function () {
                    $("#mini-program-display-text").html(language == 0 ? "Float Page" : "悬浮打开打开");
                    $(".mini-program-display").attr("data", "1");
                    updateMiniProgramProfile("loadingType", "1");
                }
            },
                // {
                //     text: language == 0 ? "Mask Page" : "Mask打开",
                //     className: "select-color-primary",
                //     onClick: function () {
                //         $("#mini-program-display-text").html(language == 0 ? "Mask Page" : "Mask打开");
                //         $(".mini-program-display").attr("data", "2");
                //         updateMiniProgramProfile("loadingType", "2");
                //     }
                // },
                {
                    text: language == 0 ? "Chatbox Page" : "Chatbox打开",
                    className: "select-color-primary",
                    onClick: function () {
                        $("#mini-program-display-text").html(language == 0 ? "Chatbox Page" : "Chatbox打开");
                        $(".mini-program-display").attr("data", "3");
                        updateMiniProgramProfile("loadingType", "3");
                    }
                },
                {
                    text: language == 0 ? "FullScreen" : "全屏打开",
                    className: "select-color-primary",
                    onClick: function () {
                        $("#mini-program-display-text").html(language == 0 ? "FullScreen" : "全屏打开");
                        $(".mini-program-display").attr("data", "4");
                        updateMiniProgramProfile("loadingType", "4");
                    }
                }
            ]
        });
    }

    function selectMiniProgramPermission() {
        var language = getLanguage();
        // PluginPermissionAdminOnly   = 0;
        // PluginPermissionAll     = 1;
        // PluginPermissionGroupMaster = 2;

        $.actions({
            title: language == 0 ? "select mini program permission" : "请选择小程序权限",
            onClose: function () {
                console.log("close");
            },
            actions: [{
                text: language == 0 ? "All User Available" : "所有人可用",
                className: "select-color-primary",
                onClick: function () {
                    $("#mini-program-permission-text").html(language == 0 ? "All User Available" : "所有人可用");
                    $(".mini-program-permission").attr("data", "1");
                    updateMiniProgramProfile("permissionType", "1");
                }
            }, {
                text: language == 0 ? "Group Master Available" : "群管理员可用",
                className: "select-color-primary",
                onClick: function () {
                    $("#mini-program-permission-text").html(language == 0 ? "Group Master Available" : "群管理员可用");
                    $(".mini-program-permission").attr("data", "2");
                    updateMiniProgramProfile("permissionType", "2");
                }
            }, {
                text: language == 0 ? "Site Managers Available" : "站点管理员可用",
                className: "select-color-primary",
                onClick: function () {
                    $("#mini-program-permission-text").html(language == 0 ? "Site Managers Available" : "站点管理员可用");
                    $(".mini-program-permission").attr("data", "0");
                    updateMiniProgramProfile("permissionType", "0");
                }
            }]
        });
    }

    function updateMiniProgramProfile(name, value) {

        var language = getLanguage();

        var pluginId = $("#mini-program-id").attr("data");

        // alert("pluginId=" + pluginId + "name=" + name + " value=" + value);

        var data = {
            'pluginId': pluginId,
            'name': name,
            'value': value
        };

        var url = "index.php?action=manage.miniProgram.update&lang=" + language;

        zalyjsCommonAjaxPostJson(url, data, updateProfileResponse);
    }

    function updateProfileResponse(url, jsonData, result) {

        if (result) {
            var resJson = JSON.parse(result);

            var errCode = resJson.errCode;

            if ("success" != errCode) {
                var errInfo = resJson['errInfo'];
                alert(errInfo);
            }
        } else {
            alert("error");
        }

    }

    function deleteMiniProgram() {
        var lang = getLanguage();
        $.modal({
            title: lang == 1 ? '删除小程序' : 'Delete Mini Program',
            text: lang == 1 ? '确定删除？' : 'Confirm Delete?',
            buttons: [
                {
                    text: lang == 1 ? "取消" : "cancel", className: "default", onClick: function () {
                        // alert("cancel");
                    }
                },
                {
                    text: lang == 1 ? "确定" : "confirm", onClick: function () {
                        var pluginId = $("#mini-program-id").attr("data");
                        var data = {
                            'pluginId': pluginId,
                        };

                        var url = "index.php?action=manage.miniProgram.delete&lang=" + getLanguage();

                        zalyjsCommonAjaxPostJson(url, data, deleteResponse);
                    }
                },

            ]
        });
    }

    function deleteResponse(url, data, result) {
        if (result) {
            var res = JSON.parse(result);

            if (res.errCode == "success") {
                var url = "index.php?action=manage.miniProgram.list&type=page&lang=" + getLanguage();
                zalyjsCommonOpenPage(url);
            } else {
                alert(res.errInfo);
                window.location.reload();
            }
        } else {
            alert(getLanguage() == 1 ? "删除失败" : "delete fail");
            window.location.reload();
        }
    }

</script>

</body>
</html>




