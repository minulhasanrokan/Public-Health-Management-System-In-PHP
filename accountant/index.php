<?php require_once __DIR__.'/body/header.php';?>
<?php require_once __DIR__.'/body/left_menu.php';?>

<?php
    require_once __DIR__."/../classes/Doctor.php";
    require_once __DIR__."/../classes/Test.php";
    require_once __DIR__."/../classes/Floor.php";
    require_once __DIR__."/../classes/Bill.php";
    
    $doctor = new Doctor();
    $number_of_doctor_fee = $doctor->number_of_doctor_fee();


    $bill = new Bill();
    $get_all_bill = $bill->get_all_bill($ofset=null, $limit=null, $year=null);

    if($get_all_bill!=''){

        $number_of_bill = mysqli_num_rows($get_all_bill);
    }

    $test = new Test();
    $number_of_test_fee = $test->number_of_test_fee();

    $floor = new Floor();
    $number_of_bed_fee = $floor->number_of_bed_fee();

    $bill_display = 1;

?>
<title><?php echo $system_data_title;?> Dashboard</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?php echo BASEPATH;?>/accountant/doctor-fee/all">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Doctor</p>
                                        <h4 class="mb-2"><?php if(isset($number_of_doctor_fee)){ echo $number_of_doctor_fee;}else{ echo 0;}?></h4>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-primary rounded-3">
                                            <i class="mdi mdi-doctor font-size-24"></i>  
                                        </span>
                                    </div>
                                </div>
                            </a>                                            
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?php echo BASEPATH;?>/accountant/bed-fee/all">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Bed</p>
                                        <h4 class="mb-2"><?php if(isset($number_of_bed_fee)){ echo $number_of_bed_fee;}else{ echo 0;}?></h4>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-primary rounded-3">
                                            <i class="mdi mdi-bed font-size-24"></i>  
                                        </span>
                                    </div>
                                </div>
                            </a>                                            
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?php echo BASEPATH;?>/accountant/test-fee/all">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Test</p>
                                        <h4 class="mb-2"><?php if(isset($number_of_test_fee)){ echo $number_of_test_fee;}else{ echo 0;}?></h4>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-primary rounded-3">
                                            <i class="mdi mdi-bed font-size-24"></i>  
                                        </span>
                                    </div>
                                </div>
                            </a>                                            
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?php echo BASEPATH;?>/accountant/bill/appointment-bill-all">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">All Bill</p>
                                        <h4 class="mb-2"><?php if(isset($number_of_bill)){ echo $number_of_bill;}else{ echo 0;}?></h4>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-primary rounded-3">
                                            <i class="mdi mdi-bed font-size-24"></i>  
                                        </span>
                                    </div>
                                </div>
                            </a>                                            
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
            
            </div><!-- end row -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pb-0">
                            <h4 class="card-title mb-4">All Bill Details</h4>
                        </div>
                        <div class="card-body py-0 px-2">
                            <div id="bill_display" class="apex-charts" dir="ltr"></div>
                        </div>
                    </div><!-- end card -->
                </div>

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">All Notice</h4>
                            <div class="table-responsive" id="notice_div">
                                <?php require_once 'body/notice.php';?>
                            </div>
                        </div><!-- end card -->
                    </div><!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        
    </div>
    <!-- End Page-content -->

    <?php require_once __DIR__.'/body/footer_content.php';?>
    
</div>
<!-- end main content-->

<script type="text/javascript">
    
    function pagination_for_notice(page,data){

        var data = "&page="+data+"&action=get_notice_data_by_pagination";

        http.open("POST","action",true);
        http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        http.send(data);
        http.onreadystatechange = pagination_for_notice_reponse;

    }

    function pagination_for_notice_reponse(){

        if(http.readyState == 4) 
        {   
          var reponse=http.responseText;

          $("#notice_div").html(reponse);
        }
    }

    function download_file(title,data){

        var data = "&data="+data+"&action=download_file&title="+title;

        http.open("POST","action",true);
        http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        http.send(data);

        http.onreadystatechange = download_file_reponse;
    }

    function download_file_reponse(){

    }

</script>


<?php require_once __DIR__.'/body/footer.php';?>

        