<?php require_once 'body/header.php';?>
<?php require_once 'body/left_menu.php';?>

<?php
    require_once __DIR__."/../classes/Blood.php";
    require_once __DIR__."/../classes/Floor.php";
    require_once __DIR__."/../classes/Admit.php";
    require_once __DIR__."/../classes/Deadreport.php";
    require_once __DIR__."/../classes/Birthreport.php";
    
    $blood = new Blood();
    $number_of_blood_group = $blood->number_of_blood_group();

    $dead_report = new Deadreport();
    $number_of_dead_report = $dead_report->number_of_dead_report();

    $birth_report = new Birthreport();
    $number_of_birth_report = $birth_report->number_of_birth_report();

    $floor = new Floor();
    $number_of_floor = $floor->number_of_floor();
    $number_of_bed = $floor->number_of_bed();

    $admit = new Admit();
    $number_of_admit = $admit->number_of_admit($appointment_id=null, $doctor_id=null,$nurse_id=$_SESSION['nurseId'],$patient_id=null,$release_satus=0,$start_date=null,$end_date=null,$admit_id=null);

    $chart_data_display = 1;

?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-2 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?php echo BASEPATH;?>/nurse/blood-bank/all">
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
                <div class="col-xl-2 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?php echo BASEPATH;?>/nurse/floor/all">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Floor</p>
                                        <h4 class="mb-2"><?php if(isset($number_of_floor)){ echo $number_of_floor;}else{ echo 0;}?></h4>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-primary rounded-3">
                                            <i class="mdi mdi-floor-plan font-size-24"></i>  
                                        </span>
                                    </div>
                                </div>
                            </a>                                            
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-2 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?php echo BASEPATH;?>/nurse/bed/all">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Manage Bed</p>
                                        <h4 class="mb-2"><?php if(isset($number_of_bed)){ echo $number_of_bed;}else{ echo 0;}?></h4>
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
                <div class="col-xl-2 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?php echo BASEPATH;?>/nurse/admit/all">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Admit</p>
                                        <h4 class="mb-2"><?php if(isset($number_of_admit)){ echo $number_of_admit;}else{ echo 0;}?></h4>
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
                <div class="col-xl-2 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?php echo BASEPATH;?>/nurse/dead-report/all">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Dead Report</p>
                                        <h4 class="mb-2"><?php if(isset($number_of_dead_report)){ echo $number_of_dead_report;}else{ echo 0;}?></h4>
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
                <div class="col-xl-2 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?php echo BASEPATH;?>/nurse/birth-report/all">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Birth Report</p>
                                        <h4 class="mb-2"><?php if(isset($number_of_birth_report)){ echo $number_of_birth_report;}else{ echo 0;}?></h4>
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
            </div><!-- end row -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pb-0">
                            <h4 class="card-title mb-4">All Admited Patient</h4>
                        </div>
                        <div class="card-body py-0 px-2">
                            <div id="all_admited_patient" class="apex-charts" dir="ltr"></div>
                        </div>
                    </div><!-- end card -->
                </div>
                <!-- end col -->
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

    <?php require_once 'body/footer_content.php';?>
    
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

<?php require_once 'body/footer.php';?>

        