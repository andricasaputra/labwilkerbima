<?php

require_once ('header.php');

$fileName = "Permintaan-Kesiapan-Pengujian-(".date('d-m-Y').").xls";

header("Content-Disposition: attachment; filename=\"$fileName\"");

header("Content-Type: application/vnd.ms-excel");

?>



<div>

	<center>
		<h3>LAPORAN PERMINTAAN KESIAPAN PENGUJIAN LABORATORIUM KARANTINA HEWAN</h3>
		<h3><b>Semua</b></h3>
	</center>

<table border="1px">

			
<tr>

	<th><b>No.</b></th>

	<th align="center"><b>No./Tlg Surat</b></th>

    <th align="center"><b>Tanggal Diterima</b></th>

    <th align="center"><b>Nama Sampel</b></th>

    <th align="center"><b>Jenis Sampel/HS Code</b></th>

    <th align="center"><b>Jumlah Sampel</b></th>

    <th align="center"><b>Jumlah Kontainer/ Lot</b></th>

    <th align="center"><b>Target Pengujian I</b></th>

    <th align="center"><b>Target Pengujian II</b></th>

    <th align="center"><b>Metode Pengujian</b></th>

    <th align="center"><b>Kode Sampel</b></th>

    <th align="center"><b>Manajer Administrasi</b></th>


</tr>





<?php

$no =1;

$tampil = $objectExport->mainExport();

while ($data = $tampil->fetch_object()){

echo "<tr>";

	echo "<td align=center>".$no++."</td>";

	echo "<td>".$data->no_permohonan."</td>";

	echo "<td>".$data->tanggal_permohonan."</td>";

	echo "<td>".$data->nama_sampel."</td>";

	echo "<td>".$data->bagian_hewan."</td>";

	echo "<td>".$data->jumlah_sampel.'&nbsp;'.$data->satuan."</td>";

	echo "<td>".$data->jumlah_kontainer."</td>";

	echo "<td>".$data->target_pengujian2."</td>";

	echo "<td>".$data->target_pengujian3."</td>";

	echo "<td>".$data->metode_pengujian."</td>";

	echo "<td>".$data->kode_sampel."</td>";

	echo "<td>".$data->ma."</td>";


echo "</tr>";	

}

?>

			

</table>

</div>