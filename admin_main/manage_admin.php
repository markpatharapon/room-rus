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
      <h1>จัดการข้อมูลแอดมิน</h1>
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
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>เบอร์โทร</th>
                    <th>ชื่อผู้ใช้</th>
                    <th>สถานะ</th>
                    <th>ศูนย์พื้นที่</th>
                    <th>แก้ไข</th>
                    <th>ลบ</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    include "connect.php";
                    $sql = "SELECT admin.id_admin, admin.name, admin.surname, admin.tel, admin.u_name, admin.p_word, admin.status, education.area_educat FROM admin join education on admin.id_educat = education.id_educat";
                    $sqlquery = mysqli_query($conn, $sql);
                    $sqlnumrow = mysqli_num_rows($sqlquery);
                    ?>
                    <tr>
                      <?php
                      $i = 1;
                      while ($row = mysqli_fetch_array($sqlquery))
                      {
                      ?>
                      <td><?php echo $row['name']?></td>
                      <td><?php echo $row['surname']?></td>
                      <td><?php echo $row['tel']?></td>
                      <td><?php echo $row['u_name']?></td>
                      <td><?php echo $row['status']?></td>
                      <td><?php echo $row['area_educat']?></td>
                      <td><a href="edit_admin.php?id_admin=<?php echo $row["id_admin"];?>"><button type"button" class="btn btn-success"><i class="fas fa-pencil-alt"></i></button></a></td>
                      <td><a href="del_admin.php?id_admin=<?php echo $row["id_admin"];?>" onclick="return confirm('คุณต้องการลบข้อมูล <?php echo $row['name']?> <?php echo $row['surname']?> ใช่หรือไม่');"><button type"button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></a></td>
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
