<?php

namespace Msi\Bundle\GoogleBundle\Map;

class MapFactory
{
    public function createBuilder($mapDiv, array $options = array())
    {
        return new MapBuilder($mapDiv, $options);
    }
}
