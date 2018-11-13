<?php
/**
 * Created by PhpStorm.
 * User: anguoyue
 * Date: 19/10/2018
 * Time: 11:32 AM
 */

class MiniProgram_Test_Data2000Controller extends MiniProgramController
{
    private $miniProgramId = 107;

    protected function getMiniProgramId()
    {
        return $this->miniProgramId;
    }

    /**
     * 在处理正式请求之前，预处理一些操作，比如权限校验
     * @return bool
     */
    protected function preRequest()
    {
        return true;
    }

    /**
     * 处理正式的请求逻辑，比如跳转界面，post获取信息等
     */
    protected function doRequest()
    {

        $this->logger->error("==================", var_export($_POST, true));

        $method = $_SERVER['REQUEST_METHOD'];

        if ($method == "GET") {

            echo $this->display("miniProgram_test_data2000");

            return;
        } else if ($method == "POST") {

            $type = $_POST['type'];

            switch ($type) {

                case "add2000Friends":
                    $this->doAdd2000Friends();
                    break;
                case "add2000Groups":
                    $this->doAdd2000Groups();
                    break;
                case "add2000GroupMembers":
                    $this->doAdd2000GroupMembers();
                    break;
                case "add2000GroupAdmins":
                    $this->doAdd2000GroupAdmins();
                    break;
                case "add2000GroupSpeakers":
                    $this->doAdd2000GroupSpeakers();
                    break;
                case "add2000FriendApply":
                    $this->doAdd2000FriendApply();
                    break;
                case "add2000ChatList":
                    $this->doAdd2000ChatList();
                    break;

            }

        }

    }

    /**
     * preRequest && doRequest 发生异常情况，执行
     * @param $ex
     * @return mixed
     */
    protected function requestException($ex)
    {
        // TODO: Implement requestException() method.
    }

    private function create2000Users($key = "")
    {
        $userIds = [];

        for ($i = 0; $i < 2000; $i++) {

            try {
                $loginName = "user-test" . $key . "-" . $i;

                $userProfile = [
                    "userId" => ZalyHelper::generateStrId(),
                    "loginName" => $loginName,
                    "loginNameLowercase" => $loginName,
                    "nickname" => $loginName,
                    "nicknameInLatin" => $loginName,
                    "avatar" => ZalyAvatar::getRandomAvatar(),
                    "availableType" => Zaly\Proto\Core\UserAvailableType::UserAvailableNormal,
                    "countryCode" => "+86",
                    "timeReg" => ZalyHelper::getMsectime()
                ];
                $result = $this->ctx->SiteUserTable->insertUserInfo($userProfile);


                $userIds[] = $userProfile['userId'];


            } catch (Exception $e) {
                $this->logger->error($this->action, $e);
            }

        }

        return $userIds;
    }

    private function create2000Groups($key = '')
    {

        $groupIds = [];

        for ($i = 0; $i < 2000; $i++) {

            try {
                $groupName = "group-test-" . $key . "-" . $i;

                $groupProfile = [
                    'groupId' => ZalyHelper::generateStrKey(10),
                    "name" => $groupName,
                    "nameInLatin" => $groupName,
                    "owner" => $this->userId,
                    "permissionJoin" => Zaly\Proto\Core\GroupJoinPermissionType::GroupJoinPermissionMember,
                    "canGuestReadMessage" => 0,
                    "canAddFriend" => 1,
                    "maxMembers" => 2000,
                    "status" => 1,
                    "timeCreate" => ZalyHelper::getMsectime(),
                ];

                $result = $this->ctx->SiteGroupTable->insertGroupInfo($groupProfile);

                $groupIds[] = $groupProfile['groupId'];

            } catch (Exception $e) {
                $this->logger->error($this->action, $e);
            }

        }

        return $groupIds;
    }

    private function doAdd2000Friends()
    {
        $key = ZalyHelper::generateNumberKey(4);
        $userIdList = $this->create2000Users($key);

        //添加当前用户，这么多好友

        $this->logger->error("===============", "add friends count=" . count($userIdList));

        if (!empty($userIdList)) {

            foreach ($userIdList as $friendId) {
                try {
                    $this->ctx->SiteUserFriendTable->saveUserFriend($this->userId, $friendId);
                } catch (Exception $e) {
                    $this->logger->error($this->action, $e);
                }
            }

        }

    }

    private function doAdd2000Groups()
    {
        $key = ZalyHelper::generateNumberKey(4);
        $groupIds = $this->create2000Groups($key);

        $this->logger->error("===============", "add groups count=" . count($groupIds));

        if (!empty($groupIds)) {
            foreach ($groupIds as $groupId) {
                $groupUserInfo = [
                    "groupId" => $groupId,
                    "userId" => $this->userId,
                    "memberType" => Zaly\Proto\Core\GroupMemberType::GroupMemberOwner,
                    "isMute" => 0,
                    "timeJoin" => ZalyHelper::getMsectime(),
                ];

                $this->ctx->SiteGroupUserTable->insertGroupUserInfo($groupUserInfo);
            }
        }
    }

    private function doAdd2000GroupMembers()
    {
        $defaultGroupIds = $this->ctx->Site_Config->getConfigValue(SiteConfig::SITE_DEFAULT_GROUPS);

        if (!empty($defaultGroupIds)) {
            $groupIds = explode(",", $defaultGroupIds);

            $groupId = $groupIds[0];


            $siteUserProfileList = $this->ctx->SiteUserTable->getSiteUserListByOffset(0, 2020);

            foreach ($siteUserProfileList as $userProfile) {

                try {
                    $memberId = $userProfile['userId'];
                    $groupUserInfo = [
                        "groupId" => $groupId,
                        "userId" => $memberId,
                        "memberType" => Zaly\Proto\Core\GroupMemberType::GroupMemberOwner,
                        "isMute" => 0,
                        "timeJoin" => ZalyHelper::getMsectime(),
                    ];
                    $this->ctx->SiteGroupUserTable->insertGroupUserInfo($groupUserInfo);
                } catch (Exception $e) {
                    $this->logger->error($this->action, $e);
                }

            }

            return true;
        } else {
            return false;
        }

    }


    private function doAdd2000GroupAdmins()
    {

        $defaultGroupIds = $this->ctx->Site_Config->getConfigValue(SiteConfig::SITE_DEFAULT_GROUPS);

        if (!empty($defaultGroupIds)) {
            $groupIds = explode(",", $defaultGroupIds);

            $groupId = $groupIds[0];

            $adminMemberType = \Zaly\Proto\Core\GroupMemberType::GroupMemberAdmin;
            $ownerMemberType = \Zaly\Proto\Core\GroupMemberType::GroupMemberOwner;
            $this->ctx->SiteGroupUserTable->updateAllMemberRoleToNomal($groupId, 2, $ownerMemberType);

        }

    }

    private function getGroupId()
    {
        $defaultGroupIds = $this->ctx->Site_Config->getConfigValue(SiteConfig::SITE_DEFAULT_GROUPS);

        $this->logger->error("================", "groupIds=" . $defaultGroupIds);

        if (!empty($defaultGroupIds)) {
            $groupIds = explode(",", $defaultGroupIds);

            $this->logger->error("================", "groupIdList =" . var_export($groupIds, true));

            $groupId = $groupIds[0];
            $this->logger->error("================", "groupId =" . $groupId);
            return $groupId;
        }

        return false;
    }

    private function doAdd2000GroupSpeakers()
    {
        $groupId = $this->getGroupId();

        $groupMembers = $this->ctx->SiteGroupUserTable->getGroupUserList($groupId, 0, 2000);

        $speakers = [];

        foreach ($groupMembers as $groupMember) {
            $speakers[] = $groupMember['userId'];
        }

        $speakers = implode(",", $speakers);

        $data = [
            'speakers' => $speakers,
        ];
        $where = [
            'groupId' => $groupId,
        ];

        $this->logger->error("=======================speakers=", "groupId" . $groupId . " speakers=" . $speakers);

        return $this->ctx->SiteGroupTable->updateGroupInfo($where, $data);
    }


    private function doAdd2000FriendApply()
    {
        $userIdList = $this->ctx->SiteUserTable->getSiteUserListByOffset(0, 2020);

        foreach ($userIdList as $userProfile) {

            try {
                $friendId = $userProfile['userId'];
                $data = [
                    "userId" => $friendId,
                    "friendId" => $this->userId,
                    "greetings" => "test",
                    "applyTime" => ZalyHelper::getMsectime(),
                ];
                $this->ctx->SiteFriendApplyTable->insertApplyData($data);
            } catch (Exception $e) {
                $this->logger->error($this->action, $e);
            }

        }

    }


    private function doAdd2000ChatList()
    {

        $userFriends = $this->ctx->SiteUserFriendTable->queryUserFriendByPage($this->userId, 0, 2000);

        $this->logger->error("=========================", "userFriends count=" . count($userFriends));

        foreach ($userFriends as $userFriend) {

            $friendId = $userFriend['userId'];

            $this->ctx->Message_Client->proxyU2TextMessage($this->userId, $friendId, $this->userId, "test");

        }

    }

}