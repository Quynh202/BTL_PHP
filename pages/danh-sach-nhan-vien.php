<?php 

// create session
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['level']))
{
  // include file
  include('../layouts/header.php');
  include('../layouts/topbar.php');
  include('../layouts/sidebar.php');

  if(isset($_POST['edit']))
  {
    $id = $_POST['idStaff'];
    echo "<script>location.href='sua-nhan-vien.php?p=staff&a=list-staff&id=".$id."'</script>";
  }

  if(isset($_POST['view']))
  {
    $id = $_POST['idStaff'];
    echo "<script>location.href='thong-tin-nhan-vien.php?p=staff&a=list-staff&id=".$id."'</script>";
  }

  // show data
  $showData = "SELECT id, ma_cb, hinh_anh, ten_cb, gioi_tinh, ngay_tao, ngay_sinh, noi_sinh, so_cmnd, trang_thai FROM can_bo ORDER BY id DESC";
  $result = mysqli_query($conn, $showData);
  $arrShow = array();
  while ($row = mysqli_fetch_array($result)) {
    $arrShow[] = $row;
  }

?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Cán bộ
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?p=index&a=statistic"><i class="fa fa-dashboard"></i> Tổng quan</a></li>
        <li><a href="danh-sach-nhan-vien.php?p=staff&a=list-staff">Cán bộ</a></li>
        <li class="active">Danh sách cán bộ</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>STA</h3>
              <p>Thêm cán bộ</p>
            </div>
            <div class="icon">
              <i class="fa fa-money"></i>
            </div>
            <a href="them-nhan-vien.php?p=staff&a=add-staff" class="small-box-footer">
              Nhấn vào thêm cán bộ mới <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

      </div>
      <!-- row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Danh sách cán bộ</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php 
                // show error
                if($row_acc['quyen'] != 1) 
                {
                  echo "<div class='alert alert-warning alert-dismissible'>";
                  echo "<h4><i class='icon fa fa-ban'></i> Thông báo!</h4>";
                  echo "Bạn <b> không có quyền </b> thực hiện chức năng này.";
                  echo "</div>";
                }
              ?>

              <?php 
                // show error
                if(isset($error)) 
                {
                  if($showMess == false)
                  {
                    echo "<div class='alert alert-danger alert-dismissible'>";
                    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
                    echo "<h4><i class='icon fa fa-ban'></i> Lỗi!</h4>";
                    foreach ($error as $err) 
                    {
                      echo $err . "<br/>";
                    }
                    echo "</div>";
                  }
                }
              ?>
              <?php 
                // show success
                if(isset($success)) 
                {
                  if($showMess == true)
                  {
                    echo "<div class='alert alert-success alert-dismissible'>";
                    echo "<h4><i class='icon fa fa-check'></i> Thành công!</h4>";
                    foreach ($success as $suc) 
                    {
                      echo $suc . "<br/>";
                    }
                    echo "</div>";
                  }
                }
              ?>
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>STT</th>
                    <th>Mã cán bộ</th>
                    <th>Ảnh</th>
                    <th>Tên cán bộ</th>
                    <th>Giới tính</th>
                    <th>Ngày sinh</th>
                    <th>Nơi sinh</th>
                    <th>Số CMND</th>
                    <th>Tình trạng</th>
                    <th>Xem</th> 
                    <th>Sửa</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                    $count = 1;
                    foreach ($arrShow as $arrS) 
                    {
                  ?>
                      <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $arrS['ma_cb']; ?></td>
                        <td><img src="../uploads/staffs/<?php echo $arrS['hinh_anh']; ?>" width="80"></td>
                        <td><?php echo $arrS['ten_cb']; ?></td>
                        <td>
                        <?php
                          if($arrS['gioi_tinh'] == 1)
                          {
                            echo "Nam";
                          } 
                          else
                          {
                            echo "Nữ";
                          }
                        ?>
                        </td>
                        <td>
                        <?php 
                          $date = date_create($arrS['ngay_sinh']);
                          echo date_format($date, 'd-m-Y');
                        ?>
                        </td>
                        <td><?php echo $arrS['noi_sinh']; ?></td>
                        <td><?php echo $arrS['so_cmnd']; ?></td>
                        <td>
                        <?php 
                          if($arrS['trang_thai'] == 1)
                          {
                            echo '<span class="badge bg-blue"> Đang làm việc </span>';
                          }
                          else
                          {
                            echo '<span class="badge bg-red"> Đã nghỉ việc </span>';
                          }
                        ?>
                        </td>
                        <td>
                          <?php 
                            if($row_acc['quyen'] == 1)
                            {
                              echo "<form method='POST'>";
                              echo "<input type='hidden' value='".$arrS['id']."' name='idStaff'/>";
                              echo "<button type='submit' class='btn btn-primary btn-flat'  name='view'><i class='fa fa-eye'></i></button>";
                              echo "</form>";
                            }
                            else
                            {
                              echo "<button type='button' class='btn btn-primary btn-flat' disabled><i class='fa fa-eye'></i></button>";
                            }
                          ?>
                        </td>
                        <td>
                          <?php 
                            if($row_acc['quyen'] == 1)
                            {
                              echo "<form method='POST'>";
                              echo "<input type='hidden' value='".$arrS['id']."' name='idStaff'/>";
                              echo "<button type='submit' class='btn bg-orange btn-flat'  name='edit'><i class='fa fa-edit'></i></button>";
                              echo "</form>";
                            }
                            else
                            {
                              echo "<button type='button' class='btn bg-orange btn-flat' disabled><i class='fa fa-edit'></i></button>";
                            }
                          ?>
                          
                        </td>
                      </tr>
                  <?php
                      $count++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

<?php
  // include
  include('../layouts/footer.php');
}
else
{
  // go to pages login
  header('Location: dang-nhap.php');
}

?>  