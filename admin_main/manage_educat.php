<!DOCTYPE html>
<?php
session_start();
if ($_SESSION['u_name']=="") {
  echo "<script>alert('กรุณาเข้าสู่ระบบ!');</script>";
  header("location:index.php");
  exit();
}
if ($_SESSION['status']=="assistant") {
  echo "<script>alert('หน้านี้สำหรับ แอดมิน หลัก เท่านั้น!');</script>";
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
      <h1>จัดการข้อมูลศูนย์พื้นที่</h1>
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
                    <th>รหัส</th>
                    <th>ศูนย์พื้นที่</th>
                    <th>แก้ไข</th>
                    <th>ลบ</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    include "connect.php";
                    $sql = "SELECT*FROM education order by id_educat";
                    $sqlquery = mysqli_query($conn, $sql);
                    $sqlnumrow = mysqli_num_rows($sqlquery);
                    ?>
                    <tr>
                      <?php
                      $i = 1;
                      while ($row = mysqli_fetch_array($sqlquery))
                      {
                      ?>
                      <td><?php echo $row['id_educat']?></td>
                      <td><?php echo $row['area_educat']?></td>
                      <td><a href="edit_educat.php?id_educat=<?php echo $row["id_educat"];?>"><button type"button" class="btn btn-success"><i class="fas fa-pencil-alt"></i></button></a></td>
                      <td><a href="del_educat.php?id_educat=<?php echo $row["id_educat"];?>" onclick="return confirm('คุณต้องการลบข้อมูล <?php echo $row['area_educat']?> ใช่หรือไม่');"><button type"button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></a></td>
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
