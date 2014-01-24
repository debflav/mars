<?php

namespace MapGenerator;


class Calque
{
    /**
     * 
     */
    protected $tracingMap = array();
    
    /**
     * 
     */
    public function __construct($map)
    {
        $this->tracingMap = $map;
    }

    /**
     * Petit cratère
     * renvoi un tableau de nouvelles altitudes
     */
    public function littleCrater()
    {
        // tableau comportant les nouvelles altitudes d'un petit cratère
        return array(array(1, 3, 5, 3, 1),
                     array(3, 5, 3, 5, 3),
                     array(5, 3, 3, 3, 5),
                     array(3, 5, 3, 5, 3),
                     array(1, 3, 5, 3, 1));
    }

    /**
     * Petite gorge
     * renvoi un tableau de nouvelles altitudes
     */
    public function littleTrench()
    {
        return array(array(0, 0, -1, -2, -1, 0, 0, 0, 0, 0),
                     array(0, -1, -10, -10, -5, -10, -10, -5, -1, 0),
                     array(0, 1, 2, 0, 0, 0, 0, -1, -1, 0));
    }

    /**
     * Petite montagne
     * renvoi un tableau de nouvelles altitudes
     */
    public function littleMontaign()
    {
        return array(array(3, 6, 5, 4, 2, 1),
                     array(5, 10, 13, 11, 7, 3),
                     array(6, 12, 15, 14, 9, 4),
                     array(5, 11, 14, 13, 8, 5),
                     array(6, 8, 10, 8, 6, 4),
                     array(3, 4, 6, 4, 3, 2));
    }

    /**
     * Petit plateau
     * renvoi un tableau de nouvelles altitudes
     */
    public function littlePlate()
    {
        return array(array(1, 3, 5, 3, 1, 0),
                     array(3, 5, 5, 5, 5, 5),
                     array(3, 5, 5, 5, 5, 5),
                     array(5, 5, 5, 5, 4, 4),
                     array(5, 5, 5, 5, 3, 5),
                     array(1, 3, 5, 3, 1, 0));
    }
}