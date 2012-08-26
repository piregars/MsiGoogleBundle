<?php

namespace Msi\Bundle\GoogleBundle\Map;

class MapRenderer
{
    public function render(Map $map)
    {
        $js = 'function initMap() {'."\n";
        $js .= 'var '.$map.' = new google.maps.Map(document.getElementById("'.$map->getMapDiv().'"), '.$this->arrayToJson($map->getOptions()).');'."\n";

        foreach ($map->getOverlays() as $overlay) {
            $js .= 'var '.$overlay['class'].uniqid().' = new google.maps.'.ucfirst($overlay['class']).'('.$this->arrayToJson($overlay['options']).');'."\n";
        }

        $js .= '}'."\n";
        $js .= 'google.maps.event.addDomListener(window, "load", initMap);';

        return $js;
    }

    public function arrayToJson(array $array)
    {
        $js = '{'."\n";

        $i = 1;
        $l = count($array);
        foreach ($array as $k => $v) {
            $js .= '    '.$k.': '.(is_array($v) ? $this->arrayToJson($v) : $v).($i === $l ? '' : ',')."\n";
            $i++;
        }

        $js .= '}';

        return $js;
    }

    public function arrayToJs(array $array)
    {
        $js = '['."\n";

        $i = 1;
        $l = count($array);
        foreach ($array as $k => $v) {
            $js .= '    '.(is_array($v) ? $this->arrayToJs($v) : $v).($i === $l ? '' : ',')."\n";
            $i++;
        }

        $js .= ']';

        return $js;
    }
}
