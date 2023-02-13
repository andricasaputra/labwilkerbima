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

        padding:4px;

        vertical-align: text-bottom;

    }



    .table2  {

        text-align: center;

        border: 0.7px solid black;

        border-collapse: collapse;

    }


    .table2 th {

       padding-top: 2px;

       padding-bottom: 2px;

    }


    .table2 td {

       vertical-align: text-top;

       text-align: center;

       padding:  3px 5px;

       border: 0.7px solid black;

       align: bottom;

    }



    div#garis {

        width: 90%;

        margin:auto;

        margin-left:-3px;

        margin-bottom: 10px

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



    div#logo {

        margin-left: 0px;

    }



     .agenda td {

        border : 0.7px solid black;

        border-collapse: collapse;

        position : absolute;

        margin-top: 30px ;

        margin-left: 330px ;

    }

    .html2pdf__page-break2 {

      height: 2000px;

    }


</style>


<page backtop="35mm" backleft="12mm" backright="10mm" backbottom="15mm"> 

<page_header> 

        <div id="logo">

        <span style="position: absolute; margin-top: 10px"><img src="'.$logoskpbiasa.'" width="744px; height:132px"></span>  

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

        if(!isset($_POST['print_data'])){


            echo "<script>window.close()</script>";

            exit;
             
        }else{



            $c = $_POST['no_a'];

            $d = $_POST['no_b'];

            $tampil = $objectPrint->print_multi_lhu($c, $d);


            if ($c > $d) {


                if(@$_SESSION['loginadminkt']){

                echo "<script>alert('Format Nomor agenda Yang Anda Pilih Salah (Sampai dan dari)')

                window.close()'</script>";

                exit;



                }elseif(@$_SESSION['loginsuperkt']){

                echo "<script>alert('Format Nomor agenda Yang Anda Pilih Salah (Sampai dan dari)')

               window.close()'</script>";

                exit;


                }else{

                echo "<script>alert('Format Nomor agenda Yang Anda Pilih Salah (Sampai dan dari)')

               window.close()'</script>";

                exit;

              } 



            }

        }  

    if ($tampil->num_rows === 0) {
        echo '<script>alert("Tidak Ada Data Untuk Di Cetak! Periksa Kembali Pemilihan Tanggal");window.close();</script>';
        return false;
    }

    $num = $tampil->num_rows;

    $arrID = array();        

    while ($data2 = $tampil->fetch_object()): 

        $id = $data2->id;  

        $bilangan = ucwords($objectNomor->bilangan($data2->jumlah_sampel));

        $arrID[] = $data2->id;

        $totalID = count($arrID);

        $pejabat = $objectPrint->getPejabat($data2->nip_kepala_plh2);

$content .= '

    <table class="agenda" style="position: absolute; margin-left: 550px; top: -50px;">

        <tr>

                ';
                    if ($data2->no_agenda == '') {

                        $content .='

                        <td style="width:100px; text-align:center; vertical-align: baseline; font-size:11pt;padding-bottom: 2px; padding-top:3px"><b>Kosong</b></td>

                        ';
                    }else{

                        $content .='
                        <td style="width:100px; text-align:center; vertical-align: baseline; font-size:11pt;padding-bottom: 2px; padding-top:3px"><b>'.$data2->no_agenda.'</b></td>
                        ';

                    }
                $content .='
        </tr>

    </table> 

    <br>


    <div align="center">

        <strong><u>'.$objectPrint->title_dokumen.'</u></strong><br>

        ';

        $ex = explode("/", $data2->no_lhu);

        $noex = $ex[0];

        if (empty($noex)) {
            
            $content .= '

                Nomor :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$data2->no_lhu.'&nbsp;, Tanggal: '.$data2->tanggal_lhu.'

            ';

        }else{

            $content .= '

                Nomor :&nbsp;'.$data2->no_lhu.'&nbsp;, Tanggal: '.$data2->tanggal_lhu.'

            ';

        }


        $content .='

    </div>

    <br>



    <div>

        Kepada Yth.

        
        <br/>

        <b>'.$data2->pemohon.'</b>

        <br>Di '.$data2->alamat_pemilik.'

    </div>

    <br/>

        Memenuhi Surat Permohonan Pengujian Laboratorium Saudara No. '.$data2->no_permohonan.' tanggal '.$data2->tanggal_permohonan.' , bersama ini disampaikan surat hasil pengujian laboratorium terhadap sampel/media pembawa OPT/OPTK dengan identitas sebagai berikut :

    <p></p>



    <strong>A. Keterangan sampel/ media pembawa :</strong><br>

    <table class="table1">



        <tr>

            <td width="10">1.</td>

            <td width="200">Nama sampel/media pembawa</td>

            <td width="10">:</td>

            <td width="300">'.$data2->nama_sampel.'</td>

        </tr>



        <tr>

            <td width="10">2.</td>

            <td width="300">Nama Ilmiah</td>

            <td width="10">:</td>

            <td width="300"><em>'.$data2->nama_ilmiah.'</em></td>

        </tr>



        <tr>

            <td width="10">3.</td>

            <td width="200">Kode Sampel/media pembawa</td>

            <td width="10">:</td>

            <td width="200">'.$data2->kode_sampel.'</td>

        </tr>



        <tr>

            <td width="10">4.</td>

            <td width="200">Pemilik</td>

            <td width="10">:</td>

            <td width="200">'.$data2->pemohon.'</td>

        </tr>



        <tr>

            <td width="10">5.</td>

            <td width="200">Jumlah sampel/media pembawa</td>

            <td width="10">:</td>

            <td width="200">'.$data2->jumlah_sampel.'&nbsp;('.$bilangan.')&nbsp;'.$data2->satuan.'</td>

        </tr>



        <tr>

            <td width="10">6.</td>

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



            if ($data2->bagian_tumbuhan == 'Akar') {



                $content .='



                <img src="'.$checkfix.'" style="width: 12px">&nbsp;&nbsp;Akar



                ';

            }else{



                $content .='



                <img src="'.$boxfix.'" style="width: 12px">&nbsp;&nbsp;Akar



                ';

            }



            if ($data2->bagian_tumbuhan == 'Batang') {



                $content .='



                <span style="margin-left: 32px"><img src="'.$checkfix.'" style="width: 12px">&nbsp;&nbsp;Batang</span>



                ';

            }else{



                $content .='



                <span style="margin-left: 32px"><img src="'.$boxfix.'" style="width: 12px">&nbsp;&nbsp;Batang</span>



                ';

            }



            if ($data2->bagian_tumbuhan == 'Daun') {



                $content .='



                <span style="margin-left: 10px"><img src="'.$checkfix.'" style="width: 12px">&nbsp;&nbsp;Daun</span>



                ';

            }else{



                $content .='



                <span style="margin-left: 10px"><img src="'.$boxfix.'" style="width: 12px">&nbsp;&nbsp;Daun</span>



                ';

            }



            if ($data2->bagian_tumbuhan == 'Umbi') {



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

            if ($data2->bagian_tumbuhan == 'Buah') {



                $content .='



               <img src="'.$checkfix.'" style="width: 12px">&nbsp;&nbsp;Buah



                ';

            }else{



                $content .='



                <img src="'.$boxfix.'" style="width: 12px">&nbsp;&nbsp;Buah



                ';

            }



            if ($data2->bagian_tumbuhan == 'Seluruh Bagian Tanaman') {



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

            if ($data2->bagian_tumbuhan == 'Biji/Benih') {



                $content .='



                <img src="'.$checkfix.'" style="width: 12px">&nbsp;&nbsp;Biji/Benih



                ';

            }else{



                $content .='



                <img src="'.$boxfix.'" style="width: 12px">&nbsp;&nbsp;Biji/Benih



                ';

            }



            if ($data2->bagian_tumbuhan == 'Bagian Lain') {



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

                 <span style="margin-left: 18px"> <img src="'.$boxfix.'" style="width: 12px">&nbsp;&nbsp;Lainnya: ...............</span>

                

            </td>

        </tr>

        <tr>

            <td width="10"></td>

            <td width="200">&middot; Vektor/Inang/Spesimen</td>

            <td width="10">:</td>

            <td width="200">'.$data2->vektor.'</td>

        </tr>



        <tr>

            <td width="10" style="vertical-align: text-top">7.</td>

            <td width="200"  style="vertical-align: text-top">Tanggal penerimaan sampel/ <br>media pembawa di laboratorium</td>

            <td width="10"  style="vertical-align: text-top">:</td>

            <td width="200"  style="vertical-align: text-top">'.$data2->tanggal_penyerahan_lab.'</td>

        </tr>

        <tr>

            <td width="10" style="vertical-align: text-top">8.</td>

            <td width="200"  style="vertical-align: text-top">Tanggal pengujian sampel/ <br>media pembawa di laboratorium</td>

            <td width="10"  style="vertical-align: text-top">:</td>

            <td width="200"  style="vertical-align: text-top">'.$data2->tanggal_pengujian.'</td>

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

            <th style="width:15%;">Metode Pengujian</th>

            <th style="width:27%;">Hasil Pengujian*)</th>

          </tr>



          ';

            $no = 1;

            $nosmpl = $data2->jumlah_sampel;

            $tampil2 = $objectPrint->print_pertanggal_sertifikat($id);

            while($data = $tampil2->fetch_object()):

            
            $content .='

          <tr>

            ';

            if ($nosmpl === 1) { $content .='

                <td style="width:5%;">'.$no.'</td> ';

                break;

            }else{ $content .='

                <td style="width:5%;">'.$no++.'</td> ';

            }

            $content .='

            

            <td style="width:13%;">'.$data->no_sampel.'</td>    

            <td style="width:15%;">'.$data->bagian_tumbuhan.''.$data->vektor.''.$data->media.'</td>

            <td style="width:25%;"><em>'.$data->target_optk.'<br>'.$data->target_optk2.'<br>'.$data->target_optk3.'</em></td>

            <td style="width:15%;">';



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



               $dicari = $data->hasil_pengujian;
                $butuh = ',';

                $cari = strpos($dicari, $butuh);

                if ($cari == true) {

                    $content .= '

                    </td>    

                    <td style="width:27%; text-align: left">&nbsp;&nbsp;'.$data->positif_negatif.'<br>&nbsp;&nbsp;Hasil identifikasi: <br>&nbsp;&nbsp; -&nbsp;<em><b>'.ucfirst(str_replace(",", ",<br/> &nbsp;&nbsp;&nbsp;-", $dicari)).'</b></em></td>  

                    ';
                    
                }else{

                    $content .= '

                    </td>    

                    <td style="width:27%; text-align: left">&nbsp;&nbsp;'.$data->positif_negatif.'<br>&nbsp;&nbsp;Hasil identifikasi: <br>&nbsp;&nbsp; -&nbsp;<em><b>'.ucfirst($data->hasil_pengujian).'</b></em></td>  

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

            <td style=" text-align: left">

                <span style="font-size: 8pt;padding-bottom: 0px">

                    *) Hanya untuk sampel yang diuji

                </span>
                <br/>

                <span style="font-size: 8pt;padding-bottom: 0px">

                    **) Termasuk Ruang Lingkup Akreditasi
            
                </span>

                <br/>
                <br/>

                <b>C. Simpulan Hasil Pengujian :</b>

                <br/>

                <em><b>'.$data2->ket_kesimpulan.'</b></em>
                
            </td>

            <td style="width: 180px"></td>

            <td style="width: 215px;height: 70px"></td>

        </tr>


    </table>


    <table>

        <tr>

            <td>Terlampir kami sampaikan sertifikat hasil pengujian dari laboratorium Karantina Tumbuhan.<br>Demikian disampaikan sebagai bahan pertimbangan lebih lanjut</td>

        </tr>

    </table>


    <table>

         <tr>

            <td style="width: 215px;"></td>

            <td style="width: 180px"></td>

            <td style="width: 215px;"></td>

        </tr>

        <tr>

            <td style="width: 215px; padding-bottom: 60px"></td>

            <td style="width: 180px"></td>

            ';



            if ($pejabat->jabatan != 'Kepala Stasiun') {

                $content .='

                <td style="width: 450px; padding-bottom: 50px">Plh. Kepala Stasiun<br>' . $pejabat->jabatan .'</td>
                ';

            }else{

                $content .='

                <td style="width: 415px; padding-bottom: 50px">Kepala Stasiun <br></td>

                ';

            }



            $content .='

            

        </tr>



        <tr>

            <td style="width: 215px"></td>

            <td style="width: 180px"></td>

            <td style="width: 215px">('.$data2->kepala_plh2.')</td>

        </tr>



        <tr>

            <td style="width: 215px></td>

            <td style="width: 180px"></td>

            <td style="width: 215px">NIP. '.$data2->nip_kepala_plh2.'</td>

        </tr>



        <tr>

            <td style="width: 215px; text-align: left; padding-top: 1px;"><span style="font-size: 7pt">Ket: **)Coret yang tidak perlu</span></td>

            <td style="width: 180px"></td>

            <td style="width: 215px"></td>

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

$html2pdf->Output('Surat_Hasil_Pengujian.pdf');

require_once('footer.php');



?>