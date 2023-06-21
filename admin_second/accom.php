<!DOCTYPE html>
<?php
session_start();
if ($_SESSION['u_name']=="") {
  echo "<script>alert('กรุณาเข้าสู่ระบบ!');</script>";
  header("location:index.php");
  exit();
}
if ($_SESSION['status']=="admin") {
  echo "<script>alert('หน้านี้สำหรับ ผู้ช่วยแอดมิน เท่านั้น!');</script>";
  header("location:index.php");
  exit();
}
?>
<html lang="en">

<?php include 'head.php' ?>

<body>
  <?php
  include "connect.php";
  $sql = "SELECT*FROM admin where u_name = '".$_SESSION['u_name']."'";
  $sqlquery = mysqli_query($conn, $sql);
  $sqlnumrow = mysqli_num_rows($sqlquery);
  $row = mysqli_fetch_array($sqlquery);
  ?>
  <?php include 'navbar.php' ?>

  <?php include 'sidebar.php' ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>รายละเอียดที่พัก</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index_admin.php">หน้าแรก</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row align-items-top">
        <div class="col-lg-12">
        <div class="card">
          <!-- Slides with captions -->
          <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <?php
            include "connect.php";
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
                <img src="../img/<?php echo $row['pic_a']?>" class="d-block w-100" alt="...">
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
          include "connect.php";
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
      </div>
      </div>
    </section>

  </main><!-- End #main -->

  <?php include 'footer.php' ?>

  <?php include 'script.php' ?>

</body>

</html>
