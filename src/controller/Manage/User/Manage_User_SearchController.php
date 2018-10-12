<?php
/**
 * Created by PhpStorm.
 * User: anguoyue
 * Date: 15/08/2018
 * Time: 10:59 AM
 */

class Manage_User_SearchController extends Manage_CommonController
{

    public function doRequest()
    {
        $result = [
            "errCode" => "succs",
        ];

        $value = $_POST['searchValue'];

        $this->logger->error("===============", "search value=" . $value);

        if (!isset($value)) {
            throw new Exception("search empty value");
        }

        if (strlen($value) == 40) {
            $users = $this->searchUserByUserId($value);
            $result["errCode"] = "success";
            $result["users"] = $users;
            echo json_encode($result);
            return;
        }


        //loginName
        $users = $this->searchUserByLoginName($value);
        $this->logger->error("============", "user LoginName usersssss=" . var_export($users, true));
        if ($users) {
            $result["errCode"] = "success";
            $result["users"] = $users;
            echo json_encode($result);
            return;
        }

        // nickName
        $users = $this->searchUserByNickname($value);
        if ($users) {
            $result["errCode"] = "success";
            $result["users"] = $users;
            echo json_encode($result);
        }

        return;
    }

    private function searchUserByLoginName($loginName)
    {
        $tag = __CLASS__ . "->" . __FUNCTION__;
        try {
            $users = [];
            $loginName = strtolower($loginName);
            $user = $this->ctx->SiteUserTable->getUserByLoginNameLowercase($loginName);
            $this->logger->error("============", "user LoginName profile=" . var_export($user, true));

            if ($user) {
                $users[] = $user;
                return $users;
            }
        } catch (Exception $e) {
            $this->logger->error($tag, $e);
        }
        return false;
    }


    private function searchUserByUserId($userId)
    {
        $tag = __CLASS__ . "->" . __FUNCTION__;
        try {
            $users = $this->ctx->SiteUserTable->getUserByUserIds([$userId]);
            $this->logger->error("============", "user UserId profile=" . var_export($users, true));

            return $users;
        } catch (Exception $e) {
            $this->logger->error($tag, $e);
        }

        return false;
    }

    private function searchUserByNickname($nickname)
    {
        $tag = __CLASS__ . "->" . __FUNCTION__;
        try {
            $pinyin = new \Overtrue\Pinyin\Pinyin();
            $nameInLatin = $pinyin->permalink($nickname, "");
            $users = $this->ctx->SiteUserTable->getUserByNicknameInLatin($nameInLatin);

            $this->logger->error("============", "user Nickname profile=" . var_export($users, true));

            return $users;
        } catch (Exception $e) {
            $this->logger->error($tag, $e);
        }
    }

}