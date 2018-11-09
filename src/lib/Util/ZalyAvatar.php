<?php
/**
 * Created by PhpStorm.
 * User: childeYin<尹少爷>
 * Date: 19/07/2018
 * Time: 10:54 AM
 */

class ZalyAvatar
{
    private static $logger;
    private static $avatars = [];

    private static function writeAvatars()
    {
        $cacheDir = WPF_ROOT_DIR . "/cache";

        error_log("====================write to Avatar Cache Dir = " . $cacheDir);

        if (!is_dir($cacheDir)) {
            mkdir($cacheDir, 0755, true);
        }

        $avatarPhpName = $cacheDir . "/avatar.php";

        $emojiAvatar = [];
        for ($i = 1; $i <= 74; $i++) {
            $defaultAva = dirname(__FILE__) . "/../../public/avatar/emoji/" . $i . "@3x.png";
            error_log("====================emoji Avatar Dir = " . $defaultAva);
            if (!file_exists($defaultAva)) {
                continue;
            }

            $defaultAvatarData = file_get_contents($defaultAva);
            $fileManager = new File_Manager();
            $fileId = $fileManager->saveFile($defaultAvatarData, "20180101");
            $emojiAvatar[] = $fileId;
        }

        $sceneryAvatar = [];
        for ($j = 1; $j <= 128; $j++) {
            $defaultAva = dirname(__FILE__) . "/../../public/avatar/scenery/" . $j . ".png";

            error_log("====================scenery Avatar Dir = " . $defaultAva);

            if (!file_exists($defaultAva)) {
                continue;
            }

            $defaultAvatarData = file_get_contents($defaultAva);
            $fileManager = new File_Manager();
            $fileId = $fileManager->saveFile($defaultAvatarData, "20180101");
            $sceneryAvatar[] = $fileId;
        }

        $allAvatars = [
            "emojiAvatar" => $emojiAvatar,
            "sceneryAvatar" => $sceneryAvatar,
        ];

        self::$avatars = array_merge($emojiAvatar, $sceneryAvatar);

        $contents = var_export($allAvatars, true);
        file_put_contents($avatarPhpName, "<?php\n return {$contents};\n ");

        self::resetOpcache();
    }

    private static function getAvatars()
    {
        $fileName = WPF_ROOT_DIR . "/cache/avatar.php";
        if (!file_exists($fileName)) {
            return;
        }
        $allAvatars = require($fileName);
        if (!empty($allAvatars)) {
            $emojiAvatars = $allAvatars['emojiAvatar'];
            $sceneryAvatars = $allAvatars['sceneryAvatar'];

            if (empty($sceneryAvatars)) {
                self::writeAvatars();
                return;
            }

            self::$avatars = array_merge($emojiAvatars, $sceneryAvatars);
        }
    }

    private static function setLogger()
    {
        if (empty(self::$logger)) {
            self::$logger = new Wpf_Logger();
        }
    }

    public static function getRandomAvatar()
    {
        self::setLogger();

        error_log("=======test static avatars = " . var_export(self::$avatars, true));

        $tag = __CLASS__ . "->" . __FUNCTION__;
        try {
            if (empty(self::$avatars)) {
                self::getAvatars();

                // 记载默认图片
                if (empty(self::$avatars)) {
                    //从文件中读取
                    self::writeAvatars();
                }
            }

            if (!empty(self::$avatars)) {
                $avatarNum = array_rand(self::$avatars, 1);
                return self::$avatars[$avatarNum];
            }
        } catch (Throwable $e) {
            self::$logger->error($tag, $e);
        }
        return '';
    }

    private static function resetOpcache()
    {
        if (function_exists("opcache_reset")) {
            opcache_reset();
        }
    }
}