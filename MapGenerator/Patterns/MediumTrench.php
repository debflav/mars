<?php

namespace MapGenerator\Patterns;


class MediumTrench
{
    /**
     * 
     */
    protected $tracingMap = array(array(  0,  0,  1,  2,  3,  2,  1,  0,  0, -1, -2, -1,  0, -1,  0,  0,  0, -1, -1, -1),
                                  array(  1, -2,-13,-12,-11,-12,-13,-14,-14,-15,-16,-15,-14,-15,-14,-14,-14,-12, -3, -1),
                                  array(  1, -3,-18,-25,-25,-27,-28,-30,-32,-30,-30,-25,-23,-25,-30,-30,-25,-20, -3, -2),
                                  array(  1, -2,-10,-11,-12,-11,-10,-10, -9, -8, -9,-10,-10,-12,-11,-10,-11,-12, -3, -1),
                                  array(  0,  0,  0, -1, -2, -1,  0,  0,  1,  2,  1,  0,  0, -1, -2, -3, -2, -1, -1, -1));
    protected $X = 5;
    protected $Y = 20;
    
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