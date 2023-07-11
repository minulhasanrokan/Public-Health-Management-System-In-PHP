<?php require_once __DIR__.'/../body/header.php';?>
<?php require_once __DIR__.'/../body/left_menu.php';?>

<?php
    require_once __DIR__."/../../classes/Patient.php";

    $patient = new Patient();

    $id = 0;
    if(isset($_SESSION['patient_id'])){
        $id = $_SESSION['patient_id'];
    }

    $single_patient = $patient ->get_single_patient($id);

    if($single_patient==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/patient/404"; ?>";</script>
        <?php
    }
    else{

        $single_patient = mysqli_fetch_array($single_patient);
    }

?>
<title><?php echo $system_data_title;?> Edit Patient Details - <?php echo $single_patient['name'];?></title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-left" style="float:left;">
                        <a href="<?php echo BASEPATH?>/admin/patient/all" class="btn btn-info">All Patient </a>&nbsp;
                        <a href="<?php echo BASEPATH?>/admin/patient/add" style="margin-left: 10px;" class="btn btn-info">Add Patient </a>
                        <a href="<?php echo BASEPATH?>/admin/patient/action?id=<?php echo $single_patient['patient_id'];?>&action=view_patient" style="margin-left: 10px;" class="btn btn-info">View Patient </a>
                    </div>
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between" style="float:right;">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/admin">Dashboard</a></li>
                                <li class="breadcrumb-item active">Edit Patient Details</li>
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
                            <form method="POST" action="<?php echo BASEPATH?>/admin/patient/action" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Patient Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="name" id="name" type="text" placeholder="Enter Patient Name" required value="<?php echo $single_patient['name'];?>">
                                        <input class="form-control" name="patient_id" id="patient_id" value="<?php echo $single_patient['patient_id'];?>" type="hidden" >
                                        <input class="form-control" name="action" id="action" type="hidden" value="update_patient" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Patient Mobile</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="mobile" id="mobile" type="text" placeholder="Enter Patient Mobile" required value="<?php echo $single_patient['mobile'];?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Patient Email</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="email" id="email" type="text" placeholder="Enter Patient Email" required value="<?php echo $single_patient['email'];?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Patient Date Of Birth</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="birth_date" id="birth_date" type="date" placeholder="Date Of Birth" required value="<?php echo $single_patient['birth_date']; ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Patient Blood Group</label>
                                    <div class="col-sm-10">
                                        <select name="blood_group" id="blood_group" class="form-control" required>
                                          <option value="">Select Patient Blood Group</option>
                                            <option value="A+">A RhD positive (A+)</option>
                                            <option value="A-">A RhD positive (A-)</option>
                                            <option value="B+">B RhD positive (B+)</option>
                                            <option value="B-">B RhD positive (B-)</option>
                                            <option value="O+">O RhD positive (O+)</option>
                                            <option value="O-">O RhD positive (O-)</option>
                                            <option value="AB+">AB RhD positive (AB+)</option>
                                            <option value="AB-">AB RhD positive (AB-)</option> 
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Patient Gender</label>
                                    <div class="col-sm-10">
                                        <select name="sex" id="sex" class="form-control" required>
                                          <option value="">Select Patient Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Patient Address</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="address" id="address" placeholder="Enter Patient Address" required><?php echo $single_patient['address'];?></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Patient Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="description" id="description" placeholder="Enter Patient Description" required><?php echo $single_patient['description'];?></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Patient Photo</label>
                                    <div class="col-sm-10">
                                        <img class="rounded avatar-lg" src="<?php echo BASEPATH; ?>/uploads/patient/<?php if($single_patient['image']!=''){ echo $single_patient['image']; }else{ echo "avatar.jpg"; }?>"
                                    alt="Patient Photo" width="100" id="photo"/>
                                        <input onchange="readUrl(this);" accept="image/*" class="form-control" name="image" id="image" type="file" placeholder="Upload Patient Photo">
                                    </div>
                                </div>
                                <input style="float: right;" type="submit" value="Update Profile" class="btn btn-info">
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

    document.getElementById("blood_group").value= '<?php echo $single_patient['blood_group'];?>';
    document.getElementById("sex").value= '<?php echo $single_patient['sex'];?>';

</script>
<script type="text/javascript">
    CKEDITOR.replace('address');
    CKEDITOR.replace('description');
</script>

<?php require_once __DIR__.'/../body/footer.php';?>
