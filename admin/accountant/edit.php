<?php require_once '../body/header.php';?>
<?php require_once '../body/left_menu.php';?>

<?php

    require_once __DIR__."/../../classes/Accountant.php";

    $accountant = new Accountant();

    $id = 0;
    if(isset($_SESSION['accountant_id'])){
        $id = $_SESSION['accountant_id'];
        unset($_SESSION['accountant_id']);
    }

    $single_accountant = $accountant ->get_single_accountant($id);

    if($single_accountant==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/admin/accountant/404"; ?>";</script>
        <?php
    }
    else{

        $single_accountant = mysqli_fetch_array($single_accountant);
    }

?>
<title><?php echo $system_data_title;?> Edit Accountant Details - <?php echo $single_accountant['name'];?></title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <a href="<?php echo BASEPATH?>/admin/accountant/all" class="btn btn-info">All Accountant </a>&nbsp;
                            <a href="<?php echo BASEPATH?>/admin/accountant/add" style="margin-left: 10px;" class="btn btn-info">Add Accountant </a>
                            <a href="<?php echo BASEPATH?>/admin/accountant/action?id=<?php echo $single_accountant['accountant_id'];?>&action=view_accountant" style="margin-left: 10px;" class="btn btn-info">View Accountant </a>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/admin">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Accountant Details</li>
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
                            <form method="POST" action="<?php echo BASEPATH?>/admin/accountant/action" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Accountant Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="name" id="name" type="text" placeholder="Enter Accountant Name" required value="<?php echo $single_accountant['name'];?>">
                                        <input class="form-control" name="accountant_id" id="accountant_id" type="hidden" placeholder="Enter Doctor Name" required value="<?php echo $single_accountant['accountant_id'];?>">
                                        <input class="form-control" name="action" id="action" type="hidden" value="update_accountant" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Accountant Speciality</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="speciality" id="speciality" type="text" placeholder="Enter Accountant Speciality" required value="<?php echo $single_accountant['speciality'];?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Accountant Mobile</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="mobile" id="mobile" type="text" placeholder="Enter Accountant Mobile" required value="<?php echo $single_accountant['mobile'];?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Accountant Email</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="email" id="email" type="text" placeholder="Enter Accountant Email" required value="<?php echo $single_accountant['email'];?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Accountant Address</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="address" id="address" placeholder="Enter Accountant Address" required><?php echo $single_accountant['address'];?></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Accountant Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="description" id="description" placeholder="Enter Accountant Description" required><?php echo $single_accountant['description'];?></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Accountant Photo</label>
                                    <div class="col-sm-10">
                                        <img class="rounded avatar-lg" src="<?php echo BASEPATH; ?>/uploads/accountant/<?php if($single_accountant['image']!=''){ echo $single_accountant['image']; }else{ echo "avatar.jpg"; }?>" alt="Accountant Photo" width="100" id="photo"/>
                                        <input onchange="readUrl(this);" accept="image/*" class="form-control" name="image" id="image" type="file" placeholder="Upload Accountant Photo">
                                    </div>
                                </div>
                                <input style="float: right;" type="submit" value="Update Accountant" class="btn btn-info">
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





        