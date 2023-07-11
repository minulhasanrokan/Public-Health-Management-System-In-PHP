<?php require_once __DIR__.'/../body/header.php';?>
<?php require_once __DIR__.'/../body/left_menu.php';?>

<?php
    require_once __DIR__."/../../classes/Department.php";

    $department = new Department();

    $all_department = $department ->get_all_active_department($ofset=null, $limit=null);

?>
<title><?php echo $system_data_title;?> Add Pharmacist Details</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <a href="<?php echo BASEPATH?>/admin/pharmacist/all" class="btn btn-info">All Pharmacist </a>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/admin">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Pharmacist Details</li>
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
                                        <input class="form-control" name="name" id="name" type="text" placeholder="Enter Pharmacist Name" required value="">
                                        <input class="form-control" name="action" id="action" type="hidden" value="add_pharmacist" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Pharmacist Speciality</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="speciality" id="speciality" type="text" placeholder="Enter Pharmacist Speciality" required value="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Pharmacist Mobile</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="mobile" id="mobile" type="text" placeholder="Enter Pharmacist Mobile" required value="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Pharmacist Email</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="email" id="email" type="text" placeholder="Enter Pharmacist Email" required value="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Pharmacist Address</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="address" id="address" placeholder="Enter Pharmacist Address" required></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Pharmacist Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="description" id="description" placeholder="Enter Pharmacist Description" required></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Pharmacist Photo</label>
                                    <div class="col-sm-10">
                                        <img class="rounded avatar-lg" src="<?php echo BASEPATH; ?>/uploads/pharmacist/avatar.jpg"
                                    alt="Pharmacist Photo" width="100" id="photo"/>
                                        <input onchange="readUrl(this);" accept="image/*" class="form-control" name="image" id="image" type="file" placeholder="Upload Pharmacist Photo">
                                    </div>
                                </div>
                                <input style="float: right;" type="submit" value="Add Pharmacist" class="btn btn-info">
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
    CKEDITOR.replace('address');
    CKEDITOR.replace('description');
</script>

<?php require_once __DIR__.'/../body/footer.php';?>





        