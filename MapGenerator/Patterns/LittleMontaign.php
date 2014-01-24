<?php

namespace MapGenerator\Patterns;


class LittleMountain
{
    /**
     * 
     */
    $tracingMap = array(array(3, 6, 5, 4, 2, 1),
                      array(5, 10, 13, 11, 7, 3),
                      array(6, 12, 15, 14, 9, 4),
                      array(5, 11, 14, 13, 8, 5),
                      array(6, 8, 10, 8, 6, 4),
                      array(3, 4, 6, 4, 3, 2));
    protected $X = 6;
    protected $Y = 6;
    
    /**
     * Petite montagne
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