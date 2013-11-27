<?php

namespace MapGenerator\Element\Type;
/*
 * Si on imagine que chaque terrain a une pénalité qui lui est propre...
 */
interface TypeInterface
{
    public function penalityField();
}
