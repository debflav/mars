<?php

namespace MapGenerator;

interface CellDrawingInterface
{
     public function current( );

     public function prev( );

     public function next( );

     public function top( );
     
     public function topLeft( );

     public function topRight( );

     public function bottom( );
     
     public function bottomLeft( );

     public function bottomRight( );
}
