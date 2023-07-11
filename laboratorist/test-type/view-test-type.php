<?php require_once __DIR__.'/../body/header.php';?>
<?php require_once __DIR__.'/../body/left_menu.php';?>


<?php
    require_once __DIR__."/../../classes/Test.php";

    $test = new Test();

    $id = 0;
    if(isset($_SESSION['test_id'])){
        $id = $_SESSION['test_id'];
        //unset($_SESSION['test_id']);
    }

    $single_test = $test ->get_single_test($id);

    if($single_test==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/laboratorist/test-type/404"; ?>";</script>
        <?php
    }
    else{

        $single_test = mysqli_fetch_array($single_test);
    }

?>
<title><?php echo $system_data_title;?> View Test Type Details - <?php echo $single_test['name'];?></title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <a href="<?php echo BASEPATH?>/laboratorist/test-type/all" class="btn btn-info">All Test Type </a>&nbsp;
                            <a href="<?php echo BASEPATH?>/laboratorist/test-type/add" style="margin-left: 10px;" class="btn btn-info">Add Test Type </a>
                            <a href="<?php echo BASEPATH?>/laboratorist/test-type/action?id=<?php echo $single_test['test_id'];?>&action=edit_test" style="margin-left: 10px;" class="btn btn-info">Edit Test Type </a>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/laboratorist">Dashboard</a></li>
                                <li class="breadcrumb-item active">View Test Type Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card-group">
                        <div class="card mb-12">
                            <img class="card-img-top img-fluid" style="height: 300px;" src="<?php echo BASEPATH;?>/uploads/test/<?php if($single_test['image']!=''){ echo $single_test['image']; }else{ echo "avatar.jpg"; }?>" alt="<?php echo $single_test['name']; ?>">
                            <div class="card-body">
                                <?php echo $single_test['description']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <?php require_once __DIR__.'/../body/footer_content.php';?>
</div>
<!-- end main content-->

<?php require_once __DIR__.'/../body/footer.php';?>
