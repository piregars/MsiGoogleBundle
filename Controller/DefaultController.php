<?php

namespace Msi\Bundle\GoogleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Msi\Bundle\GoogleBundle\Map\Map;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $builder = $this->container->get('msi_google_maps.map_factory')->createBuilder('mapCanvas', array('zoom' => 10));

        $builder->setKey('AIzaSyApRm7i1CAzNjNGhb2lqwwTRJDtKf68EKo');

        $builder->addOverlay('marker', array(
            'position' => Map::latlng(-34.397, 150.644),
        ));

        $map = $builder->getMap();

        return $this->render('MsiGoogleBundle:Default:index.html.twig', array('map' => $map));
    }
}
