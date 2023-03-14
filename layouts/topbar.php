<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php?p=index&a=statistic" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-lg"><b>NHÓM 9</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
  
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../uploads/images/<?php echo $row_acc['hinh_anh']; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $row_acc['ten']; ?> <?php echo $row_acc['ho']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../uploads/images/<?php echo $row_acc['hinh_anh']; ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $row_acc['ten']; ?> <?php echo $row_acc['ho']; ?> - 
                  <?php 
                    if($row_acc['quyen'] == 1)
                    {
                      echo "Quản trị viên";
                    }
                    else
                    {
                      echo "Nhân viên";
                    }
                  ?>
                  <small>
                    <?php 
                      echo "Lượt truy cập: " . $row_acc['truy_cap']; 
                    ?>
                  </small>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="thong-tin-tai-khoan.php?p=account&a=profile" class="btn btn-default btn-flat">Thông tin</a>
                </div>
                <div class="pull-right">
                  <a href="dang-xuat.php" class="btn btn-default btn-flat">Đăng xuất</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>