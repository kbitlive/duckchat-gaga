
<script id="tpl-protocol-init" type="text/html">

<div class="zaly_protocol_init">
    <div class="zaly_protocol">
        <div class="zaly_protocol_title">
            DuckChat用户协议及免责声明
        </div>
        <div class="zaly_protocol_content">
                        <textarea disabled>
北京阿卡信信息技术有限公司（以下简称”我公司”）提醒您：在使用DuckChat客户端（以下简称”本软件”）前，请您务必仔细阅读并透彻理解本声明。

1. 如果您使用本软件，您的使用行为将被视为对本声明全部内容的认可。除非您已充分阅读、完全理解并接受本协议所有条款，否则您无权使用服务。您点击“同意”或“下一步”，或您使用服务，或者以其他任何明示或者默示方式表示接受本协议的，均视为您已阅读并同意签署本协议。本协议即在您与我公司之间产生法律效力，成为对双方均具有约束力的法律文件。
2. 此软件是一个用以访问特定IM协议服务器的客户端，最终服务由您输入的服务器地址对应的站点提供，此软件只是一个访问工具。您在使用站点服务的过程前后，任何疑问、需求、投诉，应自行联系站点管理员予以解决。
3. 我公司尊重用户的个人隐私权，此软件自身不会收集您手机号、身份证、银行等信息。但是为了提高产品质量，您同意我们收集程序质量相关日志用以提高产品质量，如崩溃后的崩溃日志等。
4. 在您使用站点服务的过程中，如在登录过程、聊天记录等涉及到您的手机号、银行卡、昵称等各类数据，均保存在您访问的站点上，由您正在访问的站点负责管控，与我公司无关。我公司在此提醒您：在访问第三方站点时请谨慎输入个人隐私资料。
5. 为了您的使用安全，请勿绕过AppStore等其他官方渠道下载被嵌入恶意代码的客户端，如果您自行下载的恶意客户端窃取了您的资料，我公司不予负责。
6. 因软件为一个技术产品，难免会有Bug等问题，我公司对于用户的反馈将认真负责，积极解决，但无法保证随时响应随时解决，也无法对您无法正常使用此软件造成的损失予以负责。
7. 您通过本客户端发出与传播的内容（包括但不限于网页、文字、图片、音频、视频、图表等），应符合相关法律规定，并由您承担责任。
8. 若用户未满18周岁，则为未成年人，应在监护人监护、指导下阅读本协议和使用本软件。
9. 您在访问站点的过程中，请遵守站点所在国的相关法律以及站点管理员的其他协议告知，否则站点管理员有权、有责任对您在站点的数据进行删除、屏蔽等，相关行为包括但不限于：
    - 反对宪法所确定的基本原则的。
    - 危害国家安全，泄露国家秘密，颠覆国家政权，破坏国家统一的。
    - 损害国家荣誉和利益的。
    - 煽动民族仇恨、民族歧视，破坏民族团结的。
    - 破坏国家宗教政策，宣扬邪教和封建迷信的。
    - 散布谣言，扰乱社会秩序，破坏社会稳定的。
    - 散布淫秽、色情、赌博、暴力、凶杀、恐怖或者教唆犯罪的。
    - 侮辱或者诽谤他人，侵害他人合法权益的。
    - 其他您与站点在使用服务前签署的使用协议。
10. 若本协议有中文、英文等多个语言版本，相应内容不一致的，均以中文版的内容为准。
11. 本协议的签署地为北京市朝阳区。
12. 如果您是中国大陆地区以外的用户，您订立或履行本协议还需要同时遵守您所属和/或所处国家或地区的法律。
13. 对此条款的解释、修改及更新权均属于我公司所有。


北京阿卡信信息技术有限公司

2018-09-26
                        </textarea>
        </div>
    </div>
    <div class="zaly_protocol_operation">
        <button class="zaly_protocol_sure " data-local-value="agreeTip">同意并继续</button>
    </div>
    <div class="zaly_protocol_cancel">不同意可直接关掉该浏览器</div>
</div>

</script>

<script id="tpl-upgrade-tip" type="text/html">
    <div class="zaly_site_upgrade">
        <div class="zaly_site_upgrade_title">发现新版本</div>
        <div class="zaly_site_upgrade_tip">当前版本为{{siteVersion}}，服务器发现有新版本可升级，去体验一下吧！</div>
        <div class="zaly_site_upgrade_operation">
            <button class="zaly_site_upgrade_sure" data-local-value="upgradeNowTip">立即升级</button>
        </div>
        <div class="zaly_site_upgrade_cancel">
            <span style="color: #666666;font-size:1.13rem;font-family:PingFangSC-Regular;font-weight:400;"  data-local-value="jumpUpgradeContentTip">以后再说</span>
            <span onclick="newStepForCheckEnv('next_step')" style="font-size:1.13rem;font-family:PingFangSC-Regular;font-weight:400;color:#4C3BB1;cursor: pointer; " data-local-value="jumpUpgradeTip">跳过</span>
        </div>
    </div>
</script>


<script id="tpl-check-site-environment" type="text/html">
    <div class="initDiv " style="margin-top:2rem;">
        <div class="initHeader" style="">
            检测站点信息
        </div>
        <div class="initHeader-title">
            环境基础检测
        </div>
        <div class="init_check_info margin-top5 " isLoad="{{isPhpVersionValid}}">
            <div class="init_check">
                1.PHP版本大于5.6
            </div>
            <div class="init_check_result isPhpVersionValid">
                {{if isPhpVersionValid}}
                    <img src='../../public/img/init/check_success.png' />
                {{else}}
                    <img src='../../public/img//init/check_failed.png'  />
                {{/if}}
            </div>
        </div>

        <div class="init_check_info  ext_open_ssl" isLoad="isLoadOpenssl">
            <div class="init_check isLoadOpenssl">
                2.是否支持OpenSSL
            </div>
            <div class="init_check_result">
                {{if isLoadOpenssl}}
                <img src='../../public/img/init/check_success.png' />
                {{else}}
                <img src='../../public/img//init/check_failed.png'  />
                {{/if}}
            </div>
        </div>

        <div class="init_check_info justify-content-left  ext_pdo_sqlite" isLoad="{{isLoadPDOSqlite}}">
            <div class="init_check isLoadPDOSqlite">
                3.是否安装PDO_Sqlite
            </div>
            <div class="init_check_result">
                {{if isLoadPDOSqlite}}
                <img src='../../public/img/init/check_success.png' />
                {{else}}
                <img src='../../public/img//init/check_failed.png'  />
                {{/if}}
            </div>
        </div>


        <div class="init_check_info justify-content-left ext_curl" isLoad="{{isLoadPDOMysql}}">
            <div class="init_check isLoadPDOMysql">
                4.是否安装PDO_Mysql
            </div>
            <div class="init_check_result">
                {{if isLoadPDOMysql}}
                <img src='../../public/img/init/check_success.png' />
                {{else}}
                <img src='../../public/img//init/check_failed.png'  />
                {{/if}}
            </div>
        </div>

        <div class="init_check_info justify-content-left ext_curl" isLoad="{{isLoadCurl}}">
            <div class="init_check isLoadCurl">
                5.是否安装Curl
            </div>
            <div class="init_check_result">
                {{if isLoadCurl}}
                <img src='../../public/img/init/check_success.png' />
                {{else}}
                <img src='../../public/img//init/check_failed.png'  />
                {{/if}}
            </div>
        </div>

        <div class="init_check_info justify-content-left ext_curl" isLoad="{{isCanUseCurl}}">
            <div class="init_check isLoadCurl">
                6.是否可以正确Curl请求
            </div>
            <div class="init_check_result">
                {{if isCanUseCurl}}
                <img src='../../public/img/init/check_success.png' />
                {{else}}
                <img src='../../public/img//init/check_failed.png'  />
                {{/if}}
            </div>
        </div>


        <div class="init_check_info justify-content-left  ext_is_write" isLoad="{{isWritePermission}}">
            <div class="init_check isWritePermission">
                7.当前目录写权限
            </div>
            <div class="init_check_result">
                {{if isWritePermission}}
                <img src='../../public/img/init/check_success.png' />
                {{else}}
                <img src='../../public/img//init/check_failed.png'  />
                {{/if}}
            </div>
        </div>

        <div class="init_check_info justify-content-left  ext_is_write" isLoad="{{isLoadProperties}}">
            <div class="init_check isLoadProperties">
                8.是否可以加载语言包
            </div>
            <div class="init_check_result">
                {{if isLoadProperties}}
                <img src='../../public/img/init/check_success.png' />
                {{else}}
                <img src='../../public/img//init/check_failed.png'  />
                {{/if}}
            </div>
        </div>

        <div style="margin-top:4rem;margin-bottom: 5rem;">
            <button class="previte_init_protocol" data-local-value="prevStepTip">上一步</button>
            <button class="next_init_data" data-local-value="nextStepTip">下一步</button>
        </div>
</script>


<script id="tpl-init-data" type="text/html">
    <div class="initDiv ">
        <img style="width: 3rem;height: 3rem;margin-top:2rem;margin-left: 2rem;cursor: pointer;" onclick="newStepForCheckEnv('data_init')" src="../../public/img/back.png">
        <div class="initHeader" style="margin-top: 0rem;">
            数据初始化
        </div>
        <div class="initHeader-setting">
            邀请码<span style="font-size: 1rem;color: #FF6500;">（注：第一个用户使用此邀请码则为管理员）</span>
        </div>
        <div class="initHeader-uic">
            <input type="text" class="uic-input" placeholder="000000, 纯数字，6-20位">
        </div>

        <div class="initHeader-setting">
            请选择登录方式：
            <select id="verifyPluginId">
                <option class="selectOption" pluginId="102">本地账户密码校验</option>
            </select>
        </div>

        <div class="initHeader-setting">
            安装程序支持的配置
        </div>

        <div class="initHeader-sql">
            <div class="radioDiv" onclick="clickRadio('sqlite')">sqlite <span><img
                            src="../../public/img/init/select.png" class="dbType radioImg sqliteRadio" data="sqlite"
                            isSelected="1"> </span></div>
            <div class="radioDiv" onclick="clickRadio('mysql')">mysql <span><img
                            src="../../public/img/init/un_select.png" class="dbType radioImg mysqlRadio"
                            data="mysql" isSelected="0"></span></div>
        </div>


        <div class="mysql-div">
            <!--       sql address         -->
            <div class="sql-setting mysql-setting">
                <input type="text" class="sql-input sql-dbHost" placeholder="数据库地址">
                <img src="../../public/img/init/failed.png" class="failed_img dbHostFailed">
            </div>
            <!--       sql port         -->
            <div class="sql-setting mysql-setting">
                <input type="text" class="sql-input sql-dbPort" placeholder="数据库端口号,默认：3306">
                <img src="../../public/img/init/failed.png" class="failed_img dbPortFailed">
            </div>
            <!--      sql name          -->
            <div class="sql-setting mysql-setting">
                <input type="text" class="sql-input sql-dbName" placeholder="数据库名称">
                <img src="../../public/img/init/failed.png" class="failed_img dbNameFailed">
            </div>
            <!--      sql user          -->
            <div class="sql-setting mysql-setting">
                <input type="text" class="sql-input sql-dbUserName" placeholder="用户名">
                <img src="../../public/img/init/failed.png" class="failed_img dbUserNameFailed">
            </div>
            <!--      sql password          -->
            <div class="sql-setting mysql-setting">
                <input type="text" class="sql-input sql-dbPassword" placeholder="数据库密码">
                <img src="../../public/img/init/failed.png" class="failed_img dbPasswordFailed">
            </div>
        </div>
        <div class="sqlite-div">
            本地文件
            <select id="sqlite-file">
                <option class="selectOption" fileName="">创建新Sqlite数据库</option>
                    {{each dbFiles as file }}
                        <option class="selectOption {{file}}" fileName="{{file}}">{{file}}</option>
                    {{/each}}
            </select>
        </div>

        <div class="errorInfo">
        </div>

        <div class="d-flex flex-row justify-content-center init_data_btn" >
            <button type="button" class="btn login_button"><span class="span_btn_tip">初始化数据</span></button>
        </div>
    </div>
</script>

<script id="tpl-error-info" type="text/html">
        {{errorInfo}}
        <a style='color:rgba(76,59,177,1);' href='https://duckchat.akaxin.com/wiki/server/faq-mysql.md'>数据库常见问题汇总</a>
    </script>