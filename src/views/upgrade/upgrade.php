<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>login</title>
    <!-- Latest compiled and minified CSS -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="../../public/css/upgrade.css?_version=<?php echo $versionCode?>">
    <script type="text/javascript" src="../../../public/js/jquery.min.js"></script>
    <script src="../../public/js/template-web.js?_version=<?php echo $versionCode?>"></script>
    <script src="../../public/js/zalyjsHelper.js?_version=<?php echo $versionCode?>"></script>
    <script src="../../public/js/jquery.i18n.properties.min.js?_version=<?php echo $versionCode?>"></script>
    <script type="text/javascript">
        var latestVersion="0";
        function setLasteVersion(lasteVersion) {
            latestVersion = lasteVersion;
        }
    </script>
    <style>
        .upgrade_title {
            font-size:2.81rem;
            font-family:PingFangSC-Medium;
            font-weight:500;
            color:rgba(76,59,177,1);
            margin-top: 9rem;
            text-align: center;
        }
        .upgrade_token_div {
            display: flex;
            justify-content: center;
            margin-top: 3rem;
        }
        .upgrade_token {
            width:46.9rem;
            height:5.44rem;
            border-radius:0.84rem;
            border:0.09rem solid rgba(151,151,151,1);
            outline: none;
        }
        .upgrade_tip {
            font-size:1.69rem;
            font-family:PingFangSC-Regular;
            font-weight:400;
            color:rgba(102,102,102,1);
            margin-left: 14rem;
            margin-top: 1rem;
        }
        .upgrade_next_btn{
            width:28.14rem;
            height:4.69rem;
            background:rgba(76,59,177,1);
            border-radius:0.56rem;
            font-size:1.88rem;
            font-family:PingFangSC-Semibold;
            font-weight:600;
            color:rgba(255,255,255,1);
            margin-top: 5rem;
            outline: none;
            cursor: pointer;
        }
        .textcenter{
            text-align: center;
        }
        .site_upgrade_div {
            display: flex;
            justify-content: center;
            width: 47rem;
        }
        .upgrade_init_title {
            height:2.63rem;
            font-size:2.63rem;
            font-family:PingFangSC-Medium;
            font-weight:500;
            color:rgba(76,59,177,1);
            margin-top: 5rem;
        }
        .upgrade_process {
            margin-top: 3rem;
            display: flex;
            justify-content: center;
            margin-left: 16rem;
            width:47rem;
        }
        .upgrade_img{
            width:1.3rem;
            height: 1.3rem;
        }
        .upgrade_line_img {
            width: 6rem;
            height: 0.6rem;
        }
        .margin-right2{
            margin-right: 2rem;
        }
        .upgrade_info {
            height:18.76rem;
            border-radius:0.19rem;
            text-align: center;
            margin-top: 3rem;
        }
        .upgrade_info textarea {
            width:46.9rem;
            height:18.76rem;
            resize: none;
            overflow-y: scroll;
        }
        .upgrade_staring_btn {
            width:28.14rem;
            height:4.69rem;
            background:rgba(76,59,177,1);
            border-radius:0.56rem;
            font-size:1.88rem;
            font-family:PingFangSC-Semibold;
            font-weight:600;
            color:rgba(255,255,255,1);
            outline: none;
            cursor: pointer;
        }
        .margin-top3 {
            margin-top: 3rem;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="zaly_container">
        <div class="zaly_init zaly_upgrade">

        </div>
    </div>

    <div class="zaly_window">

    </div>
</div>

<input type="hidden" value='<?php echo $versions;?>' class="siteVersion">
<?php include (dirname(__DIR__) . '/upgrade/template_upgrade.php');?>

<script>
    var upgradeVerssion = 0;

    var html = template("tpl-upgrade-token", {});
    $(".zaly_upgrade").html(html);

    $(".upgrade_next_btn").on("click", function () {
        var html = template("tpl-backup-tip", {});
        $(".zaly_window").html(html);
        $(".zaly_window")[0].style.display = "flex";
    });

    $(document).on("click",".zaly_site_backup_sure", function () {
        console.log("ppp");
        $(".zaly_window")[0].style.display = "none";
        //TODO 拉取需要升级的版本数据
        var siteVersions = $(".siteVersion").val();
        siteVersions = JSON.parse(siteVersions);
        var html = template("tpl-upgrade-init", {
            versions:siteVersions,
            length:siteVersions.length
        });
        $(".zaly_upgrade").html(html);
    });

    $(document).on("click", ".upgrade_staring_btn", function () {
        // sendUpgrade();
        upgradeSiteVersion();
    });

    function sendUpgrade() {
        var upgradeSiteVersion = $("#v_"+upgradeVerssion).attr("version");
        console.log(upgradeSiteVersion);
        $.ajax({
            method: "POST",
            url: "./index.php?action=installDB&for=test_connect_mysql",
            data: data,
            success: function (resp) {
                if (resp == "success") {
                    initSite(data);
                } else {
                    var html = template("tpl-error-info", {
                        errorInfo:resp
                    })

                    $(".errorInfo").html(html);
                }
            }
        });
    }

    function upgradeSiteVersion() {
        $("#v_"+upgradeVerssion).attr("src", "../../public/img/upgrade/success.png");
        if(upgradeVerssion != 0) {
            var preSiteVersion = Number(upgradeVerssion-1);
            $("#v_line_"+preSiteVersion).attr("src", "../../public/img/upgrade/success_line.png");
        }
        $("#v_line_"+upgradeVerssion).attr("src", "../../public/img/upgrade/current_line.png");
        upgradeVerssion = Number(upgradeVerssion+1);
        sendUpgrade();
    }

    function checkUpgradeResult() {
        var upgradeSiteVersion = $("#v_"+upgradeVerssion).attr("version");
        $.ajax({
            method: "POST",
            url: "./index.php?action=installDB&for=test_connect_mysql",
            data: data,
            success: function (resp) {
                if (resp == "success") {
                    upgradeSiteVersion();
                } else {
                    $(".upgrade_info_msg").append(resp);
                }
            }
        });
    }

</script>
</body>
</html>
