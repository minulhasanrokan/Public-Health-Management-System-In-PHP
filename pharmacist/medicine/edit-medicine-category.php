<?php require_once __DIR__.'/../body/header.php';?>
<?php require_once __DIR__.'/../body/left_menu.php';?>

<?php
    require_once __DIR__."/../../classes/Medicine.php";

    $medicine = new Medicine();

    $id = 0;
    if(isset($_SESSION['medicine_category_id'])){
        $id = $_SESSION['medicine_category_id'];
        unset($_SESSION['medicine_category_id']);
    }

    $single_category = $medicine ->get_single_medicine_category($id);

    if($single_category==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/pharmacist/medicine/404"; ?>";</script>
        <?php
    }
    else{

        $single_category = mysqli_fetch_array($single_category);
    }

?>
<title><?php echo $system_data_title;?> Edit Medicine Category Details - <?php echo $single_category['name'];?></title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <a href="<?php echo BASEPATH?>/pharmacist/medicine/all-category" class="btn btn-info">All Medicine Category </a>
                            <a href="<?php echo BASEPATH?>/pharmacist/medicine/add-category" style="margin-left: 10px;" class="btn btn-info">Add Medicine Category </a>
                            <a href="<?php echo BASEPATH?>/pharmacist/medicine/action?id=<?php echo $single_category['category_id'];?>&action=view_medicine_category" style="margin-left: 10px;" class="btn btn-info">View Medicine Category </a>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/pharmacist">Dashboard</a></li>
                                <li class="breadcrumb-item active">Edit Medicine Category Details</li>
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
                            <form method="POST" action="<?php echo BASEPATH?>/pharmacist/medicine/action" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Category Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="name" id="name" type="text" placeholder="Enter Category Name" required value="<?php echo $single_category['name'];?>">
                                        <input class="form-control" name="action" id="action" type="hidden" value="update_medicine_category" required>
                                        <input class="form-control" name="category_id" id="category_id" type="hidden" value="<?php echo $single_category['category_id'];?>" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Category Title</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="title" id="title" type="text" placeholder="Enter Category Title" required value="<?php echo $single_category['title'];?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Category Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="description" id="description" placeholder="Enter Category Description" required><?php echo $single_category['description'];?></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Category Photo</label>
                                    <div class="col-sm-10">
                                        <img class="rounded avatar-lg" src="<?php echo BASEPATH; ?>/uploads/medicine/<?php if($single_category['image']!=''){ echo $single_category['image']; }else{ echo "avatar.jpg"; }?>" alt="<?php echo $single_category['name'];?>" width="100" id="photo"/>
                                        <input onchange="readUrl(this);" accept="image/*" class="form-control" name="image" id="image" type="file" placeholder="Upload Category Photo">
                                    </div>
                                </div>
                                <input style="float: right;" type="submit" value="Update Category" class="btn btn-info">
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





        