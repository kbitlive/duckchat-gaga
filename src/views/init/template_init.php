
<script id="tpl-protocol-init" type="text/html">

<div class="zaly_protocol_init">
    <div class="zaly_protocol">
        <div class="zaly_protocol_title">
            DuckChat用户协议及免责声明
        </div>
        <div class="zaly_protocol_content">
                        <textarea disabled>特别提示
            北京阿卡信信息技术有限公司在此特别提醒您（用户）在注册成为用户之前，请认真阅读本《用户协议》（以下简称“如故用户协议”），确保您充分理解本协议中各条款。请您审慎阅读并选择接受或不接受本协议。除非您接受本协议所有条款，否则您无权注册、登录或使用本协议所涉服务。您的注册、登录、使用等行为将视为对本协议的接受，并同意接受本协议各项条款的约束。
            本协议约定深圳越界创新科技有限公司与用户之间关于“如故”软件服务（以下简称“服务”）的权利义务。“用户”是指注册、登录、使用本服务的个人。本协议可由深圳越界创新科技有限公司随时更新，更新后的协议条款一旦公布即代替原来的协议条款，恕不再另行通知，用户可在本网站查阅最新版协议条款。在深圳越界创新科技有限公司修改协议条款后，如果用户不接受修改后的条款，请立即停止使用深圳越界创新科技有限公司提供的服务，用户继续使用深圳越界创新科技有限公司提供的服务将被视为接受修改后的协议。
            一、帐号注册 1、用户在使用本服务前需要注册一个“如故”帐号。“如故”帐号应当使用手机号码绑定注册，请用户使用尚未与“如故”帐号绑定的手机号码，以及未被深圳越界创新科技有限公司根据本协议封禁的手机号码注册“如故”帐号。深圳越界创新科技有限公司可以根据用户需求或产品需要对帐号注册和绑定的方式进行变更，而无须事先通知用户。
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

        <div class="init_check_info justify-content-left  ext_pdo_mysql" isLoad="{{isLoadPDOMysql}}"
             style="display:none;">
            <div class="init_check isLoadPDOMysql">
                3.是否安装PDO_Mysql
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
                4.是否安装Curl
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
                5.是否可以正确Curl请求
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
                6.当前目录写权限
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
                7.是否可以加载语言包
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

        <div class="d-flex flex-row justify-content-center " style="text-align: center;margin-bottom: 7rem;">
            <button type="button" class="btn login_button"><span class="span_btn_tip">初始化数据</span></button>
        </div>
    </div>
</script>