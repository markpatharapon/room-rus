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
      <h1>เพิ่มข้อมูลประเภทที่พัก</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index_admin.php">หน้าแรก</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">เพิ่มข้อมูลประเภทที่พัก</h5>

            <!-- Multi Columns Form -->
            <form class="row g-3" method="post">
              <div class="col-md-12">
                <label for="inputName" class="form-label">ประเภทที่พัก</label>
                <input name="name_type" type="text" class="form-control" id="inputName" placeholder="เช่น บ้านพัก">
              </div>
              <div class="text-center">
                <button name="save" type="submit" class="btn btn-success">เพิ่มข้อมูล</button>
                <button type="reset" class="btn btn-secondary">รีเซ็ต</button>
              </div>
            </form><!-- End Multi Columns Form -->
            <?php
            if (!isset($_POST['save'])) {}else {
            $name_type = $_POST['name_type'];
            include "connect.php";
            $check = "SELECT name_type FROM type_accom where name_type = '$name_type'";
            $result = mysqli_query($conn, $check) or die (mysqli_error());
            $num = mysqli_num_rows($result);
            if ($num > 0) {
              echo "ข้อมูลซ้ำ กรุณากรอกใหม่";
            }else {
            $sql = "INSERT INTO type_accom (name_type) VALUES ('$name_type')";
            $query = mysqli_query($conn, $sql);
            if ($query) {
              echo "<br><div class= 'alert alert-success' role='alert'>เพิ่มข้อมูลสำเร็จ";
            }else {
              echo "<br><div class= 'alert alert-danger' role='alert'>เพิ่มข้อมูลไม่สำเร็จ";
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
