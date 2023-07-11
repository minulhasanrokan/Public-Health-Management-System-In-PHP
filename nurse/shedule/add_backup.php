<?php require_once __DIR__.'/../body/header.php';?>
<?php require_once __DIR__.'/../body/left_menu.php';?>

<?php
    require_once __DIR__."/../../classes/Nurse.php";

    $nurse = new Nurse();

    $id = 0;
    if(isset($_SESSION['nurseId'])){
        $id = $_SESSION['nurseId'];
    }

    $single_nurse = $nurse ->get_single_nurse($id);

    if($single_nurse==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/nurse/404"; ?>";</script>
        <?php
    }
    else{

        $single_nurse = mysqli_fetch_array($single_nurse);
    }

?>
<title><?php echo $system_data_title;?> Add Shedule Details</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <a href="<?php echo BASEPATH?>/nurse/shedule/all" class="btn btn-info">All Shedule</a>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/nurse">Dashboard</a></li>
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
                            <form method="POST" action="<?php echo BASEPATH?>/nurse/shedule/action" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Doctor Name</label>
                                    <div class="col-sm-10">
                                        <select name="doctor_id" id="doctor_id" class="form-control" required>
                                            <option value="<?php echo $single_nurse['doctor_id']; ?>"><?php echo $single_nurse['doctor_name']; ?></option>
                                        </select>
                                        <input class="form-control" name="action" id="action" type="hidden" required value="add_shedule">
                                        <input class="form-control" name="nurse_id" id="nurse_id" type="hidden">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Shedule Date</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="shedule_date" id="shedule_date" type="date" placeholder="Shedule Date" required value="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Shedule Time</label>
                                    <div class="col-sm-5">
                                        <input class="form-control" name="start_time" id="start_time" type="time" placeholder="Start Time" required value="">
                                    </div>
                                    <div class="col-sm-5">
                                        <input class="form-control" name="end_time" id="end_time" type="time" placeholder="End Time" required value="">
                                    </div>
                                </div>
                                <input style="float: right;" type="submit" value="Add Shedule" class="btn btn-info">
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

<?php require_once __DIR__.'/../body/footer.php';?>
