
    <script src="../assets/js/bootstrap.min.js"></script>

    <?php  

        if (strpos($_SERVER['REQUEST_URI'], "bakteri") ) { ?>

             <script src="../assets/js/labkhnew.js"></script>
           
    <?php }elseif (strpos($_SERVER['REQUEST_URI'], "parasit")) { ?>
            
            <script src="../assets/js/labkhnewlabparasit.js"></script>

   <?php  }elseif (strpos($_SERVER['REQUEST_URI'], "bakteri") == false && strpos($_SERVER['REQUEST_URI'], "parasit") == false) { ?>

            <script src="../assets/js/labkhnew.js"></script>

    <?php } ?>

    <script src="../assets/js/bootstrap-confirmation.js"></script>   

    <script src="../assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- SB Admin Scripts - Include with every page -->

    <script src="../assets/js/sb-admin.js"></script>

    <script src="../assets/sweetalert2.js"></script>

    <script src="../assets/js/bootstrap-datepicker.js"></script>

    <!-- Page-Level Demo Scripts - Dashboard - Use for reference -->

    <script src="../assets/dataTables/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>  

    <script src="../assets/js/bootstrap-select.min.js"></script>

    <script src="../assets/dataTables/DataTables-1.10.16/js/dataTables.bootstrap.min.js"></script> 

    <script src="../assets/js/numbers_no_ellipses.js"></script>

   <!--  <script src="../assets/js/main.js"></script> -->
<?php 

$connection->destroy();

ob_end_flush();

?>

