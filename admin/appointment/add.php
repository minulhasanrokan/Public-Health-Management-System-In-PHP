<?php require_once __DIR__.'/../body/header.php';?>
<?php require_once __DIR__.'/../body/left_menu.php';?>

<?php
    require_once __DIR__."/../../classes/Shedule.php";
    require_once __DIR__."/../../classes/Doctor.php";
    require_once __DIR__."/../../classes/Patient.php";

    $doctor = new Doctor();
    $shedule = new Shedule();
    $patient = new Patient();

    $id = 0;
    if(isset($_SESSION['shedule_id'])){
        $id = $_SESSION['shedule_id'];
    }

    $single_shedule = $shedule ->get_single_shedule($id,$nurse_id=null,$doctor_id=null,$appointment_id=null);

    if($single_shedule==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/admin/404"; ?>";</script>
        <?php
    }
    else{

        $single_shedule = mysqli_fetch_array($single_shedule);
    }

    $single_doctor = $doctor ->get_single_doctor($single_shedule['doctor_id']);

    if($single_doctor==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/admin/404"; ?>";</script>
        <?php
    }
    else{

        $single_doctor = mysqli_fetch_array($single_doctor);
    }

    $all_patient = $patient ->get_all_active_patient($ofset=null, $limit=null);
?>
<title><?php echo $system_data_title;?> Add Shedule Details</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <a href="<?php echo BASEPATH?>/admin/shedule/action?action=view_shedule&id=<?php echo $single_shedule['doctor_id']; ?>" class="btn btn-info">All Shedule</a>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/admin">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Shedule Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="<?php echo BASEPATH?>/admin/appointment/action" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Patient Name</label>
                                    <div class="col-sm-10">
                                        <select name="patient_id" id="patient_id" class="form-control" required>
                                            <option value="">Select Patient</option>
                                            <?php
                                                foreach($all_patient as $patient){
                                            ?>
                                            <option value="<?php echo $patient['patient_id']; ?>"><?php echo $patient['name']; ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Doctor Name</label>
                                    <div class="col-sm-10">
                                        <select readonly name="doctor_id" id="doctor_id" class="form-control" required>
                                            <option value="<?php echo $single_doctor['doctor_id']; ?>"><?php echo $single_doctor['name']; ?></option>
                                        </select>
                                        <input class="form-control" name="action" id="action" type="hidden" required value="save_appointment">
                                        <input class="form-control" name="nurse_id" value="<?php echo $single_shedule['nurse_id']; ?>" id="nurse_id" type="hidden">
                                        <input class="form-control" name="shedule_id" value="<?php echo $single_shedule['shedule_id']; ?>" id="shedule_id" type="hidden">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Shedule Date</label>
                                    <div class="col-sm-10">
                                        <input readonly class="form-control" name="shedule_date" id="shedule_date" type="date" placeholder="Shedule Date" required value="<?php echo $single_shedule['shedule_date']; ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Shedule Time</label>
                                    <div class="col-sm-5">
                                        <input readonly class="form-control" name="start_time" id="start_time" type="time" placeholder="Start Time" required value="<?php echo $single_shedule['start_time']; ?>">
                                    </div>
                                    <div class="col-sm-5">
                                        <input readonly class="form-control" name="end_time" id="end_time" type="time" placeholder="End Time" required value="<?php echo $single_shedule['end_time']; ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Appointment Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="description" id="description" placeholder="Enter Appointment Description" required></textarea>
                                    </div>
                                </div>
                                <input style="float: right;" type="submit" value="Add Appointment" class="btn btn-info">
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <?php require_once __DIR__.'/../body/footer_content.php';?>
</div>
<!-- end main content-->
<script type="text/javascript">
    CKEDITOR.replace('description');
</script>

<?php require_once __DIR__.'/../body/footer.php';?>
