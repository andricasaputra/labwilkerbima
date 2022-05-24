<?php

ob_start();

use Lab\config\Database;
use Lab\classes\{tanggal,Init};
use Lab\classes\kh\Source4;
use Lab\classes\kh\labbakteri\{
	Data as DataKh,
	Hasil as HasilKh,
	Nomor as NomorKh,
	Cetak as CetakKh
};
use Lab\classes\kh\labparasit\{
	Data as DataKhlabparasit,
	Hasil as HasilKhlabparasit,
	Nomor as NomorKhlabparasit,
	Cetak as CetakKhlabparasit
};

use Lab\classes\kh\{
	Jabatan,
	Pejabat
};

require_once (dirname(dirname(__DIR__)).'/vendor/autoload.php');

$connection = Database::getInstance();

$conn = $connection->getConnection();

$objectData = new DataKh;

$objectHasil = new HasilKh;

$objectNomor = new NomorKh;

$objectDataParasit = new DataKhlabparasit;

$objectHasilParasit = new HasilKhlabparasit;

$objectNomorParasit = new NomorKhlabparasit;

$objectTanggal = new tanggal;

$objectPrint = new CetakKh;

$objectPrintParasit = new CetakKhlabparasit;

$objectSource4 = new Source4 ($connection);

$objectJabatan = new Jabatan;

$objectJabfung = new Jabatan;

$objectPejabat = new Pejabat;

if (strpos($_SERVER['REQUEST_URI'], "parasit")) {
	require_once (Init::basePath()."/src/classes/kh/labparasit/nomor_sampel_kh_lab_parasit.php");
}else {
	require_once (Init::basePath()."/src/classes/kh/labbakteri/nomor_sampel_kh.php");
}





?>
