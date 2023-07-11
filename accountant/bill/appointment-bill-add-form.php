<?php require_once __DIR__.'/../body/header.php';?>
<?php require_once __DIR__.'/../body/left_menu.php';?>

<?php
    require_once __DIR__."/../../classes/Appointment.php";
    require_once __DIR__."/../../classes/Doctor.php";

    $appointment = new Appointment();
    $doctor = new Doctor();

    $id = 0;
    if(isset($_SESSION['appointment_id'])){
        $id = $_SESSION['appointment_id'];
        //unset($_SESSION['appointment_id']);
    }

    $all_appointment = $appointment ->get_all_appointment_for_bill($ofset=null, $limit=null,$appointment_id=$id, $doctor_id=null,$nurse_id=null,$patient_id=null,$shedule_id=null,$bill_status='0');

    if($all_appointment==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/accountant/bill/appointment-bill-add"; ?>";</script>
        <?php
    }
    else{

        $appointment_fee = mysqli_fetch_array($all_appointment);
    }

    $all_fee = $doctor ->get_all_active_doctor_fee($ofset=null, $limit=null, $department_id=null);

    $doctor_fee_arr =array();

    foreach($all_fee as $fee)
    {
        $doctor_fee_arr[$fee['doctor_id']] = $fee['doctor_fee'];
    }

?>
<title><?php echo $system_data_title;?> Add Doctor Fee Bill Details</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        &nbsp;
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/accountant">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Doctor Fee Bill Details</li>
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
                            <form method="POST" action="<?php echo BASEPATH?>/accountant/bill/action" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Appointment Number</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="particular_no" id="particular_no" type="text" placeholder="Enter Appointment Number" required value="<?php echo $appointment_fee['appointment_number']; ?>" readonly>
                                        <input class="form-control" name="particular_id" id="particular_id" type="hidden" required value="<?php echo $appointment_fee['appointment_id']; ?>">
                                        <input class="form-control" name="action" id="action" type="hidden" required value="add_doctor_bill">
                                        <input class="form-control" name="bill_type" id="bill_type" type="hidden" required value="doctor_appointment_bill">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Doctor Fee</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="fee" id="fee" type="text" placeholder="Enter Doctor Fee" required value="<?php echo $doctor_fee_arr[$appointment_fee['doctor_id']]; ?>" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Bill Pay Type</label>
                                    <div class="col-sm-10">
                                        <select name="pay_type" id="pay_type" class="form-control" required>
                                          <option value="">Select Bill Pay Type</option>
                                          <option selected value="cash" >Cash</option>
                                          <option value="bikash">Bikash</option>
                                          <option value="nagod">Nagod</option>
                                        </select>
                                    </div>
                                </div>
                                <input style="float: right;" type="submit" value="Add Doctor Bill" class="btn btn-info">
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

<?php require_once __DIR__.'/../body/footer.php';?>