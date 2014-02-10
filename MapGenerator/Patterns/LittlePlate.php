<?php

namespace MapGenerator\Patterns;


class LittlePlate
{
    /**
     * 
     */
    protected $tracingMap = array(array(1, 3, 5, 3, 1, 0),
                                  array(3, 3, 5, 5, 5, 5),
                                  array(3, 5, 5, 5, 5, 5),
                                  array(5, 5, 5, 5, 4, 4),
                                  array(5, 5, 5, 5, 3, 5),
                                  array(1, 3, 5, 3, 1, 0));
    protected $X = 6;
    protected $Y = 6;
    
    /**
     * Petit plateau
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