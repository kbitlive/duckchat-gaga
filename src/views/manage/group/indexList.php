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

        #search-group-div {
            text-align: center;
        }
    </style>
</head>

<body>

<div class="wrapper" id="wrapper">

    <div class="item-search">
        <img class="search-img" width="19px" height="19px" src="../../public/img/manage/search.png">

        <?php if ($lang == "1") { ?>
            <input type="text" id="search-group" class="search-input" placeholder="通过群名称搜索群组">
        <?php } else { ?>
            <input type="text" id="search-group" class="search-input" placeholder="search groups by name">
        <?php } ?>
    </div>

    <div class="layout-all-row" id="search-content" style="display: none">
        <div class="list-item-center">

            <div id="search-title" class="item-row-title"><?php if ($lang == "1") { ?>
                    群组搜索结果
                <?php } else { ?>
                    Search Groups
                <?php } ?></div>

            <div id="search-group-div">

            </div>

        </div>
    </div>

    <div class="layout-all-row">

        <div class="list-item-center">

            <div class="item-row-title">
                <?php if ($lang == "1") { ?>
                    站点群聊列表
                <?php } else { ?>
                    Site Group List
                <?php } ?>(<?php echo $totalGroupCount ?>)

            </div>

            <?php foreach ($groupList as $key => $profile) { ?>

                <div class="item-row group-list">
                    <div class="item-body" onclick="showGroupProfile('<?php echo($profile["groupId"]) ?>');">
                        <div class="item-body-display">
                            <div class="item-body-desc">
                                <?php
                                $length = mb_strlen($profile['name']);
                                if ($length > 10) {
                                    echo mb_substr($profile['name'], 0, 10) . "...";
                                } else {
                                    echo $profile['name'];
                                }
                                ?>
                            </div>

                            <div class="item-body-tail">
                                <div class="item-body-value">
                                    <img class="more-img" src="../../public/img/manage/more.png"/>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="division-line"></div>
            <?php } ?>

        </div>

    </div>
</div>

<script type="text/javascript" src="../../public/jquery/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../../public/manage/native.js"></script>

<script type="text/javascript">

    $(".search-input").on('input porpertychange', function () {
        var val = $(this).val();
        if (val == "") {
            $("#search-content").hide();
        }
    });

    $(".search-input").on('keypress', function (e) {

        var keycode = e.keyCode;
        var searchName = $(this).val();
        if (keycode == '13') {
            // The Event interface's preventDefault() method tells the user agent that if the event does not get explicitly handled, its default action should not be taken as it normally would be. The event continues to propagate as usual, unless one of its event listeners calls stopPropagation() or stopImmediatePropagation(), either of which terminates propagation at once.
            e.preventDefault();

            var searchValue = $(this).val();
            searchGroups(searchValue)
        }
    });

    function searchGroups(searchValue) {
        $("#search-content").show();

        var url = "./index.php?action=manage.group.search&lang=" + getLanguage();
        var data = {
            "searchValue": searchValue
        };

        zalyjsCommonAjaxPostJson(url, data, searchGroupsResponse);
    }

    function searchGroupsResponse(url, data, result) {
        $("#search-group-div").html("");

        if (result) {

            var res = JSON.parse(result);

            if (res.errCode == "success") {

                var groupList = res['groups'];

                $.each(groupList, function (index, group) {

                    var html = '<div class="item-row">'
                        + '<div class="item-body" onclick="showGroupProfile(\'' + group["groupId"] + '\');">'
                        + '<div class="item-body-display">'
                        + '<div class="item-body-desc">' + group["name"] + '</div>'

                        + '<div class="item-body-tail">'
                        + '<img class="more-img" src="../../public/img/manage/more.png"/>'
                        + '</div>'
                        + '</div>'

                        + '</div>'
                        + '</div>'
                        + '<div class="division-line"></div>';
                    $("#search-group-div").append(html);
                });

            } else {
                var text = getLanguage() == 1 ? "没有找到结果" : "found no groups";
                $("#search-group-div").append(text);
            }

        } else {
            var text = getLanguage() == 1 ? "没有找到结果" : "found no groups";
            $("#search-group-div").append(text);
        }
    }

    function showGroupProfile(groupId) {
        var url = "index.php?action=manage.group.profile&lang=" + getLanguage() + "&groupId=" + groupId;
        zalyjsCommonOpenPage(url);
    }


</script>


</body>
</html>




