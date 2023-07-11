<?php require_once '../body/header.php';?>
<?php require_once '../body/left_menu.php';?>

<?php
    require_once __DIR__."/../../classes/Blood.php";

    $blood = new Blood();

    $id = 0;
    if(isset($_SESSION['blood_group_id'])){
        $id = $_SESSION['blood_group_id'];
        unset($_SESSION['blood_group_id']);
    }

    $single_blood_group = $blood ->get_single_blood_group($id);

    if($single_blood_group==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/nurse/blood-bank/404"; ?>";</script>
        <?php
    }
    else{

        $single_blood_group = mysqli_fetch_array($single_blood_group);
    }

?>
<title><?php echo $system_data_title;?> Edit Blood Group Details - <?php echo $single_blood_group['name']; ?></title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <a href="<?php echo BASEPATH?>/nurse/blood-bank/all" class="btn btn-info">All Blood Group </a>
                            <a href="<?php echo BASEPATH?>/nurse/blood-bank/add" style="margin-left: 10px;" class="btn btn-info">Add Blood Group</a>
                            <a href="<?php echo BASEPATH?>/nurse/blood-bank/action?id=<?php echo $single_blood_group['blood_group_id'];?>&action=view_blood_group" style="margin-left: 10px;" class="btn btn-info">View Blood Group</a>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/nurse">Dashboard</a></li>
                                <li class="breadcrumb-item active">Edit Blood Group Details</li>
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
                            <form method="POST" action="<?php echo BASEPATH?>/nurse/blood-bank/action" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="name" id="name" type="text" placeholder="Enter Name" required value="<?php echo $single_blood_group['name']; ?>">
                                        <input class="form-control" name="action" id="action" type="hidden" value="update_blood_group" required>
                                        <input class="form-control" name="blood_group_id" id="blood_group_id" type="hidden" value="<?php echo $single_blood_group['blood_group_id']; ?>" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Mobile</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="mobile" id="mobile" type="text" placeholder="Enter Mobile" required value="<?php echo $single_blood_group['mobile']; ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="email" id="email" type="text" placeholder="Enter Email" required value="<?php echo $single_blood_group['email']; ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Date Of Birth</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="date_of_birth" id="date_of_birth" type="date" placeholder="Date Of Birth" required value="<?php echo $single_blood_group['date_of_birth']; ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Date Of last Given Blood</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="date_of_last_given_blood" id="date_of_last_given_blood" type="date" placeholder="Date Of Birth" required value="<?php echo $single_blood_group['date_of_last_given_blood']; ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Blood Group</label>
                                    <div class="col-sm-10">
                                        <select name="blood_group" id="blood_group" class="form-control" required>
                                          <option value="">Select Blood Group</option>
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
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="address" id="address" placeholder="Enter Nurse Address" required><?php echo $single_blood_group['address']; ?></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="description" id="description" placeholder="Enter Nurse Description" required><?php echo $single_blood_group['description']; ?></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Photo</label>
                                    <div class="col-sm-10">
                                        <img class="rounded avatar-lg" src="<?php echo BASEPATH; ?>/uploads/blood_group/<?php if($single_blood_group['image']!=''){ echo $single_blood_group['image']; }else{ echo "avatar.jpg"; }?>"
                                    alt="<?php echo $single_blood_group['name']; ?>" width="100" id="photo"/>
                                        <input onchange="readUrl(this);" accept="image/*" class="form-control" name="image" id="image" type="file" placeholder="Upload Nurse Photo">
                                    </div>
                                </div>
                                <input style="float: right;" type="submit" value="Update Blood Group" class="btn btn-info">
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

    document.getElementById("blood_group").value= '<?php echo $single_blood_group['blood_group'];?>';
</script>
<script type="text/javascript">
    CKEDITOR.replace('address');
    CKEDITOR.replace('description');
</script>

<?php require_once '../body/footer.php';?>





        