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

        <?php

        if(isset($chart_data_display) && $chart_data_display==1){

            $number_of_admit_month_curr_year = $admit->number_of_admit_month_curr_year($doctor_id=null,$nurse_id=$_SESSION['nurseId'],$year=null);

            $admit_data_arr = array();

            if(!empty($number_of_admit_month_curr_year))
            {
                foreach($number_of_admit_month_curr_year as $val){
                    
                    $admit_data_arr[$val['admit_month']] = $val['total_admit'];
                }
            }

            $all_data = '';
            $max_value = 0;

            for($i=1;$i<=12;$i++) 
            {
                if($i>1){$all_data .= ",";
                }
                if(isset($admit_data_arr[$i])){
                    $all_data .= $admit_data_arr[$i];

                    if($max_value<$admit_data_arr[$i]){

                        $max_value = $admit_data_arr[$i];
                    }
                }
                else{
                    $all_data .= 0;
                } 
            }
        ?>
            <script type="text/javascript">
                var options={
                    series:[{name:"Pataint",data:[<?php echo $all_data; ?>]}],
                    chart:
                    {toolbar:{show:!1},height:350,type:"area"},
                    dataLabels:{enabled:!1},
                    yaxis:{labels:{formatter:function(e){return e+"Pataint"}},tickAmount:4,min:0,max:<?php echo $max_value+10;?>},
                    stroke:{curve:"smooth",width:2},
                    grid:{show:!0,borderColor:"#90A4AE",strokeDashArray:0,position:"back",xaxis:{lines:{show:!0}},yaxis:{lines:{show:!0}},row:{colors:void 0,opacity:.8},column:{colors:void 0,opacity:.8},padding:{top:10,right:0,bottom:10,left:10}},
                    legend:{show:!1},
                    colors:["#0f9cf3"],
                    labels:["Jan","Feb","Mar","Apr","May","Jun","July","Aug","Sep","Oct","Nov","Dec"]
                },

                chart=new ApexCharts(document.querySelector("#all_admited_patient"),options);
                chart.render();
            </script>
        <?php
            }
        ?>
    </body>

</html>