<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <style>
        body,html {
            height: 100%;
        }
        #wrapper {
            height: 100%;
            text-align: center;
            display: flex;
            justify-content: center;
            background:rgba(233,232,237,1);
        }
        .continer {
            width: 375px;
            height:100%;
            background:white;
        }
        .logo_img {
            width: 51px;
        }
        .box {
            text-align: center;
            margin-top: 18px;
            width: 335px;
            margin-left: 20px;
        }
        .search_input {
            width:304px;
            height:42px;
            border-radius:2px;
            border:1px solid;
            outline: none;
            padding-left: 31px;
            margin-top: 25px;
        }
        .box_relation {
            text-align: center;
            display: flex;
            justify-content: center;
            height:97px;
            position: relative;
        }
        .search_logo{
            width: 14px;
            height:16px;
        }
        .search_absoulte {
            position: absolute;
        }
        .search_logo_div {
            height: 92px;
            display: flex;
            justify-content: left;
            margin-left: -150px;
            align-items: center;
            width: 16px;
        }
        .desc {
            width: 335px;
            font-size: 12px;
            font-family: PingFangSC-Regular;
            font-weight: 400;
            color: rgba(52,54,60,1);
            line-height: 17px;
            word-break: break-all;
            text-align: left;
            margin-left: 20px;
        }
        .desc_div {
            width: 100%;
            text-align: left;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .sub_title {
            width:335px;
            height:14px;
            font-size:10px;
            font-family:PingFangSC-Regular;
            font-weight:400;
            color:rgba(52,54,60,1);
            line-height:14px;
            margin-top: 21px;
        }

        .sub_title_contact {
            width:335px;
            height:10px;
            font-size:10px;
            font-family:PingFangSC-Regular;
            font-weight:400;
            color:rgba(52,54,60,1);
            line-height:10px;
            margin-bottom: 7px;
        }
        .v_line {
            width:1px;
            height:40px;
            background:rgba(233,232,237,1);
            margin-right: 7px;
        }
        .search_tip {
            height:16px;
            font-size:16px;
            font-family:PingFangSC-Medium;
            font-weight:500;
            color:rgba(50,136,255,1);
            line-height:16px;
        }
        .v_line_absoulte {
            right: 80px;
            height: 92px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .search_tip_div {
            right: 12px;
            height: 92px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }
        .grap_div {
            height:10px;
            background:rgba(233,232,237,1);
        }
        .row {
            width: 100%;
            height: 50%;
            background:white;
        }
        .title_recomment_group {
            height:40px;
            font-size:16px;
            font-family:PingFangSC-Medium;
            font-weight:500;
            color:rgba(27,27,27,1);
            line-height:40px;
            text-align: left;
            margin-left: 10px;
        }
        .line {
            width:365px;
            height:1px;
            background:rgba(233,232,237,1);
        }
        .group_row {
            height:56px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            margin-left: 10px;
            margin-right: 10px;
        }
        .group_info {
            display:flex;
            height: 100%;
            text-align: center;
            align-items: center;
            justify-content: space-between;
        }
        .group_name, .group_owner {
            text-align: left;
        }
        .group_detail_info {
            display: flex;
        }
        .add_group_button {
            margin-right: 20px;
            height: 28px;
        }
        .add_group_button  button {
            height:28px;
            background:rgba(76,59,177,1);
            border: rgba(76,59,177,1);;
            border-radius:2px;
            font-size:12px;
            font-family:PingFangSC-Regular;
            font-weight:400;
            color:rgba(255,255,255,1);
            line-height:28px;
            outline: none;
            cursor: pointer;
        }
    </style>

</head>

<body>

<div class="wrapper" id="wrapper">

    <div class="continer">
            <div class="box">
                <img class="logo_img" src="../../public/img/search/logo.png">
            </div>
            <div class="box box_relation">
                <div class="search_absoulte">
                    <input type="text" class="search search_input">
                </div>
                <div class="search_absoulte search_logo_div">
                    <img class="search_logo " src="../../public/img/search/search.png">
                </div>
                <div class="search_absoulte v_line_absoulte">
                    <div class="v_line"></div>
                </div>
                <div class="search_absoulte search_tip_div">
                    <span class="search_tip">搜索一下</span>
                </div>
            </div>
            <div class="desc">
                核武站简介：这是一个核武内部系统搭建的聊天站点，此处的描述内容可以在管理后台进行修改配置。这是一个核武内部系统搭建的聊天站点，此处的描述内容可以在管理后台进行修改配置。
            </div>
            <div class="sub_title">
                核武站技术团队
            </div>
            <div class="sub_title_contact">
                李萌：13273247332
            </div>
        <div class="grap_div">
        </div>
        <div class="row">
            <div class="title_recomment_group">
                热门推荐
            </div>
            <div class="line"></div>

            <div class="group_row">
                <div class="group_info">
                    <div class="group_detail_info">
                        <div >
                            <img class="avatar" src="../../public/img/msg/default_user.png">
                        </div>
                        <div>
                            <div class="group_name">
                                群1
                            </div>
                            <div class="group_owner">
                                群主：少爷
                            </div>
                        </div>
                    </div>
                    <div class="add_group_button">
                        <button >一键加入</button>
                    </div>
                </div>
            </div>
            <div class="line"></div>

        </div>
    </div>


</div>


<script type="text/javascript" src="../../public/jquery/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../../public/manage/native.js"></script>
<script type="text/javascript" src="../../public/sdk/zalyjsNative.js"></script>


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
            searchUsers(searchValue)
        }
    });

    function searchUsers(searchValue) {
        $("#search-content").show();

        var url = "./index.php?action=manage.user.search&lang=" + getLanguage();
        var data = {
            "searchValue": searchValue
        };

        zalyjsCommonAjaxPostJson(url, data, searchUsersResponse);
    }

    function searchUsersResponse(url, data, result) {

        $("#search-user-div").html("");

        if (result) {


        } else {
            $("#search-user-div").append("没有找到结果");
        }
    }

    function showUserProfile(userId) {
        var url = "./index.php?action=manage.user.profile&lang=" + getLanguage() + "&userId=" + userId;
        zalyjsOpenPage(url);
    }

</script>


</body>
</html>




