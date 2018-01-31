<!DOCTYPE html>
<html>
  <head>
    <title>Vector tiles</title>
    <script
    src="https://code.jquery.com/jquery-3.2.1.js"
    integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
    crossorigin="anonymous"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://openlayers.org/en/v4.5.0/css/ol.css" type="text/css">
    <!-- The line below is only needed for old environments like Internet Explorer and Android 4.x -->
    <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script>
    <script src="https://openlayers.org/en/v4.5.0/build/ol.js"></script>
    
    <!-- Sweetalert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <style>
    html, body {
      font-family: sans-serif;
      width: 100%;
    }
    .map {
      height: 500px;
      width: 100%;
    }
    </style>
  </head>
  <body>
  <h3>Mapbox Protobuf - vector tiles</h3>
  <div id="map" class="map"></div>
  <script>

    var style_simple = new ol.style.Style({
        fill: new ol.style.Fill({
        color: '#ADD8E6'
        }),
        stroke: new ol.style.Stroke({
        color: '#880000',
        width: 1
        })
    });

    function simpleStyle(feature) {
        return style_simple;
    }

    var projection900913 = new ol.proj.Projection ({ 
        code: ' EPSG: 900913 ', 
        units: ' meters ', 
    }); 

    var layer = 'TTB:OstalaPrirodnaPodrucja';
    var projection_epsg_no = '900913';
    var map = new ol.Map({
        target: 'map',
        view: new ol.View({
        //projection: projection900913,
        center: [1791683, 5723875],
        zoom: 10
        }),
        layers: [new ol.layer.Tile({
            source: new ol.source.OSM()
          }), new ol.layer.VectorTile({
        style:simpleStyle,
        source: new ol.source.VectorTile({
            tilePixelRatio: 1, // oversampling when > 1
            tileGrid: ol.tilegrid.createXYZ({maxZoom: 19}),
            format: new ol.format.MVT(),
            url: 'https://dev.li-st.net/geoserver/gwc/service/tms/1.0.0/' + layer +
                '@EPSG%3A'+projection_epsg_no+'@pbf/{z}/{x}/{-y}.pbf'
        })
        })]
    });
  </script>
  </body>
</html>