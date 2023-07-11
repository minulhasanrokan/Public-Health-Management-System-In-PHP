<?php require_once 'body/header.php';?>
<?php require_once 'body/left_menu.php';?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<title><?php echo $system_data_title;?> Change Password</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Change Password</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/admin">Dashboard</a></li>
                                <li class="breadcrumb-item active">Change Password</li>
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
                            <form method="POST" action="<?php echo BASEPATH?>/admin/action" enctype="multipart/form-data" autocomplete="off">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Current Password</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="password" id="password" type="password" placeholder="Enter Current Password" required value="">
                                        <input class="form-control" name="action" id="action" type="hidden" value="update_password" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">New Password</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="new_password" id="new_password" type="password" placeholder="Enter New Password" required value="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Confirm New Password</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="c_password" id="c_password" type="password" placeholder="Enter Confirm New Password" required value="">
                                    </div>
                                </div>
                                <input style="float: right;" type="submit" value="Update Password" class="btn btn-info">
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
<?php require_once 'body/footer.php';?>