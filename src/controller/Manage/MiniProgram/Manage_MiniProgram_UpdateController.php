<?php
/**
 * Created by PhpStorm.
 * User: anguoyue
 * Date: 28/08/2018
 * Time: 6:40 PM
 */

class Manage_MiniProgram_UpdateController extends Manage_CommonController
{

    protected function doRequest()
    {
        $tag = __CLASS__ . "->" . __FUNCTION__;
        $result = [
            'errCode' => "error",
        ];
        try {

            $pluginId = $_POST['pluginId'];
            $name = $_POST['name'];
            $value = $_POST['value'];

            if (empty($pluginId) || empty($name)) {
                throw new Exception("error parameters");
            }

            if ($pluginId == 100) {
                throw new Exception("forbidden operation");
            }

            if ($name == "pluginId") {
                return;
            }

            $isOk = false;
            if ($name == "usageType") {

                if (!empty($value)) {
                    $value = explode(",", $value);

                    if (in_array(7, $value)) {
                        $value = [7];
                    }

                    $isOk = $this->updateMiniProgramUsageTypes($pluginId, $value);
                }

            } else {
                //update useType
                $isOk = $this->updateMiniProgramProfile($pluginId, $name, $value);
            }


            if ($isOk) {
                $result['errCode'] = "success";
            } else {
                $result["errInfo"] = "update error";
            }

        } catch (Exception $e) {
            $this->ctx->Wpf_Logger->error($tag, $e);
            $result["errInfo"] = $e->getMessage();
        }

        echo json_encode($result);
        return;
    }

    private function updateMiniProgramUsageTypes($pluginId, array $usageTypes)
    {
        $pluginProfile = $this->ctx->SitePluginTable->getPluginById($pluginId);

        //delete all
        $this->ctx->SitePluginTable->deletePlugin($pluginId);

        foreach ($usageTypes as $usageType) {
            $pluginProfile["usageType"] = $usageType;

            $result = $this->ctx->SitePluginTable->insertMiniProgram($pluginProfile);
        }

        return true;
    }

    private function updateMiniProgramProfile($pluginId, $name, $value)
    {
        $data = [
            $name => $value
        ];

        $where = [
            "pluginId" => $pluginId
        ];

        return $this->ctx->SitePluginTable->updateProfile($data, $where);
    }

}