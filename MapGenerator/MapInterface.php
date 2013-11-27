<?php

namespace MapGenerator;

interface MapInterface
{

    public function generate( $iNbLine, $iNbColumn, $aAttributs);

    public function mapToJson();

    public function loadJson( $sJson);

}
