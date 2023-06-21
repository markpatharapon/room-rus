<!DOCTYPE html>

<html lang="en">

<?php include 'layout/head.php' ?>

<body>
  <?php include 'layout/navbar.php' ?>

  <?php include 'layout/sidebar.php' ?>

  <main id="main" class="main">

    <section class="section dashboard">
      <div class="row align-items-top">
        <div class="col-lg-12">
            <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-primary">SEARCH</h5>
                                <!--  <div class="card mb-4">   -->
                                <!--<div class="card-body">-->
                                <form class="needs-validation" novalidate method="post" action="">
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-icon-default-detail">รายละเอียด</label>
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-detail" class="input-group-text">
                                                <i class="bx bx-flag"></i>
                                            </span>
                                            <select class="form-select" id="basic-icon-default-detail" aria-label="Default select example" name="id_educat" required>
                                              <option value="" selected>เลือกศูนย์พื้นที่</option>
                                              <?php
                                              include "layout/connect.php";
                                              $sql = "SELECT*FROM education order by id_educat";
                                              $sqlquery = mysqli_query($conn, $sql);
                                              $sqlnumrow = mysqli_num_rows($sqlquery);
                                              ?>
                                              <?php
                                              $i = 1;
                                              while ($row = mysqli_fetch_array($sqlquery))
                                              {
                                              ?>
                                              <option value="<?php echo $row['id_educat']; ?>"><?php echo $row['area_educat']; ?></option>
                                              <?php
                                              $i++;
                                              }
                                              ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                กรุณาเลือกรายละเอียด
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-icon-default-edu_level">ประเภท</label>
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-edu_level" class="input-group-text">
                                                <i class="bx bx-home"></i>
                                            </span>
                                            <select class="form-select" id="basic-icon-default-edu_level" aria-label="Default select example" name="id_type">
                                              <option value="0"selected>เลือกประเภทที่พัก</option>
                                              <?php
                                              include "layout/connect.php";
                                              $sql = "SELECT*FROM type_accom order by id_type";
                                              $sqlquery = mysqli_query($conn, $sql);
                                              $sqlnumrow = mysqli_num_rows($sqlquery);
                                              ?>
                                              <?php
                                              $i = 1;
                                              while ($row = mysqli_fetch_array($sqlquery))
                                              {
                                              ?>
                                              <option value="<?php echo $row['id_type']; ?>"><?php echo $row['name_type']; ?></option>
                                              <?php
                                              $i++;
                                              }
                                              ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-icon-default-edu_level">อัตราค่าเช่าต่ำสุด</label>
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-edu_level" class="input-group-text">
                                                <i class="bx bx-coin"></i>
                                            </span>
                                            <select class="form-select" id="basic-icon-default-edu_level" aria-label="Default select example" name="starting_price">
                                              <option value="0" selected>ต่ำสุด</option>
                                              <option>500</option>
                                              <option>1000</option>
                                              <option>1500</option>
                                              <option>2000</option>
                                              <option>2500</option>
                                              <option>3000</option>
                                              <option>3500</option>
                                              <option>4000</option>
                                              <option>4500</option>
                                              <option>5000</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-icon-default-edu_level">อัตราค่าเช่าสูงสุด</label>
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-edu_level" class="input-group-text">
                                                <i class="bx bx-coin"></i>
                                            </span>
                                            <select class="form-select" id="basic-icon-default-edu_level" aria-label="Default select example" name="highest_price">
                                              <option value="0" selected>สูงสุด</option>
                                              <option>1500</option>
                                              <option>2000</option>
                                              <option>2500</option>
                                              <option>3000</option>
                                              <option>3500</option>
                                              <option>4000</option>
                                              <option>4500</option>
                                              <option>5000</option>
                                              <option>5500</option>
                                              <option>6000</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="operation"/>
                                            <label class="form-check-label" for="flexSwitchCheckDefault">
                                                ค้นหาคำตรงตัว
                                            </label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="search">ค้นหา</button>
                                    <button type="reset" class="btn btn-secondary">ล้างค่า</button>
                                </form>
                                <script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
                                    (function () {
                                        'use strict';
                                        window.addEventListener('load', function () {
                                            // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                            var forms = document.getElementsByClassName('needs-validation');
                                            // Loop over them and prevent submission
                                            var validation = Array.prototype.filter.call(forms, function (form) {
                                                form.addEventListener('submit', function (event) {
                                                    if (form.checkValidity() === false) {
                                                        event.preventDefault();
                                                        event.stopPropagation();
                                                    }
                                                    form.classList.add('was-validated');
                                                }, false);
                                            });
                                        }, false);
                                    })();
                                </script>
                        </div>
            </div>
        </div>
    </div>
    <div class="row">
      <?php
      include "layout/connect.php";
      if (!isset($_POST['search'])) {
        $sql = "SELECT*FROM accom order by id_accom";
        $sqlquery = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($sqlquery);
      }else{
        $id_educat = $_POST['id_educat'];
        $id_type = $_POST['id_type'];
        $starting_price = $_POST['starting_price'];
        $highest_price = $_POST['highest_price'];
        if($id_type == 0 and $starting_price == 0 and $highest_price == 0){
          $sql = "SELECT * FROM accom WHERE id_educat = '$id_educat' order by id_accom";
        }elseif ($id_type != 0 and $starting_price == 0 and $highest_price == 0) {
          $sql = "SELECT * FROM accom WHERE id_educat = '$id_educat' and id_type = '$id_type' order by id_accom";
        }elseif ($id_type == 0 and $starting_price != 0 and $highest_price != 0) {
          $sql = "SELECT * FROM accom WHERE id_educat = '$id_educat' and (starting_price BETWEEN $starting_price AND $highest_price) and (highest_price BETWEEN $starting_price AND $highest_price)";
        }else{
          $sql = "SELECT * FROM accom WHERE id_educat = '$id_educat' and id_type = '$id_type' and (starting_price BETWEEN $starting_price AND $highest_price) and (highest_price BETWEEN $starting_price AND $highest_price)";
        }
      $sqlquery = mysqli_query($conn, $sql);
      }
      while($row = mysqli_fetch_assoc($sqlquery) ) {
          ?><div class="col-lg-3">
            <a href="accom.php?id_accom=<?php echo $row["id_accom"];?>">
              <div class="card">
                <img src="img/<?php echo $row['pic']?>" class="img-fluid rounded-start" alt="...">
                <div class="card-body" style="height: 11.5rem;">
                  <h5 class="card-title"><?php echo $row['name_accom']?></h5>
                  <p class="card-text"><small class="text-muted"><?php echo $row['address']?></small></p>
                </div>
                <div class="card-footer bg-transparent border-success"><?php echo $row['starting_price']?> - <?php echo $row['highest_price']?> บาท/เดือน</div>
              </div></a>
          </div>
          <?php
        }
        mysqli_close( $conn );
    ?>
    </div>
    </section>

  </main><!-- End #main -->

  <?php include 'layout/footer.php' ?>

  <?php include 'layout/script.php' ?>

</body>

</html>
