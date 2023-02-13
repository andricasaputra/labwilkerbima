<?php

require_once ('header.php');

$file = explode('.', basename(__FILE__));

$set = $objectPrint->setNamaDokumen($file[0]);

$content ='

<style>

    table{

        border: 0.7px solid black;

        border-collapse: collapse;

        width: 100%;

    }

    th{

        border: 0.7px solid black;

        border-collapse: collapse;

        text-align: center;

    }



    td{

        border: 0.7px solid black;

        border-collapse: collapse;

        text-align: center;

        vertical-align: text-top;

        padding-top: 7px;

        width : fixed;

        wordwrap: break-word;

        

    }

        

    div#lower{

        margin-left: 400px;

    }



    div#lower2{

    margin-left: 73px;

    }



    #garis {

        width: 95%;

        margin-left: 18px;

    }


    hr {

        border: none;

        height: 1px;

        color: black; 

        background-color: black;

    }


</style>

';


$content .= '

<page backtop="35mm" backleft="12mm" backright="10mm" backbottom="10mm">

     <page_header> 

        <div align="center">

            <strong><img src='.$logo.' width="698px; height:150px"></strong>

        </div>

    </page_header>

    <page_footer>

        <div id="garis">

            <hr>

            <span style="margin-left: 10px;"><i>'.str_replace('H;', ';', $objectPrint->kode_dokumen).'</i></span>
        </div>

    </page_footer> ';

    $no=1;              

    if(@$_GET['id'] !== ''){

        $tampil = $objectPrint->tampil(@$_GET['id']);

    }else {

        $tampil=$objectPrint->tampil();
        exit;

    }

    while ($data=$tampil->fetch_object()):

        $bil = $data->jumlah_sampel;

        $title = $objectPrint->title_dokumen.' | '.$data->kode_sampel;

        $bilangan = ucwords($objectNomor->bilangan($bil));

        $pejabat = $objectPrint->getPejabat($data->nip_ma);


$content .= '


        <div align="center">

            <strong>'.$objectPrint->title_dokumen.'</strong>
        </div>

        <p></p>

    <div>

    Laboratorium*)&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


       <div style="display: inline, paddingleft: 30px">

                <img src='.$boxfix.' style="width: 15px">

                Lab KT &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                <img src='.$checkfix.' style="width: 15px">

                Lab KH  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                <img src='.$boxfix.' style="width: 15px">

                Lab Kehati Hewani/Nabati

        </div>

            <br>

        <div>

        Kode Sampel&nbsp;&nbsp;&nbsp;  :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$data->kode_sampel.'

        </div>

         <br>

        <div>

        Jenis Sampel&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$data->bagian_hewan.'

        </div>

    </div>



        <p></p>





        <table>

              <tr>

                <th style="width:5%;" >No</th>

                <th style="width:20%;">Nama Sampel</th> 

                <th style="width:20%;">Jumlah/ Volume Sampel</th>

                <th style="width:35%;"> Target Pengujian</th>

                <th style="width:20%;">Metode Pengujian</th>

              </tr>



              <tr>                

                <td style="width:5%; border-bottom:0px;">1</td>

                <td style="width:20%; border-bottom:0px;">'.$data->nama_sampel.'</td>

                <td style="width:20%; border-bottom:0px;">'.$data->jumlah_sampel.' ('.$bilangan.')</td>

                ';

                if ($data->target_pengujian3 != '') {

                    $content .= '

                    <td style="width:35%;border-bottom:0px;"><b><em>'.$data->target_pengujian2.' & '.$data->target_pengujian3.'</em></b></td>


                    ';
                   
                }else{

                    $content .= '

                    <td style="width:35%;border-bottom:0px;"><b><em>'.$data->target_pengujian2.'</em></b></td>


                    ';

                }

                $content .='

                <td style="width:20%;border-bottom:0px; ">'.$data->metode_pengujian.' </td>

              </tr>



              <tr>

                <td style="border-top:0px; padding-bottom: 350px"></td>

                <td style="border-top:0px"></td>

                <td style="border-top:0px"></td>

                <td style="border-top:0px"></td>

                <td style="border-top:0px"></td>

              </tr>



        </table>

        <p></p>



        <div>

            Keterangan: <sup>*)</sup> Coret yang tidak perlu

        </div>

        <div id="lower2">

            <sup>**)</sup> Beri tanda Check (<img src='.$check.' width="25px; height:30px;">) pada tempat yang sesuai

        </div>

        <div  id="lower">

            <p></p>

            <p></p>

            Bima, '.$data->tanggal_diterima.' 

            <br/>

            ';

            $content .='

            <span>'.$pejabat->jabatan.'</span>
            <p></p>

            <p></p>

            <p></p>

            ';

            $content .='

            ('.$data->ma.')<br/>

            NIP. '.$data->nip_ma.'

        </div> 

        ';

$a = $data->nama_sampel;

$b = $data->tanggal_diterima;                

endwhile;

$content .='    



</page>

';

$html2pdf->WriteHTML($content);

$html2pdf->pdf->setTitle($title);

$html2pdf->Output('Permintaan_Kesiapan_Pengujian'.' '.$a.' '.$b.'.pdf');

require_once('footer.php');


?>

<!-- <div  id="lower">

            <p></p>

            <p></p>



            Sumbawa Besar, '.$data->tanggal_diterima.' 

            <br/>

            ';



                if ($data->ma == 'Andik Akrimil Fata, SP') {

                    $content .='

                    Manajer Administrasi,<br/>

                    <p></p>

                    <p></p>

                    <p></p>

                    <p></p>

                    ';

                }else{

                    $content .='

                    <span style="margin-left: -24px">An.</span> Manajer Administrasi,<br/>

                    Deputi MA

                    <p></p>

                    <p></p>

                    <p></p>

                    ';

                }



            $content .='

           
            ('.$data->ma.')<br/>

            NIP. '.$data->nip_ma.'

        </div>   -->

<!-- <div style="page-break-after:always; clear:both"></div>  -->