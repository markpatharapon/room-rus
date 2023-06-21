<!DOCTYPE html>

<html lang="en">

<?php include 'layout/head.php' ?>

<body>
  <?php include 'layout/navbar.php' ?>

  <?php include 'layout/sidebar.php' ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>ที่พักนักศึกษาราชมงคลสุวรรณภูมิ</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">หน้าแรก</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <form method="post" id="form" enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF'];?>">
      <div class="input-group mb-3">
        <input class="form-control" name="search" type="text" placeholder="กรอกคำค้นหา" aria-label="Recipient's username" aria-describedby="button-addon2">
        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">ค้นหา</button>
        <!--<a><button value="ค้นหา" class="btn btn-outline-secondary" type="submit" id="button-addon2">ค้นหา</button></a>-->
      </div>
      </form>
      <div class="row">
      <?php
      isset( $_POST['search'] ) ? $search = $_POST['search'] : $search = "";
      if( !empty( $search ) ) {
        include "layout/connect.php";
        $sql = " SELECT * FROM accom join type_accom on accom.id_type = type_accom.id_type WHERE ( name_accom LIKE '%".$search."%' ) ";
        $sqlquery = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($sqlquery) ) {
            ?><div class="col-lg-3">
              <a href="accom.php?id_accom=<?php echo $row["id_accom"];?>">
                <div class="card">
                  <img src="img/<?php echo $row['pic']?>" class="img-fluid rounded-start" alt="...">
                  <div class="card-body" style="height: 11.5rem;">
                    <h5 class="card-title"><?php echo $row['name_accom']?></h5>
                    <p class="card-text"><small class="text-muted"><?php echo $row['name_type']?>   <?php echo $row['address']?></small></p>
                  </div>
                  <div class="card-footer bg-transparent border-success"><?php echo $row['starting_price']?> - <?php echo $row['highest_price']?> บาท/เดือน</div>
                </div></a>
            </div>
        <?php
          }
          mysqli_close( $conn );
        }else {
          include "layout/connect.php";
          $sql = "SELECT*FROM accom join type_accom on accom.id_type = type_accom.id_type order by id_accom";
          $sqlquery = mysqli_query($conn, $sql);
          while($row = mysqli_fetch_assoc($sqlquery) ) {
              ?><div class="col-lg-3">
                <a href="accom.php?id_accom=<?php echo $row["id_accom"];?>">
                  <div class="card">
                    <img src="img/<?php echo $row['pic']?>" class="img-fluid rounded-start" alt="...">
                    <div class="card-body" style="height: 11.5rem;">
                      <h5 class="card-title"><?php echo $row['name_accom']?></h5>
                      <p class="card-text"><small class="text-muted"><?php echo $row['name_type']?>   <?php echo $row['address']?></small></p>
                    </div>
                    <div class="card-footer bg-transparent border-success"><?php echo $row['starting_price']?> - <?php echo $row['highest_price']?> บาท/เดือน</div>
                  </div></a>
              </div>
              <?php
            }
            mysqli_close( $conn );
        }
        ?>
        </div>
    </section>

  </main><!-- End #main -->

  <?php include 'layout/footer.php' ?>

  <?php include 'layout/script.php' ?>

</body>

</html>
