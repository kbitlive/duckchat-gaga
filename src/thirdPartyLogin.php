<?php
return array(
    'localLanding' => array(
        'name' => '192.168.3.6',
        'logo' => true,
        'landingUrl' => "http://",
        'verifyUrl' => "http://192.168.3.6/index.php?action=api.session.verify&body_format=base64pb",
    ),
    'weixin' =>
        array(
            'name' => '微信登陆',
            'logo' => true,
            'landingUrl' => "http://",
            'verifyUrl' => "http://localhost/verify",
        ),
    'discuz' =>
        array(
            'name' => 'discuz',
            'logo' => '',
            'landingUrl' => "http://",
            'verifyUrl' => "http://localhost/verify",
        ),
);