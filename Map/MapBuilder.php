<?php

namespace Msi\Bundle\GoogleBundle\Map;

class MapBuilder
{
    private $map;

    private $overlays = array();

    public function __construct($mapDiv, array $options)
    {
        $this->map = new Map($mapDiv, $options);
    }

    public function addOverlay($class, array $options = array())
    {
        $this->overlays[] = array('class' => $class, 'options' => array_merge(array('map' => $this->map), $options));

        return $this;
    }

    public function setKey($key)
    {
        $this->map->setKey($key);

        return $this;
    }

    public function getMap()
    {
        $this->map->setOverlays($this->overlays);

        return $this->map;
    }

    public function setMap($map)
    {
        $this->map = $map;

        return $this;
    }
}
