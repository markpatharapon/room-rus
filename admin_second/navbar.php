<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="index_admin.php" class="logo d-flex align-items-center">
      <img src="../assets/img/logo1.png" alt="">
      <span class="d-none d-lg-block">Room - RUS</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div><!-- End Logo -->

  <nav class="header-nav ms-auto">

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="profile.php" data-bs-toggle="dropdown">
          <span class="d-none d-md-block dropdown-toggle ps-2">สวัสดี คุณ'<?php echo $row["name"]?><?php echo "   "?><?php echo $row["surname"] ?></font></span>
        </a><!-- End Profile Iamge Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6><?php echo $row["name"]?><?php echo "   "?><?php echo $row["surname"] ?></h6>
            <span><?php echo $row["status"] ?></span>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="profile.php">
              <i class="bi bi-person"></i>
              <span>My Profile</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="../logout.php" onclick="return confirm('คุณ : <?php echo $row['name']?>  <?php echo $row['surname']?> ต้องการออกจากระบบหรือไม่');">
              <i class="bi bi-box-arrow-right"></i>
              <span>Sign Out</span>
            </a>
          </li>

        </ul><!-- End Profile Dropdown Items -->
  </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
