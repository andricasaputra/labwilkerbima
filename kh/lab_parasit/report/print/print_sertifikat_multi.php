<?php

require_once ('header.php');

$file = explode('.', basename(__FILE__));

$set = $objectPrint->setNamaDokumen($file[0], 'kh');

$content ='

<style>

    .table1 {

        border :0px;

        width: 100%;

    }

    th{

        border: 0.7px solid black;

        border-collapse: collapse;

        padding: 3px;

    }

    .tabel1 td {

        padding:8px;

        vertical-align: text-bottom;

    }


    .table2  {

        text-align: center;

        border: 0.7px solid black;

        border-collapse: collapse;

    }


    .table2 th {

       padding-top: 10px;

       padding-bottom: 10px;

    }


    .table2 td {

       vertical-align: text-top;

       text-align: center;

       padding:  7px 0px;

       border: 0.7px solid black;

       align: bottom;
    }

    div#garis {

        width: 90%;

        margin:auto;

        margin-left:-3px;

        margin-bottom: 20px
    }

    hr {

        border: none;

        height: 1px;

        color: black; 

        background-color: black;
    }


    .lower th td {

       border: 0px;

       width: 100%;

       text-align: center;

       vertical-align: text-top;

    }


    .html2pdf__page-break2 {

      height: 2000px;

    }
 
</style>

<page backtop="35mm" backleft="12mm" backright="10mm" backbottom="10mm">



     <page_header> 

        <div style="margin-left: 34px">

            <strong><img src='.$logo.' width="698px; height:150px"></strong>

        </div>

    </page_header>

   
    <page_footer>

        <hr width="75%">

        <table>
            <tr>
                <td style="width: 650">
                       <i>'.$objectPrint->kode_dokumen.'</i> 
                </td>
                <td style="style="width: 500px", text-align: right">
                       <strong><img src='.$logokanbaru.' width="100px; height:150px"></strong>

                </td>
            </tr>
        </table>

    </page_footer>
     ';         

if(isset($_POST['print_data'])){

    $tampil = $objectPrint->print_multi_sertifikat($_POST['no_a'], $_POST['no_b']);


}else {

    if(@$_SESSION['loginadminkh']) {

        echo "<script>alert('No Sertifikat Belum Diisi!')

        window.location='../admin.php?page=sertifikat'</script>";

    }else {

        echo "<script>alert('No Sertifikat Belum Diisi!')

        window.location='../pengujian.php?page=sertifikat'</script>";

    }

    exit;

}

if ($tampil->num_rows === 0) {
        echo '<script>alert("Tidak Ada Data Untuk Di Cetak! Periksa Kembali Pemilihan Tanggal");window.close();</script>';
        return false;
}

$num = $tampil->num_rows;

$arrID = array();

while ($data=$tampil->fetch_object()):

$pejabat = $objectPrint->getPejabat($data->nip_kepala_plh);


$id = $data->id;

$ttd = $objectPrint->scan($id);

$arrID[] = $data->id;

$totalID = count($arrID);

$content .= '

    <div align="center">

        <strong><u>'.$objectPrint->title_dokumen.'</u></strong><br>

        Nomor : '.$data->no_sertifikat.'

    </div>

    <p></p>

    <strong>A. Keterangan sampel/ media pembawa :</strong><br>

    <table class="table1" >



        <tr>

            <td width="10">1.</td>

            <td width="200">Nama sampel/media pembawa</td>

            <td width="10">:</td>

            <td width="300">'.$data->nama_sampel.'</td>

        </tr>



        <tr>

            <td width="10">2.</td>

            <td width="200">Kode Sampel/media pembawa</td>

            <td width="10">:</td>

            <td width="200">'.$data->kode_sampel.'</td>

        </tr>



        <tr>

            <td width="10">3.</td>

            <td width="200">Jumlah sampel/media pembawa</td>

            <td width="10">:</td>

            <td width="200">'.$data->jumlah_sampel.'</td>

        </tr>



        <tr>

            <td width="10">4.</td>

            <td width="200">Jenis sampel/media pembawa</td>

            <td width="10"></td>

            <td width="200"></td>

        </tr>



        <tr>

            <td width="24">&nbsp;</td>

            <td width="234">

                &middot; Bagian Hewan

            </td>

            <td width="18">

                :

            </td>

            <td width="316">

                ';


                    if (strpos($data->nama_sampel, "Serum") !== false) {

                        $content .='

                            <img src='.$checkfix.' style="width: 15px">&nbsp;&nbsp;Serum

                        ';

                    }else{

                        $content .='

                            <img src='.$boxfix.' style="width: 15px">&nbsp;&nbsp;Serum

                        ';

                    }



                    if (strpos($data->nama_sampel, "Darah") !== false) {

                        $content .='

                            <span style="margin-left: 25px"><img src='.$checkfix.' style="width: 15px">&nbsp;&nbsp;Darah</span>

                        ';

                    }else{

                        $content .='

                            <span style="margin-left: 25px"><img src='.$boxfix.' style="width: 15px">&nbsp;&nbsp;Darah</span>

                        ';

                    }



                    if (strpos($data->nama_sampel, "Urine") !== false) {

                        $content .='

                            <span style="margin-left: 10px"><img src='.$checkfix.' style="width: 15px">&nbsp;&nbsp;Urine</span>

                        ';

                    }else{

                        $content .='

                            <span style="margin-left: 10px"><img src='.$boxfix.' style="width: 15px">&nbsp;&nbsp;Urine</span>

                        ';

                    }



                    if (strpos($data->nama_sampel, "Feses") !== false) {

                        $content .='

                            <span style="margin-left: 10px"><img src='.$checkfix.'  style="width: 15px">&nbsp;&nbsp;Feses</span>

                        ';

                    }else{

                        $content .='

                            <span style="margin-left: 10px"><img src='.$boxfix.'  style="width: 15px">&nbsp;&nbsp;Feses</span>

                        ';

                    }



                $content .='

                     

                    

                    

                </td>

            </tr>

            <tr>

                <td width="24">&nbsp;</td>

                <td width="234">

                    

                </td>

                <td width="18">

                

                </td>

                <td width="316">

                ';



                    if (strpos($data->nama_sampel, "Kadaver") !== false) {

                        $content .='

                            <img src='.$checkfix.' style="width: 15px">&nbsp;&nbsp;Kadaver

                        ';

                    }else{

                        $content .='

                            <img src='.$boxfix.' style="width: 15px">&nbsp;&nbsp;Kadaver

                        ';

                    }



                    if (strpos($data->nama_sampel, "Swab") !== false) {

                        $content .='

                            <span style="margin-left: 15px"><img src='.$checkfix.' style="width: 15px">&nbsp;&nbsp;Swab</span>

                        ';

                    }else{

                        $content .='

                            <span style="margin-left: 15px"><img src='.$boxfix.' style="width: 15px">&nbsp;&nbsp;Swab</span>

                        ';

                    }



                    if (strpos($data->nama_sampel, "Organ") !== false) {

                        $content .='

                            <span style="margin-left: 12px"><img src='.$checkfix.' style="width: 15px">&nbsp;&nbsp;Organ</span>

                        ';

                    }else{

                        $content .='

                            <span style="margin-left: 12px"><img src='.$boxfix.' style="width: 15px">&nbsp;&nbsp;Organ</span>

                        ';

                    }





                    $content .='

                     

                     

                     



                </td>

            </tr>

            <tr>

                <td width="24">&nbsp;</td>

                <td width="234">

                </td>

                <td width="18">

                </td>

                <td width="316">

                    ';

                    if (strpos($data->nama_sampel, "Eksudat") !== false) {

                        $content .='

                            <img src='.$checkfix.' style="width: 15px">&nbsp;&nbsp;Eksudat ......................

                        ';

                    }else{

                        $content .='

                            <img src='.$boxfix.' style="width: 15px">&nbsp;&nbsp;Eksudat ......................

                        ';

                    }



                    if (strpos($data->nama_sampel, "Kerokan Kulit") !== false) {

                        $content .='

                            <span style="margin-left: 3px"><img src='.$checkfix.' style="width: 15px">&nbsp;&nbsp;Kerokan Kulit</span>

                        ';

                    }else{

                        $content .='

                            <span style="margin-left: 3px"><img src='.$boxfix.' style="width: 15px">&nbsp;&nbsp;Kerokan Kulit</span>

                        ';

                    }





                    $content .='



                     

                     

                </td>

            </tr>

            <tr>

                <td width="24">&nbsp;</td>

                <td width="234">

                </td>

                <td width="18">

                    :

                </td>

                <td width="316">

                ';

                if (strpos($data->nama_sampel, "Kulit") !== false) {

                        $content .='

                            <img src='.$checkfix.' style="width: 15px">&nbsp;&nbsp;Kulit

                        ';

                    }else{

                        $content .='

                            <img src='.$boxfix.' style="width: 15px">&nbsp;&nbsp;Kulit

                        ';

                    }



                if (strpos($data->nama_sampel, "Bagian Lain") !== false) {

                        $content .='

                            <span style="margin-left: 39px"><img src='.$checkfix.' style="width: 15px">&nbsp;&nbsp;Bagian Lain : ...............</span>

                        ';

                    }else{

                        $content .='

                            <span style="margin-left: 39px"><img src='.$boxfix.' style="width: 15px">&nbsp;&nbsp;Bagian Lain : ...............</span>

                        ';

                    }



                $content .='

                </td>
        </tr>


        <tr>

            <td width="10"></td>

            <td width="200">&middot; Jenis Media Transport</td>

            <td width="10">:</td>

            <td width="200">-</td>

        </tr>



        <tr>

            <td width="10" style="vertical-align: text-top">5.</td>

            <td width="200"  style="vertical-align: text-top">Tanggal penerimaan sampel/ <br>media pembawa di laboratorium</td>

            <td width="10"  style="vertical-align: text-top">:</td>

            <td width="200"  style="vertical-align: text-top">'.$data->tanggal_penyerahan_lab.'</td>

        </tr>

         <tr>

            <td width="10" style="vertical-align: text-top">6.</td>

            <td width="200"  style="vertical-align: text-top">Tanggal pemeriksaan sampel/ <br>media pembawa di laboratorium</td>

            <td width="10"  style="vertical-align: text-top">:</td>

            <td width="200"  style="vertical-align: text-top">'.$data->tanggal_pengujian.'</td>

        </tr>

    </table>

    <br>



    <strong>B. Hasil Pengujian :</strong><br>

    <table class="table2" style="text-align: center">

          <tr>

            <th style="width:5%;" >No</th>

            <th style="width:13%;">Nomor Sampel</th>

            <th style="width:18%;">Identitas Sampel</th>

            <th style="width:20%;">Target Pengujian</th>

            <th style="width:20%;">Metode Pengujian</th>

            <th style="width:18%;">Hasil Pengujian*)</th>

          </tr>



          ';

            $no=1;

            $nosmpl = $data->jumlah_sampel;

            if (strpos($data->nama_sampel, "Bibit") !== false) {

                $tampil2 = $objectHasil->print_pertanggal_sertifikat_bibit($id);

            }else{

                $tampil2 = $objectHasil->print_pertanggal_sertifikat($id);
            }

            while ($data2 = $tampil2->fetch_object()):

                  if (!empty($data->target_pengujian3)) :
                           
                        

                  $content .='

                      <tr>

                    
                        <td style="width:5%; vertical-align: middle" rowspan="2">'.$no++.'</td>

                        <td style="width:13%; vertical-align: middle"  rowspan="2">
                        ';

                            if (strpos($data->nama_sampel, "Bibit") !== false) {

                                $content .= '

                                '.$data2->no_sampel_bibit.'

                                ';

                            }else{
                                
                                $content .= '

                                '.$data2->no_sampel.'

                                ';
                            }

                            $content .='
                        </td>    

                        <td style="width:18%; vertical-align: middle"  rowspan="2">'.$data->nama_sampel.'</td>

                        <td style="width:20%;"><em>'.$data->target_pengujian2.'</em></td>

                        <td style="width:18%;"> '.$data->metode_pengujian.' </td> 


                        <td style="width:18%;">

                        <b>'.$data2->positif_negatif.'</b>
                        

                        </td>  

                      </tr>

                      <tr>


                        <td style="width:20%;border-left: none; "><em>'.$data->target_pengujian3.'</em></td>

                        <td style="width:16%; "> '.$data->metode_pengujian.' </td> 

                        <td style="width:23%;">

                        <b> '.$data2->positif_negatif_target3.'</b>
                        

                        </td>  

                      </tr>


                      ';

                    else :

                        $content .='

                      <tr>

                    
                        <td style="width:5%;>'.$no++.'</td>

                        <td style="width:13%;>'.$data2->no_sampel.'</td>    

                        <td style="width:15%;>'.$data->nama_sampel.'</td>

                        <td style="width:20%;"><em>'.$data->target_pengujian2.'</em></td>

                        <td style="width:20%;"> '.$data->metode_pengujian.' </td> 


                        <td style="width:23%;">

                        <b>'.$data2->positif_negatif.'</b>
                        
                        </td>  

                      </tr>


                      ';

                    endif;

            endwhile;

          $content .='



    </table>

    

    <table class="lower" style="text-align: center;">



        <tr>

            <td style="text-align: left"><span style="font-size: 8pt;padding-bottom: 35px">*) Hanya untuk sampel yang diuji</span></td>

            <td style="width: 180px"></td>

            <td style="width: 215px"></td>

        </tr>





        <tr>

            <td style="padding-bottom: 15px">Keterangan : '.$data->rekomendasi.'</td>

            <td style="width: 180px"></td>

            <td style="width: 215px"></td>

        </tr>



        <tr>

            <td></td>

            <td style="width: 100px"></td>

            <td style="width: 250px">Sumbawa Besar, '.$data->tanggal_sertifikat.'</td>

        </tr>



        <tr>

            <td style="width: 215px">Mengetahui,</td>

            <td style="width: 180px"></td>

            <td style="width: 215px"></td>

        </tr>



        <tr>

            <td style="width: 215px">'.$pejabat->jabatan.'</td>

            <td style="width: 180px"></td>

            <td style="width: 215px">Penyelia</td>

        </tr>


        <tr>

            ';


                if ($ttd["ttd_mt_hasil_uji"] == 'Ya') {
                    

                    $content .='

                        <td style="width: 215px"><img src='. $objectPrint->getScanTtd($data->nip_kepala_plh, $data->kepala_plh) .' style="width: 90%;"></td>

                    ';
                    
                }else{


                    $content .='

                        <td style="width: 215px; padding-bottom: 70px"></td>

                    ';

                }



            $content .='


            <td style="width: 180px"></td>

            ';


                if ($ttd["ttd_penyelia_hasil_uji"] == 'Ya') {

                    

                    $content .='

                        <td style="width: 215px"><img src='. $objectPrint->getScanTtd($data->nip_penyelia, $data->nama_penyelia) .' style="width: 90%;"></td>

                    ';
                    
                }else{
    
                    $content .='

                        <td style="width: 215px; padding-bottom: 70px"></td>

                    ';

                }



            $content .='



        </tr>


        <tr>

            <td style="width: 215px">('.$data->kepala_plh.')</td>

            <td style="width: 180px"></td>

            <td style="width: 215px">('.$data->nama_penyelia.')</td>

        </tr>



        <tr>

            <td style="width: 215px> NIP. '.$data->nip_kepala_plh.'</td>

            <td style="width: 180px"></td>

            <td style="width: 215px">NIP. '.$data->nip_penyelia.'</td>

        </tr>



    </table> 

    ';

    if ($totalID < $num) {

        $content .= '


             <div class="html2pdf__page-break2"></div>  


        ';

    }

endwhile;

$content .='    

</page>

';


$html2pdf->WriteHTML($content);

$html2pdf->pdf->setTitle($objectPrint->title_dokumen);

$html2pdf->Output('Sertifikat_Pengujian.pdf');

require_once('footer.php');

?>