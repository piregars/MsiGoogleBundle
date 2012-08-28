<?php

namespace Msi\Bundle\GoogleBundle\Twig\Extension;

class GoogleExtension extends \Twig_Extension
{
    private $environment;

    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    public function getFunctions()
    {
        return array(
            'msi_google_render_map_html' => new \Twig_Function_Method($this, 'renderMapHtml', array('is_safe' => array('html'))),
            'msi_google_render_map_js' => new \Twig_Function_Method($this, 'renderMapJs', array('is_safe' => array('html'))),
        );
    }

    public function renderMapHtml($map)
    {
        return $this->environment->render('MsiGoogleBundle:Map:map_html.html.twig', array('map' => $map));
    }

    public function renderMapJs($map)
    {
        return $this->environment->render('MsiGoogleBundle:Map:map_js.html.twig', array('map' => $map));
    }

    public function getName()
    {
        return 'msi_google';
    }
}
