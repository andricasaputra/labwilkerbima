<?php

require_once('header_proses.php');


	$id					=$_POST['id'];

	$kondisi_sampel		=htmlspecialchars($conn->real_escape_string(trim($_POST['kondisi_sampel'])));

	$mt					=htmlspecialchars($conn->real_escape_string(trim($_POST['mt'])));

	$nip_mt				=htmlspecialchars($conn->real_escape_string(trim($_POST['nip_mt'])));

	$penyelia			=htmlspecialchars($conn->real_escape_string(trim($_POST['penyelia'])));

	$penyelia2			=htmlspecialchars($conn->real_escape_string(trim($_POST['penyelia2'])));

	$analis				=htmlspecialchars($conn->real_escape_string(trim($_POST['analis'])));

	$analis2			=htmlspecialchars($conn->real_escape_string(trim($_POST['analis2'])));

	$bahan				=htmlspecialchars($conn->real_escape_string(trim($_POST['bahan'])));

	$bahan2				=htmlspecialchars($conn->real_escape_string(trim($_POST['bahan2'])));

	$alat				=htmlspecialchars($conn->real_escape_string(trim($_POST['alat'])));

	$alat2				=htmlspecialchars($conn->real_escape_string(trim($_POST['alat2'])));

	$kesiapan			=htmlspecialchars($conn->real_escape_string(trim($_POST['kesiapan'])));

	$jumlah_sampel 		= $_POST['jumlah_sampel'];

	if ($kesiapan == 'Tidak') :

		$query = $conn->query("SELECT nama_sampel FROM input_permohonan_kh_lab_parasit WHERE id = $id");

		$result = $query->fetch_object();

		$nama_sampel = $result->nama_sampel;

		/*Jika Tidak Pada Nama Sampel Bibit, Baru kerjakan ini*/

		if (strrpos($nama_sampel, "Bibit") === false) {

			/*check apakah id yg lebih tinggi, jika ada maka update semua id yg lebih tinggi juga*/

			if ($maxId > $id ) {

			/*Ambil jumlah sampel awal di database berdasarkan post id*/

			$query = $conn->query("SELECT jumlah_sampel FROM input_permohonan_kh_lab_parasit WHERE nama_sampel NOT LIKE '%Bibit%' AND id = $id");

			$result = $query->fetch_object();

			@$awalJumlahSampel = $result->jumlah_sampel;

			/*ambil posisi post id pada array keberapa*/

			$inarr = intval(array_search($id, $arrId));

			/*+lihat Header proses+ / ambil post id dari array*/

			$awalarrid = $arrId[$inarr];

			/*loop sesuai jumlah  id sisa*/

			for ($i=$awalarrid + 1; $i <= $maxId ; $i++) : 

				$nextid = $i;

				$PilihJumlahSampel = $objectNomorParasit->PilihJumlahSampel($nextid);

				$resultjumlahsampel = $PilihJumlahSampel->fetch_object();

				$resjumlah_sampel = $resultjumlahsampel->jumlah_sampel;

				$resno_sampel = $resultjumlahsampel->no_sampel;

				if (strpos($resno_sampel, "-") !== false) {

					$ex = explode("-", $resno_sampel);

					$awal = $ex[0] - $jumlah_sampel; 

					$akhir = end($ex);

					$akhir2 = intval($jumlah_sampel);

					$akhir3 = $akhir - $akhir2;

					$newno_sampel = $awal ."-". $akhir3;

				}else{

					$akhir = $resno_sampel;

					$akhir2 =  intval($jumlah_sampel);

					$newno_sampel = $akhir - $akhir2;
				}

				
				$objectDataParasit->edit("UPDATE input_permohonan_kh_lab_parasit SET no_sampel = '$newno_sampel' WHERE nama_sampel NOT LIKE '%Bibit%' AND id ='$nextid'");

		 	endfor;

		 		$objectDataParasit->edit("UPDATE input_permohonan_kh_lab_parasit SET no_sampel = NULL WHERE id ='$id'");


		 		/*Jika Tidak Ada Id Yang lebih tinggi masuk sini*/

			}else{


				$objectDataParasit->edit("UPDATE input_permohonan_kh_lab_parasit SET no_sampel = NULL WHERE id ='$id'");

			}


		/*Jika Nama Sampel Bibit*/
			
		}else{

			$objectDataParasit->edit("UPDATE input_permohonan_kh_lab_parasit SET no_sampel = NULL WHERE id ='$id'");
		}

	endif;

 if($mt !=="") {

	 $objectDataParasit->edit("UPDATE input_permohonan_kh_lab_parasit SET kondisi_sampel='$kondisi_sampel', mt='$mt', nip_mt='$nip_mt', penyelia='$penyelia', penyelia2='$penyelia2', analis='$analis',  analis2='$analis2' , bahan='$bahan', bahan2='$bahan2', alat='$alat', alat2='$alat2', kesiapan='$kesiapan' WHERE id ='$id'");
	 
 }
 
?>								