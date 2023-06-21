<?php
$data = json_decode(file_get_contents("php://input"), true);
include "layout/connect.php";
// include "save_location.php";
$sql = "SELECT*FROM tmp_location";
$sqlquery = mysqli_query($conn, $sql);
$num=mysqli_num_rows($sqlquery);
if($num==1){
  $sql = "DELETE FROM tmp_location";$sqlquery = mysqli_query($conn, $sql);
  $sqlquery = mysqli_query($conn, $sql);
  $sql1= "INSERT INTO tmp_location (id, lon, lat) VALUES ('','$data[longitude]', '$data[latitude]')";
  $sqlquery1 = mysqli_query($conn, $sql1);
}else{
  $sql1= "INSERT INTO tmp_location (id, lon, lat) VALUES ('','$data[longitude]', '$data[latitude]')";
  $sqlquery = mysqli_query($conn, $sql1);
}
?>
