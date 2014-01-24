<?php

namespace MapGenerator\Patterns;


class MediumCrater
{
    /**
     * 
     */
    protected $tracingMap = array(array(1, 2, 2, 2, 2, 1, 2, 2, 1, 1, 2, 3, 2, 1, 0),
                                  array(2, 6, 8, 8, 8, 8, 8, 8, 8, 7, 8, 9, 8, 5, 1),
                                  array(1, 8, 10, 12, 12, 12, 12, 11, 12, 13, 12, 12, 9, 7, 1),
                                  array(2, 9, 10, 5, 5, 5, 5, 5, 4, 5, 6, 5, 12, 7, 1),
                                  array(3, 10, 12, 0, -1, -1, -1, 0, -1, -1, 6, 12, 9, 7, 1),
                                  array(2, 9, 10, 5, -1, -3, -3, -3, -3, -1, 5, 12, 9, 7, 1),
                                  array(1, 8, 10, 3, -1, -3, -3, -3, -3, -1, 5, 12, 9, 7, 1),
                                  array(1, 8, 10, 3, -1, -3, -3, -3, -3, -1, 5, 12, 9, 7, 1),
                                  array(2, 9, 10, 3, -1, -3, -3, -3, -3, -1, 5, 12, 9, 7, 1),
                                  array(1, 8, 10, 3, -1, -3, -3, -3, -3, -1, 5, 12, 9, 7, 1),
                                  array(1, 8, 10, 3, -1, -1, -1, -1, -1, -1, 5, 12, 9, 7, 1),
                                  array(3, 8, 10, 5, 5, 5, 5, 5, 4, 5, 6, 5, 12, 7, 1),
                                  array(2, 9, 10, 12, 12, 12, 12, 11, 12, 13, 0, 12, 9, 7, 1),
                                  array(1, 6, 8, 9, 8, 9, 10, 8, 7, 8, 9, 8, 8, 5, 1),
                                  array(0, 1, 1, 2, 1, 2, 3, 1, 0, 1, 2, 1, 1, 1, 0));
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