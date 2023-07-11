                </div>
        <!-- END layout-wrapper -->


        <!-- JAVASCRIPT -->
        <script src="<?php echo BASEPATH; ?>/assets/libs/jquery/jquery.min.js"></script>
        <script src="<?php echo BASEPATH; ?>/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo BASEPATH; ?>/assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="<?php echo BASEPATH; ?>/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="<?php echo BASEPATH; ?>/assets/libs/node-waves/waves.min.js"></script>

        
        <!-- apexcharts -->
        <script src="<?php echo BASEPATH; ?>/assets/libs/apexcharts/apexcharts.min.js"></script>

        <!-- jquery.vectormap map -->
        <script src="<?php echo BASEPATH; ?>/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="<?php echo BASEPATH; ?>/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js"></script>

        <!-- Required datatable js -->
        <script src="<?php echo BASEPATH; ?>/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo BASEPATH; ?>/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

        <!-- Buttons examples -->
        <script src="<?php echo BASEPATH; ?>/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?php echo BASEPATH; ?>/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="<?php echo BASEPATH; ?>/assets/libs/jszip/jszip.min.js"></script>
        <script src="<?php echo BASEPATH; ?>/assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="<?php echo BASEPATH; ?>/assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="<?php echo BASEPATH; ?>/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="<?php echo BASEPATH; ?>/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="<?php echo BASEPATH; ?>/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

        <script src="<?php echo BASEPATH; ?>/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="<?php echo BASEPATH; ?>/assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
        
        <!-- Responsive examples -->
        <script src="<?php echo BASEPATH; ?>/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?php echo BASEPATH; ?>/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <script src="<?php echo BASEPATH; ?>/assets/js/pages/dashboard.init.js"></script>

        <!-- Datatable init js -->
        <script src="<?php echo BASEPATH; ?>/assets/js/pages/datatables.init.js"></script>

        <!-- App js -->
        <script src="<?php echo BASEPATH; ?>/assets/js/app.js"></script>
        <script src="<?php echo BASEPATH; ?>/assets/js/common.js"></script>


        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
        <?php
            if(isset($_SESSION['message'])){

                echo "var type = '".$_SESSION['alert-type']."';\n";
            }

            if(isset($_SESSION['message'])){
                ?>
                switch(type){
                    case 'info':
                    toastr.info("<?php echo $_SESSION['message'];?>");
                    break;

                    case 'success':
                    toastr.success("<?php echo $_SESSION['message'];?>");
                    break;

                    case 'warning':
                    toastr.warning("<?php echo $_SESSION['message'];?>");
                    break;

                    case 'error':
                    toastr.error("<?php echo $_SESSION['message'];?>");
                    break; 
                }
                <?php

                unset($_SESSION['message']);
            }
        ?>
        </script>
    </body>

</html>