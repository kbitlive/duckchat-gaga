<?php
/**
 * user custom items
 * User: anguoyue
 * Date: 2018/11/7
 * Time: 7:36 PM
 */

class SiteUserCustomTable extends BaseTable
{

    /**
     * @var Wpf_Logger
     */
    private $logger;
    private $table = "siteUserCustom";

    public function init()
    {
        $this->logger = $this->ctx->getLogger();
    }

    //create table
    public function createUserCustomTable($createSql)
    {
        return $this->db->exec($createSql);
    }

    /**
     * @param $customArray
     * [
     *  "phone" => "18811782523",
     *  "name" => "SAM",
     *  "age" => 20,
     * ]
     * @return mixed
     * @throws Exception
     */
    public function insertCustomProfile($customArray)
    {
        $columns = $this->getAllColumns($customArray);
        return $this->insertData($this->table, $customArray, $columns);
    }

    //get user custom profile which show to others
    public function queryCustomProfile($userId)
    {
        $tag = __CLASS__ . '->' . __FUNCTION__;
        $columns = $this->getColumns();

        return $this->queryCustom($columns, $userId, $tag);
    }

    //get user all custom profile
    public function queryAllCustomProfile($userId)
    {
        $tag = __CLASS__ . '->' . __FUNCTION__;
        $columns = $this->getAllColumns();
        return $this->queryCustom($columns, $userId, $tag);
    }

    private function queryCustom(array $queryColumns, $userId, $tag = false)
    {
        $startTime = $this->getCurrentTimeMills();

        if (!$tag) {
            $tag = __CLASS__ . "->" . __FUNCTION__;
        }

        try {
            $queryColumns = implode(",", $queryColumns);
            $sql = "select $queryColumns from $this->table where userId=:userId;";
            $prepare = $this->db->prepare($sql);
            $this->handlePrepareError($tag, $prepare);
            $prepare->bindValue("userId", $userId);
            $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } finally {
            $this->logger->writeSqlLog($tag, $sql, [$userId], $startTime);
        }
    }

    private function getAllColumns()
    {
        $columns = $this->ctx->SiteCustomItemTable->queryUserCustomKeysAll();
        $this->logger->error("==============", "all custom keys for user=" . var_export($columns, true));
        return $columns;
    }

    private function getColumns()
    {
        $columns = $this->ctx->SiteCustomItemTable->queryUserCustomKeysShow();
        $this->logger->error("==============", "custom keys for user show=" . var_export($columns, true));
        return $columns;
    }

}