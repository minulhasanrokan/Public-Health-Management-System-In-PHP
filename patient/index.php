<?php require_once 'body/header.php';?>
<?php require_once 'body/left_menu.php';?>

<?php

    require_once __DIR__."/../classes/Department.php";
    require_once __DIR__."/../classes/Doctor.php";
    require_once __DIR__."/../classes/Report.php";
    require_once __DIR__."/../classes/Appointment.php";

    $department = new Department();
    $doctor = new Doctor();
    $report = new Report();
    $appointment = new Appointment();

    $id = 0;
    if(isset($_SESSION['patientId'])){
        $id = $_SESSION['patientId'];
    }

    $all_report = $report ->get_all_report($ofset=null, $limit=null,$appointment_id=null, $doctor_id=null,$patient_id=$id,$date_con=null,$test_id=null);

    if ($all_report!='') {
        
        $number_of_report = mysqli_num_rows($all_report);
    }

    $all_appointment = $appointment ->get_all_appointment_request($ofset=null, $limit=null,$appointment_id=null, $doctor_id=null,$nurse_id=null,$id,$shedule_id=null,$accept_status=1,$date_con=0);

    if ($all_appointment!='') {
        
        $number_of_appointment = mysqli_num_rows($all_appointment);
    }

    $all_appointment_request = $appointment ->get_all_appointment_request($ofset=null, $limit=null,$appointment_id=null, $doctor_id=null,$nurse_id=null,$id,$shedule_id=null,$accept_status=0,$date_con=0);

    if ($all_appointment_request!='') {
        
        $number_of_appointment_request = mysqli_num_rows($all_appointment_request);
    }

    $all_next_visit_appointment = $appointment ->next_visit_date_appointment($ofset=null, $limit=null,$appointment_id=null, $doctor_id=null,$nurse_id=null,$id,$shedule_id=null,$accept_status=1,$date_con=0,$next_visit_date=1);

    if ($all_next_visit_appointment!='') {
        
        $number_of_next_visit_appointment = mysqli_num_rows($all_next_visit_appointment);
    }

    $number_of_active_doctor = $doctor->number_of_active_doctor();

    $number_of_active_department = $department->number_of_active_department();

    $number_of_active_department = $number_of_active_department['total_department'];

?>
<title><?php echo $system_data_title;?> Dashboard</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-2 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?php echo BASEPATH;?>/patient/doctor/all-department">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Department</p>
                                        <h4 class="mb-2"><?php if(isset($number_of_active_department)){ echo $number_of_active_department;}else{ echo 0;}?></h4>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-primary rounded-3">
                                            <i class="ri-pencil-ruler-2-line font-size-24"></i>  
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
                            <a href="<?php echo BASEPATH;?>/patient/doctor/all">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Doctor</p>
                                        <h4 class="mb-2"><?php if(isset($number_of_active_doctor)){ echo $number_of_active_doctor;}else{ echo 0;}?></h4>
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
                            <a href="<?php echo BASEPATH;?>/patient/appointment/all-appointment-request">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Appointment Request</p>
                                        <h4 class="mb-2"><?php if(isset($number_of_appointment_request)){ echo $number_of_appointment_request;}else{ echo 0;}?></h4>
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
                            <a href="<?php echo BASEPATH;?>/patient/appointment/all">
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
                <div class="col-xl-2 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?php echo BASEPATH;?>/patient/appointment/next-visit-appointment">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Next Visit Appointment</p>
                                        <h4 class="mb-2"><?php if(isset($number_of_next_visit_appointment)){ echo $number_of_next_visit_appointment;}else{ echo 0;}?></h4>
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
                            <a href="<?php echo BASEPATH;?>/patient/report/all">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Report</p>
                                        <h4 class="mb-2"><?php if(isset($number_of_report)){ echo $number_of_report;}else{ echo 0;}?></h4>
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

        