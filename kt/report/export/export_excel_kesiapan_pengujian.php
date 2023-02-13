<?php

require_once ('header.php');


$fileName = "Kesiapan-Pengujian-(".date('d-m-Y').").xls";

header("Content-Disposition: attachment; filename=\"$fileName\"");

header("Content-Type: application/vnd.ms-excel");

?>



<div>

	<center><h3>LAPORAN KESIAPAN PENGUJIAN LABORATORIUM KARANTINA TUMBUHAN</h3>

	<h3><b>Semua Data</b></h3></center>



<table border="1px">

				

					<tr>

						<th><b>No.</b></th>

			     		<th align="center"><b>Kode Sampel</b></th>

                        <th align="center"><b>Tanggal Penyerahan</b></th>

                        <th align="center"><b>Nama Sampel</b></th>

                        <th align="center"><b>Nama Ilmiah</b></th>

                        <th align="center"><b>Jenis Sampel/HS Code</b></th>

                        <th align="center"><b>Jumlah Sampel</b></th>

                        <th align="center"><b>Jumlah Kontainer/ Lot</b></th>

                        <th align="center"><b>Target Pengujian</b></th>

                        <th align="center"><b>Metode Pengujian</b></th>

                        <th align="center"><b>Kondisi Sampel</b></th> 

                        <th align="center"><b>Manajer Teknis</b></th> 

                        <th align="center"><b>NIP</b></th> 

					</tr>

			

					

					<?php

					$no =1;

					$tampil = $objectData->tampil();

					while ($data = $tampil->fetch_object()){

					echo "<tr>";

						echo "<td align=center>".$no++."</td>";

						echo "<td>".$data->kode_sampel."</td>";

						echo "<td>".$data->tanggal_penyerahan."</td>";

						echo "<td>".$data->nama_sampel."</td>";

						echo "<td>".$data->nama_ilmiah."</td>";

						echo "<td>".$data->bagian_tumbuhan."</td>";

						echo "<td>".$data->jumlah_sampel.'&nbsp;'.$data->satuan."</td>";

						echo "<td>".$data->jumlah_kontainer."</td>";

						echo "<td>".$data->target_optk."</td>";

						echo "<td>".$data->metode_pengujian."</td>";

						echo "<td>".$data->kondisi_sampel."</td>";

						echo "<td>".$data->mt."</td>";

						echo "<td>".$data->nip_mt."</td>";

					echo "</tr>";	

					}

					?>

			

</table>

</div>