<?php

namespace Utils;

class Router
{

    use Singleton;

    /**
     * Default page name when empty
     *
     * @var string
     */
    private $sDefaultPageName = 'index';

    /**
     * Default controller name when empty
     *
     * @var string
     */
    private $sDefaultControllerName = 'Index';


    /**
     * @return string
     */
    public function execute(Request $oRequest)
    {
        $sControllerName = '\\Controller\\' . $oRequest->get('controller', $this->sDefaultControllerName) . 'Controller';
        $sController = new $sControllerName();
        $sPageName = $oRequest->get('page', $this->sDefaultPageName);

        return $sController->$sPageName( $oRequest);
    }


}
