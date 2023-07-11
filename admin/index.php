<?php require_once 'body/header.php';?>
<?php require_once 'body/left_menu.php';?>

<?php
    require_once __DIR__."/../classes/Nurse.php";
    require_once __DIR__."/../classes/Pharmacist.php";
    require_once __DIR__."/../classes/Medicine.php";
    require_once __DIR__."/../classes/Department.php";
    require_once __DIR__."/../classes/Laboratorist.php";
    require_once __DIR__."/../classes/Blood.php";
    require_once __DIR__."/../classes/Floor.php";
    require_once __DIR__."/../classes/Accountant.php";
    require_once __DIR__."/../classes/Patient.php";
    require_once __DIR__."/../classes/Test.php";
    require_once __DIR__."/../classes/Admit.php";
    require_once __DIR__."/../classes/Notice.php";
    require_once __DIR__."/../classes/Deadreport.php";
    require_once __DIR__."/../classes/Birthreport.php";
    require_once __DIR__."/../classes/Bill.php";
    require_once __DIR__."/../classes/Shedule.php";
    require_once __DIR__."/../classes/Appointment.php";

    $dead_report = new Deadreport();
    $number_of_dead_report = $dead_report->number_of_dead_report();

    $birth_report = new Birthreport();
    $number_of_birth_report = $birth_report->number_of_birth_report();
    
    $nurse = new Nurse();
    $number_of_nurse = $nurse->number_of_nurse();

    $accountant = new Accountant();
    $number_of_accountant = $accountant->number_of_accountant();

    $patient = new Patient();
    $number_of_patient = $patient->number_of_patient();

    $pharmacist = new Pharmacist();
    $number_of_pharmacist = $pharmacist->number_of_pharmacist();

    $medicine = new Medicine();
    $number_of_medicine_category = $medicine->number_of_pmedicine_category();
    $number_of_medicine = $medicine->number_of_medicine();

    $department = new Department();
    $number_of_department = $department->number_of_department();

    $laboratorist = new Laboratorist();
    $number_of_laboratorist = $laboratorist->number_of_laboratorist();

    $blood = new Blood();
    $number_of_blood_group = $blood->number_of_blood_group();

    $floor = new Floor();
    $number_of_floor = $floor->number_of_floor(); 
    $number_of_bed = $floor->number_of_bed();

    $test = new Test();
    $number_of_test = $test->number_of_test();

    $bill = new Bill();
    $get_all_bill = $bill->get_all_bill($ofset=null, $limit=null, $year=null);

    if($get_all_bill!=''){

        $number_of_bill = mysqli_num_rows($get_all_bill);
    }

    $admit = new Admit();
    $number_of_admit = $admit->number_of_admit($appointment_id=null, $doctor_id=null,$nurse_id=null,$patient_id=null,$release_satus=0,$start_date=null,$end_date=null,$admit_id=null);

    $admit = new Notice();
    $number_of_notice = $admit->number_of_notice($notice_for=null,$user_id=null,$notice_date=null,$published_date=null);

    $shedule = new Shedule();
    $number_of_shedule = $shedule->number_of_shedule($ofset=null, $limit=null,$doctor_id=null,$nurse_id=null,$appointment_id=null,$appointment_status=null);

    $appointment = new Appointment();
    $all_appointment = $appointment->get_all_appointment_request($ofset=null, $limit=null,$appointment_id=null, $doctor_id=null,$nurse_id=null,$patient_id=null,$shedule_id=null,$accept_status=1,$date_con=1);

    if ($all_appointment>'0') {
        $number_of_appointment = mysqli_num_rows($all_appointment);
    }

    $chart_data_display = 1; 
    $bill_display = 1;

?>
<title><?php echo $system_data_title;?> Dashboard</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-2 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?php echo BASEPATH;?>/admin/department/all">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Department</p>
                                        <h4 class="mb-2"><?php if(isset($number_of_department)){ echo $number_of_department;}else{ echo 0;}?></h4>
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
                            <a href="<?php echo BASEPATH;?>/admin/doctor/all">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Doctor</p>
                                        <h4 class="mb-2"><?php if(isset($number_of_doctor)){ echo $number_of_doctor;}else{ echo 0;}?></h4>
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
                            <a href="<?php echo BASEPATH;?>/admin/nurse/all">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Nurse</p>
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
                            <a href="<?php echo BASEPATH;?>/admin/pharmacist/all">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Pharmacist</p>
                                        <h4 class="mb-2"><?php if(isset($number_of_pharmacist)){ echo $number_of_pharmacist;}else{ echo 0;}?></h4>
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
                            <a href="<?php echo BASEPATH;?>/admin/medicine/all-category">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Medicine Category</p>
                                        <h4 class="mb-2"><?php if(isset($number_of_medicine_category)){ echo $number_of_medicine_category;}else{ echo 0;}?></h4>
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
                            <a href="<?php echo BASEPATH;?>/admin/medicine/all-medicine">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Medicine</p>
                                        <h4 class="mb-2"><?php if(isset($number_of_medicine)){ echo $number_of_medicine;}else{ echo 0;}?></h4>
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
                <div class="col-xl-2 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?php echo BASEPATH;?>/admin/laboratorist/all">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Laboratorist</p>
                                        <h4 class="mb-2"><?php if(isset($number_of_laboratorist)){ echo $number_of_laboratorist;}else{ echo 0;}?></h4>
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
                            <a href="<?php echo BASEPATH;?>/admin/blood-bank/all">
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
                            <a href="<?php echo BASEPATH;?>/admin/floor/all">
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
                            <a href="<?php echo BASEPATH;?>/admin/bed/all">
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
                <div style="display:none;" class="col-xl-2 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?php echo BASEPATH;?>/admin/accountant/all">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Accountant</p>
                                        <h4 class="mb-2"><?php if(isset($number_of_accountant)){ echo $number_of_accountant;}else{ echo 0;}?></h4>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-primary rounded-3">
                                            <i class="ri-account-circle-line font-size-24"></i>  
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
                            <a href="<?php echo BASEPATH;?>/admin/appointment/all">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">All Appointment</p>
                                        <h4 class="mb-2"><?php if(isset($number_of_appointment)){ echo $number_of_appointment;}else{ echo 0;}?></h4>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-primary rounded-3">
                                            <i class="ri-account-circle-line font-size-24"></i>  
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
                            <a href="<?php echo BASEPATH;?>/admin/patient/all">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Patient</p>
                                        <h4 class="mb-2"><?php if(isset($number_of_patient)){ echo $number_of_patient;}else{ echo 0;}?></h4>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-primary rounded-3">
                                            <i class="ri-account-circle-line font-size-24"></i>  
                                        </span>
                                    </div>
                                </div>
                            </a>                                            
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->
            <div class="row">
                <div class="col-xl-2 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?php echo BASEPATH;?>/admin/test-type/all">
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
                <div class="col-xl-2 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?php echo BASEPATH;?>/admin/admit/all">
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
                            <a href="<?php echo BASEPATH;?>/admin/notice/all">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Notice</p>
                                        <h4 class="mb-2"><?php if(isset($number_of_notice)){ echo $number_of_notice;}else{ echo 0;}?></h4>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-primary rounded-3">
                                            <i class="ri-notification-3-line font-size-24"></i>  
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
                            <a href="<?php echo BASEPATH;?>/admin/dead-report/all">
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
                            <a href="<?php echo BASEPATH;?>/admin/dead-report/all">
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
                <div style="display:none;" class="col-xl-2 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?php echo BASEPATH;?>/admin/bill/all">
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
                <div class="col-xl-2 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?php echo BASEPATH;?>/admin/shedule/all">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">All Shedule</p>
                                        <h4 class="mb-2"><?php if(isset($number_of_shedule)){ echo $number_of_shedule;}else{ echo 0;}?></h4>
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
                <div style="display: none;" class="col-xl-6">
                    <div class="card">
                        <div class="card-body pb-0">
                            <h4 class="card-title mb-4">All Bill Details</h4>
                        </div>
                        <div class="card-body py-0 px-2">
                            <div id="bill_display" class="apex-charts" dir="ltr"></div>
                        </div>
                    </div><!-- end card -->
                </div>
            </div>
            <!-- end row -->

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

        