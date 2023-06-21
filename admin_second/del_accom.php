<meta charset="utf8">
<?php
include "connect.php";
$ID = $_GET['id_accom'];
if ($ID != "") {
$sql = "DELETE FROM accom where id_accom = '$ID'";
$result = mysqli_query($conn, $sql);
  if ($result) {
    echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว');window.location='manage_accom.php';</script>";
  }
}
?>
