<?php require_once '../body/header.php';?>
<?php require_once '../body/left_menu.php';?>

<?php

    require_once __DIR__."/../../classes/Laboratorist.php";

    $laboratorist = new Laboratorist();

    $id = 0;
    if(isset($_SESSION['laboratorist_id'])){
        $id = $_SESSION['laboratorist_id'];
        unset($_SESSION['laboratorist_id']);
    }

    $single_laboratorist = $laboratorist ->get_single_laboratorist($id);

    if($single_laboratorist==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/admin/laboratorist/404"; ?>";</script>
        <?php
    }
    else{

        $single_laboratorist = mysqli_fetch_array($single_laboratorist);
    }

?>
<title><?php echo $system_data_title;?> Edit Laboratorist Details - <?php echo $single_laboratorist['name'];?></title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <a href="<?php echo BASEPATH?>/admin/laboratorist/all" class="btn btn-info">All Laboratorist </a>&nbsp;
                            <a href="<?php echo BASEPATH?>/admin/laboratorist/add" style="margin-left: 10px;" class="btn btn-info">Add Laboratorist </a>
                            <a href="<?php echo BASEPATH?>/admin/laboratorist/action?id=<?php echo $single_laboratorist['laboratorist_id'];?>&action=view_laboratorist" style="margin-left: 10px;" class="btn btn-info">View Laboratorist </a>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/admin">Dashboard</a></li>
                                <li class="breadcrumb-item active">Edit Laboratorist Details</li>
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
                            <form method="POST" action="<?php echo BASEPATH?>/admin/laboratorist/action" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Laboratorist Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="name" id="name" type="text" placeholder="Enter Laboratorist Name" required value="<?php echo $single_laboratorist['name'];?>">
                                        <input class="form-control" name="laboratorist_id" id="laboratorist_id" type="hidden" required value="<?php echo $single_laboratorist['laboratorist_id'];?>">
                                        <input class="form-control" name="action" id="action" type="hidden" value="update_laboratorist" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Laboratorist Speciality</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="speciality" id="speciality" type="text" placeholder="Enter Laboratorist Speciality" required value="<?php echo $single_laboratorist['speciality'];?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Laboratorist Mobile</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="mobile" id="mobile" type="text" placeholder="Enter Laboratorist Mobile" required value="<?php echo $single_laboratorist['mobile'];?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Laboratorist Email</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="email" id="email" type="text" placeholder="Enter Laboratorist Email" required value="<?php echo $single_laboratorist['email'];?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Laboratorist Address</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="address" id="address" placeholder="Enter Laboratorist Address" required><?php echo $single_laboratorist['address'];?></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Laboratorist Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="description" id="description" placeholder="Enter Laboratorist Description" required><?php echo $single_laboratorist['description'];?></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Laboratorist Photo</label>
                                    <div class="col-sm-10">
                                        <img class="rounded avatar-lg" src="<?php echo BASEPATH; ?>/uploads/laboratorist/<?php if($single_laboratorist['image']!=''){ echo $single_laboratorist['image']; }else{ echo "avatar.jpg"; }?>"
                                    alt="<?php echo $single_laboratorist['name'];?>" width="100" id="photo"/>
                                        <input onchange="readUrl(this);" accept="image/*" class="form-control" name="image" id="image" type="file" placeholder="Upload Laboratorist Photo">
                                    </div>
                                </div>
                                <input style="float: right;" type="submit" value="Update Laboratorist" class="btn btn-info">
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
    CKEDITOR.replace('address');
    CKEDITOR.replace('description');
</script>

<?php require_once '../body/footer.php';?>