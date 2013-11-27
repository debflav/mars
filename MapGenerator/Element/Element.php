<?php

namespace MapGenerator\Element;

/**
 * A implementer
 */
class Element implements ElementInterface
{
    private $_aAttributs;

    public function __construct( $aAttributs)
    {
        $this->_aAttributs = $aAttributs;
    }
}
