<?php

namespace Msi\Bundle\GoogleBundle\Map;

class MapFactory
{
    public function create($mapDiv, array $options = array())
    {
        return new Map($mapDiv, $options);
    }
}
