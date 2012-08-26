<?php

namespace Msi\Bundle\GoogleBundle\Map;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class Map
{
    protected $api = 'http://maps.googleapis.com/maps/api/js?sensor=false&key=';

    protected $key;

    protected $mapDiv;

    protected $options;

    protected $id;

    protected $overlays = array();

    public function __construct($mapDiv, array $options = array())
    {
        $this->id = 'map'.uniqid();
        $this->mapDiv = $mapDiv;

        $resolver = new OptionsResolver();
        $this->setDefaultOptions($resolver);
        $this->options = $resolver->resolve($options);
    }

    public function geocode($address)
    {
        $json = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?sensor=false&address='.urlencode($address));
        $json = json_decode(utf8_encode($json), true);

        if ($json['status'] === 'OK') {
            return $json;
        }

        die($json['status'].' https://developers.google.com/maps/documentation/geocoding/#StatusCodes');
    }

    public function latlng($lat, $lng)
    {
        return 'new google.maps.LatLng('.$lat.', '.$lng.')';
    }

    public function calculateDistance($lat1, $lng1, $lat2, $lng2) {
        $theta = $lng1 - $lng2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;

        // Kilometers
        return ($miles * 1.609344);
    }

    public function __toString()
    {
        return $this->id;
    }

    public function addOverlay($class, array $options = array())
    {
        $this->overlays[] = array('class' => $class, 'options' => array_merge(array('map' => $this), $options));

        return $this;
    }

    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    public function getApi()
    {
        return $this->api.$this->key;
    }

    public function getMapDiv()
    {
        return $this->mapDiv;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function getOverlays()
    {
        return $this->overlays;
    }

    public function render()
    {
        $renderer = new MapRenderer();

        return $renderer->render($this);
    }

    protected function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'center' => 'new google.maps.LatLng(-34.397, 150.644)',
            'zoom' => 4,
            'mapTypeId' => 'google.maps.MapTypeId.ROADMAP',
        ));
    }
}
