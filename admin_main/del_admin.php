<meta charset="utf8">
<?php
include "connect.php";
$ID = $_GET['id_admin'];
if ($ID != "") {
$sql = "DELETE FROM admin where id_admin = '$ID'";
$result = mysqli_query($conn, $sql);
  if ($result) {
    echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว');window.location='manage_admin.php';</script>";
  }
}
?>
