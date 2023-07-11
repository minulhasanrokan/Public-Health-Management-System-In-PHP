<?php require_once __DIR__.'/../body/header.php';?>
<?php require_once __DIR__.'/../body/left_menu.php';?>

<?php
    require_once __DIR__."/../../classes/Patient.php";
	$patient = new Patient();

	$all_patient = $patient ->get_all_active_patient_for_dead($ofset=null, $limit=null);

?>
<title><?php echo $system_data_title;?> Add Dead Report Details</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <a href="<?php echo BASEPATH?>/nurse/dead-report/add" class="btn btn-info">All Dead Report</a>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/nurse">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Dead Report Details</li>
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
                            <form method="POST" action="<?php echo BASEPATH?>/nurse/dead-report/action" enctype="multipart/form-data">
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
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Dead Date</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="report_date" id="report_date" type="date" placeholder="Dead Report Date" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Dead Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="description" id="description" placeholder="Enter Dead Report Description" required></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Dead Report File</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="image" id="image" type="file" placeholder="Upload Dead Report File">
                                    </div>
                                </div>
                                <input class="form-control" name="action" id="action" type="hidden" value="add_dead_report">
                                <input style="float: right;" type="submit" value="Add Dead Report" class="btn btn-info">
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
