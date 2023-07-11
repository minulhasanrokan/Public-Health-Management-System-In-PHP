<?php require_once __DIR__.'/../body/header.php';?>
<?php require_once __DIR__.'/../body/left_menu.php';?>

<?php
    require_once __DIR__."/../../classes/Shedule.php";
    require_once __DIR__."/../../classes/Nurse.php";

    $shedule = new Shedule();
    $nurse = new Nurse();

    $shedule_id = 0;
    if(isset($_SESSION['shedule_id'])){
        $shedule_id = $_SESSION['shedule_id'];
        unset($_SESSION['shedule_id']); 
    }

    $single_shedule = $shedule ->get_single_shedule($shedule_id,$nurse_id=null,$doctor_id=null,$appointment_id=null);

    if($single_shedule==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/nurse/shedule//404"; ?>";</script>
        <?php
    }
    else{

        $single_shedule = mysqli_fetch_array($single_shedule);
    }

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
<title><?php echo $system_data_title;?> Edit Shedule Details - <?php echo $single_shedule['shedule_date']; ?></title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <a href="<?php echo BASEPATH?>/nurse/shedule/all" class="btn btn-info">All Shedule</a>
                            <a href="<?php echo BASEPATH?>/nurse/shedule/add" style="margin-left: 10px;" class="btn btn-info">Add Shedule </a>
                            <a href="<?php echo BASEPATH?>/nurse/shedule/action?id=<?php echo $single_shedule['shedule_id'];?>&action=view_shedule" style="margin-left: 10px;" class="btn btn-info">View Shedule </a>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/nurse">Dashboard</a></li>
                                <li class="breadcrumb-item active">Edit Shedule Details</li>
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
                                        <input class="form-control" name="action" id="action" type="hidden" required value="update_shedule">
                                        <input class="form-control" name="nurse_id" id="nurse_id" type="hidden">
                                        <input class="form-control" name="shedule_id" id="shedule_id" value="<?php echo $single_shedule['shedule_id'];?>" type="hidden">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Shedule Date</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="shedule_date" id="shedule_date" type="date" placeholder="Shedule Date" required value="<?php echo $single_shedule['shedule_date'];?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Shedule Time</label>
                                    <div class="col-sm-5">
                                        <input class="form-control" name="start_time" id="start_time" type="time" value="<?php echo $single_shedule['start_time'];?>" placeholder="Start Time" required value="">
                                    </div>
                                    <div class="col-sm-5">
                                        <input class="form-control" name="end_time" id="end_time" type="time" value="<?php echo $single_shedule['end_time'];?>" placeholder="End Time" required value="">
                                    </div>
                                </div>
                                <input style="float: right;" type="submit" value="Update Shedule" class="btn btn-info">
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
