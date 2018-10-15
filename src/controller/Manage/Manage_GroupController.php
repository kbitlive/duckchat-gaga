<?php
/**
 * Created by PhpStorm.
 * User: anguoyue
 * Date: 15/08/2018
 * Time: 10:59 AM
 */

class Manage_GroupController extends Manage_CommonController
{

    public function doRequest()
    {
        $params = ["lang" => $this->language];

        //get user list by page
        $offset = $_POST['offset'];
        $length = $_POST['length'];

        if (!$offset) {
            $offset = 0;
        }

        if (!$length) {
            $length = 2000;
        }

        // totalGroupCount
        $params['totalGroupCount'] = $this->getTotalGroupCount();

        $groupList = $this->getGroupListByOffset($offset, $length);

        if ($groupList) {
            $groupProfiles = [];
            foreach ($groupList as $group) {

                $groupProfiles[] = [
                    'groupId' => $group['groupId'],
                    'name' => htmlspecialchars($group['name']),
                ];

            }
            $params['groupList'] = $groupProfiles;
        }

        echo $this->display("manage_group_indexList", $params);

        return;
    }

    private function getTotalGroupCount()
    {
        $tag = __CLASS__ . "->" . __FUNCTION__;
        try {
            return $this->ctx->SiteGroupTable->getSiteGroupCount();
        } catch (Exception $e) {
            $this->logger->error($tag, $e);
        }
        return 0;
    }

    private function getGroupListByOffset($offset, $length)
    {
        $tag = __CLASS__ . "->" . __FUNCTION__;
        try {
            return $this->ctx->SiteGroupTable->getSiteGroupListByOffset($offset, $length);
        } catch (Exception $e) {
            $this->ctx->Wpf_Logger->info($tag, $e);
        }
        return [];
    }
}