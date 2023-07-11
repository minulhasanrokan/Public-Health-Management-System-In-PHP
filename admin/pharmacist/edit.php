<?php require_once '../body/header.php';?>
<?php require_once '../body/left_menu.php';?>

<?php

    require_once __DIR__."/../../classes/Pharmacist.php";

    $pharmacist = new Pharmacist();

    $id = 0;
    if(isset($_SESSION['pharmacist_id'])){
        $id = $_SESSION['pharmacist_id'];
        unset($_SESSION['pharmacist_id']);
    }

    $single_pharmacist = $pharmacist ->get_single_pharmacist($id);

    if($single_pharmacist==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/admin/pharmacist/404"; ?>";</script>
        <?php
    }
    else{

        $single_pharmacist = mysqli_fetch_array($single_pharmacist);
    }

?>
<title><?php echo $system_data_title;?> Edit Pharmacist Details - <?php echo $single_pharmacist['name'];?></title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <a href="<?php echo BASEPATH?>/admin/pharmacist/all" class="btn btn-info">All Pharmacist </a>&nbsp;
                            <a href="<?php echo BASEPATH?>/admin/pharmacist/add" style="margin-left: 10px;" class="btn btn-info">Add Pharmacist </a>
                            <a href="<?php echo BASEPATH?>/admin/pharmacist/action?id=<?php echo $single_pharmacist['pharmacist_id'];?>&action=view_pharmacist" style="margin-left: 10px;" class="btn btn-info">View Pharmacist </a>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/admin">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Doctor Details</li>
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
                            <form method="POST" action="<?php echo BASEPATH?>/admin/pharmacist/action" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Pharmacist Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="name" id="name" type="text" placeholder="Enter Pharmacist Name" required value="<?php echo $single_pharmacist['name'];?>">
                                        <input class="form-control" name="pharmacist_id" id="pharmacist_id" type="hidden" required value="<?php echo $single_pharmacist['pharmacist_id'];?>">
                                        <input class="form-control" name="action" id="action" type="hidden" value="update_pharmacist" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Pharmacist Speciality</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="speciality" id="speciality" type="text" placeholder="Enter Pharmacist Speciality" required value="<?php echo $single_pharmacist['speciality'];?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Pharmacist Mobile</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="mobile" id="mobile" type="text" placeholder="Enter Pharmacist Mobile" required value="<?php echo $single_pharmacist['mobile'];?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Pharmacist Email</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="email" id="email" type="text" placeholder="Enter Pharmacist Email" required value="<?php echo $single_pharmacist['email'];?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Pharmacist Address</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="address" id="address" placeholder="Enter Pharmacist Address" required><?php echo $single_pharmacist['address'];?></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Pharmacist Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="description" id="description" placeholder="Enter Pharmacist Description" required><?php echo $single_pharmacist['description'];?></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Pharmacist Photo</label>
                                    <div class="col-sm-10">
                                        <img class="rounded avatar-lg" src="<?php echo BASEPATH; ?>/uploads/pharmacist/<?php if($single_pharmacist['image']!=''){ echo $single_pharmacist['image']; }else{ echo "avatar.jpg"; }?>"
                                    alt="Pharmacist Photo" width="100" id="photo"/>
                                        <input onchange="readUrl(this);" accept="image/*" class="form-control" name="image" id="image" type="file" placeholder="Upload Pharmacist Photo">
                                    </div>
                                </div>
                                <input style="float: right;" type="submit" value="Update Pharmacist" class="btn btn-info">
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





        