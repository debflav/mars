<?php

namespace MapGenerator\Patterns;


class LittleCrater
{
    /**
     * 
     */
    $tracingMap = array(array(1, 3, 5, 3, 1),
                        array(3, 5, 3, 5, 3),
                        array(5, 3, 3, 3, 5),
                        array(3, 5, 3, 5, 3),
                        array(1, 3, 5, 3, 1));
    protected $X = 5;
    protected $Y = 5;
    
    /**
     * Petit cratère
     * renvoi un tableau de nouvelles altitudes
     */
    public function getPattern()
    {
        return $this->tracingMap;
    }

    public function getX()
    {
        return $this->X;
    }

    public function getY()
    {
        return $this->Y;
    }
}