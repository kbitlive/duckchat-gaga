<?php
/**
 * 公共静态抽象类
 * User: anguoyue
 * Date: 2018/11/9
 * Time: 6:45 PM
 */

abstract class DuckChat_Base
{

    protected function buildMsgId($roomType, $userId)
    {
        return ZalyHelper::getMsgId($roomType, $userId);
    }

}