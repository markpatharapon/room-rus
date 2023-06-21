<?php
include "layout/connect.php";
$sql = "SELECT*FROM tmp_location";
$sqlquery = mysqli_query($conn, $sql);
$rows = mysqli_fetch_array($sqlquery);
?>
<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>ที่พัก - ราชมงคลสุวรรณภูมิ</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <style type="text/css">
          html{
            height:100%;
          }
          body{
            margin:0px;
            height:100%;
          }
          #map{
            height: 100%;
          }
          #result{
              position: absolute;
              top : 0;
              bottom: 1;
              right: 0;
              width: 10%;
              height: 30%;
              margin: auto;
              border:4px solid #dddddd;
              background: #ffffff;
              overflow: auto;
              z-index: 2;
          }
        </style>
        <script type="text/javascript" src="https://api.longdo.com/map/?key=94591d5a908f3058a137b8b34241d6fb"></script>
        <?php
        // include "save_location.php";
        $sql = "SELECT*FROM accom inner join education on accom.id_educat = education.id_educat where id_accom ='".$_GET['id_accom']."'";
        $sqlquery = mysqli_query($conn, $sql);
        $sqlnumrow = mysqli_num_rows($sqlquery);
        $row = mysqli_fetch_array($sqlquery);
        ?>
        <script>
        var l = document.getElementById("location");
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showLocation);
        } else {
            l.innerHTML = "โปรแกรมเล่นอินเทอร์เน็ตของคุณไม่รองรับ Geolocation API";
        }
          var latitude=0;
          var longitude=0;

        function showLocation(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            var data = {
           latitude: latitude,
           longitude: longitude,
        };
        //////////////////////////
        var xhr = new XMLHttpRequest();

        //👇 set the PHP page you want to send data to
        xhr.open("POST", "save_location.php", true);
        xhr.setRequestHeader("Content-Type", "application/json");

        //👇 what to do when you receive a response
        xhr.onreadystatechange = function () {
            if (xhr.readyState == XMLHttpRequest.DONE) {
              //  alert(xhr.responseText);
            }
        };

        //👇 send the data
        xhr.send(JSON.stringify(data));


        }
        // document.getElementById("location1").innerHTML = "Full Name: "+ latitude + " Jobs";
        </script>
        <script>
          var map;
          var Marker = new longdo.Marker(
              { lon: <?php echo $rows['lon'];?> , lat: <?php echo $rows['lat'];?> },
              { title: 'I\'m here', detail: 'I\'m here' }
            ); // Create Marker Overlay

            function init() {

              map = new longdo.Map({
                placeholder: document.getElementById('map')
              });
            map.location({ lon: <?php echo $rows['lon'];?>, lat: <?php echo $rows['lat']; ?> }, true);//ตำแหน่งแรก
            map.Route.placeholder(document.getElementById('result'));
            map.Route.add(Marker);
            map.Route.add({ lon: <?php echo $row['longitude'];?>, lat: <?php echo $row['latitude']; ?> });
            map.Route.search();
            map.Overlays.bounce(Marker) // Show bounce animation
            map.zoom(18, true);
                map.zoomRange({ min:14, max:20 });
      }
        </script>
  <!-- Favicons -->
  <link href="assets/img/favicon1.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <!-- =======================================================
  * Template Name: NiceAdmin - v2.4.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body onload="init();">
  <div id="map"></div>
  <div id="result"></div>
</body>

</html>
