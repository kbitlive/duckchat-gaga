<?php
/**
 *
 * User: anguoyue
 * Date: 2018/10/26
 * Time: 12:29 PM
 */

class DC_Demo_Controller
{

    private $dcApi;

    function __construct()
    {
        $this->dcApi = new DCOpenApi();
    }

    public function index()
    {

        $classMethod = $_GET['class_method'];

        if ($classMethod) {
            $classMethod = "index";
        }

        $methodName = 'dc_' . $classMethod;

        if (!method_exists($this, $methodName)) {
            throw new Exception("request not class method");
        }

        call_user_func(array($this, $methodName));
    }


    private function dc_index()
    {
        echo "test index()";
    }

}