
//多语言序号

UserClientLangZH = "1";
UserClientLangEN = "0";

//语言国际化，替换文案
function handleHtmlLanguage(html)
{
    try{
        $(html).find("[data-local-value]").each(function () {
            var changeHtmlValue = $(this).attr("data-local-value");
            var valueHtml = $(this).html();
            var newValueHtml = $.i18n.map[changeHtmlValue];
            if(newValueHtml != undefined && newValueHtml != "" && newValueHtml != false) {
                html = html.replace(valueHtml, newValueHtml);
            }
        });

        $(html).find("[data-local-placeholder]").each(function () {
            var placeholderValue = $(this).attr("data-local-placeholder");
            var placeholder = $(this).attr("placeholder");
            var newPlaceholder = $.i18n.map[placeholderValue];
            if(newPlaceholder != undefined && newPlaceholder != false && newPlaceholder != "") {
                html = html.replace(placeholder, newPlaceholder);
            }
        });
    }catch (error) {

    }
    return html;
}

//获取语言序号
function getLanguage() {
    var nl = navigator.language;
    if ("zh-cn" == nl || "zh-CN" == nl) {
        return UserClientLangZH;
    }
    return UserClientLangEN;
}

//加载语言包
function getLanguageName() {
    var nl = navigator.language;
    if ("zh-cn" == nl || "zh-CN" == nl) {
        return "zh";
    }
    return "en";
}

languageName = getLanguageName();
languageNum = getLanguage();



function isMobile(phoneNum)
{
    var reg = /^((1[3-8][0-9])+\d{8})$/;
    return reg.test(phoneNum);
}


function showWindow(jqElement)
{
    jqElement.css("visibility", "visible");
    $(".wrapper-mask").css("visibility", "visible").append(jqElement);
}

function removeWindow(jqElement)
{
    jqElement.remove();
    $(".wrapper-mask").css("visibility", "hidden");
    $("#all-templates").append(jqElement);
}



function addTemplate(jqElement)
{
    $("#all-templates").append(jqElement);
}



//点击触发一个对象的点击
function uploadFile(obj)
{
    $("#"+obj).val("");
    $("#"+obj).click();
}

function showLoading(jeElement) {
    try{
        var html = "<div class=\"loader\" > <div class=\"circular_div\"> <svg class=\"circular\" viewBox=\"25 25 50 50\"> <circle class=\"path\" cx=\"50\" cy=\"50\" r=\"20\" fill=\"none\" stroke-width=\"2\" stroke-miterlimit=\"10\"/> </svg> </div> </div>";
        jeElement.append(html);
        $(".loader")[0].style.display = "flex";
    }catch (error) {
        console.log(error)
    }
}

function showMiniLoading(jeElement) {
    try{
        var html = "<div class=\"loader\" > <div class=\"mini_circular_div\"> <svg class=\"mini_circular\" viewBox=\"25 25 50 50\"> <circle class=\"path\" cx=\"50\" cy=\"50\" r=\"20\" fill=\"none\" stroke-width=\"2\" stroke-miterlimit=\"10\"/> </svg> </div> </div>";
        jeElement.append(html);
        $(".loader")[0].style.display = "flex";
    }catch (error) {
        console.log(error)
    }
}
function hideLoading() {
   try{
       $(".loader").remove();
   }catch (error) {
       console.log(error)
   }
}

function getLoadingCss()
{
    var cssId = 'loading';  // you could encode the css path itself to generate id..
    if (!document.getElementById(cssId))
    {
        var head  = document.getElementsByTagName('head')[0];
        var link  = document.createElement('link');
        link.id   = cssId;
        link.rel  = 'stylesheet';
        link.type = 'text/css';
        link.href = '../../public/css/loading.css';
        link.media = 'all';
        head.appendChild(link);
    }
}

getLoadingCss();


function cancelLoadingBySelf()
{
    setTimeout(function () {
        hideLoading();
    }, 1000);
}
function checkIsEntities(str){
    var entitiesReg = /(&nbsp;|&#160;|&lt;|&#60;|&gt;|&#62;|&amp;|&#38;|&quot;|&#34;|&apos;|&#39;|&cent;|&#162;|&pound;|&#163;|&yen;|&#165;|&euro;|&#8364;|&sect;|&#167;|&copy;|&#169;|&reg;|&#174;|&times;|&#215;|&divide;|&#247;|&)/g;
    var arrEntities = str.match(entitiesReg);
    if(arrEntities != null) {
        return true;
    }
    return false;
}


function trimString(str){
    return  str.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, '');
}


function isWeixinBrowser(){
    return /micromessenger/.test(navigator.userAgent.toLowerCase())
}

function getOsType() {
    var clientType;
    var u = navigator.userAgent;
    if (u.indexOf('Android') > -1) {
        clientType =  'Android';
    } else if (u.indexOf('iPhone') > -1) {
        clientType = 'IOS';
    } else {
        clientType = "PC";
    }
    return clientType;
}

