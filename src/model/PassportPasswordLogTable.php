<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 23/10/2018
 * Time: 6:04 PM
 */

class PassportPasswordLogTable extends BaseTable
{
    private $table = "passportPasswordLog";
    private $columns = [
        "id",
        "userId",
        "loginName",
        "operation",
        "ip",
        "operateDate",
        "operateTime"
    ];

    private $selectColumns;

    public function init()
    {
        $this->selectColumns = implode(",", $this->columns);
    }

    public function insertLogData($log)
    {
        return $this->insertData($this->table, $log, $this->columns);
    }

    public function deleteLogDataByUserId($userId, $date)
    {

    }
}