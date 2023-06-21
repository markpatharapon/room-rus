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
      <h1>เพิ่มข้อมูลแอดมิน</h1>
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
            <h5 class="card-title">เพิ่มข้อมูลแอดมิน</h5>

            <!-- Multi Columns Form -->
            <form class="row g-3" method="post">
              <div class="col-md-6">
                <label for="inputName" class="form-label">ชื่อ</label>
                <input name="name" type="text" class="form-control" id="inputName" placeholder="เช่น สมใจ">
              </div>
              <div class="col-md-6">
                <label for="inputSurname" class="form-label">นามสกุล</label>
                <input name="surname" type="text" class="form-control" id="inputSurname" placeholder="เช่น ใจดี">
              </div>
              <div class="col-md-6">
                <label for="inputUsername" class="form-label">ชื่อผู้ใช้</label>
                <input name="u_name" type="text" class="form-control" id="inputUsername" placeholder="เช่น mark_ptrp">
              </div>
              <div class="col-md-6">
                <label for="inputPassword" class="form-label">รหัสผ่าน</label>
                <input name="p_word" type="text" class="form-control" id="inputPassword" placeholder="เช่น 123456">
              </div>
              <div class="col-md-4">
                <label for="inputTel" class="form-label">เบอร์โทร</label>
                <input name="tel" type="text" class="form-control" id="inputTel" placeholder="เช่น 0899999999">
              </div>
              <div class="col-md-4">
                <label for="inputStatus" class="form-label">สถานะ</label>
                <select name="status" class="form-select" id="input-select">
                  <option selected disabled>เลือกสถานะ</option>
                  <option value="admin">admin</option>
                  <option value="assistant">assistant</option>
                </select>
              </div>
              <div class="col-md-4">
                <label for="inputEducat" class="form-label">ศูนย์พื้นที่</label>
                <select name="id_educat" id="inputEducat" class="form-select">
                  <option selected disabled>เลือกศูนย์พื้นที่</option>
                  <?php
                  include "connect.php";
                  $sql = "SELECT*FROM education order by id_educat";
                  $sqlquery = mysqli_query($conn, $sql);
                  $sqlnumrow = mysqli_num_rows($sqlquery);
                  ?>
                  <?php
                  $i = 1;
                  while ($row = mysqli_fetch_array($sqlquery))
                  {
                  ?>
                  <option value="<?php echo $row['id_educat']; ?>"><?php echo $row['area_educat']; ?></option>
                  <?php
                  $i++;
                  }
                  ?>
                </select>
              </div>
              <div class="text-center">
                <button name="save" type="submit" class="btn btn-success">เพิ่มข้อมูล</button>
                <button type="reset" class="btn btn-secondary">รีเซ็ต</button>
              </div>
            </form><!-- End Multi Columns Form -->
            <?php
            if (!isset($_POST['save'])) {}else {
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $tel = $_POST['tel'];
            $u_name = $_POST['u_name'];
            $p_word = $_POST['p_word'];
            $status = $_POST['status'];
            $id_educat = $_POST['id_educat'];
            include "connect.php";
            $check = "SELECT u_name FROM admin where u_name = '$u_name'";
            $result = mysqli_query($conn, $check) or die (mysqli_error());
            $num = mysqli_num_rows($result);
            if ($num > 0) {
              echo "ข้อมูลซ้ำ กรุณากรอกใหม่";
            }else {
            $sql = "INSERT INTO admin (name, surname, tel, u_name, p_word, status, id_educat) VALUES ('$name', '$surname', '$tel', '$u_name', '$p_word', '$status', '$id_educat')";
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
