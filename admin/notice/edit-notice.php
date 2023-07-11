<?php require_once __DIR__.'/../body/header.php';?>
<?php require_once __DIR__.'/../body/left_menu.php';?>

<?php
    require_once __DIR__."/../../classes/Notice.php";

    $notice = new Notice();

    $id = 0;
    if(isset($_SESSION['notice_id'])){
        $id = $_SESSION['notice_id'];
        //unset($_SESSION['notice_id']);
    }

    $single_notice = $notice ->get_single_notice($id);

    if($single_notice==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/admin/notice/404"; ?>";</script>
        <?php
    }
    else{

        $single_notice = mysqli_fetch_array($single_notice);
    }
?>
<title><?php echo $system_data_title;?> Edit Notice Details - <?php echo $single_notice['title']; ?></title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <a href="<?php echo BASEPATH?>/admin/notice/all" class="btn btn-info">All Notice</a>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/admin">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Notice Details</li>
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
                            <form method="POST" action="<?php echo BASEPATH?>/admin/notice/action" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Notice For</label>
                                    <div class="col-sm-10">
                                        <select name="user_type" id="user_type" class="form-control" required>
                                          <option value="">Select User Type</option>
                                            <option value="0">All</option>
                                            <option value="1">Patient</option>
                                            <option value="2">Doctor</option>
                                            <option value="3">Nurse</option>
                                            <option value="4">Pharmacist</option>
                                            <option value="5">Laboratorist</option>
                                            <option value="6">Accountant</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Notice Title</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="title" id="title" type="text" placeholder="Enter Notice Title" required value="<?php echo $single_notice['title']; ?>">
                                        <input class="form-control" name="action" id="action" type="hidden" required value="update_notice">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Notice Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="description" id="description" placeholder="Enter Notice Description" required><?php echo $single_notice['description']; ?></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Notice Date</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="notice_date" id="notice_date" type="date" required value="<?php echo $single_notice['notice_date']; ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Published Date</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="published_date" id="published_date" type="date" required value="<?php echo $single_notice['published_date']; ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Notice File</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="file" id="file" type="file">
                                        <input class="form-control" name="notice_file" id="notice_file" type="hidden" value="<?php echo $single_notice['file_url'];?>">
                                    </div>
                                </div>
                                <input style="float: right;" type="submit" value="Add Notice" class="btn btn-info">
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
    CKEDITOR.replace('description');

    document.getElementById("user_type").value= '<?php echo $single_notice['user_type'];?>';
</script>

<?php require_once __DIR__.'/../body/footer.php';?>
