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
      <h1>แก้ไขข้อมูลศูนย์พื้นที่</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index_admin.php">หน้าแรก</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <?php
          include "connect.php";
          $sql = "SELECT*FROM education where id_educat ='".$_GET['id_educat']."'";
          $sqlquery = mysqli_query($conn, $sql);
          $sqlnumrow = mysqli_num_rows($sqlquery);
          $row = mysqli_fetch_array($sqlquery);
      ?>
      <div class="row">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">แก้ไขข้อมูลศูนย์พื้นที่</h5>

            <!-- Multi Columns Form -->
            <form class="row g-3" method="post">
              <div class="col-md-12">
                <label for="inputName" class="form-label">ชื่อศูนย์พื้นที่</label>
                <input type="hidden" name="id_educat" value="<?php echo $row['id_educat']; ?>">
                <input name="area_educat" value="<?php echo $row['area_educat']; ?>" type="text" class="form-control" id="inputName" placeholder="สุพรรณบุรี">
              </div>
              <div class="col-md-6">
                <label for="inputLatitude" class="form-label">ละติจูด</label>
                <input name="latitude_e" value="<?php echo $row['latitude_e']; ?>" type="text" class="form-control" id="inputID" placeholder="14.71969572139479">
              </div>
              <div class="col-md-6">
                <label for="inputLongitude" class="form-label">ลองจิจูด</label>
                <input name="longitude_e" value="<?php echo $row['longitude_e']; ?>" type="text" class="form-control" id="inputID" placeholder="100.1101952791214">
              </div>
              <div class="text-center">
                <button name="save" type="submit" class="btn btn-success">แก้ไขข้อมูล</button>
                <button type="reset" class="btn btn-secondary">รีเซ็ต</button>
              </div>
            </form><!-- End Multi Columns Form -->
            <?php
            if (!isset($_POST['save'])) {}else {
            $id_educat = $_POST['id_educat'];
            $area_educat = $_POST['area_educat'];
            $latitude_e = $_POST['latitude_e'];
            $longitude_e = $_POST['longitude_e'];
            include "connect.php";
            $check = "SELECT*FROM education where area_educat = '$area_educat' and latitude_e = '$latitude_e' and longitude_e = '$longitude_e'";
            $result = mysqli_query($conn, $check) or die (mysqli_error());
            $num = mysqli_num_rows($result);
            if ($num > 0) {
              echo "ข้อมูลซ้ำ กรุณากรอกใหม่";
            }else {
            $sql = "UPDATE education SET id_educat = '$id_educat', area_educat = '$area_educat', latitude_e = '$latitude_e', longitude_e = '$longitude_e' where id_educat = '$id_educat'";
            $query = mysqli_query($conn, $sql);
            if ($query) {
              echo "<br><div class= 'alert alert-success' role='alert'>แก้ไขข้อมูลสำเร็จ";
            }
            $conn->close();
            }
            }
            ?>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <?php include 'footer.php' ?>

  <?php include 'script.php' ?>

</body>

</html>
