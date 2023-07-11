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
            <script>window.location="<?php echo BASEPATH."/doctor/pharmacist/404"; ?>";</script>
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
                            <a href="<?php echo BASEPATH?>/doctor/appointment/all" class="btn btn-info">All Appointment </a>&nbsp;
                            <a href="<?php echo BASEPATH?>/doctor/appointment/add" style="margin-left: 10px;" class="btn btn-info">Add Appointment</a>
                            <?php if($single_appointment['accept_status']==0){ ?>
                            <a href="<?php echo BASEPATH;?>/doctor/appointment/action?id=<?php echo $single_appointment['appointment_id'];?>&action=accept_appointment" class="btn btn-info btn-icon mg-r-5 mg-b-10"><i class="mdi mdi-check"></i></a>
                            <a href="<?php echo BASEPATH;?>/doctor/appointment/action?id=<?php echo $single_appointment['appointment_id'];?>&action=reject_appointment" class="btn btn-danger btn-icon mg-r-5 mg-b-10"><i class="mdi mdi-delete"></i></a>
                        <?php }?>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/doctor">Dashboard</a></li>
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
                                <h3 class="card-text"><a href="<?php echo BASEPATH;?>/doctor/action?id=<?php echo $single_doctor['doctor_id'];?>&action=view_profile" style="text-decoration: none;">Doctor Name: <?php echo $single_doctor['name']; ?></a></h3>
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
            <hr/>
            <div class="row">
                <div class="col-12">
                    <div class="card-group">
                        <div class="card mb-12">
                            <div class="card-body">
                                <form method="POST" action="<?php echo BASEPATH?>/doctor/appointment/action" enctype="multipart/form-data">
                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">Need To Admit</label>
                                        <div class="col-sm-10">
                                            <select name="need_to_admit" id="need_to_admit" class="form-control" required>
                                              <option value="">Select</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">Doctor Comment</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="doctor_comment" id="doctor_comment" placeholder="Enter Doctor Comment" required><?php echo $single_appointment['doctor_comment'];?></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">Next Visit Date</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" name="next_visit_date" id="next_visit_date" type="date" placeholder="Next Visit Date" value="<?php echo $single_appointment['next_visit_date'];?>">
                                        </div>
                                    </div>
                                    <input type="hidden" id="action" name="action" value="add_doctor_comment">
                                    <input type="hidden" id="appointment_id" name="appointment_id" value="<?php echo $single_appointment['appointment_id'];?>">
                                    <input style="float: right;" type="submit" value="Submit" class="btn btn-info">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            </div>        
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <script type="text/javascript">
        CKEDITOR.replace('doctor_comment');
        document.getElementById("need_to_admit").value= <?php echo $single_appointment['need_to_admit'];?>;
    </script>
    <?php require_once __DIR__.'/../body/footer_content.php';?>
</div>
<!-- end main content-->

<?php require_once __DIR__.'/../body/footer.php';?>
