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
      <h1>ข้อมูลส่วนตัว</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index_admin.php">หน้าแรก</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-xl-4">
          <?php
              include "connect.php";
              $sql = "SELECT admin.id_admin, admin.name, admin.surname, admin.tel, admin.u_name, admin.p_word, admin.status, admin.id_educat, education.area_educat FROM admin join education on admin.id_educat = education.id_educat where u_name = '".$_SESSION['u_name']."'";
              $sqlquery = mysqli_query($conn, $sql);
              $sqlnumrow = mysqli_num_rows($sqlquery);
              $row = mysqli_fetch_array($sqlquery);
          ?>
          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
              <h2><?php echo $row["name"]?><?php echo "   "?><?php echo $row["surname"] ?></h2>
              <h3>สถานะ : <?php echo $row["status"]?></h3>
              <h4>ศูนย์ : <?php echo $row["area_educat"]?></h4>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">ข้อมูลส่วนตัว</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">แก้ไขโปรไฟล์</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">เปลี่ยนรหัสผ่าน</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">รายละเอียดโปรไฟล์</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">ชื่อ-นามสกุล</div>
                    <div class="col-lg-9 col-md-8"><?php echo $row["name"]?><?php echo "   "?><?php echo $row["surname"] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">เบอร์โทร</div>
                    <div class="col-lg-9 col-md-8"><?php echo $row["tel"]?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">ชื่อผู้ใช้</div>
                    <div class="col-lg-9 col-md-8"><?php echo $row["u_name"]?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">สถานะ</div>
                    <div class="col-lg-9 col-md-8"><?php echo $row["status"]?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">ศูนย์พื้นที่</div>
                    <div class="col-lg-9 col-md-8"><?php echo $row["area_educat"]?></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="post">

                    <div class="row mb-3">
                      <label for="Name" class="col-md-4 col-lg-3 col-form-label">ชื่อ</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="hidden" name="id_admin" value="<?php echo $row['id_admin']; ?>">
                        <input name="name" type="text" class="form-control" value="<?php echo $row["name"]?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Surname" class="col-md-4 col-lg-3 col-form-label">นามสกุล</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="surname" type="text" class="form-control" value="<?php echo $row["surname"]?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Tel" class="col-md-4 col-lg-3 col-form-label">เบอร์โทร</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="tel" type="text" class="form-control" value="<?php echo $row["tel"]?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Username" class="col-md-4 col-lg-3 col-form-label">ชื่อผู้ใช้</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="hidden" name="u_name" value="<?php echo $row['u_name']; ?>">
                        <input disabled type="text" class="form-control" value="<?php echo $row["u_name"]?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="area_educat" class="col-md-4 col-lg-3 col-form-label">ศูนย์พื้นที่</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="hidden" name="area_educat" value="<?php echo $row['area_educat']; ?>">
                        <input disabled type="text" class="form-control" value="<?php echo $row["area_educat"]?>">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" name="save" class="btn btn-warning">บันทึก</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                  <?php
                  if (!isset($_POST['save'])) {}else {
                  $id_admin = $_POST['id_admin'];
                  $name = $_POST['name'];
                  $surname = $_POST['surname'];
                  $tel = $_POST['tel'];
                  $u_name = $_POST['u_name'];
                  $area_educat = $_POST['area_educat'];
                  include "connect.php";
                  $check = "SELECT*FROM admin where name = '$name' and surname = '$surname' and tel = '$tel' and area_educat = '$area_educat'";
                  $result = mysqli_query($conn, $check) or die (mysqli_error());
                  $num = mysqli_num_rows($result);
                  if ($num > 0) {
                    echo "ข้อมูลซ้ำ กรุณากรอกใหม่";
                  }else {
                  $sql = "UPDATE admin SET id_admin = '$id_admin', name = '$name', surname = '$surname', tel = '$tel', u_name = '$u_name', area_educat = '$area_educat' where id_admin = '$id_admin'";
                  $query = mysqli_query($conn, $sql);
                  if ($query) {
                    echo "<br><div class= 'alert alert-success' role='alert'>แก้ไขข้อมูลสำเร็จ";
                  }
                  $conn->close();
                  }
                  }
                  ?>

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">รหัสผ่านปัจจุบัน</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">รหัสผ่านใหม่</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">ป้อนรหัสผ่านใหม่อีกครั้ง</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">เปลี่ยนรหัสผ่าน</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

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
