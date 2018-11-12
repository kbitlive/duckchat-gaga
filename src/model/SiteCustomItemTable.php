<?php
/**
 * Custom Items for Site
 * User: anguoyue
 * Date: 2018/11/7
 * Time: 7:45 PM
 */

class SiteCustomItemTable extends BaseTable
{
    /**
     * @var Wpf_Logger
     */
    private $logger;
    private $table = "siteCustomItem";
    /**
     * keyType:
     *  1:login
     *
     */
    private $columns = [
        "id",
        "customKey",
        "keyName",
        "keyDesc",
        "keyType", //1:user custom key
        "keySort",
        "keyConstraint",
        "status", //0:无效 1:有效并且客户端显示 2：有效但是客户端不显示
        "tableName",
        "dataVerify",
        "addTime",
    ];

    private $queryColumns;

    public function init()
    {
        $this->logger = $this->ctx->getLogger();
        $this->queryColumns = implode(",", $this->columns);
    }


    public function insertUserCustomKeys(array $keyData)
    {
        $keyData['keyType'] = 1;
        $keyData['tableName'] = "siteUserCustom";
        $keyData['addTime'] = $this->getCurrentTimeMills();
        return $this->insertData($this->table, $keyData, $this->columns);
    }

    //only get customKey array not all info
    public function queryUserCustomKeysAll()
    {
        $tag = __CLASS__ . '->' . __FUNCTION__;
        return $this->queryUserCustomKeys(-1, $tag);
    }

    //only get customKey array not all info
    public function queryUserCustomKeysShow()
    {
        $tag = __CLASS__ . '->' . __FUNCTION__;
        return $this->queryUserCustomKeys(1, $tag);
    }

    //only get customKey array not all info
    private function queryUserCustomKeys($status, $tag = false)
    {
        $startTime = $this->getCurrentTimeMills();

        if (!$tag) {
            $tag = __CLASS__ . '->' . __FUNCTION__;
        }
        $sql = "select customKey from $this->table where keyType=1";

        if (isset($status) && $status >= 0) {
            $sql .= " and status=:status;";
        }

        try {
            $prepare = $this->db->prepare($sql);
            $this->handlePrepareError($tag, $prepare);

            if (isset($status) && $status >= 0) {
                $prepare->bindValue(":status", $status, PDO::PARAM_INT);
            }

            $prepare->execute();
            $result = $prepare->fetchColumn();
            return $result;
        } finally {
            $this->logger->writeSqlLog($tag, $sql, [$status], $startTime);
        }
    }

}