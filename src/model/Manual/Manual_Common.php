<?php
/**
 * Manual 抽象类，提供公共方法
 * Author: SAM<an.guoyue254@gmail.com>
 * Date: 2018/11/13
 * Time: 11:23 AM
 */

abstract class Manual_Common
{
    protected $logger;
    protected $ctx;

    public function __construct(BaseCtx $ctx)
    {
        $this->logger = $ctx->getLogger();
        $this->ctx = $ctx;
    }


}