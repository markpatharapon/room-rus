<meta charset="utf8">
<?php
session_start();
include "layout/head.php";
include "login/connect.php";
$sql = "SELECT*FROM admin where u_name = '".$_GET['u_name']."' and '".$_GET['p_word']."'";
$sqlquery = mysqli_query($conn, $sql);
$sqlnumrow = mysqli_num_rows($sqlquery);
$row = mysqli_fetch_array($sqlquery);
if (!$row) {
  echo "Username หรือ Password ไม่ถูกต้อง!";
}
else {
  $_SESSION["id_accom"]=$row["id_accom"];
  $_SESSION["u_name"]=$row["u_name"];
  $_SESSION["p_word"]=$row["p_word"];
  $_SESSION["status"]=$row["status"];
  $_SESSION["id_educat"]=$row["id_educat"];
  session_write_close();
  if ($row["status"]=="admin") {
    header("location:admin_main/index_admin.php");
  }else if ($row["status"]=="assistant") {
    header("location:admin_second/index_admin.php");
  }else {
    header("location:index.php");
  }
}
?>
