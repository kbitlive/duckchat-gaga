var clientType = "iOS";
// var callbackIdParamName = "_zalyjsCallbackId"
var callbackIdParamName = "zalyjsCallbackId";

//set pc web referrer
//localStorage, prevent page flush, and the referrer is lost
var refererUrl = document.referrer;
var refererUrlKey = "documentReferer";

refererUrlKeyVal = localStorage.getItem(refererUrlKey);

if(refererUrl.length>0 && (!refererUrlKeyVal) && refererUrlKeyVal.indexOf("from=duckchat")) {
    localStorage.setItem(refererUrlKey, refererUrl);
}
var zalyjsSiteLoginMessageBody = {};


function zalyjsCallbackHelperConstruct() {

    var thiz = this
    this.dict = {}

    //
    // var id = helper.register(callback)
    //
    this.register = function (callbackFunc) {
        var id = Math.random().toString()
        thiz.dict[id] = callbackFunc
        return id
    }

    //
    // helper.call({"_zalyjsCallbackId", "args": ["", "", "", ....]  })
    //
    this.callback = function (param) {
        try {
            // alert("enter =====" + param);
            var paramBase64Decode;
            try {
                paramBase64Decode = decodeURIComponent(escape(window.atob(param)));
            } catch (error) {
                paramBase64Decode = window.atob(param);
            }
            // js json for \n
            param = paramBase64Decode.replace(/\n/g, "\\\\n");

            var paramObj = JSON.parse(param)
            var id = paramObj[callbackIdParamName]

            var args = paramObj["args"]
            var callbackFunc = thiz.dict["" + id]
            if (callbackFunc != undefined) {
                // callback.apply(undefined, args)
                callbackFunc(args);
                delete(thiz.dict[id])
            } else {
                // do log
                console.log("callback", "" + id + "is undefined")
            }
        } catch (error) {
            console.log("callback", error)
            // do log
        }
    }
    return this
};
var zalyjsCallbackHelper = new zalyjsCallbackHelperConstruct();

getOsType();

function getOsType() {
    var u = navigator.userAgent;
    if (u.indexOf('Android') > -1) {
        clientType = 'Android';
    } else if (u.indexOf('iPhone') > -1) {
        clientType = 'IOS';
    } else {
        clientType = "PC";
    }
}

function isMobile() {
    if (/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent)) {
        return true;
    }
    return false;
}

//是否是android客户端
function isAndroid() {
    return clientType.toLowerCase() == "android"
}

//是否为iOS客户端
function isIOS() {
    return clientType.toLowerCase() == "ios"
}

function jsonToQueryString(json) {
    url = Object.keys(json).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(json[k])
    }).join('&')
    return url
}


function addJsByDynamic(url) {
    var script = document.createElement("script")
    script.type = "text/javascript";
    //Firefox, Opera, Chrome, Safari 3+
    script.src = url;

    document.getElementsByTagName('head')[0].appendChild(script);
}

//
//
// Native Javascript
//
//

//-private
function zalyjsSetClientType(t) {
    clientType = t
}


//-private
function zalyjsNavOpenPage(url) {
    var messageBody = {}
    messageBody["url"] = url
    messageBody = JSON.stringify(messageBody)

    if (isAndroid()) {
        window.Android.zalyjsNavOpenPage(messageBody)
    } else if (isIOS()) {
        window.webkit.messageHandlers.zalyjsNavOpenPage.postMessage(messageBody)
    }
}

//-public
function zalyjsOpenPage(url) {
    location.href = url;
}

//-public
function zalyjsOpenNewPage(url) {
    if (isMobile()) {
        zalyjsNavOpenPage(url);
    } else {
        //new page
        window.open(url, "_blank");
    }
}

//-public
function zalyjsLoginSuccess(loginName, sessionid, isRegister, callback) {

    var callbackId = zalyjsCallbackHelper.register(callback)
    var messageBody = {}
    messageBody["loginName"] = loginName
    messageBody["sessionid"] = sessionid
    messageBody["isRegister"] = (isRegister == true ? true : false)
    messageBody[callbackIdParamName] = callbackId
    messageBody = JSON.stringify(messageBody)

    if (isAndroid()) {
        window.Android.zalyjsLoginSuccess(messageBody)
    } else if (isIOS()) {
        window.webkit.messageHandlers.zalyjsLoginSuccess.postMessage(messageBody)
    } else {
        loginPcClient(messageBody, callback.name);
    }
}

// -private
function zalyjsWebSuccessCallBack() {
    var refererUrl = localStorage.getItem(refererUrlKey);
    if (!refererUrl) {
        refererUrl = "./index.php";
    }
    localStorage.clear();
    window.location.href = refererUrl;
}

// -private  登录pc, 暂时没有使用callbackId,
function loginPcClient(messageBody, callbackName) {
    messageBody = JSON.parse(messageBody);
    var refererUrl = localStorage.getItem(refererUrlKey);
    zalyjsSiteLoginMessageBody = messageBody;
    zalyjsSiteLoginMessageBody.refererUrl = refererUrl;
    zalyjsSiteLoginMessageBody.callbackName = callbackName;

    if (!refererUrl) {
        refererUrl = "./index.php";
    }

    if (messageBody.isRegister == false) {
        if (refererUrl.indexOf("?") > -1) {
            var jsUrl = refererUrl + "&action=page.js&loginName=" + messageBody.loginName + "&success_callback=zalyjsWebLoginSuccess&fail_callback=" + callbackName;
        } else {
            var jsUrl = refererUrl + "?action=page.js&loginName=" + messageBody.loginName + "&success_callback=zalyjsWebLoginSuccess&fail_callback=" + callbackName;
        }
        addJsByDynamic(jsUrl);
        return;
    }
    zalyjsWebLoginSuccess();
}


// -private 登录成功后，web回调
function zalyjsWebLoginSuccess() {
    var refererUrl = zalyjsSiteLoginMessageBody.refererUrl;
    if (!refererUrl) {
        refererUrl = "./index.php";
    }

    if (refererUrl) {
        if (refererUrl.indexOf("?") > -1) {
            var refererUrl = refererUrl + "&preSessionId=" + zalyjsSiteLoginMessageBody.sessionid + "&isRegister=" + zalyjsSiteLoginMessageBody.isRegister;
        } else {
            var refererUrl = refererUrl + "?preSessionId=" + zalyjsSiteLoginMessageBody.sessionid + "&isRegister=" + zalyjsSiteLoginMessageBody.isRegister;
        }
        refererUrl = refererUrl + " &fail_callback=" + zalyjsSiteLoginMessageBody.callbackName + "&success_callback=zalyjsWebSuccessCallBack";
        addJsByDynamic(refererUrl);
    }
}

//// -private web 检查用户是否已经被注册
function zalyjsWebCheckUserExists(failedCallback, successCallback) {
    var refererUrl = localStorage.getItem(refererUrlKey);
    if (!refererUrl) {
        refererUrl = "./index.php";
    }
    if (refererUrl.indexOf("?") > -1) {
        var jsUrl = refererUrl + "&action=page.js&loginName=" + registerLoginName + "&success_callback=" + successCallback.name + "&fail_callback=" + failedCallback.name;
    } else {
        var jsUrl = refererUrl + "?action=page.js&loginName=" + registerLoginName + "&success_callback=" + successCallback.name + "&fail_callback=" + failedCallback.name;
    }
    addJsByDynamic(jsUrl);
}

// -public
function zalyjsLoginConfig(callback) {
    var callbackId = zalyjsCallbackHelper.register(callback)

    var messageBody = {}
    messageBody[callbackIdParamName] = callbackId
    messageBody = JSON.stringify(messageBody)

    if (isAndroid()) {
        window.Android.zalyjsLoginConfig(messageBody)
    } else if (isIOS()) {
        window.webkit.messageHandlers.zalyjsLoginConfig.postMessage(messageBody)
    } else {
        var siteConfigJsUrl = "./index.php?action=page.siteConfig&callback=" + callback.name;
        addJsByDynamic(siteConfigJsUrl);
    }
}

//-public
function zalyjsClosePage() {
    if (isAndroid()) {
        window.Android.zalyjsNavClose()
    } else if (isIOS()) {
        window.webkit.messageHandlers.zalyjsNavClose.postMessage("");
    } else {
        window.close();
    }
}

//-public
function zalyjsGoto(page, xarg) {

    var gotoUrl = "duckchat://0.0.0.0/goto?page=" + page + "&x=" + xarg;

    if (isAndroid()) {
        window.Android.zalyjsGoto(gotoUrl);
    } else if (isIOS()) {
        window.webkit.messageHandlers.zalyjsGoto.postMessage(gotoUrl);
    }
}

//-public
function zalyjsBackPage() {
    if (isAndroid()) {
        window.Android.zalyjsNavBack();
    } else if (isIOS()) {
        var messageBody = {};
        window.webkit.messageHandlers.zalyjsNavBack.postMessage("");
    }
}


//-public
function zalyjsImageUpload(callback) {
    var callbackId = zalyjsCallbackHelper.register(callback);
    var messageBody = {};
    messageBody[callbackIdParamName] = callbackId;
    messageBody = JSON.stringify(messageBody);

    if (isAndroid()) {
        window.Android.zalyjsImageUpload(messageBody);
    } else if (isIOS()) {
        window.webkit.messageHandlers.zalyjsImageUpload.postMessage(messageBody);
    }
}