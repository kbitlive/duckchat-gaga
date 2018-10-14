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
        .upgrade_token {
            font-size:1.88rem;
            font-family:PingFangSC-Regular;
            font-weight:400;
            color:rgba(153,153,153,1);
            padding-left: 1rem;
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

<input type="hidden" value='<?php echo $passwordFileName;?>' class="passwordFileName">
<?php include (dirname(__DIR__) . '/upgrade/template_upgrade.php');?>

<script>
    var upgradeVersion = 0;
    var isCheckUpgradeTokenKey = "is_check_upgrade_token";
    var isSureSiteBackup = "is_sure_site_backup";
    var versionsKey = "versions";
    var currentUpgradeVersionKey = "current_upgrade_version";
    var upgradeId = undefined;

    function displayInitUpgrade() {
        var passwordFileName = $(".passwordFileName").val();
        var html = template("tpl-upgrade-token", {
            passwordFileName:passwordFileName
        });
        $(".zaly_upgrade").html(html);
    }
    displayInitUpgrade();

    var isCheckUpgradeToken = localStorage.getItem(isCheckUpgradeTokenKey);
    var isSureSiteBackup = localStorage.getItem(isSureSiteBackup, "yes");

    if(isCheckUpgradeToken == "yes" && isSureSiteBackup == 'yes') {
        // displayUpgradeVersion();
    }

    function checkUpgradeToken() {
        var upgradeToken = $(".upgrade_token").val();
        var data = {
            password:upgradeToken
        }
        $.ajax({
            method: "POST",
            url: "./index.php?action=page.version.password",
            data: data,
            success: function (resp) {
                if (resp == "error") {
                    alert("校验口令失败");
                } else {
                    var versionData = JSON.parse(resp);
                    var versions = versionData.versions;
                    localStorage.setItem(versionsKey, JSON.stringify(versions));
                    upgradeVersion = Object.keys(versions)[0];
                    localStorage.setItem(currentUpgradeVersionKey,upgradeVersion);
                    var html = template("tpl-backup-tip", {});
                    $(".zaly_window").html(html);
                    $(".zaly_window")[0].style.display = "flex";
                    localStorage.setItem(isCheckUpgradeTokenKey, "yes");
                }
            }
        });
    }

    $(".upgrade_next_btn").on("click", function () {
        checkUpgradeToken();
    });

    $(document).on("click",".zaly_site_backup_sure", function () {
        localStorage.setItem(isSureSiteBackup, "yes");
        //TODO 拉取需要升级的版本数据
        $(".zaly_window")[0].style.display = "none";
        displayUpgradeVersion();
    });

    function displayUpgradeVersion()
    {
        try{
            var siteVersionStr = localStorage.getItem(versionsKey);
            var siteVersions = JSON.parse(siteVersionStr);
            var html = template("tpl-upgrade-init", {
                versions:siteVersions,
                length:Object.keys(siteVersions).length,
                nowLength:0
            });
            $(".zaly_upgrade").html(html);
        }catch (error) {
            displayInitUpgrade();
        }
    }


    $(document).on("click", ".upgrade_staring_btn", function () {
        sendUpgrade();
    });

    function sendUpgrade() {
        var upgradeVersionNum = localStorage.getItem(currentUpgradeVersionKey);
        var upgradeSiteVersion = $("#v_"+upgradeVersionNum).attr("version");
        console.log("upgradeSiteVersion ==" + upgradeSiteVersion);
        var data = {
            versionCode:upgradeSiteVersion
        }
        clearInterval(upgradeId);
        $.ajax({
            method: "POST",
            url: "./index.php?action=page.version.upgrade",
            data: data,
            success: function (resp) {
                if (resp == "success") {
                    upgradeId = setInterval(function () {
                        checkUpgradeResult();
                    }, 1000)
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
        var upgradeVersionNum = localStorage.getItem(currentUpgradeVersionKey);

        $("#v_"+upgradeVersionNum).attr("src", "../../public/img/upgrade/success.png");
        if(upgradeVersionNum != 0) {
            var preSiteVersion = Number(upgradeVersionNum-1);
            $("#v_line_"+preSiteVersion).attr("src", "../../public/img/upgrade/success_line.png");
        }
        $("#v_line_"+upgradeVersionNum).attr("src", "../../public/img/upgrade/current_line.png");
        upgradeVersionNum = Number(upgradeVersionNum+1);
        localStorage.setItem(currentUpgradeVersionKey, upgradeVersionNum);
        sendUpgrade();
    }

    function checkUpgradeResult() {
        $.ajax({
            method: "POST",
            url: "./index.php?action=page.version.check",
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
