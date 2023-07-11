<?php require_once '../body/header.php';?>
<?php require_once '../body/left_menu.php';?>

<?php
    require_once __DIR__."/../../classes/Doctor.php";

    $doctor = new Doctor();

    $all_doctor = $doctor ->get_all_active_doctor($ofset=null, $limit=null);

?>
<title><?php echo $system_data_title;?> Add Nurse Details</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <a href="<?php echo BASEPATH?>/admin/nurse/all" class="btn btn-info">All Nurse </a>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/admin">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Nurse Details</li>
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
                            <form method="POST" action="<?php echo BASEPATH?>/admin/nurse/action" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Nurse Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="name" id="name" type="text" placeholder="Enter Nurse Name" required value="">
                                        <input class="form-control" name="action" id="action" type="hidden" value="add_nurse" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Nurse Speciality</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="speciality" id="speciality" type="text" placeholder="Enter Nurse Speciality" required value="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Nurse Mobile</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="mobile" id="mobile" type="text" placeholder="Enter Nurse Mobile" required value="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Nurse Email</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="email" id="email" type="text" placeholder="Enter Nurse Email" required value="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Nurse Doctor</label>
                                    <div class="col-sm-10">
                                        <select name="doctor_id" id="doctor_id" class="form-control" required>
                                          <option value="">Select Doctor</option>
                                          <?php
                                            foreach($all_doctor as $doctor){
                                          ?>
                                            <option value="<?php echo $doctor['doctor_id']?>"><?php echo $doctor['name']?></option>
                                          <?php
                                            }
                                          ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Nurse Address</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="address" id="address" placeholder="Enter Nurse Address" required></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Nurse Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="description" id="description" placeholder="Enter Nurse Description" required></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Nurse Photo</label>
                                    <div class="col-sm-10">
                                        <img class="rounded avatar-lg" src="<?php echo BASEPATH; ?>/uploads/doctor/avatar.jpg"
                                    alt="Nurse Photo" width="100" id="photo"/>
                                        <input onchange="readUrl(this);" accept="image/*" class="form-control" name="image" id="image" type="file" placeholder="Upload Nurse Photo">
                                    </div>
                                </div>
                                <input style="float: right;" type="submit" value="Add Nurse" class="btn btn-info">
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





        