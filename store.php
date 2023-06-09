<?php
session_start();
require_once "util.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Find Stores</title>
        <?php head();?>
        <link rel="stylesheet" type="text/css" href="css/style.css?<?php echo time(); ?>">
    </head>    
    <body>
    <header>
            <nav class="navbar">
                <a href="index.php" class="nav-branding">Always Healthy</a>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="store.php">Store</a>
                    </li>
                    <?php
                    if (isset($_SESSION["firstName"]) && isset($_SESSION["lastName"])) {
                        echo '<li class="nav-item"><a href="dietTable.php" class="nav-link">View Diets</a></li>';
                        echo '<li class="nav-item"><a href="logout.php" class="nav-link">Log Out</a></li>';
                    }
                    else {
                        echo '<li class="nav-item"><a href="login.php" class="nav-link">Log In</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="signin.php">Sign In</a>
                    </li>';
                    }
                    ?>
                </ul>
                <div class="hamburger">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </nav>
        </header>
        <div class="storeTitle">
            <h1>Nearby Stores</h1>
            <h3>Using the search bar you can look for nearby stores that have the items you need for your diet<h3>
            <button id="generateMapDiv" onclick="toggle(this)">Initiate</button>
        </div>
        <input id="pac-input" class="controls" type="text" placeholder="Search Box" hidden="hidden">
        <div id="map" hidden="hidden"></div>
        <script src="js/mapsAPICall.js"></script>
        <script>
            // Toggles the visibility of the map and search box
            let toggle = button => {
            let map = document.getElementById("map");
            let hidden = map.getAttribute("hidden");

            let box = document.getElementById("pac-input");
            let hidden2 = box.getAttribute("hidden");

                if (hidden) {
                    map.removeAttribute("hidden");
                    setTimeout(function() {
                        document.getElementById("pac-input").style.display = "block"; 
                        box.removeAttribute("hidden");
                    },2000)
                    
                } 
            }
            // When the window loads, the initMap() function is called
            window.onload = function() {
                initMap();
            }
            var map;

            //Creates the map based on user location and adds event listeners
            function initMap() {
                navigator.geolocation.getCurrentPosition(function(position) {
                         map = new google.maps.Map(document.getElementById('map'), {
                        center: {lat: position.coords.latitude, lng: position.coords.longitude},
                        zoom: 14
                    });
                    var marker = new google.maps.Marker({
                    position: {lat: position.coords.latitude, lng: position.coords.longitude},
                    map: map
                    });

                var input = document.getElementById('pac-input');
                var searchBox = new google.maps.places.SearchBox(input);
                map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

                map.addListener('bounds_changed', function() {
                    searchBox.setBounds(map.getBounds());
                });

                google.maps.event.addListener(map, "click", function (event) {
                    // Get the latitude and longitude of the clicked location
                    var clickedLat = event.latLng.lat();
                    var clickedLng = event.latLng.lng();
                    
                    //Creates a marker when a location is clicked on the map
                    var tempMarker = new google.maps.Marker({
                    position: {lat: clickedLat, lng: clickedLng},
                    map: map
                    });
                });
                
                //Adds markers when the searchbox value changes
                searchBox.addListener('places_changed', function() {
                    var places = searchBox.getPlaces();

                    if (places.length == 0) {
                    return;
                    }

                    var bounds = new google.maps.LatLngBounds();
                    places.forEach(function(place) {
                    if (!place.geometry) {
                        return;
                    }

                    //Creates the marker for the value in the searchbox
                    var marker = new google.maps.Marker({
                        map: map,
                        title: place.name,
                        position: place.geometry.location
                    });

                    if (place.geometry.viewport) {
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                    });
                    map.fitBounds(bounds);
                });
            });
        }

        
        </script>
    </body>
</html>