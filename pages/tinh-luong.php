<?php 

// create session
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['level']))
{
  // include file
  include('../layouts/header.php');
  include('../layouts/topbar.php');
  include('../layouts/sidebar.php');


  // tao bien mac dinh
  $salaryCode = "ML" . time();

  // show data
  $nv = "SELECT id, ma_cb, ten_cb FROM can_bo WHERE trang_thai <> 0";
  $resultNV = mysqli_query($conn, $nv);
  $arrNV = array();
  while($rowNV = mysqli_fetch_array($resultNV)){
    $arrNV[] = $rowNV;
  }

  // thang tinh luong
  $thang = date_create(date("Y-m-d"));
  $thangFormat = date_format($thang, "m/Y");

  // tinh luong nhan vien
  if(isset($_POST['tinhLuong']))
  {
    // tao cac gia tri mac dinh
    $showMess = false;
    $error = array();
    $success = array();

    // lay gia tri tren form
    $maNhanVien = $_POST['maNhanVien'];
    //$soNgayCong = $_POST['soNgayCong'];
    //$phuCap = $_POST['phuCap'];
    $phuCap = 0; 
    $tamUng = $_POST['tamUng'];
    $moTa = $_POST['moTa'];
    $ngayTinhLuong = $_POST['ngayTinhLuong'];
    $user_id = $row_acc['id'];
    $ngayTao = date("Y-m-d H:i:s");

    if($maNhanVien == 'chon')
      $error['maNhanVien'] = 'error';
    if($phuCap == "")
      $error['phuCap'] = 'error';
    if(!empty($phuCap) && !is_numeric($phuCap))
      $error['phuCapSo'] = 'error';
    
    //lay bac luong 
    $hangCanBo = "SELECT hang_cb FROM can_bo cb WHERE cb.id = $maNhanVien"; 
    $bacLuong = "SELECT bac_nhom_ngach FROM can_bo cb WHERE cb.id = $maNhanVien";
    $resultBacLuong = mysqli_query($conn, $bacLuong); 
    $rowBacLuong = mysqli_fetch_array($resultBacLuong); 
    $getBacLuong = $rowBacLuong['bac_nhom_ngach']; 
    // lay ma chuc vu
    $resultHangCanBo = mysqli_query($conn, $hangCanBo); 
    $rowHangCanBo = mysqli_fetch_array($resultHangCanBo); 
    $getHangCanBo = $rowHangCanBo['hang_cb']; 

    // tao bien thuc lanh
    $thucLanh = 0;


    //tinh luong co ban 
    if($getHangCanBo == 1){ //giáo viên hạng I 
      if($getBacLuong == 1){
        $luongThang = 6556000; 
      } else if($getBacLuong == 2){
        $luongThang = 7063000;
      } else if($getBacLuong == 3){
        $luongThang = 7569000; 
      } else if($getBacLuong == 4){
        $luongThang = 8076000; 
      } else if($getBacLuong == 5){
        $luongThang = 8582000; 
      } else if($getBacLuong == 6){
        $luongThang = 9089000; 
      } else if($getBacLuong == 7){
        $luongThang = 9596000; 
      } else {
        $luongThang = 10102000; 
      }
    } else if($getHangCanBo  == 2){
      if($getBacLuong == 1){
        $luongThang = 5960000; 
      } else if($getBacLuong == 2){
        $luongThang = 6467000; 
      } else if($getBacLuong == 3){
        $luongThang = 6973000; 
      } else if($getBacLuong == 4){
        $luongThang = 7480000; 
      } else if($getBacLuong == 5){
        $luongThang = 7986000; 
      } else if($getBacLuong == 6){
        $luongThang = 8493000; 
      } else if($getBacLuong == 7){
        $luongThang = 9000000; 
      } else {
        $luongThang = 9506000; 
      }
    } else if($getHangCanBo == 3){
      if($getBacLuong == 1){
        $luongThang = 3487000; 
      } else if($getBacLuong == 2){
        $luongThang = 3978000; 
      } else if($getBacLuong == 3){
        $luongThang = 4470000; 
      } else if($getBacLuong == 4){
        $luongThang = 4962000; 
      } else if($getBacLuong == 5){
        $luongThang = 5453000; 
      } else if($getBacLuong == 6){
        $luongThang = 5945000; 
      } else if($getBacLuong == 7){
        $luongThang = 6437000; 
      } else if($getBacLuong == 8){
        $luongThang = 6929000; 
      } else {
        $luongThang = 7420000;
      }
    }

    // tinh cac khoan phai nop lai
    // bao hiem xa hoi: 8%
    $baoHiemXaHoi = $luongThang * (8/100);
    // bao hiem y te : 1,5%
    $baoHiemYTe = $luongThang * (1.5/100);
    // bao hiem that nghiep
    $baoHiemThatNghiep = $luongThang * (1/100);
    // tinh tong cac khoan tru
    $tongKhoanTru = $baoHiemXaHoi + $baoHiemYTe + $baoHiemThatNghiep;

    //tinh phu cap 
    function tinhPhuCap($hangCanBo, $bacLuong){
      $heSo = 0; 
		if($hangCanBo == 1){
			if($bacLuong == 1){
				$heSo = 4.4; 
			} else if($bacLuong == 2){
				$heSo = 4.74; 
			} else if($bacLuong == 3){
				$heSo = 5.08;
			} else if($bacLuong == 4){
				$heSo = 5.42; 
			} else if($bacLuong == 5){
				$heSo = 5.76; 
			} else if($bacLuong == 6){
				$heSo = 6.1; 
			} else if($bacLuong == 7){
				$heSo = 6.44; 
			} else if($bacLuong == 8){
				$heSo = 6.78; 
			}
		} else if($hangCanBo == 2){
			if($bacLuong == 1){
				$heSo = 4.0; 
			} else if($bacLuong == 2){
				$heSo = 4.34; 
			} else if($bacLuong == 3){
				$heSo = 4.68;
			} else if($bacLuong == 4){
				$heSo = 5.02; 
			} else if($bacLuong == 5){
				$heSo = 5.36; 
			} else if($bacLuong == 6){
				$heSo = 5.7; 
			} else if($bacLuong == 7){
				$heSo = 6.04; 
			} else if($bacLuong == 8){
				$heSo = 6.38; 
			}
		} else {
			if($bacLuong == 1){
				$heSo = 2.34; 
			} else if($bacLuong == 2){
				$heSo = 2.67; 
			} else if($bacLuong == 3){
				$heSo = 3.0;
			} else if($bacLuong == 4){
				$heSo = 3.33; 
			} else if($bacLuong == 5){
				$heSo = 3.66; 
			} else if($bacLuong == 6){
				$heSo = 3.99; 
			} else if($bacLuong == 7){
				$heSo = 4.32; 
			} else if($bacLuong == 8){
				$heSo = 4.65; 
			} else {
				$heSo = 4.98; 
			}
		}
		//Tinh phu cap theo nghe 
		return 1800000*$heSo*0.35; 
    }

    $phuCap = tinhPhuCap($getHangCanBo, $getBacLuong);

    // tam ung
    if((2/3*$luongThang) <= $tamUng)
    {
      $error['tamUngQuaLon'] = 'error';
      $tamUngChoPhep = 2/3*$luongThang;
    }

    // tinh thuc lanh
    $thucLanh = $luongThang + $phuCap - $tongKhoanTru - $tamUng;


    if(!$error)
    {
      // them vao db
      //$insert = "INSERT INTO luong(ma_luong, canbo_id, luong_thang, ngay_cong, phu_cap, khoan_nop, tam_ung, thuc_lanh, ngay_cham, ghi_chu, nguoi_tao_id, ngay_tao, nguoi_sua_id, ngay_sua) VALUES('$salaryCode', $maNhanVien, $luongThang, $soNgayCong, $phuCap, $tongKhoanTru, $tamUng, $thucLanh, '$ngayTinhLuong', '$moTa', $user_id, '$ngayTao', $user_id, '$ngayTao')";
      $insert = "INSERT INTO luong(ma_luong, canbo_id, luong_thang, phu_cap, khoan_nop, tam_ung, thuc_lanh, ngay_cham, ghi_chu, nguoi_tao_id, ngay_tao, nguoi_sua_id, ngay_sua) VALUES('$salaryCode', $maNhanVien, $luongThang, $phuCap, $tongKhoanTru, $tamUng, $thucLanh, '$ngayTinhLuong', '$moTa', $user_id, '$ngayTao', $user_id, '$ngayTao')";
      $result = mysqli_query($conn, $insert);

      if($result)
      {
        $showMess = true;
        $success['success'] = 'Tính lương thành công';
        echo '<script>setTimeout("window.location=\'bang-luong.php?p=salary&a=salary\'",1000);</script>';
      }
      else
      {
        echo "<script>alert('Lõii');</script>";
      }
    }


  }

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tính lương
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?p=index&a=statistic"><i class="fa fa-dashboard"></i> Tổng quan</a></li>
        <li><a href="tinh-luong.php?p=salary&a=salary">Tính lương</a></li>
        <li class="active">Tính lương cán bộ</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tính lương cán bộ</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
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
                if(isset($error2)) 
                {
                  if($showMess == false)
                  {
                    echo "<div class='alert alert-danger alert-dismissible'>";
                    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
                    echo "<h4><i class='icon fa fa-ban'></i> Lỗi!</h4>";
                    foreach ($error2 as $err2) 
                    {
                      echo $err2 . "<br/>";
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
              <form action="" method="POST">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Mã lương: </label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="maLuong" value="<?php echo $salaryCode; ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Cán bộ: </label>
                      <select class="form-control" name="maNhanVien" id="idNhanVien">
                        <option value="chon">--- Chọn cán bộ ---</option>
                        <?php 
                          foreach ($arrNV as $nv)
                          {
                            echo "<option value='".$nv['id']."'>" .$nv['ma_cb']."</option>";
                            //. " - " .$nv['ten_cb']
                          } 
                        ?>
                      </select>
                      <small style="color: red;"><?php if(isset($error['maNhanVien'])){ echo 'Vui lòng chọn cán bộ'; } ?></small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tạm ứng: </label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="tamUng" placeholder="Nhập số tiền muốn tạm ứng" value="0">
                      <small style="color: red;"><?php if(isset($error['tamUngQuaLon'])){ echo 'Bạn đã tạm ứng vượt quá 2/3 lương tháng. Chỉ tạm ứng tối đa: ' . number_format(ceil($tamUngChoPhep))."vnđ"; } ?></small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Ngày tính lương: </label>
                      <input type="date" class="form-control" id="exampleInputEmail1" placeholder="Nhập số tiền phụ cấp" name="ngayTinhLuong" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Mô tả: </label>
                      <textarea id="editor1" rows="10" cols="80" name="moTa" class="ckeditor">
                      </textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Người tạo: </label>
                      <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $row_acc['ho']; ?> <?php echo $row_acc['ten']; ?>" name="nguoiTao" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Ngày tạo: </label>
                      <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo date('d-m-Y H:i:s'); ?>" name="ngayTao" readonly>
                    </div>
                    <!-- /.form-group -->
                    <?php 
                      if($_SESSION['level'] == 1)
                        echo "<button type='submit' class='btn btn-primary' name='tinhLuong'><i class='fa fa-money'></i> Tính lương cán bộ</button>";
                    ?>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </form>
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