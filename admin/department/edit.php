<?php require_once '../body/header.php';?>
<?php require_once '../body/left_menu.php';?>


<?php
    require_once __DIR__."/../../classes/Department.php";

    $department = new Department();

    $id = 0;
    if(isset($_SESSION['department_id'])){
        $id = $_SESSION['department_id'];
        unset($_SESSION['department_id']);
    }

    $single_department = $department ->get_single_department($id);

    if($single_department==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/admin/404"; ?>";</script>
        <?php
    }
    else{

        $single_department = mysqli_fetch_array($single_department);
    }

?>
<title><?php echo $system_data_title;?> Edit Department Details - <?php echo $single_department['name'];?></title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <a href="<?php echo BASEPATH?>/admin/department/all" class="btn btn-info">All Department </a>&nbsp;
                            <a href="<?php echo BASEPATH?>/admin/department/add" style="margin-left: 10px;" class="btn btn-info">Add Department </a>
                            <a href="<?php echo BASEPATH?>/admin/department/action?id=<?php echo $single_department['department_id'];?>&action=view_department" style="margin-left: 10px;" class="btn btn-info">View Department </a>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/admin">Dashboard</a></li>
                                <li class="breadcrumb-item active">Edit Department Details</li>
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
                            <form method="POST" action="<?php echo BASEPATH?>/admin/department/action" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Department Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="name" id="name" type="text" placeholder="Enter Department Name" required value="<?php echo $single_department['name'];?>">
                                        <input class="form-control" name="department_id" id="department_id" type="hidden" placeholder="Enter Department Name" required value="<?php echo $single_department['department_id'];?>">
                                        <input class="form-control" name="action" id="action" type="hidden" value="update_depertment" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Department Title</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="title" id="title" type="text" placeholder="Enter Department Title" required value="<?php echo $single_department['title'];?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Department Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="description" id="description" placeholder="Enter Department Description" required><?php echo $single_department['description'];?></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Department Photo</label>
                                    <div class="col-sm-10">
                                        <img class="rounded avatar-lg" src="<?php echo BASEPATH; ?>/uploads/department/<?php if($single_department['image']!=''){ echo $single_department['image']; }else{ echo "avatar.jpg"; }?>"
                                    alt="Department Photo" width="100" id="photo"/>
                                        <input onchange="readUrl(this);" accept="image/*" class="form-control" name="image" id="image" type="file" placeholder="Upload Department Photo">
                                    </div>
                                </div>
                                <input style="float: right;" type="submit" value="Update Department" class="btn btn-info">
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <?php require_once '../body/footer_content.php';?>
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

<?php require_once '../body/footer.php';?>





        