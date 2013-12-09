<?php

namespace MapGenerator;

interface CellDrawingInterface
{
     public function current( );

     public function prev( $iLine);

     public function next( $iLine);

     public function top( $iColumn);

     public function topLeft( $iColumn, $iLine);

     public function topRight( $iColumn, $iLine);

     public function bottom( $iStep);

     public function bottomLeft( $iColumn, $iLine);

     public function bottomRight( $iColumn, $iLine);
}
