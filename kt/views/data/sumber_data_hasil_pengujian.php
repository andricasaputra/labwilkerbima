<?php

include_once ('header_source.php');

$col =array(

    0   =>  'id',
    1   =>  'tanggal_sertifikat',
    2   =>  'no_sertifikat',
    3   =>  'no_sampel',
    4   =>  'kode_sampel',
    5   =>  'nama_sampel',
    6   =>  'waktu_apdate_sertifikat'


);  

$sql = "SELECT * FROM input_permohonan WHERE kesiapan = 'Ya' ";

include_once ("sortir_hasil.php");

if(isset($_POST["search"]["value"])){


    $sql .=" AND (id LIKE '%".@$_POST['search']['value']."%' ";

    $sql .=" OR tanggal_sertifikat LIKE '%".@$_POST['search']['value']."%' ";

    $sql .=" OR no_sertifikat LIKE '%".@$_POST['search']['value']."%' ";

    $sql .=" OR kode_sampel LIKE '%".@$_POST['search']['value']."%' ";

    $sql .=" OR nama_sampel LIKE '%".@$_POST['search']['value']."%' ";

    $sql .=" OR no_sampel LIKE '%".@$_POST['search']['value']."%' )";
}

if(isset($_POST["order"]))
{
 $sql .= 'ORDER BY '.$col[@$_POST['order']['0']['column']].' '.@$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $sql .= 'ORDER BY id DESC ';
}

$sql1 = '';

if(isset($_POST["length"]) && @$_POST["length"] != -1)
{
 $sql1 = 'LIMIT ' . @$_POST['start'] . ', ' . @$_POST['length'];
}

$query = $conn->query($sql);

$totalData = $query->num_rows;

$query = $conn->query($sql . $sql1);



$data = array();

$nomor = 1;

$sql3 = "SELECT no_sampel FROM hasil_kt";

while($data2 = $query->fetch_object()){


    $id2 =  $data2->id;

    $isi = $data2->no_sertifikat;

    $selesai = $data2->no_agenda;

    $rek = $data2->rekomendasi;

    $qu = $objectHasil->tampil_hasil($id2);

        /*Input Lebih Dari 1 Hasil Pengujian*/

        $qu2 = $objectHasil->input_ulang($id2);

        $num = $qu2->num_rows;

        $banyak_sampel = $data2->jumlah_sampel;

        $j = $data2->no_sampel;

        $x = explode("-", $j);

        if($banyak_sampel != 1){

          $k = $x[0] + $num;

          $l = $x[1];

          $r = $k.'-'.$l;

        }else{

          $r = $data2->no_sampel;

        }

    $has = $qu->fetch_assoc();

    $f = $has['hasil_pengujian'] ?? 0;

    $nmr = $nomor++;

    $bilangan = ucwords($objectNomor->bilangan($data2->jumlah_sampel));

    $dat = array("no" => $nmr);

    $subdata = array();

        if (strlen($f) == 0 || is_null($isi)) {

            $subdata[] = "<span class='kosong'>".$dat['no']."</span>"; 

            $subdata[] = "<span class='kosong'>".$data2->tanggal_sertifikat."</span>";

            $subdata[] = "<span class='kosong'>".$data2->no_sertifikat."</span>";

            $subdata[] = "<span class='kosong'>".$data2->kode_sampel."</span>"; 

            $subdata[] = "<span class='kosong'>".$data2->no_sampel."</span>";

            $subdata[] = "<span class='kosong'>".$data2->nama_sampel."</span>";

                          

        }elseif (strlen($f) == 0 || $banyak_sampel > $num) {

            $subdata[] = "<span class='nonuji'>".$dat['no']."</span>"; 

            $subdata[] = "<span class='nonuji'>".$data2->tanggal_sertifikat."</span>";

            $subdata[] = "<span class='nonuji'>".$data2->no_sertifikat."</span>";

            $subdata[] = "<span class='nonuji'>".$data2->kode_sampel."</span>";  

            $subdata[] = "<span class='nonuji'>".$data2->no_sampel."</span>"; 

            $subdata[] = "<span class='nonuji'>".$data2->nama_sampel."</span>";

              

        }elseif (strlen($selesai) == 0) {

            $subdata[] = "<span class='proses'>".$dat['no']."</span>"; 

            $subdata[] = "<span class='proses'>".$data2->tanggal_sertifikat."</span>";

            $subdata[] = "<span class='proses'>".$data2->no_sertifikat."</span>";

            $subdata[] = "<span class='proses'>".$data2->kode_sampel."</span>";  

            $subdata[] = "<span class='proses'>".$data2->no_sampel."</span>"; 

            $subdata[] = "<span class='proses'>".$data2->nama_sampel."</span>";

              

        }else{


            $subdata[] = "<span class='selsesai'>".$dat['no']."</span>"; 

            $subdata[] = "<span class='selsesai'>".$data2->tanggal_sertifikat."</span>";

            $subdata[] = "<span class='selsesai'>".$data2->no_sertifikat."</span>"; 

            $subdata[] = "<span class='selsesai'>".$data2->kode_sampel."</span>";

            $subdata[] = "<span class='selsesai'>".$data2->no_sampel."</span>";

            $subdata[] = "<span class='selesai'>".$data2->nama_sampel."</span>";

         
        }


        if(strlen($rek) == 0){

            $subdata[] = '

                 <i class="fa fa-exclamation-circle kosong"></i> <i>Pending </i>
                ';


        } elseif (strlen($selesai) == 0) {

           if(is_null($isi)){


            $subdata[] = '

                <a><button type="button" id="tombol_input_hasil_pengujian" class="btn btn-kusuccess btn-xs" data-toggle="modal" data-target="#modal_input_hasil_pengujian" data-id="'.$data2->id.'"><i class="fa fa-edit fa-fw"></i> Input</button></a>  

                <a class="btn btn-warning btn-xs" href="#" disabled><i class="fa fa-pencil fa-fw"></i>&nbsp;&nbsp;Edit Hasil Uji</a>        
                
                <a href="#"><button type="button" class="btn btn-danger btn-xs btn-not-allowed" disabled><i class="fa fa-print fa-fw"></i> Print</button></a>
                ';


            }else{

                 $subdata[] = '

           
                <a><button type="button" id="tombol_edit_hasil_pengujian" class="btn btn-kusuccess btn-xs" data-toggle="modal" data-target="#modal_edit_hasil_pengujian" data-id="'.$data2->id.'"><i class="fa fa-edit fa-fw"></i>&nbsp;&nbsp;Edit</button></a>

                <a class="btn btn-warning btn-xs" href="./views/edit_hasil_pengujian.php?id='.$data2->id.'&no_sampel='.$data2->no_sampel.'&nama_sampel='.$data2->nama_sampel.'" target="_blank"><i class="fa fa-pencil fa-fw"></i>&nbsp;&nbsp;Edit Hasil Uji</a>

                
                <a href="./report/print/print_sertifikat.php?id='.$data2->id.'&no_sertifikat='.$data2->no_sertifikat.'" target="_blank"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-print fa-fw"></i> Print</button></a>
                ';
            }
             

        }else{

            if(isset($_SESSION['loginsuperkt']) || isset($_SESSION['loginadminkt']) || date("Y-m-d", strtotime($data2->waktu_apdate_sertifikat)) == $objectTanggal->now()){

                $subdata[] = '

                
                <a><button type="button" id="tombol_edit_hasil_pengujian" class="btn btn-kusuccess btn-xs" data-toggle="modal" data-target="#modal_edit_hasil_pengujian" data-id="'.$data2->id.'"><i class="fa fa-edit fa-fw"></i>&nbsp;&nbsp;Edit</button></a>

                <a class="btn btn-warning btn-xs" href="./views/edit_hasil_pengujian.php?id='.$data2->id.'&no_sampel='.$data2->no_sampel.'&nama_sampel='.$data2->nama_sampel.'" target="_blank"><i class="fa fa-pencil fa-fw"></i>&nbsp;&nbsp;Edit Hasil Uji</a>

                
                <a href="./report/print/print_sertifikat.php?id='.$data2->id.'&no_sertifikat='.$data2->no_sertifikat.'" target="_blank"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-print fa-fw"></i> Print</button></a>
                ';

            }else{

                $subdata[] = '


                <a><button type="button" id="tombol_edit_hasil_pengujian" class="btn btn-kusuccess btn-xs btn-not-allowed"><i class="fa fa-edit fa-fw"></i>&nbsp;&nbsp;Edit</button></a>

                <a class="btn btn-warning btn-xs" href="#" disabled><i class="fa fa-pencil fa-fw"></i>&nbsp;&nbsp;Edit Hasil Uji</a>   


                <a href="./report/print/print_sertifikat.php?id='.$data2->id.'&no_sertifikat='.$data2->no_sertifikat.'" target="_blank"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-print fa-fw"></i> Print</button></a>';
            }

        }

      
  
    $data[] = $subdata;
}


function get_all_data($conn)
{
 $query = "SELECT id FROM input_permohonan";
 $result = $conn->query($query);
 return $result->num_rows;
}



$json_data = array(

    "draw"              =>  intval(@$_POST['draw']),
    "recordsTotal"      =>  get_all_data($conn),
    "recordsFiltered"   =>  $totalData,
    "data"              =>  $data
);

echo json_encode($objectData->utf8ize($json_data));

$connection->destroy();
?>