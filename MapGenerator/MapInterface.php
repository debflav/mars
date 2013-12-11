<?php

namespace MapGenerator;

interface MapInterface
{

    public function generate( $iDimension, $aAttributs);

    public function mapToJson();

    public function generateMapFromJson( $sJson);

}
