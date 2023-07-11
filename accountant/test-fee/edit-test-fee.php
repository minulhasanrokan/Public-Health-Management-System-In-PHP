<?php require_once __DIR__.'/../body/header.php';?>
<?php require_once __DIR__.'/../body/left_menu.php';?>

<?php
    require_once __DIR__."/../../classes/Test.php";

    $test = new Test();

    $id = 0;
    if(isset($_SESSION['test_fee_id'])){
        $id = $_SESSION['test_fee_id'];
        //unset($_SESSION['test_fee_id']);
    }

    $single_test_fee = $test ->get_single_test_fee($fee_id=$id);

    if($single_test_fee==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/accountant/test-fee/404"; ?>";</script>
        <?php
    }
    else{

        $single_test_fee = mysqli_fetch_array($single_test_fee);
    }
?>
<title><?php echo $system_data_title;?> Edit Test Fee Details</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <a href="<?php echo BASEPATH?>/accountant/test-fee/all" class="btn btn-info">All Test Fee</a>
                            <a href="<?php echo BASEPATH?>/accountant/test-fee/add" class="btn btn-info">Add Test Fee</a>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/accountant">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Test Fee Details</li>
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
                            <form method="POST" action="<?php echo BASEPATH?>/accountant/test-fee/action" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">test Name</label>
                                    <div class="col-sm-10">
                                        <select name="test_id" id="test_id" class="form-control" required>
                                          <option value="">Select test Name</option>
                                            <option selected value="<?php echo $single_test_fee['test_id']?>"><?php echo $single_test_fee['test_name']?></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Doctor Fee</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="test_fee" id="test_fee" type="number" placeholder="Enter Doctor Fee" required value="<?php echo $single_test_fee['test_fee']?>">
                                        <input class="form-control" name="action" id="action" type="hidden" required value="update_test_fee">
                                        <input class="form-control" name="fee_id" id="fee_id" type="hidden" required value="<?php echo $single_test_fee['fee_id']?>">
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