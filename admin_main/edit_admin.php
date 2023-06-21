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
      <h1>แก้ไขข้อมูลแอดมิน</h1>
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
          $sql = "SELECT*FROM admin where id_admin ='".$_GET['id_admin']."'";
          $sqlquery = mysqli_query($conn, $sql);
          $sqlnumrow = mysqli_num_rows($sqlquery);
          $row = mysqli_fetch_array($sqlquery);
      ?>
      <div class="row">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">แก้ไขข้อมูลแอดมิน</h5>
            <!-- Multi Columns Form -->
            <form class="row g-3" method="post">
              <div class="col-md-6">
                <label for="inputName" class="form-label">ชื่อ</label>
                <input type="hidden" name="id_admin" value="<?php echo $row['id_admin']; ?>">
                <input name="name" value="<?php echo $row['name']; ?>" type="text" class="form-control" id="inputName" placeholder="สมใจ">
                <input type="hidden" name="u_name" value="<?php echo $row['u_name']; ?>">
                <input type="hidden" name="p_word" value="<?php echo $row['p_word']; ?>">
              </div>
              <div class="col-md-6">
                <label for="inputSurname" class="form-label">นามสกุล</label>
                <input name="surname" value="<?php echo $row['surname']; ?>" type="text" class="form-control" id="inputSurname" placeholder="ใจดี">
              </div>
              <div class="col-md-4">
                <label for="inputTel" class="form-label">เบอร์โทร</label>
                <input name="tel" value="<?php echo $row['tel']; ?>" type="text" class="form-control" id="inputTel" placeholder="0899999999">
              </div>
              <?php
                  include "connect.php";
                  $sql = "SELECT*FROM admin where id_admin ='".$_GET['id_admin']."'";
                  $sqlquery = mysqli_query($conn, $sql);
                  $sqlnumrow = mysqli_num_rows($sqlquery);
                  $row = mysqli_fetch_array($sqlquery);
                  $status = $row['status'];
              ?>
              <div class="col-md-4">
                <label for="inputStatus" class="form-label">สถานะ</label>
                <select name="status" class="form-select" id="input-select">
                  <?php
                      include "connect.php";
                      $sql = "SELECT*FROM admin where id_admin ='".$_GET['id_admin']."'";
                      $sqlquery = mysqli_query($conn, $sql);
                  ?>
                  <?php
                  $i = 1;
                  while ($row = mysqli_fetch_array($sqlquery))
                  {
                    $s_t = $row['status'];
                    if ($s_t == $status) {
                  ?>
                    <option value="<?php echo $row['status']; ?>" selected disabled><?php echo $row['status']; ?></option>
                    <option value="admin">admin</option>
                    <option value="assistant">assistant</option>
                  <?php } else { ?>
                    <option value="admin">admin</option>
                    <option value="assistant">assistant</option>
                    <?php
                    $i++;
                    }
                    }
                    ?>
                </select>
              </div>
              <?php
                  include "connect.php";
                  $sql = "SELECT admin.id_admin, admin.name, admin.surname, admin.tel, admin.u_name, admin.p_word, admin.status, admin.id_educat, education.area_educat FROM admin join education on admin.id_educat = education.id_educat where id_admin ='".$_GET['id_admin']."'";
                  $sqlquery = mysqli_query($conn, $sql);
                  $sqlnumrow = mysqli_num_rows($sqlquery);
                  $row = mysqli_fetch_array($sqlquery);
                  $id_educat=  $row['id_educat'];
              ?>
              <div class="col-md-4">
                <label for="inputEducat" class="form-label">ศูนย์พื้นที่</label>
                <select name="id_educat" id="inputEducat" class="form-select">
                  <option selected disabled>เลือกศูนย์พื้นที่</option>
                  <?php
                  include "connect.php";
                  $sql = "SELECT*FROM education ";
                  $sqlquery = mysqli_query($conn, $sql);
                  ?>
                  <?php
                  $i = 1;
                  while ($row = mysqli_fetch_array($sqlquery))
                  {
                    $educat = $row['id_educat'];
                    if ($educat == $id_educat) {
                  ?>
                    <option value="<?php echo $row['id_educat']; ?>" selected><?php echo $row['area_educat']; ?></option>
                  <?php } else { ?>
                    <option value="<?php echo $row['id_educat']; ?>"><?php echo $row['area_educat']; ?></option>
                  <?php
                  $i++;
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="text-center">
                <button name="save" type="submit" class="btn btn-success">แก้ไขข้อมูล</button>
                <button type="reset" class="btn btn-secondary">รีเซ็ต</button>
              </div>
            </form><!-- End Multi Columns Form -->
            <?php
            if (!isset($_POST['save'])) {}else {
            $id_admin = $_POST['id_admin'];
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $tel = $_POST['tel'];
            $u_name = $_POST['u_name'];
            $p_word = $_POST['p_word'];
            $status = $_POST['status'];
            $id_educat = $_POST['id_educat'];
            include "connect.php";
            $check = "SELECT*FROM admin where name = '$name' and surname = '$surname' and tel = '$tel' and status = '$status' and id_educat = '$id_educat'";
            $result = mysqli_query($conn, $check) or die (mysqli_error());
            $num = mysqli_num_rows($result);
            if ($num > 0) {
              echo "ข้อมูลซ้ำ กรุณากรอกใหม่";
            }else {
            $sql = "UPDATE admin SET id_admin = '$id_admin', name = '$name', surname = '$surname', tel = '$tel', u_name = '$u_name', p_word = '$p_word', status = '$status', id_educat = '$id_educat' where id_admin = '$id_admin'";
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
