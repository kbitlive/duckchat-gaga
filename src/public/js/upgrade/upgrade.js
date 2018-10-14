var upgradeVersion = 0;
var isCheckUpgradeTokenKey = "is_check_upgrade_token";
var isSureSiteBackup = "is_sure_site_backup";
var versionsKey = "versions";
var currentUpgradeVersionKey = "current_upgrade_version";
var endUpgradeVersionKey = "end_upgrade_version";
var upgradeId = undefined;

//-------------------------------------page upgrade int------------------------------------

function displayInitUpgrade() {
    var passwordFileName = $(".passwordFileName").val();
    var html = template("tpl-upgrade-token", {
        passwordFileName:passwordFileName
    });
    $(".zaly_upgrade").html(html);
}
displayInitUpgrade();

//-------------------------------------site backup-------------------------------------s

var isCheckUpgradeToken = localStorage.getItem(isCheckUpgradeTokenKey);
var isSureSiteBackup = localStorage.getItem(isSureSiteBackup, "yes");

if(isCheckUpgradeToken == "yes" && isSureSiteBackup == 'yes') {
    // displayUpgradeVersion();
}

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
//-------------------------------------page.password.version-------------------------------------

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
                localStorage.setItem(currentUpgradeVersionKey, upgradeVersion);
                var length = Object.keys(versions).length-1;
                localStorage.setItem(endUpgradeVersionKey, Object.keys(versions)[length]);
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


//-------------------------------------page.version.upgrade function-------------------------------------

function sendUpgrade() {
    var upgradeVersionNum = localStorage.getItem(currentUpgradeVersionKey);
    var upgradeSiteVersion = $("#v_"+upgradeVersionNum).attr("version");
    var data = {
        versionCode:upgradeSiteVersion
    }
    clearInterval(upgradeId);

    upgradeId = setInterval(function () {
        checkUpgradeResult();
    }, 1000);

    $.ajax({
        method: "POST",
        url: "./index.php?action=page.version.upgrade",
        data: data,
        success: function (resp) {

        },
        fail:function (resp) {
            console.log(resp);
            alert("请求失败");
        }
    });
}

function upgradeSiteVersion() {
    var upgradeVersionNum = localStorage.getItem(currentUpgradeVersionKey);
    upgradeUpgradeProgress("done");
    var nextUpgradeVersionNum = Number(Number(upgradeVersionNum)+1);
    localStorage.setItem(currentUpgradeVersionKey, nextUpgradeVersionNum);

    var endUpgradeNum = localStorage.getItem(endUpgradeVersionKey);
    if(nextUpgradeVersionNum > Number(endUpgradeNum)) {
        var html = "升级完成，前往站点";
        $(".upgrade_staring_btn").html(html);
        $(".upgrade_staring_btn").attr("goto", "site");
        $(".upgrade_staring_btn").attr("disabled", false);
        return;
    };
    upgradeUpgradeProgress("start");
    sendUpgrade();
}

function updateSiteVersionFailed(resp)
{
    if(resp == "") {
        var info = "请求失败";
    } else {
        var info = resp;
    }
    var info = template("tpl-upgrade-errorInfo", {
        errorInfo:info
    });
    $(".upgrade_info_msg").append(info);
    var upgradeVersionNum = localStorage.getItem(currentUpgradeVersionKey);
    $("."+upgradeVersionNum).attr("src", "../../public/img/upgrade/fail.png");
    $(".text_"+upgradeVersionNum)[0].style.color = "RGBA(244, 67, 54, 1)";
    $(".upgrade_staring_btn").html("升级失败");
}

//-------------------------------------page.version.upgrade-------------------------------------

function upgradeUpgradeProgress(type)
{
    var upgradeVersionNum = localStorage.getItem(currentUpgradeVersionKey);

    try{
        if(type=="done") {
            $("#v_line_"+upgradeVersionNum).attr("src", "../../public/img/upgrade/success_line.png");
            var nextUpgradeVersionNum = Number(Number(upgradeVersionNum)+1);
            $("#v_"+nextUpgradeVersionNum).attr("src", "../../public/img/upgrade/success.png");
            $(".text_"+nextUpgradeVersionNum)[0].style.color = "RGBA(76, 59, 177, 1)";
        } else {
            $("#v_line_"+upgradeVersionNum).attr("src", "../../public/img/upgrade/current_line.png");
            var nextUpgradeVersionNum = Number(Number(upgradeVersionNum)+1);
            $("#v_"+nextUpgradeVersionNum).attr("src", "../../public/img/upgrade/current.png");
            $(".text_"+nextUpgradeVersionNum)[0].style.color = "RGBA(73, 205, 186, 1)";
        }
    }catch(error){
        console.log(error.message);
    }

}

$(document).on("click", ".upgrade_staring_btn", function () {
    var goto = $(this).attr("goto");
    if(goto == "site") {
        window.location.href="./index.php";
        return;
    }
    var html = "正在升级...";
    $(this).html(html);
    $(this).attr("disabled", "disabled");
    upgradeUpgradeProgress("start");
    sendUpgrade();
});


//-------------------------------------page.version.check-------------------------------------


function checkUpgradeResult() {
    $.ajax({
        method: "POST",
        url: "./index.php?action=page.version.check",
        success: function (resp) {
            var data = JSON.parse(resp);
            if(data.upgradeErrCode == "") {
                return;
            }
            clearInterval(upgradeId);
            if (data.upgradeErrCode == "success") {
                upgradeSiteVersion();
            } else {
                updateSiteVersionFailed(resp);
            }
        }
    });
}
