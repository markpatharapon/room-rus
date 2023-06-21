<!DOCTYPE html>
<?php
session_start();
if ($_SESSION['u_name']=="") {
  echo "<script>alert('กรุณาเข้าสู่ระบบ!');</script>";
  header("location:index.php");
  exit();
}
if ($_SESSION['status']=="assistant") {
  echo "<script>alert('หน้านี้สำหรับ แอดมิน หลัก เท่านั้น!');</script>";
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
      <h1>ที่พักนักศึกษาราชมงคลสุวรรณภูมิ</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index_admin.php">หน้าแรก</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <form method="post" id="form" enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF'];?>">
      <div class="input-group mb-3">
        <input class="form-control" name="search" type="text" placeholder="กรอกคำค้นหา" aria-label="Recipient's username" aria-describedby="button-addon2">
        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">ค้นหา</button>
        <!--<a><button value="ค้นหา" class="btn btn-outline-secondary" type="submit" id="button-addon2">ค้นหา</button></a>-->
      </div>
      </form>
      <div class="row">
      <?php
      isset( $_POST['search'] ) ? $search = $_POST['search'] : $search = "";
      if( !empty( $search ) ) {
        include "connect.php";
        $sql = " SELECT * FROM accom WHERE ( name_accom LIKE '%".$search."%' ) and id_educat = '$_SESSION[id_educat]'";
        $sqlquery = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($sqlquery) ) {
            ?><div class="col-lg-3">
              <a href="accom.php?id_accom=<?php echo $row["id_accom"];?>">
                <div class="card">
                  <img src="../img/<?php echo $row['pic']?>" class="img-fluid rounded-start" alt="...">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $row['name_accom']?></h5>
                    <p class="card-text"><small class="text-muted"><?php echo $row['address']?></small></p>
                    <p class="card-text"><?php echo $row['starting_price']?> - <?php echo $row['highest_price']?> บาท/เดือน</p>
                  </div>
                </div></a>
            </div>
        <?php
          }
          mysqli_close( $conn );
        }else {
          include "connect.php";
          $sql = "SELECT*FROM accom WHERE id_educat = '$_SESSION[id_educat]' order by id_accom";
          $sqlquery = mysqli_query($conn, $sql);
          while($row = mysqli_fetch_assoc($sqlquery) ) {
              ?><div class="col-lg-3">
                <a href="accom.php?id_accom=<?php echo $row["id_accom"];?>">
                  <div class="card">
                    <img src="../img/<?php echo $row['pic']?>" class="img-fluid rounded-start" alt="...">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $row['name_accom']?></h5>
                      <p class="card-text"><small class="text-muted"><?php echo $row['address']?></small></p>
                      <p class="card-text"><?php echo $row['starting_price']?> - <?php echo $row['highest_price']?> บาท/เดือน</p>
                    </div>
                  </div></a>
              </div>
              <?php
            }
            mysqli_close( $conn );
        }
        ?>
        </div>
    </section>

  </main><!-- End #main -->

  <?php include 'footer.php' ?>

  <?php include 'script.php' ?>

</body>

</html>
