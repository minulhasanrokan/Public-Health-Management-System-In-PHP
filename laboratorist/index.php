<?php require_once __DIR__.'/body/header.php';?>
<?php require_once __DIR__.'/body/left_menu.php';?>

<?php
    require_once __DIR__."/../classes/Blood.php";
    require_once __DIR__."/../classes/Test.php";
    require_once __DIR__."/../classes/Report.php";
    
    $blood = new Blood();
    $test = new Test();
    $report = new Report();


    $number_of_blood_group = $blood->number_of_blood_group();

    $number_of_test = $test->number_of_test();

    $all_report = $report ->get_all_report($ofset=null, $limit=null,$appointment_id=null, $doctor_id=null,$patient_id=null,$date_con=null,$test_id=null);

    if($all_report!=''){

        $number_of_report = mysqli_num_rows($all_report);
    }

?>
<title><?php echo $system_data_title;?> Deashboard</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <div class="row">
                <div class="col-xl-4 col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?php echo BASEPATH;?>/laboratorist/blood-bank/all">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Blood Bank</p>
                                        <h4 class="mb-2"><?php if(isset($number_of_blood_group)){ echo $number_of_blood_group;}else{ echo 0;}?></h4>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-primary rounded-3">
                                            <i class="mdi mdi-medical-bag font-size-24"></i>  
                                        </span>
                                    </div>
                                </div>
                            </a>                                            
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-4 col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?php echo BASEPATH;?>/laboratorist/test-type/all">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Test Type</p>
                                        <h4 class="mb-2"><?php if(isset($number_of_test)){ echo $number_of_test;}else{ echo 0;}?></h4>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-primary rounded-3">
                                            <i class="mdi mdi-medical-bag font-size-24"></i>  
                                        </span>
                                    </div>
                                </div>
                            </a>                                            
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-4 col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?php echo BASEPATH;?>/laboratorist/report/all">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Report</p>
                                        <h4 class="mb-2"><?php if(isset($number_of_report)){ echo $number_of_report;}else{ echo 0;}?></h4>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-primary rounded-3">
                                            <i class="mdi mdi-medical-bag font-size-24"></i>  
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
                        <div class="card-body">
                            <h4 class="card-title mb-4">All Notice</h4>
                            <div class="table-responsive" id="notice_div">
                                <?php require_once 'body/notice.php';?>
                            </div>
                        </div><!-- end card -->
                    </div><!-- end card -->
                </div>
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

        