<meta charset="utf8">
<?php
include "connect.php";
$ID = $_GET['id_type'];
if ($ID != "") {
$sql = "DELETE FROM type_accom where id_type = '$ID'";
$result = mysqli_query($conn, $sql);
  if ($result) {
    echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว');window.location='manage_type.php';</script>";
  }
}
?>
