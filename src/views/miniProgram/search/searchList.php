<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>搜索列表</title>
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


        .item-body-display, .item-body-desc, .item-body, .group-list {
            height:56px;
            line-height: 56px;
        }
        .item-body-desc {
            display: flex;
        }

        .show_all_list_name {
            height: 30px;
            font-size:12px;
            font-family:PingFangSC-Regular;
            font-weight:400;
            color:rgba(157,155,159,1);
            line-height:30px;
        }
        .height30{
            height: 30px;
            line-height: 30px;
        }
        .height36{
            height: 36px;
            line-height: 36px;
        }
        .user-avatar-image {
            width:40px;
            height:40px;
        }

        .item-header {
            height:56px;
            width: 60px;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>

</head>

<body>

<input type="hidden" value="<?php echo $key?>" class="search_key">
<div class="wrapper" id="wrapper">

    <div class="layout-all-row">

        <div class="list-item-center" style="margin-top: 20px;">
            <div class="item-row-list">

                <div class="item-row group-list height30" >
                    <div class="item-body height30" >
                        <div class="item-body-display height30" >
                            <div class="item-body-desc show_all_list_name height30" >
                                用户列表
                            </div>
                        </div>
                    </div>
                </div>
                <div class="division-line"></div>

                <?php if(count($users)):?>
                    <?php foreach ($users as $user):?>
                    <div class="item-row group-list">
                        <div class="item-header">
                            <img class="user-avatar-image" avatar="<?php echo $user['avatar'] ?>"
                                 src=""
                                 onerror="this.src='../../public/img/msg/default_user.png'"/>
                        </div>
                        <div class="item-body" onclick="showGroupProfile(<?php echo $user['userId']; ?>);">
                            <div class="item-body-display">
                                <div class="item-body-desc">
                                   <?php echo $user['loginName']; ?>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="division-line"></div>
                    <?php endforeach;?>

                <div class="division-line"></div>
                <div class="item-row group-list height36 show_all_friend">
                    <div class="item-body height36 " >
                        <div class="item-body-display height36 ">
                            <div class="item-body-desc show_all_tip height36 " >
                                查看更多好友
                            </div>

                            <div class="item-body-tail">
                                <div class="item-body-value">
                                    <img class="more-img" src="../../public/img/manage/more.png"/>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <?php endif;?>
            </div>
        </div>

    </div>

    <div class="layout-all-row">

        <div class="list-item-center" style="margin-top: 20px;">
            <div class="item-row-list">

                <div class="item-row group-list height30" >
                    <div class="item-body height30" >
                        <div class="item-body-display height30" >
                            <div class="item-body-desc show_all_list_name height30" >
                                群组列表
                            </div>
                        </div>
                    </div>
                </div>
                <div class="division-line"></div>

                <?php if(count($groups)):?>
                <?php foreach ($groups as $group):?>
                        <div class="item-row group-list">
                            <div class="item-header">
                                <img class="user-avatar-image" avatar="<?php echo $group['avatar'] ?>"
                                     src=""
                                     onerror="this.src='../../public/img/msg/default_user.png'"/>
                            </div>
                            <div class="item-body">
                                <div class="item-body-display">
                                    <div class="item-body-desc">
                                        <?php echo $group['name']?>
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
                    <?php endforeach;?>

                <div class="item-row group-list height36 show_all_group">
                    <div class="item-body height36" >
                        <div class="item-body-display height36">
                            <div class="item-body-desc show_all_tip height36" >
                                查看更多群组
                            </div>

                            <div class="item-body-tail">
                                <div class="item-body-value">
                                    <img class="more-img" src="../../public/img/manage/more.png"/>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <?php endif;?>

            </div>

        </div>

    </div>
</div>

<script type="text/javascript" src="../../public/jquery/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../../public/manage/native.js"></script>


<script type="text/javascript">


    $(".user-avatar-image").each(function () {
        var avatar = $(this).attr("avatar");
        var src = " /_api_file_download_/?fileId=" + avatar;
        if (!isMobile()) {
            src = "./index.php?action=http.file.downloadFile&fileId=" + avatar + "&returnBase64=0";
        }
        $(this).attr("src", src);
    });

    $(".show_all_friend").on("click", function () {
        var param = $(".search_key").val();
        var url = "index.php?action=miniProgram.search.index&for=user&key="+param;
        zalyjsCommonOpenPage(url);
    });
    $(".show_all_group").on("click", function () {
        var param = $(".search_key").val();
        var url = "index.php?action=miniProgram.search.index&for=group&key="+param;
        zalyjsCommonOpenPage(url);
    });


</script>

</body>
</html>




