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
      <h1>เพิ่มข้อมูลที่พัก</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">หน้าแรก</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">เพิ่มข้อมูลที่พัก</h5>

            <!-- Multi Columns Form -->
            <form class="row g-3" method="post" enctype="multipart/form-data">
              <div class="col-md-6">
                <label for="inputEducat" class="form-label">ศูนย์พื้นที่</label>
                <select name="id_educat" id="inputEducat" class="form-select">
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
                    if ($_SESSION["id_educat"] == $row["id_educat"]) {
                  ?>
                  <option value="<?php echo $row['id_educat']; ?>" selected><?php echo $row['area_educat']; ?></option>
                <?php }else{
                  ?><option value="<?php echo $row['id_educat']; ?>"><?php echo $row['area_educat']; ?></option>
                  <?php
                } ?>
                  <?php
                  $i++;
                  }
                  ?>
                </select>
              </div>
              <div class="col-md-6">
                <label for="inputType" class="form-label">ประเภทที่พัก</label>
                <select name="id_type" id="inputType" class="form-select">
                  <option selected disabled>เลือกประเภทที่พัก</option>
                  <?php
                  include "connect.php";
                  $sql = "SELECT*FROM type_accom order by id_type";
                  $sqlquery = mysqli_query($conn, $sql);
                  $sqlnumrow = mysqli_num_rows($sqlquery);
                  ?>
                  <?php
                  $i = 1;
                  while ($row = mysqli_fetch_array($sqlquery))
                  {
                  ?>
                  <option value="<?php echo $row['id_type']; ?>"><?php echo $row['name_type']; ?></option>
                  <?php
                  $i++;
                  }
                  ?>
                </select>
              </div>
              <div class="col-md-12">
                <label for="inputName" class="form-label">ชื่อที่พัก</label>
                <input name="name_accom" type="text" class="form-control" id="inputName" placeholder="เช่น หอใจรัก">
              </div>
              <div class="input-group">
                <label for="inputPrice" class="input-group-text">ราคาเริ่มต้น</label>
                <input name="starting_price" type="text" class="form-control" id="Address" placeholder="เช่น 2000">
                <label class="input-group-text" for="inputGroupSelect02">บาท/ต่อเดือน</label>
                <label class="input-group-text" for="inputGroupSelect02" style="background-color:#FFFFFF">ถึง</label>
                <label for="inputPrice1" class="input-group-text">ราคาสูงสุด</label>
                <input name="highest_price" type="text" class="form-control" id="Address" placeholder="เช่น 5000">
                <label class="input-group-text" for="inputGroupSelect02">บาท/ต่อเดือน</label>
              </div>
              <div class="input-group">
                <label for="inputPrice1" class="input-group-text">ค่าน้ำ</label>
                <select name="water_bill" class="form-select" id="inputGroupSelect02">
                  <option selected disabled>เลือกค่าน้ำ</option>
                  <?php
                  $i = 1;
                  while ($i <= 30) {
                    ?>
                    <option value="<?=$i;?>"><?=$i;?></option>
                    <?php
                    $i++;
                  }
                  ?>
                </select>
                <label class="input-group-text" for="inputGroupSelect02">บาท/ยูนิต</label>
                &nbsp&nbsp&nbsp&nbsp<label for="inputPrice1" class="input-group-text">ค่าไฟ</label>
                <select name="elect_bill" class="form-select" id="inputGroupSelect02">
                  <option selected disabled>เลือกค่าไฟ</option>
                  <?php
                  $i = 1;
                  while ($i <= 30) {
                    ?>
                    <option value="<?=$i;?>"><?=$i;?></option>
                    <?php
                    $i++;
                  }
                  ?>
                </select>
                <label class="input-group-text" for="inputGroupSelect02">บาท/ยูนิต</label>
              </div>
              <div class="col-6">
                <label for="inputAddress" class="form-label">ที่ตั้ง</label>
                <input name="address" type="text" class="form-control" id="Address" placeholder="เช่น ตำบลย่านยาว อำเภอสามชุก จังหวัดสุพรรณบุรี">
              </div>
              <div class="col-6">
                <label for="inputTel" class="form-label">เบอร์โทร</label>
                <input name="tel" type="text" class="form-control" id="inputTel" placeholder="เช่น 0899999999">
              </div>
              <div class="col-12">
                <label for="inputDetail" class="form-label">รายละเอียดที่พัก</label>
                <textarea name="detail" type="text" class="form-control" id="inputDetail" placeholder="เช่น ใกล้เคียงราชมงคล ราคาถูก"></textarea>
              </div>
              <div class="col-md-6">
                <label for="inputLatitude" class="form-label">ละติจูด</label>
                <input name="latitude" type="text" class="form-control" id="inputLatitude" placeholder="เช่น 13.736717">
              </div>
              <div class="col-md-6">
                <label for="inputLongitude" class="form-label">ลองจิจูด</label>
                <input name="longitude" type="text" class="form-control" id="inputLongitude" placeholder="เช่น 100.523186">
              </div>
              <div class="col-md-6">
                <label for="inputPic" class="form-label">ภาพหลัก (เลือก 1 ภาพ **ควรใช้ภาพขนาด 555x416**)</label>
                <input name="pic" type="file" class="form-control" id="inputPic">
              </div>
              <div class="col-md-6">
                <label for="inputPic" class="form-label">อัลบั้มภาพ (เลือกหลายภาพ เป็นอัลบั้ม)</label>
                <input name="files[]" type="file" multiple  class="form-control" id="inputPic">
              </div>
              <div class="text-center">
                <button name="save" type="submit" class="btn btn-success">เพิ่มข้อมูล</button>
                <button type="reset" class="btn btn-secondary">รีเซ็ต</button>
              </div>
            </form><!-- End Multi Columns Form -->
            <?php
            if (!isset($_POST['save'])) {}else {
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
            $pic = $_FILES['pic'];
            $picname = $_FILES['pic']['name'];

    $targetDir = "../img/";
    $allowTypes = array('jpg','png','jpeg','gif');

    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
    $fileNames = array_filter($_FILES['files']['name']);

            include "connect.php";
            $check = "SELECT name_accom FROM accom where name_accom = '$name_accom'";
            $result = mysqli_query($conn, $check) or die (mysqli_error());
            $num = mysqli_num_rows($result);
            if ($num > 0) {
              echo "ข้อมูลซ้ำ กรุณากรอกใหม่";
            }else {
              if (move_uploaded_file($_FILES["pic"]["tmp_name"],"../img/".$_FILES["pic"]["name"])) {

                $sql_ins = "INSERT INTO accom (id_accom,name_accom,id_type,id_educat,starting_price,highest_price,water_bill,elect_bill,address,detail,tel,latitude,longitude,pic)
                VALUES (null,'$name_accom','$id_type','$id_educat','$starting_price','$highest_price','$water_bill','$elect_bill','$address','$detail','$tel','$latitude','$longitude','$picname')";
                $query=mysqli_query($conn,$sql_ins);
                //$last_id = mysqli_insert_id(); // คืนค่า id ที่ insert ล่าสุด
                $last_id = "SELECT MAX(id_accom) AS maxid FROM accom"; // query อ่านค่า id สูงสุด
                $res = mysqli_query($conn, $last_id ); // ทำคำสั่ง
                $ret = mysqli_fetch_assoc($res); // อ่านค่า
                $last_id = $ret['maxid']; // คืนค่า id ที่ insert สูงสุด
 //ทดลอง---------------------------------------------------------------------------------------------
                if(!empty($fileNames)){
                  foreach($_FILES['files']['name'] as $key=>$val){
                    // File upload path
                    $fileName = basename($_FILES['files']['name'][$key]);
                    $targetFilePath = $targetDir . $fileName;

                    // Check whether file type is valid
                    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                    if(in_array($fileType, $allowTypes)){
                      // Upload file to server
                      if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){
                        // Image db insert sql
                        $insertValuesSQL .= "('".$last_id."', '".$fileName."'),";
                      }else{
                        $errorUpload .= $_FILES['files']['name'][$key].' | ';
                      }
                    }else{
                      $errorUploadType .= $_FILES['files']['name'][$key].' | ';
                    }
                  }
                  // Error message
                  $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):'';
                  $errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):'';
                  $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType;

                  if(!empty($insertValuesSQL)){
                    $insertValuesSQL = trim($insertValuesSQL, ',');
                    // Insert image file name into database
                    $insert = $conn->query("INSERT INTO album (id_accom, pic_a) VALUES $insertValuesSQL ");
                    if($insert){
                      $statusMsg = "Files are uploaded successfully.".$errorMsg;
                    }else{
                      $statusMsg = "Sorry, there was an error uploading your file.";
                    }
                  }else{
                    $statusMsg = "Upload failed! ".$errorMsg;
                  }
                }

 //ทดลอง---------------------------------------------------------------------------------------------
                  $query = (mysqli_query($conn, $sql));
                  if ($query) {
                    echo "<br><div class= 'alert alert-success' role='alert'>เพิ่มข้อมูลสำเร็จ";
                  }else {
                    echo "<br><div class= 'alert alert-danger' role='alert'>เพิ่มข้อมูลไม่สำเร็จ";
                  }
                  $conn->close();
              }
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
