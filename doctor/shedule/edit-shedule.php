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
        //unset($_SESSION['shedule_id']); 
    }

    $single_shedule = $shedule ->get_single_shedule($shedule_id,$nurse_id=null,$doctor_id=null,$appointment_id=null);

    if($single_shedule==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/doctor/shedule/404"; ?>";</script>
        <?php
    }
    else{

        $single_shedule = mysqli_fetch_array($single_shedule);
    }

    $id = 0;
    if(isset($_SESSION['doctorId'])){
        $id = $_SESSION['doctorId'];
    }

    $nurse_data = $nurse ->get_all_nurse_by_doctor($ofset=null, $limit=null,$id);

    if($nurse_data==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/doctor/shedule/404"; ?>";</script>
        <?php
    }

?>
<title><?php echo $system_data_title;?> Edit Shedule Details - <?php echo $single_shedule['single_shedule']; ?></title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <a href="<?php echo BASEPATH?>/doctor/shedule/all" class="btn btn-info">All Shedule</a>
                            <a href="<?php echo BASEPATH?>/doctor/shedule/add" style="margin-left: 10px;" class="btn btn-info">Add Shedule </a>
                            <a href="<?php echo BASEPATH?>/doctor/shedule/action?id=<?php echo $single_shedule['shedule_id'];?>&action=view_shedule" style="margin-left: 10px;" class="btn btn-info">View Shedule </a>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/doctor">Dashboard</a></li>
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
                            <form method="POST" action="<?php echo BASEPATH?>/doctor/shedule/action" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Nurse Name</label>
                                    <div class="col-sm-10">
                                        <select name="nurse_id" id="nurse_id" class="form-control" required>
                                            <option value="">Select Nurse</option>
                                            <?php
                                                foreach($nurse_data as $nurse){
                                            ?>
                                            <option value="<?php echo $nurse['nurse_id']; ?>"><?php echo $nurse['name']; ?></option>
                                        <?php } ?>
                                        </select>
                                        <input class="form-control" name="action" id="action" type="hidden" required value="update_shedule">
                                        <input class="form-control" name="doctor_id" id="doctor_id" type="hidden">
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
<script type="text/javascript">

    document.getElementById("nurse_id").value= <?php echo $single_shedule['nurse_id'];?>;
</script>

<?php require_once __DIR__.'/../body/footer.php';?>
