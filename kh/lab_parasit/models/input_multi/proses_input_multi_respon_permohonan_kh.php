<?php

require_once('../header_proses.php');


$ma						=htmlspecialchars($conn->real_escape_string(trim($_POST['ma'])));

$nip_ma					=htmlspecialchars($conn->real_escape_string(trim($_POST['nip_ma'])));

$saran					=htmlspecialchars($conn->real_escape_string(trim($_POST['saran'])));

$tanggal_selesai		=htmlspecialchars($conn->real_escape_string(trim($_POST['tanggal_selesai'])));


$sql = $conn->query("SELECT ma,saran FROM input_permohonan_kh_lab_parasit WHERE ma IS NOT NULL AND saran IS NULL");

$cek = $sql->num_rows;

if ($cek == 0) {
	echo "nodata"; exit;
}

  if($penyelia !=="") {

	 $objectDataParasit->edit2("UPDATE input_permohonan_kh_lab_parasit SET  ma='$ma', nip_ma='$nip_ma', saran='$saran', tanggal_selesai='$tanggal_selesai' WHERE ma IS NOT NULL AND saran IS NULL");

 }



?>		