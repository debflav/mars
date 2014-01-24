<?php

namespace MapGenerator\Patterns;


class LittleTrench
{
    /**
     * 
     */
    protected $tracingMap = array(array(0, 0, -1, -2, -1, 0, 0, 0, 0, 0),
                        array(0, -1, -10, -10, -5, -10, -10, -5, -1, 0),
                        array(0, 1, 2, 0, 0, 0, 0, -1, -1, 0));
    protected $X = 10;
    protected $Y = 3;
    
    /**
     * Petite gorge
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