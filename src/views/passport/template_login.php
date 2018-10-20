
<script id="tpl-register-div" type="text/html">

    <div class="login_input_div" >
        <div class="d-flex flex-row justify-content-center login-header"style="text-align: center;margin-top: 2rem;margin-bottom: 1rem;">
            <span class="login_phone_tip_font" data-local-value="registerTip" >注册</span>
        </div>

        <div class="d-flex flex-row justify-content-left login_name_div margin-top2 login_name_div_mobile" >
            <image src="../../public/img/login/loginName.png" class="img"/>
            {{if loginNameAlias }}
            <input type="text" id="register_input_loginName"  datatype="s"  class="input_login_site  register_input_loginName"   autocapitalize="off"   placeholder="{{loginNameAlias}}" >
            {{else}}
            <input type="text" id="register_input_loginName"  datatype="s"  class="input_login_site  register_input_loginName" data-local-placeholder="registerLoginNamePlaceholder"  autocapitalize="off"   placeholder="用户名以字母、数字、下划线，1-16个字符" >
            {{/if}}
            <img src="../../public/img/msg/msg_failed.png" class="img-failed register_input_loginName_failed">
            <div class="line"></div>
        </div>

        <div class="login_name_div" style="margin-top: 2rem;">
            <image src="../../public/img/login/pwd.png" class="img"/>
            <input type="password" class="input_login_site register_input_pwd" autocapitalize="off"   id="register_input_pwd" data-local-placeholder="enterPasswordPlaceholder"  placeholder="输入密码, 长度5到20个字符(无中文)"  >
            <div class="pwd_div" onclick="changeImgByClickPwd()"><image src="../../public/img/login/hide_pwd.png" class="pwd" img_type="hide"/></div>
            <img src="../../public/img/msg/msg_failed.png" class="img-failed register_input_pwd_failed">
        </div>
        <div class="line"></div>

        <div class="login_name_div" style="margin-top: 2rem;">
            <image src="../../public/img/login/pwd.png" class="img"/>
            <input type="password" class="input_login_site register_input_repwd" autocapitalize="off"   id="register_input_repwd" data-local-placeholder="enterRepasswordPlaceholder"  placeholder="再次输入密码"  >
            <div class="repwd_div" onclick="changeImgByClickRepwd()"><image src="../../public/img/login/hide_pwd.png" class="repwd" img_type="hide"/></div>
            <img src="../../public/img/msg/msg_failed.png" class="img-failed register_input_repwd_failed">
            <div class="line" ></div>
        </div>

        <div class="login_name_div" style="margin-top: 2rem;">
            <image src="../../public/img/login/nickname.png" class="img"/>
            <input type="text" class="input_login_site register_input_nickname"  autocapitalize="off"  id="register_input_nickname" data-local-placeholder="enterNicknamePlaceholder" placeholder="输入昵称,1-16个字符"  >
            <img src="../../public/img/msg/msg_failed.png" class="img-failed register_input_nickname_failed">
            <div class="line"></div>
        </div>

        <div class="login_name_div" style="margin-top: 2rem;">
            <image src="../../public/img/login/find_pwd.png" class="img"/>

            {{if enableInvitationCode == 1}}
                {{if passwordFindWay }}
                    <input type="text" class="input_login_site register_input_email" autocapitalize="off"  id="register_input_email"  placeholder="{{passwordFindWay}}" >
                {{else}}
                    <input type="text" class="input_login_site register_input_email" autocapitalize="off"  id="register_input_email" data-local-placeholder="enterEmailPlaceholder" placeholder="输入邮箱" >
                {{/if}}
            {{else }}
                {{if passwordFindWay }}
                    <input type="text" class="input_login_site register_input_email" autocapitalize="off"  id="register_input_email"  placeholder="{{passwordFindWay}}" onkeydown="registerAndLoginByKeyDown(event)">
                {{else}}
                    <input type="text" class="input_login_site register_input_email" autocapitalize="off"  id="register_input_email" data-local-placeholder="enterEmailPlaceholder" onkeydown="registerAndLoginByKeyDown(event)" placeholder="输入邮箱" >
                {{/if}}
            {{/if}}
            <img src="../../public/img/msg/msg_failed.png" class="img-failed register_input_email_failed">
            <div class="line"></div>
        </div>
        <div style="font-size:1.31rem;font-family:PingFangSC-Regular;font-weight:400;color:rgba(153,153,153,1);"data-local-value="findPasswordTip" >通过此信息联系管理员找回密码。</div>


        <div class="d-flex flex-row justify-content-center ">
            {{if enableInvitationCode == 1}}
            <button type="button" class="btn register_code_button"><span class="span_btn_tip" data-local-value="registerBtnCodeTip">下一步</span></button>
            {{else }}
            <button type="button" class="btn register_button"><span class="span_btn_tip" data-local-value="registerBtnTip">注册并登录</span></button>
            {{/if}}
        </div>

        <div class="d-flex flex-row register_span_div login_span_div" >
            <span style="color:rgba(153,153,153,1);" data-local-value="hasAccountTip">已有账号？</span>
            <span onclick="registerForLogin()" data-local-value="loginTip">登录</span>
        </div>
    </div>
</script>


<script type="text/html" id="tpl-login-div">
    <div style="position: relative; height: 100%;">
        <div>
            <div class="mobile_logo_div">
                {{if siteLogo}}
                <img class="mobile_logo" src="{{siteLogo}}">
                {{else}}
                <img class="mobile_logo" src="../../public/img/login/mobile_logo.png">
                {{/if}}
            </div>
            <div class="d-flex flex-row justify-content-center login-header" style="text-align: center;">
                <span class="login_phone_tip_font" data-local-value="loginTip">登录</span>
            </div>

            <div class=" d-flex flex-row justify-content-left login_name_div" >
                <image src="../../public/img/login/loginName.png" class="img"/>
                {{if loginNameAlias }}
                 <input type="text" class="input_login_site  login_input_loginName" datatype="s" autocapitalize="off"  placeholder="{{loginNameAlias}}" >
                {{else}}
                    <input type="text" class="input_login_site  login_input_loginName" datatype="s" autocapitalize="off"  data-local-placeholder="loginNamePlaceholder" placeholder="输入登录名" >
                {{/if}}
                <div class="clearLoginName" onclick="clearLoginName()"><image src="../../public/img/msg/btn-x.png" class="clearLoginName clear_img" /></div>
                <img src="../../public/img/msg/msg_failed.png" class="img-failed login_input_loginName_failed">
            </div>
            <div class="line"></div>

            <div class="login_name_div margin-top2">
                <image src="../../public/img/login/pwd.png" class="img"/>
                <input type="password" class="input_login_site phone_num  login_input_pwd" autocapitalize="off"  data-local-placeholder="enterPasswordPlaceholder"  onkeydown="loginPassportByKeyPress(event)"  placeholder="输入密码, 长度5到20个字符(无中文)" >
                <div class="pwd_div" onclick="changeImgByClickPwd()"><image src="../../public/img/login/hide_pwd.png" class="pwd" img_type="hide" /></div>
                <img src="../../public/img/msg/msg_failed.png" class="img-failed login_input_pwd_failed">
            </div>
            <div class="line"></div>


            <div class="d-flex flex-row justify-content-center ">
                <button type="button" class="btn login_button" ><span class="span_btn_tip" data-local-value="loginTip">登录</span></button>
            </div>

            <div class="d-flex flex-row register_span_div" >
                <span onclick="registerForPassportPassword()" style="color: RGBA(0, 0, 0, 0.2);" data-local-value="noAccountTip">还没有账户？</span> <span onclick="registerForPassportPassword()" data-local-value="registerContentTip">去注册</span>
            </div>
        </div>
        <div class="mobile_slogn_div" style="position: absolute;bottom:3rem;">
            {{if loginWelcomeText }} {{loginWelcomeText}} {{else}}
            这是一个使用DuckChat系统搭建的聊天站点，此处的描述内容可以在管理后台进行修改配置。<br/>官网：<a target="_blank" href="https://duckchat.akaxin.com">https://duckchat.akaxin.com</a>
            {{/if}}
        </div>
    </div>
</script>

<script type="text/html" id="tpl-company-custom-made">
    <div class="company_custom_made">
        <div>
            {{if siteLogo}}
             <img src="{{siteLogo}}" class="company_logo">
            {{else }}
                <img src="../../public/img/login/logo.png" class="company_logo">
            {{/if}}
        </div>
        <div>
            {{if siteName }}
            <span class="company_name">{{siteName}}</span>
            {{else}}
            <span class="company_name">Duckchat</span>
            {{/if}}
        </div>
        <div class="company_slogan">
            {{if loginWelcomeText }} {{loginWelcomeText}} {{else}}
                这是一个使用DuckChat系统搭建的聊天站点，此处的描述内容可以在管理后台进行修改配置。<br/>官网：<a target="_blank" href="https://duckchat.akaxin.com">https://duckchat.akaxin.com</a>
            {{/if}}
        </div>
        <div class="site_version">
            {{siteVersionName}}
        </div>
    </div>
</script>

<script type="text/html" id="tpl-string">
    {{string}}
</script>