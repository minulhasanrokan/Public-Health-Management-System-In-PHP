<?php require_once __DIR__.'/../body/header.php';?>
<?php require_once __DIR__.'/../body/left_menu.php';?>

<?php
    require_once __DIR__."/../../classes/Floor.php";

    $floor = new Floor();

    $all_floor = $floor ->get_all_active_floor($ofset=null, $limit=null);

    $id = 0;
    if(isset($_SESSION['bed_fee_id'])){
        $id = $_SESSION['bed_fee_id'];
        //unset($_SESSION['bed_fee_id']);
    }

    $single_bed_fee = $floor ->get_all_active_bed_fee($ofset=null, $limit=null, $department_id=null, $floor_id=null, $fee_id=$id);

    if($single_bed_fee==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/accountant/bed-fee/404"; ?>";</script>
        <?php
    }
    else{

        $single_bed_fee = mysqli_fetch_array($single_bed_fee);
    }

?>
<title><?php echo $system_data_title;?> Edit Bed Fee Details</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <a href="<?php echo BASEPATH?>/accountant/bed-fee/all" class="btn btn-info">All Bed Fee</a>
                            <a href="<?php echo BASEPATH?>/accountant/bed-fee/add" class="btn btn-info">Add Bed Fee</a>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/accountant">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Bed Fee Details</li>
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
                            <form method="POST" action="<?php echo BASEPATH?>/accountant/bed-fee/action" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Floor Number</label>
                                    <div class="col-sm-10">
                                        <select name="floor_id" id="floor_id" class="form-control" required>
                                          <option value="">Select Floor Number</option>
                                            <option selected value="<?php echo $single_bed_fee['floor_id']?>"><?php echo $single_bed_fee['floor_name']?></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Bed Number</label>
                                    <div class="col-sm-10" id="bed_display_id">
                                        <select name="bed_id" id="bed_id" class="form-control" required>
                                          <option value="">Select Bed Number</option>
                                          <option selected value="<?php echo $single_bed_fee['bed_id']?>"><?php echo $single_bed_fee['bed_name']?></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Bed Fee</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="bed_fee" id="bed_fee" type="number" placeholder="Enter Bed Fee" required value="<?php echo $single_bed_fee['bed_fee']?>">
                                        <input class="form-control" name="fee_id" id="fee_id" type="hidden" required value="<?php echo $single_bed_fee['fee_id']?>">
                                        <input class="form-control" name="action" id="action" type="hidden" required value="update_bed_fee">
                                    </div>
                                </div>
                                <input style="float: right;" type="submit" value="Update Bed Fee" class="btn btn-info">
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
