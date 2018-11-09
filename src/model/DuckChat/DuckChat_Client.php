<?php
/**
 * 提供duckchat外部接口同时，也提供内部接口
 * User: anguoyue
 * Date: 2018/11/9
 * Time: 3:39 PM
 */

class DuckChat_Client
{

    private $ctx;

    public function __construct(BaseCtx $ctx)
    {
        $this->ctx = $ctx;
    }

    public function doRequest($pluginId, $action, $request)
    {
        $response = false;
        switch ($action) {
            case "duckchat.session.profile":
                $response = $this->ctx->DuckChat_Session->getProfile($pluginId, $request);
                break;
            case "duckchat.session.clear":
                break;

        }

        return $response;
    }

}