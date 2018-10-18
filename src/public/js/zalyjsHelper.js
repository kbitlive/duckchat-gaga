
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

