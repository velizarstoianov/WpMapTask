
<!DOCTYPE html>
<html>
  <head>
    <title>Add Map</title>

    <style type="text/css">
      /* Set the size of the div element that contains the map */
      #map {
        height: 400px;
        /* The height is 400 pixels */
        width: 100%;
        /* The width is the width of the web page */
      }
    </style>
    <script language="JavaScript">
      // Language marked for php to read
      // Func to add marker
      function addMarker(map,coordinated_to_parse)
      {
        //Parse json data to coordinates
        const marker_coordinates = new google.maps.LatLng(coordinated_to_parse.lat, coordinated_to_parse.lng);
        const marker = new google.maps.Marker({
          position: marker_coordinates,
          map: map,
        });
      }
      function initMap() {
        //init map and center it on Australia
        let center={ lat: -25.344, lng: 131.036 };
        //Query database
        let jsonStringToParse = <?php include 'queryDB.php';
                                echo $json_output;
                                ?>;
        let points = jsonStringToParse;
        let map = new google.maps.Map(document.getElementById("map"), {
          zoom: 2,
          center: center,
        });
        //Add all points from db
        for(let i=0;i<points.length;i++)
        {
          addMarker(map,points[i]);
        }
        
      }


    </script>
  </head>
  <body>
    <h3>My Google Maps Demo</h3>
    <!--The div element for the map -->
    <div id="map"></div>

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDt55g-_V9nqRusdVfYX6f3YAZSJacfQU&callback=initMap&libraries=&v=weekly"
      async
    ></script>
  </body>
</html>