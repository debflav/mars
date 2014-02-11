<?php

namespace MapGenerator\Patterns;


class MediumPlate
{
    /**
     * 
     */
    protected $tracingMap = array(array(0,  0,  0,  0,  1,  1,  1,  0,  0,  0),
                                  array(0,  3,  3,  4,  5,  5,  5,  4,  3,  0),
                                  array(0,  3,  9,  9,  9,  9,  9,  9,  3,  0),
                                  array(0,  3,  9,  9,  9,  7,  9,  9,  4,  0),
                                  array(1,  5,  9,  9,  9,  8,  9,  9,  5,  1),
                                  array(1,  6,  9, 10,  9,  9,  9,  9,  6,  2),
                                  array(2,  6,  9, 11,  9,  9, 10,  9,  5,  1),
                                  array(1,  5,  9,  9,  8,  9,  9,  9,  6,  2),
                                  array(1,  5,  9,  8,  7,  8,  9,  9,  5,  1),
                                  array(0,  3,  9,  9,  9,  9,  9,  9,  4,  0),
                                  array(0,  4,  6,  7,  6,  5,  3,  4,  3,  0),
                                  array(0,  0,  1,  2,  1,  1,  0,  1,  0,  1));
    protected $X = 12;
    protected $Y = 10;
    
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