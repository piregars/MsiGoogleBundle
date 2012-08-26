MsiGoogleBundle
===============

add to kernel:

    new Msi\Bundle\GoogleBundle\MsiGoogleBundle(),

usage:

    // controller

    use Msi\Bundle\GoogleBundle\Map\Map;

    $builder = $this->container->get('msi_google.map_factory')->createBuilder('mapCanvas', array());

    $builder->setKey('AIzaSyApRm7i1CAzNjNGhb2lqwwTRJDtKf68EKo');

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
