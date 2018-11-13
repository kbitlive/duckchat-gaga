<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="../../public/manage/config.css"/>

    <style>
        body,html {
            height: 100%;
        }
        #wrapper {
            height: 100%;
            text-align: center;
            display: flex;
            justify-content: center;
            background:white;
        }
        .continer {
            width: 100%;
            height:100%;
            background:white;
            overflow-y: scroll;
            max-width: 375px;
            border: 1px solid #cccccc;
        }
        .logo_img {
            width: 51px;
        }
        .box {
            text-align: center;
            margin-top: 18px;
            width: 100%;
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
            width: 100%;
            font-size: 12px;
            font-family: PingFangSC-Regular;
            font-weight: 400;
            color: rgba(52,54,60,1);
            line-height: 17px;
            word-break: break-all;
            text-align: left;

        }
        .desc_div {
            width: 100%;
            text-align: left;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .sub_title {
            width: 100%;
            height:14px;
            font-size:10px;
            font-family:PingFangSC-Regular;
            font-weight:400;
            color:rgba(52,54,60,1);
            line-height:14px;
            margin-top: 21px;
        }

        .sub_title_contact {
            width: 100%;
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
            height:45px;
            background:rgba(233,232,237,1);
            margin-right: 7px;
        }
        .search_tip {
            font-size:16px;
            font-family:PingFangSC-Medium;
            font-weight:500;
            color:rgba(50,136,255,1);
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
            width: 80px;
        }
        .grap_div {
            height:10px;
            background:rgba(233,232,237,1);
            overflow: hidden;
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
        .group_owner {
            height:12px;
            font-size:12px;
            font-family:PingFangSC-Regular;
            font-weight:400;
            color:rgba(153,153,153,1);
            line-height:12px;
            margin-top: 8px;
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
        .desc_box {
            text-align: center;
            width: 100%;
            justify-content: center;
            display: flex;
            align-items: center;
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
            <div class="box desc_box">
                <div style="width: 90%;">
                    <div class="desc">
                        核武站简介：这是一个核武内部系统搭建的聊天站点，此处的描述内容可以在管理后台进行修改配置。这是一个核武内部系统搭建的聊天站点，此处的描述内容可以在管理后台进行修改配置。
                    </div>
                    <div class="sub_title">
                        核武站技术团队
                    </div>
                    <div class="sub_title_contact">
                        李萌：13273247332
                    </div>
                </div>
            </div>
        <div class="grap_div">
        </div>
        <div class="row">
            <div class="title_recomment_group">
                热门推荐
            </div>
            <div class="line"></div>

            <div class="group_rows">

            </div>

        </div>
    </div>

<input type="hidden" value="<?php echo $recommend_groupids;?>" class="recommendGroupIds">
</div>


<?php include (dirname(__DIR__) . '/search/template_search.php');?>

<script type="text/javascript" src="../../public/jquery/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../../public/manage/native.js"></script>
<script type="text/javascript" src="../../public/js/template-web.js"></script>


<script type="text/javascript">


    $(".search_tip_div").on("click", function () {
        var param = $(".search_input").val();
        if(param == undefined || param.length < 1) {
            alert("请输入需要搜索的内容");
            return;
        }
        var url = "index.php?action=miniProgram.search.index&for=search&key="+param;
        zalyjsCommonOpenPage(url);
    });

    $(".join_group").on("click", function () {
        var url = "index.php?action=miniProgram.search.index&for=search";
        zalyjsCommonOpenPage(url);
    });


</script>


</body>
</html>




