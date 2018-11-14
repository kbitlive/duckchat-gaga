<?php
/**
 * Custom Items for Site
 * User: anguoyue
 * Date: 2018/11/7
 * Time: 7:45 PM
 */

class SiteCustomTable extends BaseTable
{
    /**
     * @var Wpf_Logger
     */
    private $logger;
    private $table = "siteCustom";
    /**
     * keyType:
     *  1:login
     *
     */
    private $columns = [
        "id",
        "customKey",
        "keyName",
        "keyIcon",
        "keyDesc",
        "keyType",
        "keySort",
        "keyConstraint",
        "isRequired",
        "isOpen",
        "status",
        "dataType",
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
        $keyData['keyType'] = Zaly\Proto\Core\CustomType::CustomTypeUser;
        $keyData['addTime'] = $this->getCurrentTimeMills();
        return $this->insertData($this->table, $keyData, $this->columns);
    }

    public function deleteCustomInfo($keyType, $customKey)
    {
        $tag = __CLASS__ . "->" . __FUNCTION__;
        $sql = "delete from $this->table where keyType=:keyTYpe and customKey=:customKey;";

        $prepare = $this->db->prepare($sql);
        $this->handlePrepareError($tag, $prepare);

        $prepare->bindValue(":keyTYpe", $keyType);
        $prepare->bindValue(":customKey", $customKey);

        $result = $prepare->execute();

        return $this->handlerResult($result, $prepare, $tag);
    }

    public function updateCustomInfo($data, $where)
    {
        return $this->updateInfo($this->table, $where, $data, $this->columns);
    }

    //only get customKey array not all info
    public function queryUserCustomKeysAll()
    {
        $tag = __CLASS__ . '->' . __FUNCTION__;
        return $this->queryUserCustomKeys(false, $tag);
    }

    //only get customKey array not all info
    public function queryUserCustomKeysShow()
    {
        $tag = __CLASS__ . '->' . __FUNCTION__;
        return $this->queryUserCustomKeys(1, $tag);
    }

    public function queryLoginCustomKeys($status, $tag = false)
    {
        $keyType = Zaly\Proto\Core\CustomType::CustomTypeLogin;
        return $this->queryCustomKeys($keyType, $status, $tag);
    }

    //only get customKey array not all info
    public function queryUserCustomKeys($status, $tag = false)
    {
        $keyType = Zaly\Proto\Core\CustomType::CustomTypeUser;
        return $this->queryCustomKeys($keyType, $status, $tag);
    }

    private function queryCustomKeys($keyType, $status, $tag = false)
    {
        $startTime = $this->getCurrentTimeMills();

        if (!$tag) {
            $tag = __CLASS__ . '->' . __FUNCTION__;
        }

        $sql = "select customKey from $this->table where keyType=:keyType ";

        if ($status && $status >= 0) {
            $sql .= " and status=:status;";
        }

        try {
            $prepare = $this->dbSlave->prepare($sql);
            $this->handlePrepareError($tag, $prepare);

            $prepare->bindValue(":keyType", $keyType);
            if ($status && $status >= 0) {
                $prepare->bindValue(":status", $status, PDO::PARAM_INT);
            }

            $prepare->execute();
            $result = $prepare->fetchAll(PDO::FETCH_COLUMN);

            return $result;
        } finally {
            $this->logger->writeSqlLog($tag, $sql, [$status], $startTime);
        }

    }

    public function queryCustomByKey($keyType, $customKey)
    {
        $startTime = $this->getCurrentTimeMills();

        $tag = __CLASS__ . '->' . __FUNCTION__;

        $sql = "select $this->queryColumns from $this->table where keyType=:keyType and customKey=:customKey;";

        try {
            $prepare = $this->dbSlave->prepare($sql);
            $this->handlePrepareError($tag, $prepare);

            $prepare->bindValue(":keyType", $keyType);
            $prepare->bindValue(":customKey", $customKey);

            $prepare->execute();
            $result = $prepare->fetch(PDO::FETCH_ASSOC);
            error_log("=====" . var_export($result, true));
            return $result;
        } finally {
            $this->logger->writeSqlLog($tag, $sql, [$customKey, $keyType], $startTime);
        }

    }

    public function queryUserCustomInfo($status, $tag = false)
    {
        $keyType = Zaly\Proto\Core\CustomType::CustomTypeUser;
        return $this->queryCustomInfo($keyType, $status, $tag);
    }

    private function queryCustomInfo($keyType, $status, $tag = false)
    {
        $startTime = $this->getCurrentTimeMills();

        if (!$tag) {
            $tag = __CLASS__ . '->' . __FUNCTION__;
        }

        $sql = "select $this->queryColumns from $this->table where keyType=:keyType ";

        if ($status && $status >= 0) {
            $sql .= " and status=:status;";
        }

        try {
            $prepare = $this->dbSlave->prepare($sql);
            $this->handlePrepareError($tag, $prepare);

            $prepare->bindValue(":keyType", $keyType);
            if ($status && $status >= 0) {
                $prepare->bindValue(":status", $status, PDO::PARAM_INT);
            }

            $prepare->execute();
            $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
            error_log("=====" . var_export($result, true));
            return $result;
        } finally {
            $this->logger->writeSqlLog($tag, $sql, [$status], $startTime);
        }

    }
}