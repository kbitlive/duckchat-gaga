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

                <div class="item-row">
                    <div class="item-header">
                        <img class="user-avatar-image" avatar="<?php echo $user['avatar'] ?>"
                             src=""
                             onerror="this.src='../../public/img/msg/default_user.png'"/>
                    </div>
                    <div class="item-body">
                        <div class="item-body-display">
                            <div class="item-body-desc" onclick="showUserChat('')">
                               11111111
                            </div>

                            <div class="item-body-tail">

                                    <button class="addButton applyButton" userId="">
                                        添加好友
                                    </button>
                                    <button class="chatButton" userId="">
                                        发起会话
                                    </button>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="division-line"></div>


            </div>
        </div>

    </div>

</div>

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


</script>

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




