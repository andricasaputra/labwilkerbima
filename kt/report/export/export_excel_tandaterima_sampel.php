<?php

require_once ('header.php');


$fileName = "Tanda_Terima_Sampel-(".date('d-m-Y').").xls";

header("Content-Disposition: attachment; filename=\"$fileName\"");

header("Content-Type: application/vnd.ms-excel");

?>



<div>

	<center><h3>LAPORAN TANDA TERIMA SAMPEL</h3>

	<h3><b>Semua Data</b></h3></center>



<table border="1px">

				

					<tr>

						<th><b>No.</b></th>

			     		<th align="center"><b>No./Tlg Surat</b></th>

                        <th align="center"><b>Tanggal Diterima</b></th>

                        <th align="center"><b>Cara Pengiriman Sampel</b></th>

                       	<th align="center"><b>Pengantar</b></th>

                        <th align="center"><b>Nama Pelanggan</b></th>

                        <th align="center"><b>Alamat</b></th>

                        <th align="center"><b>Nama Sampel</b></th>

                        <th align="center"><b>Nama Ilmiah</b></th>

                        <th align="center"><b>Jenis Sampel/HS Code</b></th>

                        <th align="center"><b>Jumlah Sampel</b></th>

                        <th align="center"><b>Jumlah Kontainer/ Lot</b></th>

                        <th align="center"><b>Target Pengujian</b></th>

                        <th align="center"><b>Metode Pengujian</b></th>

                        <th align="center"><b>Lama Pengujian</b></th>

                        <th align="center"><b>Penerima Sampel</b></th>  

					</tr>

			

					

					<?php

					$no =1;

					$tampil = $objectData->tampil();

					while ($data = $tampil->fetch_object()){

					echo "<tr>";

						echo "<td align=center>".$no++."</td>";

						echo "<td>".$data->no_permohonan."</td>";

						echo "<td>".$data->tanggal_permohonan."</td>";

						echo "<td>".$data->cara_pengiriman."</td>";

						echo "<td>".$data->pengantar."</td>";

						echo "<td>".$data->pemohon."</td>";

						echo "<td>".$data->alamat_pemilik."</td>";

						echo "<td>".$data->nama_sampel."</td>";

						echo "<td>".$data->nama_ilmiah."</td>";

						echo "<td>".$data->bagian_tumbuhan."</td>";

						echo "<td>".$data->jumlah_sampel.'&nbsp;'.$data->satuan."</td>";

						echo "<td>".$data->jumlah_kontainer."</td>";

						echo "<td>".$data->target_optk."</td>";

						echo "<td>".$data->metode_pengujian."</td>";

						echo "<td>".$data->lama_pengujian."</td>";

						echo "<td>".$data->jabatan."</td>";

					echo "</tr>";	

					}

					?>

			

</table>

</div>