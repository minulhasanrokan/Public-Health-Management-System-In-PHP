<?php require_once __DIR__.'/../body/header.php';?>
<?php require_once __DIR__.'/../body/left_menu.php';?>

<?php
    require_once __DIR__."/../../classes/Patient.php";
	$patient = new Patient();

	$all_patient = $patient ->get_all_active_patient_for_birth_report($ofset=null, $limit=null);
?>
<title><?php echo $system_data_title;?> Add Birth Report Details</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <a href="<?php echo BASEPATH?>/doctor/birth-report/all" class="btn btn-info">All Birth Report</a>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/doctor">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Birth Report Details</li>
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
                            <form method="POST" action="<?php echo BASEPATH?>/doctor/birth-report/action" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Select Patient</label>
                                    <div class="col-sm-10">
                                        <select name="patient_id" id="patient_id" class="form-control" required>
                                          <option value="">Select Patient</option>
                                          <?php
                                            foreach($all_patient as $patient){
                                          ?>
                                            <option value="<?php echo $patient['patient_id']?>"><?php echo $patient['name']?></option>
                                          <?php
                                            }
                                          ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Birth Date</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="report_date" id="report_date" type="date" placeholder="Birth Report Date" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Baby Gender</label>
                                    <div class="col-sm-10">
                                        <select name="sex" id="sex" class="form-control" required>
                                          <option value="">Select Baby Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Birth Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="description" id="description" placeholder="Enter Birth Report Description" required></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Birth Report File</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="image" id="image" type="file" placeholder="Upload Birth Report File">
                                    </div>
                                </div>
                                <input class="form-control" name="action" id="action" type="hidden" value="add_birth_report">
                                <input style="float: right;" type="submit" value="Add Birth Report" class="btn btn-info">
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
</script>
<?php require_once __DIR__.'/../body/footer.php';?>
