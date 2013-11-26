<?php

namespace Framework\Mvc;

class Request
{

    /**
     *
     * @param string $sParameterName
     * @param string $sDefault
     * @return string
     */
    public function get($sParameterName, $sDefaultValue = NULL)
    {
        if( isset($_GET[$sParameterName])) {
                return $_GET[$sParameterName];
        }

        if( isset($_POST[$sParameterName])) {
                return $_POST[$sParameterName];
        }

        return $sDefaultValue;
    }


    /**
     * Check if method is post or get
     *
     * @param string $sMethodName
     * @return string
     */
    public function isMethod( $sMethodName)
    {
        return $_SERVER['REQUEST_METHOD'] == $sMethodName;
    }


}
