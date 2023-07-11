<?php require_once '../body/header.php';?>
<?php require_once '../body/left_menu.php';?>

<?php
    require_once __DIR__."/../../classes/Department.php";
    require_once __DIR__."/../../classes/Doctor.php";

    $department = new Department();
    $doctor = new Doctor();

    $id = 0;
    if(isset($_SESSION['doctor_id'])){
        $id = $_SESSION['doctor_id'];
        //unset($_SESSION['doctor_id']);
    }

    $single_doctor = $doctor ->get_single_doctor($id);

    if($single_doctor==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/admin/doctor/404"; ?>";</script>
        <?php
    }
    else{

        $single_doctor = mysqli_fetch_array($single_doctor);
    }

    $all_department = $department ->get_all_active_department($ofset=null, $limit=null);

?>
<title><?php echo $system_data_title;?> Edit Doctor Details - <?php echo $single_doctor['name'];?></title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <a href="<?php echo BASEPATH?>/admin/doctor/all" class="btn btn-info">All Doctor </a>&nbsp;
                            <a href="<?php echo BASEPATH?>/admin/doctor/add" style="margin-left: 10px;" class="btn btn-info">Add Doctor </a>
                            <a href="<?php echo BASEPATH?>/admin/doctor/action?id=<?php echo $single_doctor['doctor_id'];?>&action=view_doctor" style="margin-left: 10px;" class="btn btn-info">View Doctor </a>
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
                            <form method="POST" action="<?php echo BASEPATH?>/admin/doctor/action" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Doctor Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="name" id="name" type="text" placeholder="Enter Doctor Name" required value="<?php echo $single_doctor['name'];?>">
                                        <input class="form-control" name="doctor_id" id="doctor_id" type="hidden" placeholder="Enter Doctor Name" required value="<?php echo $single_doctor['doctor_id'];?>">
                                        <input class="form-control" name="action" id="action" type="hidden" value="update_doctor" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Doctor Speciality</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="speciality" id="speciality" type="text" placeholder="Enter Doctor Speciality" required value="<?php echo $single_doctor['speciality'];?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Doctor Mobile</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="mobile" id="mobile" type="text" placeholder="Enter Doctor Mobile" required value="<?php echo $single_doctor['mobile'];?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Doctor Email</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="email" id="email" type="text" placeholder="Enter Doctor Email" required value="<?php echo $single_doctor['email'];?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Doctor Department</label>
                                    <div class="col-sm-10">
                                        <select name="department" id="department" class="form-control" required>
                                          <option >Select Department</option>
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
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Doctor Address</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="address" id="address" placeholder="Enter Doctor Address" required><?php echo $single_doctor['address'];?></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Doctor Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="description" id="description" placeholder="Enter Doctor Description" required><?php echo $single_doctor['description'];?></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Doctor Photo</label>
                                    <div class="col-sm-10">
                                        <img class="rounded avatar-lg" src="<?php echo BASEPATH; ?>/uploads/doctor/<?php if($single_doctor['image']!=''){ echo $single_doctor['image']; }else{ echo "avatar.jpg"; }?>"
                                    alt="Doctor Photo" width="100" id="photo"/>
                                        <input onchange="readUrl(this);" accept="image/*" class="form-control" name="image" id="image" type="file" placeholder="Upload Doctor Photo">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <label for="example-text-input" style="margin-right: 40px;" class="col-sm-2 col-form-label">All Certificate</label>
                                        <?php
                                            $image_arr = explode("***",$single_doctor['certificate']);
                                            $i=1;

                                            foreach($image_arr as $img){

                                                if($img!=''){

                                                    ?>
                                                        <a id="deleteid_<?php echo $i;?>" onclick="remove_image(<?php echo $i;?>);" class="btn btn-primary"><i class="mdi mdi-delete"></i></a><img id="imageid_<?php echo $i;?>" width="50" src="<?php echo BASEPATH; ?>/uploads/doctor/<?php echo $img;?>" >
                                                        <input class="form-control" name="imagevalue[]" id="imagevalue_<?php echo $i;?>" type="hidden" value="<?php echo $img;?>" required>
                                                    <?php

                                                    $i++;
                                                }
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Doctor Certificate</label>
                                    <div class="col-sm-10">
                                        <input accept="image/*" multiple class="form-control" name="certificate[]" id="certificate" type="file" placeholder="Upload Doctor Certificate">
                                    </div>
                                </div>

                                <input class="form-control" name="hidden_image" id="hidden_image" type="hidden">
                                <input class="form-control" name="hidden_all_image" id="hidden_all_image" type="hidden" value="<?php echo $single_doctor['certificate']; ?>" required>

                                <input style="float: right;" type="submit" value="Update Doctor" class="btn btn-info">
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

    document.getElementById("department").value= <?php echo $single_doctor['department'];?>;
</script>
 
<script type="text/javascript">
    
    function remove_image(id) {
        
        var hidden_image_value = $('#hidden_image').val();
        var image_name = $('#imagevalue_'+id).val();
        if(hidden_image_value!=''){
            hidden_image_value =hidden_image_value+"***"+image_name;
        }
        else{
            hidden_image_value =image_name;
        }
        $('#hidden_image').val(hidden_image_value);
        $('#deleteid_'+id).remove();
        $('#imageid_'+id).remove();
        $('#imagevalue_'+id).remove();
    }
</script>

<?php require_once '../body/footer.php';?>





        