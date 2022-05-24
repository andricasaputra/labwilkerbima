<div class="navbar-default navbar-static-side" role="navigation" id="side">

    <div class="sidebar-collapse">

        <ul class="nav" id="side-menu" >

            <li>

                <a href="?lab=bakteri&page=dashboard"><i class="fa fa-home fa-fw"></i> Dashboard</a>

            </li>



            <li>

                <a href="?lab=bakteri&page=data_permohonan"><i class="fa fa-table fa-fw"></i> Data Permohonan</a>

            </li>

            <li>

                <a href="#"><i class="fa fa-tasks fa-fw"></i> Manajer Administrasi<span class="fa arrow"></span></a>

                <ul class="nav nav-second-level">

                    <li>

                        <a href="?lab=bakteri&page=penerima_sampel"><i class="fa fa-user fa-fw"></i>Penerima Sampel</a>

                    </li>

                    <li>

                        <a href="?lab=bakteri&page=penyerahan_sampel"><i class="fa fa-leaf fa-fw"></i>Penyerahan Sampel </a>

                    </li>

                    <li>

                        <a href="?lab=bakteri&page=permintaan_kesiapan_pengujian"><i class="fa fa-dashboard fa-fw"></i>Permintaan Kesiapan</a>

                    </li>

                    <li>

                        <a href="?lab=bakteri&page=respon_permohonan"><i class="fa fa-file-text-o fa-fw"></i>Respon Permohonan </a>

                    </li>

                </ul>

                <!-- /.nav-second-level -->

            </li>

            <li>

                <a href="#"><i class="fa fa-tasks fa-fw"></i> Manajer Teknis<span class="fa arrow"></span></a>

                <ul class="nav nav-second-level">

                    <li>

                        <a href="?lab=bakteri&page=kesiapan_pengujian"><i class="fa fa-dashboard fa-fw"></i>Kesiapan Pengujian</a>

                    </li>

                    <li>

                        <a href="?lab=bakteri&page=penyelia_analis"><i class="fa fa-pencil fa-fw"></i>Penunjukan Petugas</a>

                    </li>

                    <li>

                        <a href="?lab=bakteri&page=pengelola_sampel"><i class="fa fa-user fa-fw"></i>Pengelola Sampel</a>

                    </li>

                </ul>

                <!-- /.nav-second-level -->

            </li>

            <li>

                <a href="#"><i class="fa fa-flask fa-fw" ></i>Pengujian<span class="fa arrow"></span></a>

                <ul class="nav nav-second-level">

                    <li>

                        <a href="?lab=bakteri&page=data_teknis"><i class="fa fa-file-text fa-fw" ></i>Data Teknis</a>

                    </li>

                    <li>

                        <a href="?lab=bakteri&page=sertifikat"><i class="fa fa-file-text-o fa-fw" ></i>Hasil Pengujian</a>

                    </li>

                </ul>

                <!-- /.nav-second-level -->

            </li>

            <li>

                <a href="?lab=bakteri&page=surat_hasil_uji"><i class="fa fa-check-square fa-fw" ></i>Surat Hasil Uji</a>

            </li>

            <li>

                <a href="#"><i class="fa fa-gear fa-fw"></i> Database<span class="fa arrow"></span></a>

                <ul class="nav nav-second-level">

                    <li>

                        <a href="?page=input_nama_pelanggan"><i class="fa fa-sitemap fa-fw"></i> Nama Pelanggan</a>

                    </li>

                    <li>

                        <a href="?page=input_nama_hewan"><i class="fa fa-suitcase fa-fw"></i> Nama Sampel</a>

                    </li>

                    <li>

                        <a href="?page=input_nama_patogen_kh"><i class="fa fa-bug fa-fw"></i>Nama Target</a>

                    </li>

                    <li>

                        <a href="?page=tambah_nama_user_kh"><i class="fa fa-user fa-fw"></i>Nama Pejabat</a>

                    </li>

                    <li>

                        <a href="?page=tambah_jabatan"><i class="fa fa-user fa-fw"></i>Jabatan Lab</a>

                    </li>

                    <li>

                        <a href="?page=tambah_jabfung"><i class="fa fa-user fa-fw"></i>Jabatan Fungsional</a>

                    </li>

                </ul>

                <!-- /.nav-second-level -->



            </li>


        </ul>

        <!-- /#side-menu -->



    </div>


</div>

<!-- /.navbar-static-side -->

</nav>

</div>



<div id="page-wrapper">

<div class="row">

<div class="col-lg-12">

    <?php

    if (@$_GET['page'] == 'dashboard' || @$_GET['page'] == '') {

        require_once "lab_bakteri/views/dashboard_admin.php";

    } elseif (@$_GET['page'] == 'data_permohonan' && $_GET['lab'] == 'bakteri') {

        require_once "lab_bakteri/views/data_permohonan_kh.php";

    } elseif (@$_GET['page'] == 'penerima_sampel' && $_GET['lab'] == 'bakteri') {

        require_once "lab_bakteri/views/penerima_sampel.php";

    } elseif (@$_GET['page'] == 'permintaan_kesiapan_pengujian' && $_GET['lab'] == 'bakteri') {

        require_once "lab_bakteri/views/permintaan_kesiapan_pengujian_kh.php";

    } elseif (@$_GET['page'] == 'kesiapan_pengujian' && $_GET['lab'] == 'bakteri') {

        require_once "lab_bakteri/views/kesiapan_pengujian.php";

    } elseif (@$_GET['page'] == 'input_nama_pelanggan') {

        require_once "database/views/pelanggan_kh.php";

    } elseif (@$_GET['page'] == 'input_nama_hewan') {

        require_once "database/views/input_database_nama_hewan.php";

    } elseif (@$_GET['page'] == 'input_nama_patogen_kh') {

        require_once "database/views/input_database_patogen_kh.php";

    } elseif (@$_GET['page'] == 'tambah_nama_user_kh') {

        require_once "database/views/tambah_nama_user_kh.php";

    } elseif (@$_GET['page'] == 'respon_permohonan' && $_GET['lab'] == 'bakteri') {

        require_once "lab_bakteri/views/respon_permohonan_pengujian_kh.php";

    } elseif (@$_GET['page'] == 'penyerahan_sampel' && $_GET['lab'] == 'bakteri') {

        require_once "lab_bakteri/views/penyerahan_sampel_kh.php";

    } elseif (@$_GET['page'] == 'penyelia_analis' && $_GET['lab'] == 'bakteri') {

        require_once "lab_bakteri/views/penyelia_analis.php";

    } elseif (@$_GET['page'] == 'pengelola_sampel' && $_GET['lab'] == 'bakteri') {

        require_once "lab_bakteri/views/pengelola_sampel.php";

    } elseif (@$_GET['page'] == 'data_teknis' && $_GET['lab'] == 'bakteri') {

        require_once "lab_bakteri/views/data_teknis.php";

    } elseif (@$_GET['page'] == 'sertifikat' && $_GET['lab'] == 'bakteri') {

        require_once "lab_bakteri/views/sertifikat.php";

    } elseif (@$_GET['page'] == 'surat_hasil_uji' && $_GET['lab'] == 'bakteri') {

        require_once "lab_bakteri/views/surat_hasil_uji.php";

    } elseif (@$_GET['page'] === 'tambah_jabatan') {

        require_once "./database/views/tambah_jabatan.php";

    } elseif (@$_GET['page'] === 'tambah_jabfung') {

        require_once "./database/views/tambah_jabfung.php";

    } elseif (@$_GET['page'] == 'lihat_data_permohonan') {

        require_once 'lab_bakteri/views/lihat_data_permohonan.php';

    }

    ?>



</div>

</div>

</div>