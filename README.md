MsiGoogleBundle
===============

add to kernel:

    new Msi\Bundle\GoogleBundle\MsiGoogleBundle(),

usage:

    // controller

    $map = $this->container->get('msi_google.map_factory')->create('mapCanvas', array());

    $map->setKey('ewhf09weFf9w3hj39ff9wf9h3h0h32fh38290h');

    $map->addOverlay('marker', array(
        'position' => $map->latlng(-32423, 737213),
        'title' => 'dadada',
    ));

    // view

    <div id="mapCanvas" style="width:500px;height:300px;"></div>
    <script src="{{ map.api }}"></script>
    <script>
    {{ map.render|raw }}
    </script>
