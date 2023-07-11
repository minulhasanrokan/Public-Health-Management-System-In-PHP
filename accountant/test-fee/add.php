<?php require_once __DIR__.'/../body/header.php';?>
<?php require_once __DIR__.'/../body/left_menu.php';?>

<?php
    require_once __DIR__."/../../classes/Test.php";

    $test = new Test();

    $all_test = $test ->get_all_active_test_in_fee($ofset=null, $limit=null,$display=0);
?>
<title><?php echo $system_data_title;?> Add Test Fee Details</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <a href="<?php echo BASEPATH?>/accountant/test-fee/all" class="btn btn-info">All Test Fee</a>
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
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Test Name</label>
                                    <div class="col-sm-10">
                                        <select name="test_id" id="test_id" class="form-control" required>
                                          <option value="">Select Test Name</option>
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
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Test Fee</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="test_fee" id="test_fee" type="number" placeholder="Enter Test Fee" required value="">
                                        <input class="form-control" name="action" id="action" type="hidden" required value="add_test_fee">
                                    </div>
                                </div>
                                <input style="float: right;" type="submit" value="Add Test Fee" class="btn btn-info">
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
