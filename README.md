MsiGoogleBundle
===============

register bundle:

``` php
new Msi\GoogleBundle\MsiGoogleBundle(),
```

usage:

``` php
// controller

$map = $this->container->get('msi_google.map.factory')->create();

// $map->setKey('ewhf09weFf9w3hj39ff9wf9h3h0h32fh38290h');

$map->addOverlay('marker', array(
    'position' => $map->latlng(45.5086699, -73.5539925),
    'title' => '"some_title"',
    'icon' => '"path_to_some_icon_image"',
));

// view

{{ msi_google_render_map_html(map) }}

// ...

{{ msi_google_render_map_js(map) }}
```
