<?php
/**
 * Created by PhpStorm.
 * User: childeYin<尹少爷>
 * Date: 13/07/2018
 * Time: 6:32 PM
 */

use Google\Protobuf\Any;
use Zaly\Proto\Core\TransportData;
use Zaly\Proto\Core\TransportDataHeaderKey;
use Google\Protobuf\Internal\Message;

abstract class UpgradeController extends \Wpf_Controller
{
    protected $logger;
    protected $language = Zaly\Proto\Core\UserClientLangType::UserClientLangZH;
    protected $ctx;

    public function __construct(BaseCtx $context)
    {
        if (!$this->checkDBIsExist()) {
            $initUrl = ZalyConfig::getConfig("apiPageSiteInit");
            header("Location:" . $initUrl);
            exit();
        }
        $this->logger = $context->getLogger();
        $this->ctx = $context;

    }

    abstract public function index();

    /**
     * 处理方法， 根据bodyFormatType, 获取transData
     * @return string|void
     */
    public function doIndex()
    {
        $tag = __CLASS__ . "-" . __FUNCTION__;
        try {
//            parent::doIndex();

            $this->index();
        } catch (Exception $ex) {
            $this->ctx->Wpf_Logger->error($tag, "error msg =" . $ex->getMessage());

        }
    }
}