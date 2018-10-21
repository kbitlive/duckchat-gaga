<?php
/**
 * custom exception by errCode && errInfo
 * User: anguoyue
 * Date: 21/10/2018
 * Time: 12:16 PM
 */

class ZalyException extends Exception
{
    private $errCode;
    private $errInfo;


    public function __construct($errCode, $errInfo, Throwable $previous = null)
    {
        parent::__construct($errInfo, 0, $previous);
        $this->errCode = $errCode;
        $this->errInfo = $errInfo;
    }


    public function getErrCode()
    {
        return $this->errCode;
    }

    public function getErrInfo()
    {
        return $this->errInfo;
    }
}