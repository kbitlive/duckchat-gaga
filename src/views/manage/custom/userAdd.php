<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?php echo $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="../../public/jquery/weui.min.css"/>
    <link rel="stylesheet" href="../../public/jquery/jquery-weui.min.css"/>
    <link rel="stylesheet" href="../../public/manage/config.css"/>

    <style>

        .save_button,
        .save_button:hover,
        .save_button:focus,
        .save_button:active {
            margin-top: 2rem;
            width: 100%;
            height: 44px;
            background: rgba(76, 59, 177, 1);
            border-radius: 0.94rem;
            font-size: 16px;
            color: rgba(255, 255, 255, 1);
            line-height: 1.67rem;
        }

        .site-image {
            width: 30px;
            height: 30px;
            margin-top: 12px;
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

<div class="wrapper" id="wrapper">

    <!--  site basic config  -->
    <div class="layout-all-row">

        <div class="list-item-center">

            <div class="item-row" id="custom-key" onclick="showPopup('custom-key');">
                <div class="item-body">
                    <div class="item-body-display">

                        <?php if ($lang == "1") { ?>
                            <div class="item-body-desc">自定义字段</div>
                        <?php } else { ?>
                            <div class="item-body-desc">Custom Key</div>
                        <?php } ?>

                        <div class="item-body-tail">
                            <div class="item-body-value" id="custom-key-value"></div>
                            <div class="item-body-value-more">
                                <img class="more-img" src="../../public/img/manage/more.png"/>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="division-line"></div>

            <div class="item-row" id="custom-key-name" onclick="showPopup('custom-key-name');">
                <div class="item-body">
                    <div class="item-body-display">
                        <?php if ($lang == "1") { ?>
                            <div class="item-body-desc">字段名称</div>
                        <?php } else { ?>
                            <div class="item-body-desc">Key Name</div>
                        <?php } ?>

                        <div class="item-body-tail">
                            <div class="item-body-value" id="custom-key-name-value"></div>
                            <div class="item-body-value-more">
                                <img class="more-img" src="../../public/img/manage/more.png"/>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="division-line"></div>

            <div class="item-row" id="mini-program-icon-id">
                <div class="item-body">
                    <div class="item-body-display">

                        <?php if ($lang == "1") { ?>
                            <div class="item-body-desc">字段图标</div>
                        <?php } else { ?>
                            <div class="item-body-desc">Key Icon</div>
                        <?php } ?>

                        <div class="item-body-tail">
                            <div class="item-body-value" id="custom-key-fileid">
                                <img class="site-image" id="custom-key-image" onclick="uploadImage('custom-key-logo');"
                                     src="../../public/img/manage/plugin_default.png">

                                <input id="custom-key-logo" type="file" onchange="uploadImageFile(this)"
                                       style="display: none;" accept="image/*">
                            </div>

                            <div class="item-body-value-more">
                                <img class="more-img" src="../../public/img/manage/more.png"/>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="division-line"></div>

            <div class="item-row" id="custom-key-sort" onclick="showPopup('custom-key-sort');">
                <div class="item-body">
                    <div class="item-body-display">
                        <?php if ($lang == "1") { ?>
                            <div class="item-body-desc">排序</div>
                        <?php } else { ?>
                            <div class="item-body-desc">KeySort</div>
                        <?php } ?>

                        <div class="item-body-tail">
                            <div class="item-body-value"></div>
                            <div class="item-body-value-more">
                                <img class="more-img" src="../../public/img/manage/more.png"/>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="division-line"></div>
        </div>

    </div>


    <!--   part 3  -->
    <div class="layout-all-row">

        <div class="list-item-center">

            <div class="item-row">
                <div class="item-body">
                    <div class="item-body-display custom-key-status">
                        <?php if ($lang == "1") { ?>
                            <div class="item-body-desc">是否注册时填写</div>
                        <?php } else { ?>
                            <div class="item-body-desc">Register Need</div>
                        <?php } ?>

                        <div class="item-body-tail">
                            <input id="custom-key-status-switch" class="weui_switch" type="checkbox">
                        </div>
                    </div>

                </div>
            </div>
            <div class="division-line"></div>

            <div class="item-row">
                <div class="item-body">
                    <div class="item-body-display custom-key-required">
                        <?php if ($lang == "1") { ?>
                            <div class="item-body-desc">是否必填</div>
                        <?php } else { ?>
                            <div class="item-body-desc">Required</div>
                        <?php } ?>

                        <div class="item-body-tail">
                            <input id="custom-key-required-switch" class="weui_switch" type="checkbox">
                        </div>
                    </div>

                </div>
            </div>
            <div class="division-line"></div>

            <div class="item-row">
                <div class="item-body">
                    <div class="item-body-display custom-key-open">
                        <?php if ($lang == "1") { ?>
                            <div class="item-body-desc">是否公开显示</div>
                        <?php } else { ?>
                            <div class="item-body-desc">Public Display</div>
                        <?php } ?>

                        <div class="item-body-tail">
                            <input id="custom-key-open-switch" class="weui_switch" type="checkbox">
                        </div>
                    </div>
                </div>
            </div>
            <div class="division-line"></div>

        </div>

    </div>

</div>


<div class="wrapper">

    <?php if ($lang == "1") { ?>
        <button id="addButton" type="button" class="save_button" url-value="">保存</button>
    <?php } else { ?>
        <button id="addButton" type="button" class="save_button" url-value="">Save</button>
    <?php } ?>

</div>

<div class="wrapper-mask" id="wrapper-mask" style="visibility: hidden;"></div>

<div class="popup-template" style="display: none;">

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
                <button type="button" id="updatePopupButton" class="create_button" onclick="updateDataValue()"
                        url-value="">保存
                </button>
            <?php } else { ?>
                <button type="button" id="updatePopupButton" class="create_button" onclick="updateDataValue()"
                        url-value="">Save
                </button>
            <?php } ?>
        </div>

    </div>

</div>


<script type="text/javascript" src="../../public/jquery/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../../public/jquery/jquery-weui.min.js"></script>
<script type="text/javascript" src="../../public/manage/native.js"></script>

<script type="text/javascript" src="../../public/sdk/zalyjsNative.js"></script>

<script type="text/javascript">

    function uploadImage(obj) {
        if (isAndroid()) {
            zalyjsImageUpload(uploadImageResult);
        } else {
            $("#" + obj).val("");
            $("#" + obj).click();
        }
    }

    function uploadImageResult(result) {

        var fileId = result.fileId;

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

                $("#mini-program-image").attr("src", src);
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
                    // updateServerImage(fileId);
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

    function showLocalImage(fileId) {
        var requestUrl = downloadFileUrl + "&fileId=" + fileId + "&returnBase64=0";
        var xhttp = new XMLHttpRequest();
        console.log("showSiteLogo imageId ==" + fileId);

        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && (this.status == 200 || this.status == 304)) {
                var blob = this.response;
                var src = window.URL.createObjectURL(blob);
                console.log("showSiteLogo imageId response src=" + src);
                $("#mini-program-image").attr("src", src);
            }
        };
        xhttp.open("GET", requestUrl, true);
        xhttp.responseType = "blob";
        // xhttp.setRequestHeader('Cache-Control', "max-age=2592000, public");
        xhttp.send();
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

        var value = $.trim($(".popup-group-input").val());

        $("#" + key).find(".item-body-value").html(value);
        // close
        removeWindow($(".config-hidden"));
    }

    function showPopup(showId) {
        var title = $("#" + showId).find(".item-body-desc").html();
        var inputBody = $("#" + showId).find(".item-body-value").html();

        showWindow($(".config-hidden"));

        $(".popup-group-title").html(title);
        $(".popup-group-input").val(inputBody);
        $("#updatePopupButton").attr("key-value", showId);
    }


    $("#addButton").click(function () {
        var customKey = $("#custom-key").find(".item-body-value").html();
        var customKeyName = $("#custom-key-name").find(".item-body-value").html();
        var customKeyIconFileId = $("#custom-key-fileid").attr("fileId");
        var customKeySort = $("#custom-key-sort").find(".item-body-value").html();

        var statusIsChecked = $("#custom-key-status-switch").is(':checked');
        var requiredIsChecked = $("#custom-key-required-switch").is(':checked');
        var openIsChecked = $("#custom-key-open-switch").is(':checked');

        //"customKey",
        //        "keyName",
        //        "keyDesc",
        //        "keyType",
        //        "keySort",
        //        "keyConstraint",
        //        "isRequired",
        //        "isOpen",
        //        "status",
        //        "dataType",
        //        "dataVerify",
        //        "addTime",
        var data = {
            'customKey': customKey,
            'keyName': customKeyName,
            'keyIcon': customKeyIconFileId,
            'keySort': customKeySort,
            'status': statusIsChecked ? 2 : 1,
            'isOpen': openIsChecked ? 1 : 0,
            'isRequired': requiredIsChecked ? 1 : 0,
        };

        var url = "./index.php?action=manage.custom.userAdd&lang=" + getLanguage();
        zalyjsCommonAjaxPostJson(url, data, addResponse);
    });

    function addResponse(url, data, result) {
        if (result) {
            var resJson = JSON.parse(result);

            var errCode = resJson['errCode'];

            if ("success" == errCode) {
                alert(getLanguage() == 1 ? "添加成功" : "Add Success");
                window.location.reload();
            } else {
                var errInfo = resJson['errInfo'];
                alert("error:" + errInfo);
            }
        } else {
            alert("error");
        }
    }

</script>

</body>
</html>




