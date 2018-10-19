<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登录</title>
    <!-- Latest compiled and minified CSS -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="../../public/css/login.css?_version=<?php echo $versionCode?>">
    <script type="text/javascript" src="../../public/js/jquery.min.js"></script>
    <script src="../../public/js/jquery.i18n.properties.min.js"></script>
        <script src="../../public/js/zalyjsNative.js?_version=<?php echo $versionCode?>"></script>
    <script src="../../public/js/template-web.js"></script>
    <script src="../../public/js/zalyjsHelper.js"></script>
    <style>
        </style>
</head>
<body>
<div class="site-warning"></div>
<div class="zaly_container">

    <div class="container">
        <div  class="login_custom_made">
            <div class="company_custom_made">
                <div>
                    <img src="../../public/img/login/logo.png" class="company_logo">
                </div>
                <div>
                    <span class="company_name">Duckchat</span>
                </div>
                <div class="company_slogan">
                    拥有自己的聊天软件，安全可靠、私有部署、随意定制
                    拥有自己的聊天软件，安全可靠、私有部署、随意定制
                    拥有自己的聊天软件，安全可靠、私有部署、随意定制
                    拥有自己的聊天软件，安全可靠、私有部署、随意定制
                </div>
                <div class="site_version">
                    v1.0.13
                </div>
            </div>
        </div>
        <div  class="login_div">
            <div class="zaly_login zaly_login_by_pwd" >
                <div class="login_input_div" >
                    <div style="position: relative; height: 100%;">
                        <div>
                            <div class="mobile_logo_div">
                                <img class="mobile_logo" src="../../public/img/login/mobile_logo.png">
                            </div>
                            <div class="d-flex flex-row justify-content-center login-header" style="text-align: center;">
                                <span class="login_phone_tip_font" data-local-value="loginTip">登录</span>
                            </div>

                            <div class=" d-flex flex-row justify-content-left login_name_div" >
                                <image src="../../public/img/login/loginName.png" class="img"/>
                                <input type="text" class="input_login_site  login_input_loginName" datatype="s" autocapitalize="off"  data-local-placeholder="loginNamePlaceholder" placeholder="输入登录名" >
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
                            拥有自己的聊天软件，安全可靠、私有部署、随意定制
                            拥有自己的聊天软件，安全可靠、私有部署、随意定制
                            拥有自己的聊天软件，安全可靠、私有部署、随意定制
                            拥有自己的聊天软件，安全可靠、私有部署、随意定制
                        </div>
                    </div>
                </div>
            </div>

            <div class="zaly_login zaly_site_register zaly_site_register-name" style="display: none;">

            </div>

            <div class="zaly_login zaly_site_register zaly_site_register-invitecode" style="display: none;">
                <div class="back">
                    <img src="../../public/img/back.png" style="margin-left: 2rem; width: 3rem;height:3rem; margin-top: 2rem;cursor: pointer;" onclick="returnRegisterDiv(); return false;"/>
                </div>
                <div class="login_input_div" >
                    <div class="d-flex flex-row justify-content-center login-header"style="text-align: center;margin-top: 8rem;margin-bottom: 1rem;">
                        <span class="login_phone_tip_font" data-local-value="registerInvitationCodeTip" >输入邀请码</span>
                    </div>

                    <div class="code_div login_name_div_mobile" style="margin-top: 8rem;">
                        <input type="text" class="input_login_site register_input_code" style="margin-left: 0rem;" data-local-placeholder="enterCodePlaceholder" autocapitalize="off"   placeholder="输入邀请码"  >
                        <div class="line" ></div>
                    </div>

                    <div class="d-flex flex-row justify-content-center " >
                        <button type="button" class="btn register_button"  style="margin-top: 7rem;"><span class="span_btn_tip" data-local-value="registerBtnTip">注册并登录</span></button>
                    </div>
                </div>
            </div>

            <div class="zaly_login zaly_site_register zaly_site_update-invitecode" style="display: none;">
                <div class="back">
                    <img src="../../public/img/back.png" style="margin-left: 2rem; width: 3rem;height:3rem; margin-top: 2rem;cursor: pointer;" onclick="returnLoginDiv(); return false;"/>
                </div>
                <div class="login_input_div" >
                    <div class="d-flex flex-row justify-content-center login-header "style="text-align: center;margin-top: 8rem;margin-bottom: 1rem;">
                        <span class="login_phone_tip_font" data-local-value="registerInvitationCodeTip" >输入邀请码</span>
                    </div>

                    <div class="code_div login_name_div_mobile" style="margin-top: 8rem;">
                        <input type="text" class="input_login_site update_input_code" autocapitalize="off" style="margin-left: 0rem;" data-local-placeholder="enterCodePlaceholder" onkeydown="registerAndLoginByKeyDown(event)" placeholder="输入邀请码"  >
                        <div class="line" ></div>
                    </div>

                    <div class="d-flex flex-row justify-content-center " >
                        <button type="button" class="btn update_code_btn"  style="margin-top: 7rem;"><span class="span_btn_tip" data-local-value="registerBtnTip">注册并登录</span></button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<?php include(dirname(__DIR__) . '/passport/template_login.php'); ?>

<input type="hidden" value="<?php echo $isDuckchat; ?>" class="isDuckchat">
<script src="../../public/js/zalyjsHelper.js?_version=<?php echo $versionCode?>"></script>
<script src="../../public/js/im/zalyKey.js?_version=<?php echo $versionCode?>"></script>
<script src="../../public/js/im/zalyAction.js?_version=<?php echo $versionCode?>"></script>
<script src="../../public/js/im/zalyClient.js?_version=<?php echo $versionCode?>"></script>
<script src="../../public/js/im/zalyBaseWs.js?_version=<?php echo $versionCode?>"></script>
<script src="../../public/js/login/login.js?_version=<?php echo $versionCode?>"></script>


</body>
</html>
