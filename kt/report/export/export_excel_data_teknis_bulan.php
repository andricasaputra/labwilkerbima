<?php

require_once ('header.php');


$awal = explode("-", $_POST['tgl_a']);

	$thn = $awal[0];

	$bln = $awal[1];

	$tanggal = $awal[2];

$sampai = explode("-", $_POST['tgl_b']);

	$thnb = $sampai[0];

	$blnb = $sampai[1];

	$tanggalb = $sampai[2];


$fileName = "Data_Teknis_Pengujian-(".date('d-m-Y').").xls";

header("Content-Disposition: attachment; filename=\"$fileName\"");

header("Content-Type: application/vnd.ms-excel");

?>



<div>

	<center><h3>DATA TEKNIS PENGUJIAN LABORATORIUM KARANTINA TUMBUHAN</h3>

	<h3><b>Tanggal <?php echo $tanggal.'-'.$bln.'-'.$thn ;?> s/d <?php echo $tanggalb.'-'.$blnb.'-'.$thnb ;?></b></h3></center>



<table border="1px">

				

					<tr>

						<th><b>No.</b></th>

						<th align="center"><b>Nama Sampel</b></th>

						<th align="center"><b>Nama Ilmiah</b></th>

						<th align="center"><b>Kode Sampel</b></th>

						<th align="center"><b>Tanggal Pengujian</b></th>

                        <th align="center"><b>Nomor Sampel</b></th>

                        <th align="center"><b>Bagian Tumbuhan</b></th>

                        <th align="center"><b>Vektor</b></th>

                        <th align="center"><b>Media</b></th>

                        <th align="center"><b>Target Pengujian </b></th>

                        <th align="center"><b>No Surat Tugas</b></th>

                        <th align="center"><b>Penyelia</b></th>

                        <th align="center"><b>Analis</b></th>

                        <th align="center"><b>Metode Pengujian</b></th>

                        <th align="center"><b>Metode Pengujian 2</b></th>

                        <th align="center"><b>Metode Pengujian 3</b></th>

                        <th align="center"><b>Positif/Negatif</b></th>

                        <th align="center"><b>Hasil Pengujian </b></th>


					</tr>

			

					

					<?php

					$no =1;

					if(@$_POST['export_data']){


						$tampil = $objectPrint->print_pertanggal_hasil2(@$_POST['tgl_a'], @$_POST['tgl_b']);

					}

						while ($data = $tampil->fetch_object()):

							$id = $data->id;

							$tampil2 = $objectPrint->print_pertanggal_sertifikat($id);

							while ($data2 = $tampil2->fetch_object()):

					echo "<tr>";

						echo "<td align=center>".$no++."</td>";						

						echo "<td>".$data->nama_sampel."</td>";

						echo "<td>"."<em>".$data->nama_ilmiah."</em>"."</td>";

						echo "<td>".$data->kode_sampel."</td>";

						echo "<td>".$data->tanggal_pengujian."</td>";

						echo "<td>".$data2->no_sampel."</td>";

						echo "<td>".$data2->bagian_tumbuhan."</td>";

						echo "<td>".$data2->vektor."</td>";

						echo "<td>".$data2->media."</td>";	

						echo "<td>"."<em>".$data2->target_optk."&nbsp;".$data2->target_optk2."&nbsp;".$data2->target_optk3."</em>"."</td>";

						echo "<td>".$data->no_surat_tugas."</td>";

						echo "<td>".$data->nama_penyelia."</td>";

						echo "<td>".$data->nama_analis."</td>";

						echo "<td>".$data2->metode_pengujian."</td>";

						echo "<td>".$data2->metode_pengujian2."</td>";

						echo "<td>".$data2->metode_pengujian3."</td>";

						echo "<td>".$data2->positif_negatif."</td>";

						echo "<td>"."<em>".$data2->hasil_pengujian."<em>"."</td>";

					echo "</tr>";	

							endwhile;
					endwhile;

					?>

			

</table>

</div>