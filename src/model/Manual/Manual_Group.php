<?php
/**
 * 内部接口开发手册，群组相关内部接口
 *  1.查找群组
 *  2.批量获取群组资料
 *  3.加群组
 * Author: SAM<an.guoyue254@gmai.com>
 * Date: 2018/11/13
 * Time: 11:00 AM
 */

class Manual_Group
{

    /**
     * 更具$search查找群组
     * @param $search   查找的内容
     * @param int $pageNum 第几页，从1开始
     * @param int $pageSize 每页面数量
     */
    public function search($search, $pageNum = 1, $pageSize = 20)
    {

    }

    /**
     * @param array $groupIds 批量获取的群组ID数组
     * @return array 返回群组资料的数组
     */
    public function getProfiles(array $groupIds)
    {

        return [];
    }

    /**
     * $userId 加入 $groupId，这里需要做群组的权限控制，群组允许加群才可以入群
     * @param $groupId 加入的群组
     * @param $userId
     * @param $joinNotice
     * @return bool
     */
    public function joinGroup($groupId, $userId, $joinNotice)
    {
        //check permission by group profile

        return true;
    }

}