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
<title><?php echo $system_data_title;?> View Department Details - <?php echo $single_department['name'];?></title>
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
                            <a href="<?php echo BASEPATH?>/admin/department/action?id=<?php echo $single_department['department_id'];?>&action=edit_department" style="margin-left: 10px;" class="btn btn-info">Edit Department </a>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/admin">Dashboard</a></li>
                                <li class="breadcrumb-item active">View Department Details</li>
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
                            <img class="card-img-top img-fluid" style="height: 300px;" src="<?php echo BASEPATH;?>/uploads/department/<?php if($single_department['image']!=''){ echo $single_department['image']; }else{ echo "avatar.jpg"; }?>" alt="<?php echo $single_department['name']; ?>">
                            <div class="card-body">
                                <h3 class="card-text"><?php echo $single_department['name']; ?></h3>
                                <h4 class="card-text"><?php echo $single_department['title']; ?></h4>
                                <?php echo $single_department['description']; ?>
                            </div>
                        </div>
                    </div>
                </div>
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





        