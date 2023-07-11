<?php require_once 'body/header.php';?>
<?php require_once 'body/left_menu.php';?>

<?php
    require_once __DIR__."/../classes/Nurse.php";
    require_once __DIR__."/../classes/Admit.php";
    require_once __DIR__."/../classes/Deadreport.php";
    require_once __DIR__."/../classes/Birthreport.php";
    require_once __DIR__."/../classes/Shedule.php";
    require_once __DIR__."/../classes/Appointment.php";

    $id = 0;

    if(isset($_SESSION['doctorId'])){
        $id = $_SESSION['doctorId'];
    }

    $dead_report = new Deadreport();
    $number_of_dead_report = $dead_report->number_of_dead_report();

    $shedule = new Shedule();
    $number_of_shedule = $shedule->number_of_shedule($ofset=null, $limit=null,$doctor_id=$id,$nurse_id=null,$appointment_id=null,$appointment_status=null);

    $appointment = new Appointment();
    $all_appointment = $appointment->get_all_appointment_request($ofset=null, $limit=null,$appointment_id=null, $doctor_id=$id,$nurse_id=null,$patient_id=null,$shedule_id=null,$accept_status=1,$date_con=1);

    if ($all_appointment>'0') {
        $number_of_appointment = mysqli_num_rows($all_appointment);
    }

    $birth_report = new Birthreport();
    $number_of_birth_report = $birth_report->number_of_birth_report();
    
    $nurse = new Nurse();
    $number_of_nurse = $nurse->number_of_doctor_nurse($_SESSION['doctorId']);

    $admit = new Admit();
    $number_of_admit = $admit->number_of_admit($appointment_id=null, $doctor_id=$_SESSION['doctorId'],$nurse_id=null,$patient_id=null,$release_satus=0,$start_date=null,$end_date=null,$admit_id=null);

    $chart_data_display = 1;
?>
<title><?php echo $system_data_title;?> Dashboard</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-2 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?php echo BASEPATH;?>/doctor/nurse/all">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Total Nurse</p>
                                        <h4 class="mb-2"><?php if(isset($number_of_nurse)){ echo $number_of_nurse;}else{ echo 0;}?></h4>
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
                            <a href="<?php echo BASEPATH;?>/doctor/admit/all">
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
                            <a href="<?php echo BASEPATH;?>/doctor/dead-report/all">
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
                            <a href="<?php echo BASEPATH;?>/doctor/birth-report/all">
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
                <div class="col-xl-2 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?php echo BASEPATH;?>/doctor/shedule/all">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Shedule</p>
                                        <h4 class="mb-2"><?php if(isset($number_of_shedule)){ echo $number_of_shedule;}else{ echo 0;}?></h4>
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
                            <a href="<?php echo BASEPATH;?>/doctor/appointment/all-appointment">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Appointment</p>
                                        <h4 class="mb-2"><?php if(isset($number_of_appointment)){ echo $number_of_appointment;}else{ echo 0;}?></h4>
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

        