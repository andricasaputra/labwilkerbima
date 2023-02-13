<?php

require_once ('header.php');

$bln = date('m');

$awal = $_POST['tgl_a'];

$sampai = $_POST['tgl_b'];

$fileName = "Penyerahan_Sampel-Pengujian-(".date('d-m-Y').").xls";

header("Content-Disposition: attachment; filename=\"$fileName\"");

header("Content-Type: application/vnd.ms-excel");

?>



<div>

	<center><h3>LAPORAN PENYERAHAN SAMPEL PENGUJIAN LABORATORIUM KARANTINA HEWAN</h3>

	<h3><b>Tanggal <?php echo $awal; ?> s/d <?php echo $sampai;  ?></b></h3></center>



<table border="1px">

				
<tr>

	<th><b>No.</b></th>

	<th align="center"><b>No./Tlg Surat</b></th>

    <th align="center"><b>Tanggal Penyerahan</b></th>

    <th align="center"><b>Nama Sampel</b></th>

    <th align="center"><b>Jenis Sampel/HS Code</b></th>

    <th align="center"><b>Jumlah Sampel</b></th>

    <th align="center"><b>Jumlah Kontainer/ Lot</b></th>

    <th align="center"><b>Target Pengujian</b></th>

    <th align="center"><b>Metode Pengujian</b></th>

    <th align="center"><b>Kode Sampel</b></th>

    <th align="center"><b>Yang Menyerahkan</b></th> 

    <th align="center"><b>NIP</b></th> 

    <th align="center"><b>Yang Menerima</b></th> 

    <th align="center"><b>NIP</b></th> 

</tr>





<?php

$no =1;

$tampil = $objectExport->mainExport($_POST['tgl_a'], $_POST['tgl_b']);

while ($data = $tampil->fetch_object()){

echo "<tr>";

	echo "<td align=center>".$no++."</td>";

	echo "<td>".$data->no_permohonan."</td>";

	echo "<td>".$data->tanggal_penyerahan."</td>";

	echo "<td>".$data->nama_sampel."</td>";

	echo "<td>".$data->bagian_hewan."</td>";

	echo "<td>".$data->jumlah_sampel.'&nbsp;'.$data->satuan."</td>";

	echo "<td>".$data->jumlah_kontainer."</td>";

	echo "<td>".$data->target_pengujian2."</td>";

	echo "<td>".$data->metode_pengujian."</td>";

	echo "<td>".$data->kode_sampel."</td>";

	echo "<td>".$data->yang_menyerahkan."</td>";

	echo "<td>".$data->nip_ygmenyerahkan."</td>";

	echo "<td>".$data->yang_menerima."</td>";

	echo "<td>".$data->nip_ygmenerima."</td>";

echo "</tr>";	

}

?>

			

</table>

</div>