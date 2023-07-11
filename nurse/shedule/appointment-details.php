<?php require_once '../body/header.php';?>
<?php require_once '../body/left_menu.php';?>


<?php
    require_once __DIR__."/../../classes/Appointment.php";
    require_once __DIR__."/../../classes/Patient.php";
    require_once __DIR__."/../../classes/Doctor.php";

    $appointment = new Appointment();
    $patient = new Patient();
    $doctor = new Doctor();

    $id = 0;
    if(isset($_SESSION['appointment_id'])){
        $id = $_SESSION['appointment_id'];
        //unset($_SESSION['pharmacist_id']);
    }

    $single_appointment = $appointment ->get_single_appointment($id);

    if($single_appointment==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/nurse/pharmacist/404"; ?>";</script>
        <?php
    }
    else{

        $single_appointment = mysqli_fetch_array($single_appointment);
    }

    $single_patient = $patient ->get_single_patient($single_appointment['patient_id']);

    $single_patient = mysqli_fetch_array($single_patient);

    $single_doctor = $doctor ->get_single_doctor($single_appointment['doctor_id']);

    $single_doctor = mysqli_fetch_array($single_doctor);

?>
<title><?php echo $system_data_title;?> View Appointment Details - <?php echo $single_appointment['appointment_number']; ?></title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <a href="<?php echo BASEPATH?>/nurse/appointment/all" class="btn btn-info">All Appointment </a>&nbsp;
                            <a href="<?php echo BASEPATH?>/nurse/appointment/add" style="margin-left: 10px;" class="btn btn-info">Add Appointment</a>
                            <?php if($single_appointment['accept_status']==0){ ?>
                            <a href="<?php echo BASEPATH;?>/nurse/appointment/action?id=<?php echo $single_appointment['appointment_id'];?>&action=accept_appointment" class="btn btn-info btn-icon mg-r-5 mg-b-10"><i class="mdi mdi-check"></i></a>
                            <a href="<?php echo BASEPATH;?>/nurse/appointment/action?id=<?php echo $single_appointment['appointment_id'];?>&action=reject_appointment" class="btn btn-danger btn-icon mg-r-5 mg-b-10"><i class="mdi mdi-delete"></i></a>
                        <?php }?>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/nurse">Dashboard</a></li>
                                <li class="breadcrumb-item active">View Appointment Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-4">
                    <div class="card-group">
                        <div class="card mb-12">
                            <img class="card-img-top img-fluid" style="height: 300px;" src="<?php echo BASEPATH;?>/uploads/patient/<?php if($single_patient['image']!=''){ echo $single_patient['image']; }else{ echo "avatar.jpg"; }?>" alt="<?php echo $single_patient['name']; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card-group">
                        <div class="card mb-12">
                            <div class="card-body">
                                <h3 class="card-text">Appointment Status: <?php if($single_appointment['accept_status']==1){ echo "Accepted"; }else if($single_appointment['accept_status']==2){ echo "Rejected"; } else{ echo  "Panding"; } ?></h3>
                                <h3 class="card-text">Name: <?php echo $single_patient['name']; ?></h3>
                                <h3 class="card-text">Mobile: <?php echo $single_patient['mobile']; ?></h3>
                                <h3 class="card-text">Email: <?php echo $single_patient['email']; ?></h3>
                                <h3 class="card-text">Age: <?php $bday = new DateTime( $single_patient['birth_date']); $today = new Datetime(date('m.d.y')); $diff = $today->diff($bday); printf(' %d years, %d month, %d days', $diff->y, $diff->m, $diff->d); ?></h3>
                                <p class="card-text"><?php echo $single_patient['address']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-12">
                    <div class="card-group">
                        <div class="card mb-12">
                            <div class="card-body">
                                <h3 class="card-text"><a href="<?php echo BASEPATH;?>/nurse/doctor/action?id=<?php echo $single_doctor['doctor_id'];?>&action=view_doctor" style="text-decoration: none;">Doctor Name: <?php echo $single_doctor['name']; ?></a></h3>
                                <h3 class="card-text">Doctor Phone: <?php echo $single_doctor['mobile']; ?></h3>
                                <h3 class="card-text">Doctor Email: <?php echo $single_doctor['email']; ?></h3>
                                <h3 class="card-text">Doctor Speciality: <?php echo $single_doctor['speciality']; ?></h3>
                                <h3 class="card-text">Appointment Date: <?php echo $single_appointment['shedule_date']; ?></h3>
                                <h3 class="card-text">Appointment Time : <?php echo $single_appointment['start_time']; ?> - <?php echo $single_appointment['end_time']; ?></h3> 
                            </div>
                        </div>
                        <div class="card mb-12">
                            <h3 class="card-text">Problem Details:</h3>
                            <div class="card-body">
                                <?php echo $single_appointment['description']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <?php require_once __DIR__.'/../body/footer_content.php';?>
</div>
<!-- end main content-->

<?php require_once __DIR__.'/../body/footer.php';?>
