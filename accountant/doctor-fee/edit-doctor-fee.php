<?php require_once __DIR__.'/../body/header.php';?>
<?php require_once __DIR__.'/../body/left_menu.php';?>

<?php
    require_once __DIR__."/../../classes/Doctor.php";

    $doctor = new Doctor();

    $id = 0;
    if(isset($_SESSION['doctor_fee_id'])){
        $id = $_SESSION['doctor_fee_id'];
        //unset($_SESSION['doctor_fee_id']);
    }

    $single_doctor_fee = $doctor ->get_single_doctor_fee($department_id=null,$fee_id=$id);

    if($single_doctor_fee==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/accountant/doctor-fee/404"; ?>";</script>
        <?php
    }
    else{

        $single_doctor_fee = mysqli_fetch_array($single_doctor_fee);
    }
?>
<title><?php echo $system_data_title;?> Edit Doctor Fee Details</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <a href="<?php echo BASEPATH?>/accountant/doctor-fee/all" class="btn btn-info">All Doctor Fee</a>
                            <a href="<?php echo BASEPATH?>/accountant/doctor-fee/add" class="btn btn-info">Add Doctor Fee</a>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/accountant">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Doctor Fee Details</li>
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
                            <form method="POST" action="<?php echo BASEPATH?>/accountant/doctor-fee/action" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Doctor Name</label>
                                    <div class="col-sm-10">
                                        <select name="doctor_id" id="doctor_id" class="form-control" required>
                                          <option value="">Select Doctor Name</option>
                                            <option selected value="<?php echo $single_doctor_fee['doctor_id']?>"><?php echo $single_doctor_fee['name']?></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Doctor Fee</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="doctor_fee" id="doctor_fee" type="number" placeholder="Enter Doctor Fee" required value="<?php echo $single_doctor_fee['doctor_fee']?>">
                                        <input class="form-control" name="action" id="action" type="hidden" required value="update_doctor_fee">
                                        <input class="form-control" name="fee_id" id="fee_id" type="hidden" required value="<?php echo $single_doctor_fee['fee_id']?>">
                                    </div>
                                </div>
                                <input style="float: right;" type="submit" value="Update Doctor Fee" class="btn btn-info">
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