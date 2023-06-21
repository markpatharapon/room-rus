<meta charset="utf8">
<?php
include "connect.php";
$ID = $_GET['id_educat'];
$sql = "SELECT*FROM accom where id_educat = '$ID'";
$result = mysqli_query($conn, $sql);
$row = mysqli_num_rows($result);
if ($row > 0) {
  echo "<script>alert('ไม่สามารถลบข้อมูลได้ เนื่องจากมีการถูกเรียกใช้');window.location='manage_educat.php';</script>";
  exit();
}else {
if ($ID != "") {
$sql = "DELETE FROM education where id_educat = '$ID'";
$result = mysqli_query($conn, $sql);
  if ($result) {
    echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว');window.location='manage_educat.php';</script>";
  }
}
}
?>
