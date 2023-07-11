<?php require_once __DIR__.'/body/header.php';?>
<?php require_once __DIR__.'/body/left_menu.php';?>

<?php
    require_once __DIR__."/../classes/Doctor.php";
    require_once __DIR__."/../classes/Nurse.php";

    $doctor = new Doctor();
    $nurse = new Nurse();

    $id = 0;
    if(isset($_SESSION['nurseId'])){
        $id = $_SESSION['nurseId'];
    }

    $single_nurse = $nurse ->get_single_nurse($id);

    if($single_nurse==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/nurse/404"; ?>";</script>
        <?php
    }
    else{

        $single_nurse = mysqli_fetch_array($single_nurse);
    }

    $all_doctor = $doctor ->get_all_active_doctor($ofset=null, $limit=null);
?>
<title><?php echo $system_data_title;?> Edit Profile</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between" style="float:right;">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/nurse">Dashboard</a></li>
                                <li class="breadcrumb-item active">Edit Profile</li>
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
                            <form method="POST" action="<?php echo BASEPATH?>/nurse/action" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Nurse Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="name" id="name" type="text" placeholder="Enter Nurse Name" required value="<?php echo $single_nurse['name'];?>">
                                        <input class="form-control" name="nurse_id" id="nurse_id" type="hidden" >
                                        <input class="form-control" name="action" id="action" type="hidden" value="update_nurse" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Nurse Speciality</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="speciality" id="speciality" type="text" placeholder="Enter Nurse Speciality" required value="<?php echo $single_nurse['speciality'];?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Nurse Mobile</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="mobile" id="mobile" type="text" placeholder="Enter Nurse Mobile" required value="<?php echo $single_nurse['mobile'];?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Nurse Email</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="email" id="email" type="text" placeholder="Enter Nurse Email" required value="<?php echo $single_nurse['email'];?>">
                                    </div>
                                </div>
                                <div class="row mb-3" style="display: none;">
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
                                        <textarea class="form-control" name="address" id="address" placeholder="Enter Nurse Address" required><?php echo $single_nurse['address'];?></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Nurse Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="description" id="description" placeholder="Enter Nurse Description" required><?php echo $single_nurse['description'];?></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Nurse Photo</label>
                                    <div class="col-sm-10">
                                        <img class="rounded avatar-lg" src="<?php echo BASEPATH; ?>/uploads/nurse/<?php if($single_nurse['image']!=''){ echo $single_nurse['image']; }else{ echo "avatar.jpg"; }?>"
                                    alt="Nurse Photo" width="100" id="photo"/>
                                        <input onchange="readUrl(this);" accept="image/*" class="form-control" name="image" id="image" type="file" placeholder="Upload Nurse Photo">
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
    <?php require_once __DIR__.'/body/footer_content.php';?>
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

    document.getElementById("doctor_id").value= <?php echo $single_nurse['doctor_id'];?>;
</script>

<?php require_once __DIR__.'/body/footer.php';?>





        