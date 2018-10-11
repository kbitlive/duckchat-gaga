
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