<?php

include_once ("header_source.php");

$col =array(

    0   =>  'id',
    1   =>  'tanggal_lhu',
    2   =>  'no_sertifikat',
    3   =>  'no_agenda',
    4   =>  'no_lhu',
    5   =>  'nama_sampel',
    6   =>  'tanggal_sertifikat',
    7   =>  'waktu_apdate_sertifikat'

);  

$othersql = $objectData->infoLHU();

$fetch = $othersql->fetch_object();

if ($fetch != null) {
    
    $result_no_agenda = $fetch->no_agenda;

    $result_kepala_plh2 = $fetch->kepala_plh2;

    $result_id = $fetch->id;

}else{


    $result_no_agenda = '1';

    $result_kepala_plh2 = '1';

    $result_id = 0;
}

$sql = "SELECT * FROM input_permohonan_kh WHERE kesiapan = 'Ya' AND ";

include_once ("sortir_hasil.php");

if(isset($_POST["search"]["value"])){

    $sql .=" (id LIKE '%".@$_POST['search']['value']."%' ";

    $sql .=" OR tanggal_lhu LIKE '%".@$_POST['search']['value']."%' ";

    $sql .=" OR no_sertifikat LIKE '%".@$_POST['search']['value']."%' ";

    $sql .=" OR nama_sampel LIKE '%".@$_POST['search']['value']."%' ";

    $sql .=" OR no_agenda LIKE '%".@$_POST['search']['value']."%' ";

    $sql .=" OR tanggal_sertifikat LIKE '%".@$_POST['search']['value']."%' ";

    $sql .=" OR no_lhu LIKE '%".@$_POST['search']['value']."%' )";
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

if(@$_POST["length"] != -1)
{
 $sql1 = 'LIMIT ' . @$_POST['start'] . ', ' . @$_POST['length'];
}

$query = $conn->query($sql);

$totalData = $query->num_rows;

$query = $conn->query($sql . $sql1);

$data = array();

$nomor = 1;

while($data2 = $query->fetch_object()){

    $id2 =  $data2->id;

    $isi = $data2->no_sertifikat;

    $selesai = $data2->no_agenda;

    $banyak_sampel = $data2->jumlah_sampel;

    if (strpos($data2->nama_sampel_lab, "Bibit") !== false) {

        $qu2 = $objectHasil->input_ulang_bibit($id2);

        $num = $qu2->num_rows;


    }else{

        $qu2 = $objectHasil->input_ulang($id2);

        $num = $qu2->num_rows;

    }

    $nmr = $nomor++;

    $bilangan = ucwords($objectNomor->bilangan($data2->jumlah_sampel));

    $dat = array("no" => $nmr);

    $subdata = array();

        if (strlen($isi) == 0) {

            $subdata[] = "<span class='kosong'>".$dat['no']."</span>"; 

            $subdata[] = "<span class='kosong'>".$data2->tanggal_lhu."</span>";

            $subdata[] = "<span class='kosong'>".$data2->no_sertifikat."</span>";

            $subdata[] = "<span class='kosong'>".$data2->tanggal_sertifikat."</span>";

            $subdata[] = "<span class='kosong'>".$data2->no_agenda."</span>";

            $subdata[] = "<span class='kosong'>".$data2->no_lhu."</span>";

            $subdata[] = "<span class='kosong'>".$data2->nama_sampel."</span>";               


        

        }elseif ($banyak_sampel > $num) {

            var_dump($num); die;

            $subdata[] = "<span class='nonuji'>".$dat['no']."</span>"; 

            $subdata[] = "<span class='nonuji'>".$data2->tanggal_lhu."</span>";

            $subdata[] = "<span class='nonuji'>".$data2->no_sertifikat."</span>"; 

            $subdata[] = "<span class='nonuji'>".$data2->tanggal_sertifikat."</span>";

            $subdata[] = "<span class='nonuji'>".$data2->no_agenda."</span>"; 

            $subdata[] = "<span class='nonuji'>".$data2->no_lhu."</span>";

            $subdata[] = "<span class='nonuji'>".$data2->nama_sampel."</span>"; 
     
            


        }elseif (strlen($selesai) == 0) {

            $subdata[] = "<span class='proses'>".$dat['no']."</span>"; 

            $subdata[] = "<span class='proses'>".$data2->tanggal_lhu."</span>";

            $subdata[] = "<span class='proses'>".$data2->no_sertifikat."</span>"; 

            $subdata[] = "<span class='proses'>".$data2->tanggal_sertifikat."</span>";

            $subdata[] = "<span class='proses'>".$data2->no_agenda."</span>"; 

            $subdata[] = "<span class='proses'>".$data2->no_lhu."</span>";

            $subdata[] = "<span class='proses'>".$data2->nama_sampel."</span>"; 
     
            


        }else{


            $subdata[] = "<span class='selsesai'>".$dat['no']."</span>"; 

            $subdata[] = "<span class='selsesai'>".$data2->tanggal_lhu."</span>";

            $subdata[] = "<span class='selsesai'>".$data2->no_sertifikat."</span>"; 

            $subdata[] = "<span class='selesai'>".$data2->tanggal_sertifikat."</span>";

            $subdata[] = "<span class='selsesai'>".$data2->no_agenda."</span>";

            $subdata[] = "<span class='selesai'>".$data2->no_lhu."</span>";

            $subdata[] = "<span class='selsesai'>".$data2->nama_sampel."</span>"; 
     
              
        
    
        }


        if(strlen($isi) == 0){

            $subdata[] = '

                <i class="fa fa-exclamation-circle kosong"></i> <i>Pending </i>
                ';


        }else if($banyak_sampel > $num){

            $subdata[] = '

                <button type="button" class="btn btn-kusuccess btn-xs btn-not-allowed" disabled><i class="fa fa-plus-circle fa-fw"></i> Input</button>

                <a href="#"><button type="button" class="btn btn-warning btn-xs btn-not-allowed" disabled><i class="fa fa-print fa-fw"></i> Print</button></a>
                ';


        }else {

            if (strlen($selesai) == 0) {

                $subdata[] = '

                <button type="button" id="tombol_input_lhu_kh" class="btn btn-kusuccess btn-xs" data-toggle="modal" data-target="#modal_input_lhu_kh" data-id="'.$data2->id.'"><i class="fa fa-plus-circle fa-fw"></i> Input</button>


                <a href="#"><button type="button" class="btn btn-warning btn-xs btn-not-allowed"><i class="fa fa-print fa-fw"></i> Print</button></a>
                ';

            }else{


            $subdata[] = '

           
                <button type="button" id="tombol_edit_lhu_kh" class="btn btn-kusuccess btn-xs" data-toggle="modal" data-target="#modal_edit_lhu_kh" data-id="'.$data2->id.'"><i class="fa fa-edit fa-fw"></i> Edit</button>
                
                <a href="./lab_bakteri/report/print/print_surat_hasil_uji.php?id='.$data2->id.'&nama_sampel='.$data2->nama_sampel.'" target="_blank"><button type="button" class="btn btn-warning btn-xs"><i class="fa fa-print fa-fw"></i> Print</button></a>
                ';


            }
             

        }

      
  
    $data[] = $subdata;
}


function get_all_data($conn)
{
 $query = "SELECT id FROM input_permohonan_kh";
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