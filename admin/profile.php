<?php require_once 'body/header.php';?>
<?php require_once 'body/left_menu.php';?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<title><?php echo $system_data_title;?> Edit Profile Details - <?php echo $user_data['name'];?></title>
<div class="main-content">
    <div class="page-content">
	    <div class="container-fluid">
	        <!-- start page title -->
	        <div class="row">
	            <div class="col-12">
	                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
	                    <h4 class="mb-sm-0">Edit Profile Details</h4>
	                    <div class="page-title-right">
	                        <ol class="breadcrumb m-0">
	                            <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/admin">Dashboard</a></li>
	                            <li class="breadcrumb-item active">Edit Profile Details</li>
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
	                        <form method="POST" action="<?php echo BASEPATH?>/admin/action" enctype="multipart/form-data">
	                            <div class="row mb-3">
	                                <label for="example-text-input" class="col-sm-2 col-form-label">Admin Name</label>
	                                <div class="col-sm-10">
	                                    <input class="form-control" name="name" id="name" value="<?php echo $user_data['name'];?>" type="text" placeholder="Enter Admin Name" required value="">
	                                    <input class="form-control" name="admin_id" id="admin_id" type="hidden" value="<?php echo $user_data['admin_id'];?>" required>
	                                    <input class="form-control" name="action" id="action" type="hidden" value="update_admin_profile" required>
	                                </div>
	                            </div>
	                            <div class="row mb-3">
	                                <label for="example-text-input" class="col-sm-2 col-form-label">Admin Mobile</label>
	                                <div class="col-sm-10">
	                                    <input class="form-control" name="mobile" id="mobile" type="text" placeholder="Enter Admin Mobile" required value="<?php echo $user_data['phone'];?>">
	                                </div>
	                            </div>
	                            <div class="row mb-3">
	                                <label for="example-text-input" class="col-sm-2 col-form-label">Admin Email</label>
	                                <div class="col-sm-10">
	                                    <input class="form-control" name="email" id="email" type="text" placeholder="Enter Admin Email" required value="<?php echo $user_data['email'];?>">
	                                </div>
	                            </div>
	                            <div class="row mb-3">
	                                <label for="example-text-input" class="col-sm-2 col-form-label">Admin Address</label>
	                                <div class="col-sm-10">
	                                    <textarea class="form-control" name="address" id="address" placeholder="Enter Admin Address" required><?php echo $user_data['address'];?></textarea>
	                                </div>
	                            </div>
	                            <div class="row mb-3">
	                                <label for="example-text-input" class="col-sm-2 col-form-label">Admin Description</label>
	                                <div class="col-sm-10">
	                                    <textarea class="form-control" name="description" id="description" placeholder="Enter Admin Description" required><?php echo $user_data['description'];?></textarea>
	                                </div>
	                            </div>

	                            <div class="row mb-3">
	                                <label for="example-text-input" class="col-sm-2 col-form-label">Admin Photo</label>
	                                <div class="col-sm-10">
	                                    <img class="rounded avatar-lg" src="<?php echo BASEPATH; ?>/uploads/users/<?php if($user_data['image']!=''){ echo $user_data['image']; } else{ echo "avatar.jpg";}?>"
                                    alt="<?php echo $user_data['name'];?>" width="100" id="photo"/>
	                                    <input onchange="readUrl(this);" accept="image/*" class="form-control" name="image" id="image" type="file" placeholder="Upload Slider Photo">
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
    <?php require_once 'body/footer_content.php';?>
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

<?php require_once 'body/footer.php';?>





        