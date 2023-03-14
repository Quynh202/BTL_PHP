<?php 

// connect database
require_once('../config.php');

  	if(isset($_POST["idNhanVien"]) && isset($_POST["soNgayCong"]))
  	{
  		$idNhanVien = $_POST['idNhanVien'];
  		//$soNgayCong = $_POST['soNgayCong'];

  		// lay chuc vu de kiem tra phu cap
  		// $phuCap = "SELECT ma_chuc_vu, ten_chuc_vu FROM can_bo cb, chuc_vu cv WHERE cb.chuc_vu_id = cv.id AND cb.id = $idNhanVien";
  		// $resultPhuCap = mysqli_query($conn, $phuCap);
  		// $rowPhuCap = mysqli_fetch_array($resultPhuCap);
  		// $maChucVu = $rowPhuCap['ma_chuc_vu'];

		//Lay hang luong va bac luong của can bo 
		$phuCap = "SELECT hang_cb, bac_nhom_ngach FROM can_bo cb WHERE cb.id = $idNhanVien"; 
		$resultPhuCap = mysqli_query($conn, $phuCap); 
		$rowPhuCap = mysqli_fetch_array($resultPhuCap); 
		$hangCanBo = $rowPhuCap['hang_cb']; 
		$bacLuong = $rowPhuCap['bac_nhom_ngach']; 

		//Lay he so luong theo ngach
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
		$phuCapTheoNghe = 1800000*$heSo*0.35; 

  		// if($maChucVu == 'MCV1569203773') // giam doc
  		// 	$tongPhuCap = 1000000; //+ ($soNgayCong * 45000);
  		// else if($maChucVu == 'MCV1569203762') // pho giam doc
  		// 	$tongPhuCap = 800000; //+ ($soNgayCong * 45000);
  		// else if($maChucVu == 'MCV1569985216' || $maChucVu == 'MCV1569985261') // TP, PP
  		// 	$tongPhuCap = 500000; // + ($soNgayCong * 45000);
  		// else if($maChucVu == 'MCV1569204007') // nhan vien
  		// 	// neu ngay cong lon hon 25 ngay 
  		// 	//if($soNgayCong > 25)
  		// 		$tongPhuCap = 300000; //+ ($soNgayCong * 45000);
  		// 	//else
  		// 		//$tongPhuCap = 0;
  		// else
  		// 	$tongPhuCap = 0;



  		echo $tongPhuCap;
  	}
?>