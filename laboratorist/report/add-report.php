<?php require_once __DIR__.'/../body/header.php';?>
<?php require_once __DIR__.'/../body/left_menu.php';?>

<?php
    require_once __DIR__."/../../classes/Appointment.php";
    require_once __DIR__."/../../classes/Test.php";

    $appointment = new Appointment();
    $test = new Test();

    $id = 0;
    if(isset($_SESSION['appointment_id'])){
        $id = $_SESSION['appointment_id'];
    }

    $single_appointment = $appointment ->get_all_appointment_for_add_report($ofset=null, $limit=null,$appointment_id=$id, $doctor_id=null,$nurse_id=null,$patient_id=null,$shedule_id=null,$accept_status=1,$date_con=null,$doctor_comment=1,$report_status='0');

    if($single_appointment==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/laboratorist/report/add"; ?>";</script>
        <?php
    }
    else{

        $single_appointment = mysqli_fetch_array($single_appointment);
    }

    $all_test = $test ->get_all_test_type($ofset=null, $limit=null);

?>
<title><?php echo $system_data_title;?> Add Report Details</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <a href="<?php echo BASEPATH?>/laboratorist/report/add" class="btn btn-info">All Appointment</a>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/laboratorist">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Report Details</li>
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
                            <form method="POST" action="<?php echo BASEPATH?>/laboratorist/report/action" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Appointment Number</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="appointment_no" id="appointment_no" type="text" placeholder="Appointment Number" required value="<?php echo $single_appointment['appointment_number']; ?>" readonly>
                                        <input class="form-control" name="appointment_id" id="appointment_id" type="hidden" required value="<?php echo $single_appointment['appointment_id']; ?>">
                                        <input class="form-control" name="action" id="action" type="hidden" required value="store_report">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Doctor Name</label>
                                    <div class="col-sm-10">
                                        <select name="doctor_id" id="doctor_id" class="form-control" required>
                                            <option value="<?php echo $single_appointment['doctor_id']; ?>"><?php echo $single_appointment['doctor_name']; ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Patient Name</label>
                                    <div class="col-sm-10">
                                        <select name="patient_id" id="patient_id" class="form-control" required>
                                            <option value="<?php echo $single_appointment['patient_id']; ?>"><?php echo $single_appointment['patient_name']; ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Test Type</label>
                                    <div class="col-sm-10">
                                        <select name="test_id" id="test_id" class="form-control" required>
                                          <option value="">Select Test</option>
                                          <?php
                                            foreach($all_test as $test){
                                          ?>
                                            <option value="<?php echo $test['test_id']?>"><?php echo $test['name']?></option>
                                          <?php
                                            }
                                          ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Report Date</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="report_date" id="report_date" type="date" placeholder="Report Date" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Report Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="description" id="description" placeholder="Enter Report Description" required></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Report File</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="image" id="image" type="file" placeholder="Upload Report File" required>
                                    </div>
                                </div>
                                <input style="float: right;" type="submit" value="Add Report" class="btn btn-info">
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
