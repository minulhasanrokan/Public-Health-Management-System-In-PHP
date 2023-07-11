<?php require_once __DIR__.'/../body/header.php';?>
<?php require_once __DIR__.'/../body/left_menu.php';?>

<?php
    require_once __DIR__."/../../classes/Doctor.php";

    $doctor = new Doctor();

    $doctor_data = $doctor ->get_all_active_doctor($ofset=null, $limit=null, $department_id=null);

    if($doctor_data==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/admin/shedule/404"; ?>";</script>
        <?php
    }

?>
<title><?php echo $system_data_title;?> Add Shedule Details</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <a href="<?php echo BASEPATH?>/admin/shedule/all" class="btn btn-info">All Shedule</a>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/admin">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Shedule Details</li>
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
                            <form method="POST" action="<?php echo BASEPATH?>/admin/shedule/action" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Doctor Name</label>
                                    <div class="col-sm-10">
                                        <select onchange="get_nurse_by_doctor(this.value);" name="doctor_id" id="doctor_id" class="form-control" required>
                                            <option value="">Select Doctor</option>
                                            <?php
                                                foreach($doctor_data as $doctor){
                                            ?>
                                            <option value="<?php echo $doctor['doctor_id']; ?>"><?php echo $doctor['name']; ?></option>
                                        <?php } ?>
                                        </select>
                                        <input class="form-control" name="action" id="action" type="hidden" required value="add_shedule_details">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Nurse Name</label>
                                    <div class="col-sm-10" id="nurse_div">
                                        <select onchange="check_doctor(this.value);" name="nurse_id" id="nurse_id" class="form-control" required>
                                            <option value="">Select Nurse</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Shedule Date</label>
                                    <div class="col-sm-5">
                                        <input class="form-control" name="shedule_start_date" id="shedule_start_date" type="date" placeholder="Shedule Date" required value="">
                                    </div>
                                    <div class="col-sm-5">
                                        <input class="form-control" name="shedule_end_date" id="shedule_end_date" type="date" placeholder="Shedule Date" required value="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Shedule Date</label>
                                    <div class="col-sm-5">
                                        <input class="form-control" name="shedule_start_time" id="shedule_start_time" type="time" placeholder="Shedule Date" required value="">
                                    </div>
                                    <div class="col-sm-5">
                                        <input class="form-control" name="shedule_end_time" id="shedule_end_time" type="time" placeholder="Shedule Date" required value="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Shedule Time</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="total_shedule" id="total_shedule" type="number" placeholder="Total Shedule" required value="">
                                    </div>
                                </div>
                                <input style="float: right;" type="submit" value="Add Shedule" class="btn btn-info">
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
    
    function get_nurse_by_doctor(value){

        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange=function() {
            if (this.readyState == 4) {

                document.getElementById("nurse_div").innerHTML = this.responseText;
            }
        };

        if(value==''){
            
            value = 0;
        }        
        xhttp.open("GET", "action?action=get_nurse_by_doctor&&doctor_id="+value, true);
        xhttp.send();
        
    }

    function check_doctor(value){

        var doctor_value = $("$doctor_id").val();

        if(value=='' || value==0){

            alert("Please Select Doctor.");
            return;
        }
    }
</script>

<?php require_once __DIR__.'/../body/footer.php';?>
