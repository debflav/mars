<?php

namespace MapGenerator;

interface MapInterface
{

    public function generate($iDimension);

    public function mapToJson();

    // public function generateMapFromJson( $sJson);

}
