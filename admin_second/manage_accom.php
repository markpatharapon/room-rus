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
      <h1>จัดการข้อมูลที่พัก</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index_admin.php">หน้าแรก</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table id="example" class="datatable" style="width:100%">
                <thead>
                <tr>
                  <th>ชื่อที่พัก</th>
                  <th>ประเภทที่พัก</th>
                  <th>ศูนย์พื้นที่</th>
                  <th>ที่ตั้ง</th>
                  <th>รูปภาพหลัก</th>
                  <th>แก้ไข</th>
                  <th>ลบ</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  include "connect.php";
                  $sql = "SELECT*FROM accom as d1 inner join type_accom as d2 on (d1.id_type = d2.id_type) inner join education as d3 on (d1.id_educat = d3.id_educat) WHERE (d1.id_educat = '$_SESSION[id_educat]')";
                  $sqlquery = mysqli_query($conn, $sql);
                  $sqlnumrow = mysqli_num_rows($sqlquery);
                  ?>
                  <tr>
                    <?php
                    $i = 1;
                    while ($row = mysqli_fetch_array($sqlquery))
                    {
                    ?>
                    <td><?php echo $row['name_accom']?></td>
                    <td><?php echo $row['name_type']?></td>
                    <td><?php echo $row['area_educat']?></td>
                    <td><?php echo $row['address']?></td>
                    <td><img width="150px" class="img-thumbnail" src="../img/<?php echo $row['pic']?>"/></td>
                    <td><a href="edit_accom.php?id_accom=<?php echo $row["id_accom"];?>"><button type"button" class="btn btn-success"><i class="fas fa-pencil-alt"></i></button></a></td>
                    <td><a href="del_accom.php?id_accom=<?php echo $row["id_accom"];?>" onclick="return confirm('คุณต้องการลบข้อมูล <?php echo $row['name_accom']?> ใช่หรือไม่');"><button type"button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></a></td>
                  </tr>
                  <?php
                  $i++;
                  }
                  ?>
                  </tbody>
                </table>
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
