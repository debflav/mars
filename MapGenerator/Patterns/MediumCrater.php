<?php

namespace MapGenerator\Patterns;


class MediumCrater
{
    /**
     * 
     */
    protected $tracingMap = array(array(1,  2,  2,  2,  2,  1,  2,  2,  1,  1,  2,  3,  2,  1,  0),
                                  array(2,  3,  3,  3,  8,  8,  9,  8,  8,  5,  4,  3,  3,  2,  1),
                                  array(1,  4,  5,  9, 12, 12, 12, 11, 12,  8,  6,  4,  3,  2,  1),
                                  array(2,  6,  9, 10, 12,  5,  5,  5, 12, 12,  6,  5,  3,  4,  1),
                                  array(3, 10, 12, 12,  5,  3, -1,  0,  3,  5, 13, 12,  4,  3,  1),
                                  array(2,  9, 10,  5,  3, -3, -3, -3, -1,  3,  5, 12,  4,  1,  1),
                                  array(1,  8, 10,  3, -1, -3, -3, -3, -3, -1,  5, 12,  9,  3,  1),
                                  array(1,  9, 10,  3, -1, -3, -3, -3, -3, -1,  5, 12,  9,  2,  1),
                                  array(2,  9, 10,  3, -1, -3, -3, -3, -3, -1,  5, 12,  9,  2,  1),
                                  array(1,  8, 10,  3, -1, -1, -3, -3, -1,  2,  5, 12,  9,  1,  1),
                                  array(1,  8, 10,  5,  3, -1, -1, -1,  2,  4, 12, 12,  3,  2,  1),
                                  array(3,  6, 10, 12,  5,  5,  5,  5,  4,  5,  6,  5,  4,  2,  1),
                                  array(2,  3,  9,  9, 12, 12, 12, 11, 12, 13,  4,  5,  3,  2,  1),
                                  array(1,  2,  2,  3,  8,  9, 10,  8,  7,  5,  2,  5,  2,  5,  1),
                                  array(0,  1,  1,  2,  1,  2,  3,  1,  0,  1,  2,  1,  1,  1,  0));
    protected $X = 15;
    protected $Y = 15;
    
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