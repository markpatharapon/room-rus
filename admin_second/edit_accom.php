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
      <h1>แก้ไขข้อมูลที่พัก</h1>
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
            <h5 class="card-title">แก้ไขข้อมูลที่พัก</h5>

            <!-- Multi Columns Form -->
            <form class="row g-3" method="post" enctype="multipart/form-data">
              <?php
                  include "connect.php";
                  $sql = "SELECT*FROM accom as d1 inner join type_accom as d2 on (d1.id_type = d2.id_type) inner join education as d3 on (d1.id_educat = d3.id_educat) where id_accom ='".$_GET['id_accom']."'";
                  $sqlquery = mysqli_query($conn, $sql);
                  $sqlnumrow = mysqli_num_rows($sqlquery);
                  $row = mysqli_fetch_array($sqlquery);
                  $id_educat=  $row['id_educat'];
              ?>
              <div class="col-md-6">
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
              <?php
                  include "connect.php";
                  $sql = "SELECT*FROM accom as d1 inner join type_accom as d2 on (d1.id_type = d2.id_type) inner join education as d3 on (d1.id_educat = d3.id_educat) where id_accom ='".$_GET['id_accom']."'";
                  $sqlquery = mysqli_query($conn, $sql);
                  $sqlnumrow = mysqli_num_rows($sqlquery);
                  $row = mysqli_fetch_array($sqlquery);
                  $id_type=  $row['id_type'];
              ?>
              <div class="col-md-6">
                <label for="inputType" class="form-label">ประเภทที่พัก</label>
                <select name="id_type" id="inputType" class="form-select">
                  <option selected disabled>เลือกประเภทที่พัก</option>
                  <?php
                  include "connect.php";
                  $sql = "SELECT*FROM type_accom ";
                  $sqlquery = mysqli_query($conn, $sql);
                  ?>
                  <?php
                  $i = 1;
                  while ($row = mysqli_fetch_array($sqlquery))
                  {
                    $type = $row['id_type'];
                    if ($type == $id_type) {
                  ?>
                    <option value="<?php echo $row['id_type']; ?>" selected><?php echo $row['name_type']; ?></option>
                  <?php } else { ?>
                    <option value="<?php echo $row['id_type']; ?>"><?php echo $row['name_type']; ?></option>
                  <?php
                  $i++;
                  }
                  }
                  ?>
                </select>
              </div>
              <?php
                  include "connect.php";
                  $sql = "SELECT*FROM accom where id_accom ='".$_GET['id_accom']."'";
                  $sqlquery = mysqli_query($conn, $sql);
                  $sqlnumrow = mysqli_num_rows($sqlquery);
                  $row = mysqli_fetch_array($sqlquery);
              ?>
              <div class="col-md-12">
                <label for="inputName" class="form-label">ชื่อที่พัก</label>
                <input type="hidden" name="id_accom" value="<?php echo $row['id_accom']; ?>">
                <input name="name_accom" value="<?php echo $row['name_accom']; ?>" type="text" class="form-control" id="inputName" placeholder="เช่น หอใจรัก">
              </div>
              <div class="input-group">
                <label for="inputPrice" class="input-group-text">ราคาเริ่มต้น</label>
                <input name="starting_price" value="<?php echo $row['starting_price']; ?>" type="text" class="form-control" id="Address" placeholder="2000">
                <label class="input-group-text" for="inputGroupSelect02">บาท/ต่อเดือน</label>
                <label class="input-group-text" for="inputGroupSelect02" style="background-color:#FFFFFF">ถึง</label>
                <label for="inputPrice1" class="input-group-text">ราคาสูงสุด</label>
                <input name="highest_price" value="<?php echo $row['highest_price']; ?>" type="text" class="form-control" id="Address" placeholder="5000">
                <label class="input-group-text" for="inputGroupSelect02">บาท/ต่อเดือน</label>
              </div>
              <?php
                  include "connect.php";
                  $sql = "SELECT*FROM accom where id_accom ='".$_GET['id_accom']."'";
                  $sqlquery = mysqli_query($conn, $sql);
                  $sqlnumrow = mysqli_num_rows($sqlquery);
                  $row = mysqli_fetch_array($sqlquery);
                  $water_bill = $row['water_bill'];
              ?>
              <div class="input-group">
                <label for="inputPrice1" class="input-group-text">ค่าน้ำ</label>
                <select name="water_bill" class="form-select" id="inputGroupSelect02">
                  <?php
                      include "connect.php";
                      $sql = "SELECT*FROM accom where id_accom ='".$_GET['id_accom']."'";
                      $sqlquery = mysqli_query($conn, $sql);
                  ?>
                  <?php
                  $i = 1;
                  while ($row = mysqli_fetch_array($sqlquery))
                  {
                    $water = $row['water_bill'];
                    if ($water == $water_bill) {
                  ?>
                    <option value="<?php echo $row['water_bill']; ?>" selected><?php echo $row['water_bill']; ?></option>
                    <?php
                    $i = 1;
                    while ($i <= 30) {
                      ?>
                      <option value="<?=$i;?>"><?=$i;?></option>
                    <?php
                    $i++;
                  }
                  ?>
                  <?php } else { ?>
                    <?php
                    $i = 1;
                    while ($i <= 30) {
                      ?>
                      <option value="<?=$i;?>"><?=$i;?></option>
                      <?php
                      $i++;
                    }
                    ?>
                    <?php
                    $i++;
                    }
                    }
                    ?>
                </select>
                <label class="input-group-text" for="inputGroupSelect02">บาท/ยูนิต</label>
                &nbsp&nbsp&nbsp&nbsp
                <?php
                    include "connect.php";
                    $sql = "SELECT*FROM accom where id_accom ='".$_GET['id_accom']."'";
                    $sqlquery = mysqli_query($conn, $sql);
                    $sqlnumrow = mysqli_num_rows($sqlquery);
                    $row = mysqli_fetch_array($sqlquery);
                    $elect_bill = $row['elect_bill'];
                ?>
                <label for="inputPrice1" class="input-group-text">ค่าไฟ</label>
                <select name="elect_bill" class="form-select" id="inputGroupSelect02">
                  <?php
                      include "connect.php";
                      $sql = "SELECT*FROM accom where id_accom ='".$_GET['id_accom']."'";
                      $sqlquery = mysqli_query($conn, $sql);
                  ?>
                  <?php
                  $i = 1;
                  while ($row = mysqli_fetch_array($sqlquery))
                  {
                    $elect = $row['elect_bill'];
                    if ($elect == $elect_bill) {
                  ?>
                    <option value="<?php echo $row['elect_bill']; ?>" selected><?php echo $row['elect_bill']; ?></option>
                    <?php
                    $i = 1;
                    while ($i <= 30) {
                      ?>
                      <option value="<?=$i;?>"><?=$i;?></option>
                    <?php
                    $i++;
                  }
                  ?>
                  <?php } else { ?>
                    <?php
                    $i = 1;
                    while ($i <= 30) {
                      ?>
                      <option value="<?=$i;?>"><?=$i;?></option>
                      <?php
                      $i++;
                    }
                    ?>
                    <?php
                    $i++;
                    }
                    }
                    ?>
                </select>
                <label class="input-group-text" for="inputGroupSelect02">บาท/ยูนิต</label>
              </div>
              <?php
                  include "connect.php";
                  $sql = "SELECT*FROM accom where id_accom ='".$_GET['id_accom']."'";
                  $sqlquery = mysqli_query($conn, $sql);
                  $sqlnumrow = mysqli_num_rows($sqlquery);
                  $row = mysqli_fetch_array($sqlquery);
              ?>
              <div class="col-6">
                <label for="inputAddress" class="form-label">ที่ตั้ง</label>
                <input name="address" value="<?php echo $row['address']; ?>" type="text" class="form-control" id="Address" placeholder="เช่น ตำบลย่านยาว อำเภอสามชุก จังหวัดสุพรรณบุรี">
              </div>
              <div class="col-6">
                <label for="inputTel" class="form-label">เบอร์โทร</label>
                <input name="tel" value="<?php echo $row['tel']; ?>" type="text" class="form-control" id="inputTel" placeholder="เช่น 0899999999">
              </div>
              <div class="col-12">
                <label for="inputDetail" class="form-label">รายละเอียดที่พัก</label>
                <textarea name="detail" value="<?php echo $row['detail']; ?>" type="text" class="form-control" id="inputDetail" placeholder="เช่น ใกล้เคียงราชมงคล ราคาถูก"><?php echo $row['detail']; ?></textarea>
              </div>
              <div class="col-md-6">
                <label for="inputLatitude" class="form-label">ละติจูด</label>
                <input name="latitude" value="<?php echo $row['latitude']; ?>" type="text" class="form-control" id="inputLatitude" placeholder="เช่น 13.736717">
              </div>
              <div class="col-md-6">
                <label for="inputLongitude" class="form-label">ลองจิจูด</label>
                <input name="longitude" value="<?php echo $row['longitude']; ?>" type="text" class="form-control" id="inputLongitude" placeholder="เช่น 100.523186">
              </div>
              <div class="text-center">
                <button name="save" type="submit" class="btn btn-success">แก้ไขข้อมูล</button>
              </div>
            </form><!-- End Multi Columns Form -->
            <?php
            if (!isset($_POST['save'])) {}else {
            $id_accom = $_POST['id_accom'];
            $name_accom = $_POST['name_accom'];
            $id_type = $_POST['id_type'];
            $id_educat = $_POST['id_educat'];
            $starting_price = $_POST['starting_price'];
            $highest_price = $_POST['highest_price'];
            $water_bill = $_POST['water_bill'];
            $elect_bill = $_POST['elect_bill'];
            $address = $_POST['address'];
            $detail = $_POST['detail'];
            $tel = $_POST['tel'];
            $latitude = $_POST['latitude'];
            $longitude = $_POST['longitude'];
            include "connect.php";
            $check = "SELECT name_accom FROM accom where name_accom = '$name_accom' and id_type = '$id_type' and id_educat = '$id_educat' and starting_price = '$starting_price' and highest_price = '$highest_price' and water_bill = '$water_bill' and elect_bill = '$elect_bill' and address = '$address' and detail = '$detail' and tel = '$tel' and latitude = '$latitude' and longitude = '$longitude'";
            $result = mysqli_query($conn, $check) or die (mysqli_error());
            $num = mysqli_num_rows($result);
            if ($num > 0) {
              echo "ข้อมูลซ้ำ กรุณากรอกใหม่";
            }else {
              $sql = "UPDATE accom SET id_accom = '$id_accom', name_accom = '$name_accom', id_type = '$id_type', id_educat = '$id_educat', starting_price = '$starting_price', highest_price = '$highest_price', water_bill = '$water_bill', elect_bill = '$elect_bill', address = '$address', detail = '$detail', tel = '$tel', latitude = '$latitude', longitude = '$longitude' where id_accom = '$id_accom'";
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
