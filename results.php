<?php
    session_start();
?>
<?
    include 'header.php'
?>

<?php
    define('GOOGLE_MAPS_APP_ID', 'AIzaSyCvu9bAVXqfYa0MWMxs-8MkWIt4jjP-Q4k');
    define('GOOGLE_LOCATION_ID', 'AIzaSyDJ1smMBIFbfNAjvsRz8TFNeslF1H3zcoA');
    define('OPEN_WEATHER_MAP_APP_ID', 'a5ad7ceecc8e91f347084a8192d4c842');

    $hot_city = ['BeloHorizonte', 'Bogota', 'Monterrey', 'Al-Aïn', 'Gaborone'];
    $hot_sea = ['Sydney', 'Miami', 'Split', 'Hossegor', 'Rio'];
    $hot_land = ['pas trouvé encore', 'toujours pas'];
    $cold_city = ['Reykjavik', 'Osaka', 'Montréal', 'Paris', 'Dublin'];
    $cold_sea = ['Liverpool', 'Malmö', 'Flensburg', 'Sundsvall', 'Brest'];
    $cold_land = ['Reykjahlíð', 'Rovaniemi', 'Lillehammer', 'Kuopio', 'Armagh'];


    if ($_SESSION['climate'] === "hot" && $_SESSION['environment'] === "city" ){
        $value = array_rand($hot_city);
        $v = $hot_city[$value];
    } else if ($_SESSION['climate'] === "hot" && $_SESSION['environment'] === "sea" ){
        $value = array_rand($hot_sea);
        $v = $hot_sea[$value];
    } else if ($_SESSION['climate'] === "hot" && $_SESSION['environment'] === "land" ){
        $value = array_rand($hot_land);
        $v = $hot_land[$value];
    } else if ($_SESSION['climate'] === "cold" && $_SESSION['environment'] === "city" ){
        $value = array_rand($cold_city);
        $v = $cold_city[$value];
    } else if ($_SESSION['climate'] === "cold" && $_SESSION['environment'] === "sea" ){
        $value = array_rand($cold_sea);
        $v = $cold_sea[$value];
    } else if ($_SESSION['climate'] === "cold" && $_SESSION['environment'] === "land" ){
        $value = array_rand($cold_land);
        $v = $cold_land[$value];
    }

    $url_geolocation = 'https://maps.googleapis.com/maps/api/geocode/json?address='.$v.'&key='.GOOGLE_LOCATION_ID.'';
    $data_maps = file_get_contents($url_geolocation);
    $data_maps = json_decode($data_maps);
    
    ?>
    <?php foreach($data_maps->results as $result_map): ?>
        <?
            $lng = number_format(json_encode($result_map->geometry->location->lng), 6);
            $lat = number_format(json_encode($result_map->geometry->location->lat), 6);
        ?>
    <?php endforeach ?>

    <!-- $longitude = rand(-180, 180);
    $latitude = rand(-90, 90); -->
    <?php
    $city = isset($_GET['city']) ? $_GET['city'] : 'Paris';
    $url = 'https://maps.googleapis.com/maps/api/elevation/json?locations='.$lng.','.$lat.'&key='.GOOGLE_MAPS_APP_ID.'';
    
    $data = file_get_contents($url);
    $data = json_decode($data);
    ?>
<a name="lkr-nearby-widget" data-params='{ "lat": <?= $lat ?>, "lng": <?= $lng ?> }' href="https://www.lookr.com/fr/explore#!<? $lat ;$lng?>-<?$v?>"></a><script async src="nearby.js"></script>
<h1 class="title_result">Hey <?= $_SESSION['first-name'] ?> !</h1>
<h2>Your next destination will be... <?= $v ?> !</h2>


<?php

    $url_maps = 'https://maps.googleapis.com/maps/api/staticmap?center='.$v.'&zoom=5&size=300x800&key='.GOOGLE_MAPS_APP_ID.'&markers=color:pink%7C'.$lat.','.$lng.'';
?>
<img class="map" src="<?= $url_maps ?>">


<!-- https://maps.googleapis.com/maps/api/staticmap?center='.$v.',CA&zoom=5&size=400x400&markers=color:blue%7Clabel:S%'.$lng.'%'.$lat.'&maptype=terrain&key='.GOOGLE_MAPS_APP_ID.' -->
<?php 
    $url_weather = 'https://api.openweathermap.org/data/2.5/weather?lat='.$lat.'&lon='.$lng.'&appid='.OPEN_WEATHER_MAP_APP_ID.'&units=metric';
    $data_weather = file_get_contents($url_weather);
    $data_weather = json_decode($data_weather);

    $description = $data_weather->weather[0]->description;
    $description = (string)$description;

    if ($description === 'thunderstorm')
    {
        $img_weather = "img/storm.svg";
    }
    else if ($description === 'shower rain' || $description === 'light rain' || $description ==='light intensity shower rain' || $description === 'moderate rain') {
        $img_weather = "img/rain.svg";
    }
    else if ($description === 'clear sky') {
        $img_weather = "img/sun.svg";
    }
    else if ($description === 'few clouds' ||  $description === 'scattered clouds' || $description === 'broken clouds'){
        $img_weather = "img/cloudy.svg";
    }
    else if ($description === 'overcast clouds') {
        $img_weather = "img/clouds.svg";
    }
    else if ($description === 'mist' || $description ==='fog' || $description ==='haze') {
        $img_weather = "img/wind.svg";
    }
    else if ($description === 'light shower snow' || $description === 'heavy snow' || $description === 'snow' || $description === 'light snow') {
        $img_weather = "img/snow.svg";
    }
?>

<div class = "weather">
    <h3>Weather in <?= $v ?></h3>
    <img width=80 src="<?= $img_weather ?>">
    <p>Sky : <?= $data_weather->weather[0]->description?></p>
    <p>Temperature : <?= floor($data_weather->main->temp)?>°</p>
    <p>Humidity : <?= floor($data_weather->main->humidity)?>%</p>
</div>
<div class = "share">
    <h3>SHARE IT !</h3>
    <img width=80 src="<?= $img_weather ?>">
    <p>Sky : <?= $data_weather->weather[0]->description?></p>
    <p>Temperature : <?= floor($data_weather->main->temp)?>°</p>
    <p>Humidity : <?= floor($data_weather->main->humidity)?>%</p>
</div>

<?php
// Create a stream
$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"X-Mashape-Key: 4F5Bo8vtqUmshkHpvDIXRYN0RMS0p1kV2Btjsnf21Lfxnmdq2s"               
  )
);

$context = stream_context_create($opts);

// Open the file using the HTTP headers set above
$data_webcam = file_get_contents('https://webcamstravel.p.mashape.com/webcams/list/nearby='.$lat.','.$lng.',5?show=webcams:', false, $context);
echo "<pre>";
$res = json_decode($data_webcam);
echo "</pre>";
?>

<?php foreach($res->result as $id_webcam): ?>
    <?
       $id = $res->result->webcams[0]->id;
    ?>
<?php endforeach ?>
