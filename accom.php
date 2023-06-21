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
            height: 500px;
            width: 100%;
          }
          #result{
              position: absolute;
              top : auto;
              bottom: 11%;
              left: auto;
              right: auto;
              width: 1px;
              height: 78%;
              margin: auto;
              border:5px solid #dddddd;
              background: #ffffff;
              overflow: auto;
              z-index: 2;
          }
        </style>
        <script type="text/javascript" src="https://api.longdo.com/map/?key=94591d5a908f3058a137b8b34241d6fb"></script>
        <?php
        include "layout/connect.php";
        $sql = "SELECT*FROM accom inner join education on accom.id_educat = education.id_educat where id_accom ='".$_GET['id_accom']."'";
        $sqlquery = mysqli_query($conn, $sql);
        $sqlnumrow = mysqli_num_rows($sqlquery);
        $row = mysqli_fetch_array($sqlquery);
        ?>
     <script>
       var map;
       var Marker = new longdo.Marker(
           { lon: <?php echo $row['longitude_e'];?> , lat: <?php echo $row['latitude_e'];?> },
           { title: 'มหาวิทยาลัยฯ', detail: 'จุดเริ่มต้น' }
         ); // Create Marker Overlay

         function init() {

           map = new longdo.Map({
             placeholder: document.getElementById('map')
           });
         map.location({ lon: <?php echo $row['longitude_e'];?>, lat: <?php echo $row['latitude_e'];?> }, true);//ตำแหน่งแรก
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
  <?php include 'layout/navbar.php' ?>

  <?php include 'layout/sidebar.php' ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>รายละเอียดที่พัก</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">หน้าแรก</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row align-items-top">
        <div class="col-lg-12">
        <div class="card">
          <!-- Slides with captions -->
          <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <?php
            include "layout/connect.php";
            $sql = "SELECT*FROM album where id_accom ='".$_GET['id_accom']."'";
            $sqlquery = mysqli_query($conn, $sql);
            $sqlnumrow = mysqli_num_rows($sqlquery);
            ?>
            <div class="carousel-inner">
              <?php
              $i = 1;
              while ($row = mysqli_fetch_array($sqlquery))
              {
                if ($i == 1) {
                ?>
              <div class="carousel-item active">
              <?php } else { ?>
                <div class="carousel-item">
              <?php } ?>
                <img src="img/<?php echo $row['pic_a']?>" class="d-block w-100" alt="...">
              </div>
              <?php
              $i++;
              }
              ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div><!-- End Slides with captions -->
          <?php
          include "layout/connect.php";
          $sql = "SELECT*FROM accom where id_accom ='".$_GET['id_accom']."'";
          $sqlquery = mysqli_query($conn, $sql);
          $sqlnumrow = mysqli_num_rows($sqlquery);
          $row = mysqli_fetch_array($sqlquery);
          ?>
            <div class="card-body">
              <h2 class="card-title"><?php echo $row['name_accom']?></h2><hr>
              <p class="card-text"><?php echo $row['detail']?></p>
              <p class="card-text">ค่าน้ำ : <?php echo $row['water_bill']?> บาท/ยูนิต</p>
              <p class="card-text">ค่าไฟ : <?php echo $row['elect_bill']?> บาท/ยูนิต</p>
              <p class="card-text">ราคา : <?php echo $row['starting_price']?> - <?php echo $row['highest_price']?> บาท/เดือน</p>
              <p class="card-text">ที่อยู่ : <?php echo $row['address']?></p>
              <p class="card-text">เบอร์โทรติดต่อ : <?php echo $row['tel']?></p><hr>
            </div>
        </div>
      </div>
      <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">ตำแหน่งที่พัก เริ่มจากที่อยู่มหาลัย (MAP)</h5>
          <!-- Default Tabs -->
          <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
          </ul>
          <div class="tab-content pt-2" id="myTabjustifiedContent">
            <div class="tab-pane fade show active" id="home-justified" role="tabpanel" aria-labelledby="home-tab">
              <div id="map"></div>
            </div>
          </div><!-- End Default Tabs -->
          <a href="accom_map.php?id_accom=<?php echo $row["id_accom"];?>"><div class="d-grid gap-2 mt-3">
            <button class="btn btn-primary" type="button">เลือกตำแหน่งปัจจุบัน</button>
          </div></a>
        </div>
      </div>
      </div>
    </div>
    </div>
    </section>

  </main><!-- End #main -->

  <?php include 'layout/footer.php' ?>

  <?php include 'layout/script.php' ?>

</body>

</html>
