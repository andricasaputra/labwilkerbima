<?php		


require_once('header_proses.php');
					

$no_permohonan				=htmlspecialchars($conn->real_escape_string(trim($_POST['no_permohonan'])));

$tanggal_permohonan			=htmlspecialchars($conn->real_escape_string(trim($_POST['tanggal_permohonan'])));

$tanggal_acu_permohonan		=htmlspecialchars($conn->real_escape_string(trim($_POST['tanggal_acu_permohonan'])));

$jenis_permohonan			=htmlspecialchars($conn->real_escape_string(trim($_POST['jenis_permohonan'])));

$nama_sampel				=htmlspecialchars($conn->real_escape_string(trim($_POST['nama_sampel'])));

$jumlah_sampel				=htmlspecialchars($conn->real_escape_string(trim($_POST['jumlah_sampel'])));

$satuan						=htmlspecialchars($conn->real_escape_string(trim($_POST['satuan'])));

$no_sampel_awal				=htmlspecialchars($conn->real_escape_string(trim($_POST['no_sampel_awal'])));

$bagian_hewan				=htmlspecialchars($conn->real_escape_string(trim($_POST['bagian_hewan'])));

$produk_hewan				=htmlspecialchars($conn->real_escape_string(trim($_POST['produk_hewan'])));

$metode_pengujian			=htmlspecialchars($conn->real_escape_string(trim($_POST['metode_pengujian'])));

$biaya_pengujian			=htmlspecialchars($conn->real_escape_string(trim($_POST['biaya_pengujian'])));

$waktu_pengambilan_sampel	=htmlspecialchars($conn->real_escape_string(trim($_POST['waktu_pengambilan_sampel'])));

$area_asal					=htmlspecialchars($conn->real_escape_string(trim($_POST['area_asal'])));

$cara_pengambilan_sampel	=htmlspecialchars($conn->real_escape_string(trim($_POST['cara_pengambilan_sampel'])));

$target_pengujian			=htmlspecialchars($conn->real_escape_string(trim($_POST['target_pengujian'])));

$lama_pengujian				=htmlspecialchars($conn->real_escape_string(trim($_POST['lama_pengujian'])));

$nama_pemilik				=htmlspecialchars($conn->real_escape_string(trim($_POST['nama_pemilik'])));

$alamat_pemilik				=htmlspecialchars($conn->real_escape_string(trim($_POST['alamat_pemilik'])));

$dokumen_pendukung			=htmlspecialchars($conn->real_escape_string(trim($_POST['dokumen_pendukung'])));

$pemohon					=htmlspecialchars($conn->real_escape_string(trim($_POST['pemohon'])));

$nip_pemohon				=htmlspecialchars($conn->real_escape_string(trim($_POST['nip_pemohon'])));

if (strpos($nama_sampel, "Bibit") === false) {

	$no_sampel					=htmlspecialchars($conn->real_escape_string(trim($_POST['no_sampel'])));

}else{

	if (strpos($no_sampel_awal, "-") !== false) {

		$x = explode("-", $no_sampel_awal);

		$awal = "0".ltrim($x[0] , "0");

		$akhir = "0".ltrim($x[1] , "0");

		$no_sampel = $awal."-".$akhir;

	}elseif (strpos($no_sampel_awal, ",") !== false) {

		$x = explode(",", $no_sampel_awal);

		sort($x);

		// $awal = "0".ltrim($x[0] , "0");

		// $akhir = "0".ltrim(end($x) , "0");

		// $no_sampel = $awal."-".$akhir;

		// $no_sampel = array_map(function($item){
		// 	$item = '0'.$item;

		// 	return $item;

		// }, $x);

		$no_sampel = implode(',', $x);

		//var_dump($no_sampel); 

		//$no_sampel = json_encode($akhir);

		//var_dump($akhir);

	}
}

$sql = $conn->query("SELECT no_permohonan FROM input_permohonan_kh WHERE no_permohonan ='$no_permohonan'");

$cek = $sql->num_rows;

if ($cek > 0) {

	echo "<script>alert('Nomor Permohonan Sudah Pernah Dipakai')</script>";

	return false;

	exit;

}else{


	if($nama_sampel !==""){

		$input  = $objectData->input($no_permohonan, $tanggal_permohonan, $tanggal_acu_permohonan , $jenis_permohonan , $nama_sampel, $jumlah_sampel, $satuan ,$no_sampel_awal, $bagian_hewan, $produk_hewan, $metode_pengujian, $biaya_pengujian, $waktu_pengambilan_sampel, $area_asal, $cara_pengambilan_sampel, $target_pengujian, $lama_pengujian, $nama_pemilik, $alamat_pemilik, $dokumen_pendukung, $pemohon, $nip_pemohon, $no_sampel);

		echo 'goal';

	}

}

?>