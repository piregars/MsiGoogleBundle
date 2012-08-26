<?php

namespace Msi\Bundle\GoogleBundle\Map;

class MapRenderer
{
    private $map;

    public function getMap()
    {
        return $this->map;
    }

    public function setMap($map)
    {
        $this->map = $map;

        return $this;
    }

    public function toJs()
    {
        $js = '(function() {'."\n";
        $js .= '"use strict";'."\n";
        $js .= 'function initMap() {'."\n";
        $js .= 'var '.$this->map.' = new google.maps.Map(document.getElementById("'.$this->map->getMapDiv().'"), '.$this->arrayToJson($this->map->getOptions()).');'."\n";

        foreach ($this->map->getOverlays() as $overlay) {
            $js .= 'var '.$overlay['class'].uniqid().' = new google.maps.'.ucfirst($overlay['class']).'('.$this->arrayToJson($overlay['options']).');'."\n";
        }

        $js .= '}'."\n";
        $js .= 'google.maps.event.addDomListener(window, "load", initMap);'."\n";
        $js .= '})();';

        return $js;
    }

    public function arrayToJson(array $array)
    {
        $js = '{'."\n";

        foreach ($array as $k => $v) {
            if (is_array($v)) {
                $js .= '    '.$k.': '.self::arrayToJs($v).','."\n";
            } else {
                $js .= '    '.$k.': '.$v.','."\n";
            }
        }
        $js .= '}';

        return $js;
    }

    public function arrayToJs(array $array)
    {
        $js = '['."\n";

        foreach ($array as $k => $v) {
            $js .= '        '.$v.','."\n";
        }
        $js .= '    ]';

        return $js;
    }
}
