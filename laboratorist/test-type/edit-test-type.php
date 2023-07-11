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
<title><?php echo $system_data_title;?> Edit Test Type Details - <?php echo $single_test['name'];?></title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <a href="<?php echo BASEPATH?>/laboratorist/test-type/all" class="btn btn-info">All Test Type </a>
                            <a href="<?php echo BASEPATH?>/laboratorist/test-type/add" style="margin-left: 10px;" class="btn btn-info">Add Test Type </a>
                            <a href="<?php echo BASEPATH?>/laboratorist/test-type/action?id=<?php echo $single_test['test_id'];?>&action=view_test_type" style="margin-left: 10px;" class="btn btn-info">View Test Type </a>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/laboratorist">Dashboard</a></li>
                                <li class="breadcrumb-item active">Edit Test Type Details</li>
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
                            <form method="POST" action="<?php echo BASEPATH?>/laboratorist/test-type/action" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Test Type Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="name" id="name" type="text" placeholder="Enter Test Type Name" required value="<?php echo $single_test['name'];?>">
                                        <input class="form-control" name="action" id="action" type="hidden" value="update_test_type" required>
                                        <input class="form-control" name="test_id" id="test_id" type="hidden" value="<?php echo $single_test['test_id'];?>" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Test Type Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="description" id="description" placeholder="Enter Test Type Description" required><?php echo $single_test['description'];?></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Test Type Photo</label>
                                    <div class="col-sm-10">
                                        <img class="rounded avatar-lg" src="<?php echo BASEPATH; ?>/uploads/test/<?php if($single_test['image']!=''){ echo $single_test['image']; }else{ echo "avatar.jpg"; }?>" alt="<?php echo $single_test['name'];?>" width="100" id="photo"/>
                                        <input onchange="readUrl(this);" accept="image/*" class="form-control" name="image" id="image" type="file" placeholder="Upload Test Type Photo">
                                    </div>
                                </div>
                                <input style="float: right;" type="submit" value="Update Test Type" class="btn btn-info">
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
    function readUrl(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e){
                $('#photo').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>
<script type="text/javascript">
    CKEDITOR.replace('description');
</script>

<?php require_once __DIR__.'/../body/footer.php';?>
