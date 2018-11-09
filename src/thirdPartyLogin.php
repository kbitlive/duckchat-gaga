<?php
return array(
    'localLanding' => array(
        'name' => '192.168.3.6',
        'logo' => "",
        'landingUrl' => "http://192.168.3.6/index.php?action=page.passport.login",
        'verifyUrl' => "http://192.168.3.6/index.php?action=api.session.verify&body_format=base64pb",
    ),
    'jianghao' => array(
        'name' => '192.168.3.254',
        'logo' => "",
        'landingUrl' => "http://192.168.3.254:9900/index.php?action=page.passport.login",
        'verifyUrl' => "http://192.168.3.254:9900/index.php?action=api.session.verify&body_format=base64pb",
    ),
    'mysql' => array(
        'name' => '192.168.3.175',
        'logo' => "https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1541750104691&di=98b4a7fb9da4e7a577dd8aabcdd951ea&imgtype=0&src=http%3A%2F%2Fimg.ui.cn%2Fdata%2Ffile%2F8%2F8%2F9%2F1593988.jpg%3FimageMogr2%2Fauto-orient%2Fformat%2Fjpg%2Fstrip%2Fthumbnail%2F%25211800%253E%2Fquality%2F90%2F",
        'landingUrl' => "http://192.168.3.175/index.php?action=page.passport.login",
        'verifyUrl' => "http://192.168.3.175/index.php?action=api.session.verify&body_format=base64pb",
    ),
    'discuz' =>
        array(
            'name' => 'discuz',
            'logo' => '',
            'landingUrl' => "http://192.168.3.152:8034/member.php?mod=logging&action=login",
            'verifyUrl' => "http://192.168.3.152:8034/plugin.php?id=duckchat&action=api.session.verify&body_format=base64pb",
        ),
);
