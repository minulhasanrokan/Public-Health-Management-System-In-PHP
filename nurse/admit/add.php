<?php require_once __DIR__.'/../body/header.php';?>
<?php require_once __DIR__.'/../body/left_menu.php';?>

<?php
    require_once __DIR__."/../../classes/Floor.php";
    require_once __DIR__."/../../classes/Appointment.php";

    $appointment = new Appointment();

    $id = 0;

    if(isset($_SESSION['appointment_id'])){
        $id = $_SESSION['appointment_id'];
    }

    $appointment = $appointment ->get_all_appointment_request($ofset=null, $limit=null,$appointment_id=$id, $doctor_id=null,$nurse_id=null,$patient_id=null,$shedule_id=null,$accept_status=1,$date_con=1,$need_to_admit=1,$admit_id=0);

    $floor = new Floor();

    $all_floor = $floor ->get_all_active_floor($ofset=null, $limit=null);

    if($appointment==''){
        
        ?>
            <script>window.location="<?php echo BASEPATH."/nurse/appointment/need-to-admit"; ?>";</script>
        <?php
    }
    else{

        $appointment = mysqli_fetch_array($appointment);
    }

?>
<title><?php echo $system_data_title;?> Add Admit Details</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <a href="<?php echo BASEPATH?>/nurse/appointment/need-to-admit" class="btn btn-info">All Need To Appointment</a>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/nurse">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Admit Details</li>
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
                            <form method="POST" action="<?php echo BASEPATH?>/nurse/admit/action" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Appointment Number</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="appointment_no" id="appointment_no" type="text" placeholder="Enter Appointment Number" required value="<?php echo $appointment['appointment_number'];?>" readonly>
                                        <input class="form-control" name="appointment_id" id="appointment_id" type="hidden" value="<?php echo $appointment['appointment_id'];?>" required>
                                        <input class="form-control" name="patient_id" id="patient_id" type="hidden" value="<?php echo $appointment['patient_id'];?>" required>
                                        <input class="form-control" name="doctor_id" id="doctor_id" type="hidden" value="<?php echo $appointment['doctor_id'];?>" required>
                                        <input class="form-control" name="action" id="action" type="hidden" value="store_admit" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Floor Number</label>
                                    <div class="col-sm-10">
                                        <select name="floor_id" id="floor_id" onchange="get_bed_by_floor(this.id,this.value);" class="form-control" required>
                                          <option value="">Select Floor Number</option>
                                          <?php
                                            foreach($all_floor as $floor){
                                          ?>
                                            <option value="<?php echo $floor['floor_id']?>"><?php echo $floor['name']?></option>
                                          <?php
                                            }
                                          ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Bed Number</label>
                                    <div class="col-sm-10" id="bed_display_id">
                                        <select name="bed_id" id="bed_id" class="form-control" required>
                                          <option value="">Select Bed Number</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Admit Date</label>
                                    <div class="col-sm-10" id="bed_display_id">
                                         <input class="form-control" name="admit_date" id="admit_date" type="date" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="description" id="description" placeholder="Enter Bed Description" required></textarea>
                                    </div>
                                </div>
                                <input style="float: right;" type="submit" value="Add New Admit" class="btn btn-info">
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

</script>
<script type="text/javascript">
    CKEDITOR.replace('address');
    CKEDITOR.replace('description');
</script>
<script type="text/javascript">
    function get_bed_by_floor(id,value){

        var data = "&floor_id="+value+"&action=get_bed_by_floor";

        http.open("POST","action",true);
        http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        http.send(data);
        http.onreadystatechange = get_bed_by_floor_reponse;
    }

    function get_bed_by_floor_reponse(){

        if(http.readyState == 4) 
        {   
          var reponse=http.responseText;

          $("#bed_display_id").html(reponse);
        }
    }

</script>

<?php require_once __DIR__.'/../body/footer.php';?>