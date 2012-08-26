MsiGoogleBundle
===============

add to kernel:

    new Msi\Bundle\GoogleBundle\MsiGoogleBundle(),

usage:

    // controller

    use Msi\Bundle\GoogleBundle\Map\Map;

    $builder = $this->container->get('msi_google.map_factory')->createBuilder('mapCanvas', array());

    $builder->setKey('ewhf09weFf9w3hj39ff9wf9h3h0h32fh38290h');

    $builder->addOverlay('marker', array(
        'position' => Map::latlng(-32423, 737213),
        'title' => 'dadada',
    ));

    $map = $builder->getMap();


    // view

    <div id="mapCanvas" style="width:500px;height:300px;"></div>
    <script src="{{ map.api }}"></script>
    <script>
    {{ map.render|raw }}
    </script>
