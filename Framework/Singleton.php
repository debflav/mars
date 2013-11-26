<?php

namespace Framework;

trait Singleton
{
    /**
     * @var object
     */
    private static $oInstance;


    /**
     * Final : Une classe fille ne pourra pas surcharger cette méthode.
     */
    final public function __construct() { }

    final public function __clone() {
        throw new \Exception('Impossible de cloner un Singleton.');
    }

    /**
     * @return object
     */
    public static function getInstance()
    {
        if( !isset(self::$oInstance)) {
            $oClass = get_called_class();
            self::$oInstance = new $oClass();
        }

        return self::$oInstance;
    }
}
