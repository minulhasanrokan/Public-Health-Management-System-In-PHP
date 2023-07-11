<?php require_once __DIR__.'/../body/header.php';?>
<?php require_once __DIR__.'/../body/left_menu.php';?>


<?php
    require_once __DIR__."/../../classes/Department.php";
    require_once __DIR__."/../../classes/Floor.php";

    $department = new Department();
    $floor = new Floor();

    $id = 0;
    if(isset($_SESSION['floor_id'])){
        $id = $_SESSION['floor_id'];
        unset($_SESSION['floor_id']);
    }

    $single_floor = $floor ->get_single_floor($id);

    if($single_floor==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/admin/floor/404"; ?>";</script>
        <?php
    }
    else{

        $single_floor = mysqli_fetch_array($single_floor);
    }

    $all_department = $department ->get_all_active_department($ofset=null, $limit=null);

?>
<title><?php echo $system_data_title;?> Edit Floor Details - <?php echo $single_floor['name']; ?></title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                         <div class="page-title-left">
                            <a href="<?php echo BASEPATH?>/nurse/floor/all" class="btn btn-info">All Floor</a>
                            <a href="<?php echo BASEPATH?>/nurse/floor/add" style="margin-left: 10px;" class="btn btn-info">Add Floor </a>
                            <a href="<?php echo BASEPATH?>/nurse/floor/action?id=<?php echo $single_floor['floor_id'];?>&action=view_floor" style="margin-left: 10px;" class="btn btn-info">View Floor </a>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/nurse">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Floor Details</li>
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
                            <form method="POST" action="<?php echo BASEPATH?>/nurse/floor/action" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Floor Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="name" id="name" type="text" placeholder="Enter Floor Name" required value="<?php echo $single_floor['name']; ?>">
                                        <input class="form-control" name="action" id="action" type="hidden" value="update_floor" required>
                                        <input class="form-control" name="floor_id" id="floor_id" type="hidden" value="<?php echo $single_floor['floor_id']?>" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Doctor Department</label>
                                    <div class="col-sm-10">
                                        <select name="department" id="department" class="form-control" required>
                                          <option value="">Floor Department</option>
                                          <?php
                                            foreach($all_department as $department){
                                          ?>
                                            <option value="<?php echo $department['department_id']?>"><?php echo $department['name']?></option>
                                          <?php
                                            }
                                          ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="description" id="description" placeholder="Enter Floor Description" required><?php echo $single_floor['description']; ?></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Floor Photo</label>
                                    <div class="col-sm-10">
                                        <img class="rounded avatar-lg" src="<?php echo BASEPATH; ?>/uploads/floor/<?php if($single_floor['image']!=''){ echo $single_floor['image']; }else{ echo "avatar.jpg"; }?>"
                                    alt="Floor Photo" width="100" id="photo"/>
                                        <input onchange="readUrl(this);" accept="image/*" class="form-control" name="image" id="image" type="file" placeholder="Upload Floor Photo">
                                    </div>
                                </div>
                                <input style="float: right;" type="submit" value="Update Floor" class="btn btn-info">
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
    document.getElementById("department").value= <?php echo $single_floor['department'];?>;
</script>
<script type="text/javascript">
    CKEDITOR.replace('description');
</script>

<?php require_once __DIR__.'/../body/footer.php';?>