<?php

namespace Msi\Bundle\GoogleBundle\Map;

class MapRenderer
{
    public function render(Map $map)
    {
        $js = 'function initializeGoogleMaps() {'."\n";
        $js .= 'var '.$map.' = new google.maps.Map(document.getElementById("'.$map->getMapDiv().'"), '.$this->arrayToJson($map->getOptions()).');'."\n";
        foreach ($map->getOverlays() as $overlay) {
            $js .= 'var '.$overlay['class'].uniqid().' = new google.maps.'.ucfirst($overlay['class']).'('.$this->arrayToJson($overlay['options']).');'."\n";
        }
        $js .= '}'."\n";

        $js .= 'function loadScriptGoogleMaps() {'."\n";
        $js .= 'var script = document.createElement("script");'."\n";
        $js .= 'script.type = "text/javascript";'."\n";
        $js .= 'script.src = "http://maps.googleapis.com/maps/api/js?key='.$map->getKey().'&sensor=true&callback=initializeGoogleMaps";'."\n";
        $js .= 'document.body.appendChild(script);'."\n";
        $js .= '}'."\n";

        $js .= 'window.onload = loadScriptGoogleMaps;';

        return '<script>'.$js.'</script>';
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
