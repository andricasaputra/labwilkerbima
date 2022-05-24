<?php

require_once ('header.php');

$file = explode('.', basename(__FILE__));

$set = $objectPrint->setNamaDokumen($file[0], 'kt');

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

        page-break-after: always;

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


</style>

<page backtop="35mm" backleft="12mm" backright="10mm" backbottom="10mm">

     <page_header> 

        <div style="margin-left: 34px">

            <strong><img src="'.$logo.'" width="698px; height:150px"></strong>

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



    $no=1;

                
    if($_GET['id'] && $_GET['no_sertifikat'] !== ''){

        $tampil  = $objectPrint->tampil($_GET['id'], $_GET['no_sertifikat']);

        $tampil2 = $objectHasil->tampil($_GET['id']);

        $ttd = $objectPrint->scan(@$_GET['id']);


    }else {


        echo "<script>window.close()</script>";

        exit;

    }

    while ($data=$tampil->fetch_object()):

        $bilangan = ucwords($objectNomor->bilangan($data->jumlah_sampel));

        $title = $objectPrint->title_dokumen .' | '.$data->no_sertifikat;

        $pejabat = $objectPrint->getPejabat($data->nip_kepala_plh);

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

            <td width="300">Nama Ilmiah</td>

            <td width="10">:</td>

            <td width="300"><em>'.$data->nama_ilmiah.'</em></td>

        </tr>



        <tr>

            <td width="10">3.</td>

            <td width="200">Kode Sampel/media pembawa</td>

            <td width="10">:</td>

            <td width="200">'.$data->kode_sampel.'</td>

        </tr>



        <tr>

            <td width="10">4.</td>

            <td width="200">Jumlah sampel/media pembawa</td>

            <td width="10">:</td>

            <td width="200">'.$data->jumlah_sampel.'&nbsp;('.$bilangan.')&nbsp;'.$data->satuan.'</td>

        </tr>



        <tr>

            <td width="10">5.</td>

            <td width="200">Jenis sampel/media pembawa</td>

            <td width="10"></td>

            <td width="200"></td>

        </tr>



        <tr>

            <td width="24">&nbsp;</td>

            <td width="234">

                &middot; Bagian tumbuhan

            </td>

            <td width="18">

                :

            </td>

            <td width="316">';



            if ($data->bagian_tumbuhan == 'Akar') {



                $content .='



                <img src="'.$checkfix.'" style="width: 12px">&nbsp;&nbsp;Akar



                ';

            }else{



                $content .='



                <img src="'.$boxfix.'" style="width: 12px">&nbsp;&nbsp;Akar



                ';

            }



            if ($data->bagian_tumbuhan == 'Batang') {



                $content .='



                <span style="margin-left: 32px"><img src="'.$checkfix.'" style="width: 12px">&nbsp;&nbsp;Batang</span>



                ';

            }else{



                $content .='



                <span style="margin-left: 32px"><img src="'.$boxfix.'" style="width: 12px">&nbsp;&nbsp;Batang</span>



                ';

            }



            if ($data->bagian_tumbuhan == 'Daun') {



                $content .='



                <span style="margin-left: 10px"><img src="'.$checkfix.'" style="width: 12px">&nbsp;&nbsp;Daun</span>



                ';

            }else{



                $content .='



                <span style="margin-left: 10px"><img src="'.$boxfix.'" style="width: 12px">&nbsp;&nbsp;Daun</span>



                ';

            }



            if ($data->bagian_tumbuhan == 'Umbi') {



                $content .='



               <span style="margin-left: 10px"><img src="'.$checkfix.'" style="width: 12px">&nbsp;&nbsp;Umbi</span>



                ';

            }else{



                $content .='



                <span style="margin-left: 10px"><img src="'.$boxfix.'" style="width: 12px">&nbsp;&nbsp;Umbi</span>



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

            if ($data->bagian_tumbuhan == 'Buah') {



                $content .='



               <img src="'.$checkfix.'" style="width: 12px">&nbsp;&nbsp;Buah



                ';

            }else{



                $content .='



                <img src="'.$boxfix.'" style="width: 12px">&nbsp;&nbsp;Buah



                ';

            }



            if ($data->bagian_tumbuhan == 'Seluruh Bagian Tanaman') {



                $content .='



               <span style="margin-left: 28px"><img src="'.$checkfix.'" style="width: 12px">&nbsp;&nbsp;Seluruh bag tanaman</span>



                ';

            }else{



                $content .='



                <span style="margin-left: 28px"><img src="'.$boxfix.'" style="width: 12px">&nbsp;&nbsp;Seluruh bag tanaman</span>



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

            if ($data->bagian_tumbuhan == 'Biji/Benih') {



                $content .='



                <img src="'.$checkfix.'" style="width: 12px">&nbsp;&nbsp;Biji/Benih



                ';

            }else{



                $content .='



                <img src="'.$boxfix.'" style="width: 12px">&nbsp;&nbsp;Biji/Benih



                ';

            }



            if ($data->bagian_tumbuhan == 'Bagian Lain') {



                $content .='



                <span style="margin-left: 4px"><img src="'.$checkfix.'" style="width: 12px">&nbsp;&nbsp;Bagian Lain : ...............</span>



                ';

            }else{



                $content .='



                <span style="margin-left: 4px"><img src="'.$boxfix.'" style="width: 12px">&nbsp;&nbsp;Bagian Lain : ...............</span>



                ';

            }



            $content .='

                 

                 

            </td>

        </tr>



        <tr>

            <td width="24">&nbsp;</td>

            <td width="234">

                &middot; Media

            </td>

            <td width="18">

                :

            </td>

            <td width="316">

                 <img src="'.$boxfix.'" style="width: 12px">&nbsp;&nbsp;Tanah

                 <span style="margin-left: 22px"><img src="'.$boxfix.'" style="width: 12px">&nbsp;&nbsp;Lainnya: ...............</span>

                

            </td>

        </tr>



        <tr>

            <td width="10"></td>

            <td width="200">&middot; Vektor/Inang/Spesimen</td>

            <td width="10">:</td>

            <td width="200">'.$data->vektor.'</td>

        </tr>



        <tr>

            <td width="10" style="vertical-align: text-top">6.</td>

            <td width="200"  style="vertical-align: text-top">Tanggal penerimaan sampel/ <br>media pembawa di laboratorium</td>

            <td width="10"  style="vertical-align: text-top">:</td>

            <td width="200"  style="vertical-align: text-top">'.$data->tanggal_penyerahan_lab.'</td>

        </tr>

        <tr>

            <td width="10" style="vertical-align: text-top">7.</td>

            <td width="200"  style="vertical-align: text-top">Tanggal pengujian sampel/ <br>media pembawa di laboratorium</td>

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

            <th style="width:15%;">Identitas Sampel</th>

            <th style="width:25%;" >Target Pengujian</th>

            <th style="width:10%;">Metode Pengujian</th>

            <th style="width:27%;">Hasil Pengujian*)</th>

          </tr>



          ';



            while ($data2 =$tampil2->fetch_object()):



          $content .='

          <tr>


            <td style="width:5%; ">'.$no++.'</td>

            <td style="width:13%; ">'.$data2->no_sampel.'</td>    

            <td style="width:15%; ">'.$data->bagian_tumbuhan.''.$data->vektor.''.$data->media.'</td>

            <td style="width:23%; ">

            <em>'.$data->target_optk.'<br>'.$data->target_optk2.'<br>'.$data->target_optk3.'</em>

            </td>

            <td style="width:12%; ">

            ';



                if ($data->metode_pengujian2 !=='') {

                    $content .='



                    '.$data->metode_pengujian.'

                <br>'.$data->metode_pengujian2.'



                    ';

                }elseif($data->metode_pengujian3 !==''){



                    $content .='



                    '.$data->metode_pengujian.'

                <br>'.$data->metode_pengujian2.'

                <br>'.$data->metode_pengujian3.'



                    ';



                }else{



                    $content .='



                    '.$data->metode_pengujian.'



                    ';

                }

                $dicari = $data2->hasil_pengujian;
                $butuh = ',';

                $cari = strpos($dicari, $butuh);

                if ($cari == true) {

                    $content .= '

                    </td>    

                    <td style="width:27%; text-align: left">&nbsp;&nbsp;'.$data2->positif_negatif.'<br>&nbsp;&nbsp;Hasil identifikasi: <br>&nbsp;&nbsp; -&nbsp;<em><b>'.ucfirst(str_replace(",", ",<br/> &nbsp;&nbsp;&nbsp;-", $dicari)).'</b></em></td>  

                    ';
                    
                }else{

                    $content .= '

                    </td>    

                    <td style="width:27%; text-align: left">&nbsp;&nbsp;'.$data2->positif_negatif.'<br>&nbsp;&nbsp;Hasil identifikasi: <br>&nbsp;&nbsp; -&nbsp;<em><b>'.ucfirst($data2->hasil_pengujian).'</b></em></td>  

                    ';
                     
                }


                $content .= '

          </tr>


          ';   



            endwhile;




          $content .='



    </table>

   
    <table class="lower" style="text-align: center;">


        <tr>

            <td style="text-align: left">

                <span style="font-size: 8pt;padding-bottom: 35px">

                    *) Hanya untuk sampel yang diuji

                </span>

            </td>

            <td style="width: 180px"></td>

            <td style="width: 215px"></td>

        </tr>





        <tr>

            <td colspan="3" style="padding-bottom: 15px; width: 215px; text-align: left">Rekomendasi : '.$data->rekomendasi.'</td>


        </tr>



        <tr>

            <td></td>

            <td style="width: 150px"></td>

            <td style="width: 255px">Sumbawa Besar, '.$data->tanggal_sertifikat.'</td>

        </tr>



        <tr>

            <td style="width: 215px">Mengetahui,</td>

            <td style="width: 180px"></td>

            <td style="width: 215px"></td>

        </tr>



        ';


            if ($ttd["ttd_mt_hasil_uji"] == 'Tidak' && $ttd["ttd_penyelia_hasil_uji"] == 'Tidak' || $ttd["ttd_mt_hasil_uji"] == '' || $ttd["ttd_penyelia_hasil_uji"] == '') {

                $content .='

                   <tr>

                        <td style="width: 215px; padding-bottom: 80px;position : relative; z-index: 1">'.$pejabat->jabatan.'</td>

                        <td style="width: 180px"></td>

                        <td style="width: 215px; padding-bottom: 80px;position : relative; z-index: 1">Penyelia</td>

                    </tr>
                    

                ';



            }else{



                $content .='

                    <tr>

                        <td style="width: 215px;position : relative; z-index: 1">'.$pejabat->jabatan.'</td>

                        <td style="width: 180px"></td>

                        <td style="width: 215px;position : relative; z-index: 1">Penyelia</td>

                    </tr>

                    

                ';

            }


        $content .= '


        <tr>
            ';

                if ($ttd["ttd_mt_hasil_uji"] == 'Ya') {


                    $content .='

                        <td style="width: 215px"><img src='.$objectPrint->getScanTtd($data->nip_kepala_plh, $data->kepala_plh).' style="width: 90%;"></td>

                    ';

                }else{

                    $content .='

                        <td style="width: 215px; text-align: center;"></td>
         
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

                      <td style="width: 215px;text-align: center;"></td>
  
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

        <tr>

            <td style="width: 215px></td>

            <td style="width: 180px"></td>

            <td style="width: 215px"></td>

        </tr>



        <tr>

            <td style="width: 215px; text-align: left; padding-top: 0px;">

            <span style="font-size: 7pt">
                <br/>

                <small>
                 *) Coret yang tidak perlu
                <br/>
                **) Termasuk Ruang Lingkup Akreditasi
                </small>

            </span>

            </td>

            <td style="width: 180px"></td>

            <td style="width: 215px"></td>

        </tr>

    </table> ';

$a = $data->nama_sampel;

$b = $data->tanggal_sertifikat; 

endwhile;

$content .='    

</page>

';

$html2pdf->WriteHTML($content);

$html2pdf->pdf->setTitle($title);

$html2pdf->Output('Sertifikat_Pengujian'.' '.$a.' '.$b.'.pdf');

require_once('footer.php');

?>