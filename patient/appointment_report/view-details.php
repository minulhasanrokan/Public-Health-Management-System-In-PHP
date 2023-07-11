<?php require_once '../body/header.php';?>
<?php require_once '../body/left_menu.php';?>

<?php
	require_once __DIR__."/../../classes/Appointment.php";
	require_once __DIR__."/../../classes/Doctor.php";
    require_once __DIR__."/../../classes/Report.php";

	$appointment = new Appointment();
	$doctor = new Doctor();
    $report = new Report();

	$id = 0;
    if(isset($_SESSION['patientId'])){
        $id = $_SESSION['patientId'];
    }

   	$appointment_id  = $_SESSION['appointment_id'];

   	$appointment_details = $appointment->get_all_appointment_details($ofset=null, $limit=null,$appointment_id=$appointment_id, $doctor_id=null,$nurse_id=null,$patient_id=null,$shedule_id=null,$accept_status=1,$date_con=null,$need_to_admit=null,$next_visit_date=null,$admit_id=null);

   	$appointment_details = mysqli_fetch_array($appointment_details);

   	$single_doctor = $doctor ->get_single_doctor($appointment_details['doctor_id']);

    $single_doctor = mysqli_fetch_array($single_doctor);

    $all_report = $report ->get_all_report($ofset=null, $limit=null,$appointment_id=$appointment_id, $doctor_id=null,$patient_id=$id,$date_con=null,$test_id=null);
?>
<title><?php echo $system_data_title;?> All Appointment Report Details</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
	                        &nbsp;
	                    </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/patient">Dashboard</a></li>
                                <li class="breadcrumb-item active">All Appointment Report Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="card-group">
                        <div class="card mb-12">
                            <img class="card-img-top img-fluid" style="height: 300px;" src="<?php echo BASEPATH;?>/uploads/patient/<?php if($appointment_details['patient_image']!=''){ echo $appointment_details['patient_image']; }else{ echo "avatar.jpg"; }?>" alt="<?php echo $appointment_details['patient_name']; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card-group">
                        <div class="card mb-12">
                            <div class="card-body">
                                <h3 class="card-text">Appointment Status: <?php if($appointment_details['accept_status']==1){ echo "Accepted"; }else if($appointment_details['accept_status']==2){ echo "Rejected"; } else{ echo  "Panding"; } ?>
                                <a style="float:right;" target="_blank" href="<?php echo BASEPATH?>/patient/appointment_report/action?action=print-appointment-details&id=<?php echo $appointment_details['appointment_id'];?>" class="btn btn-info">Print Details</a></h3>
                                <h3 class="card-text">Name: <?php echo $appointment_details['patient_name']; ?></h3>
                                <h3 class="card-text">Mobile: <?php echo $appointment_details['patient_mobile']; ?></h3>
                                <h3 class="card-text">Email: <?php echo $appointment_details['patient_email']; ?></h3>
                                <h3 class="card-text">Age: <?php $bday = new DateTime( $appointment_details['birth_date']); $today = new Datetime(date('m.d.y')); $diff = $today->diff($bday); printf(' %d years, %d month, %d days', $diff->y, $diff->m, $diff->d); ?></h3>
                                <p class="card-text"><?php echo $appointment_details['address']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-12">
                    <div class="card-group">
                        <div class="card mb-12">
                            <div class="card-body">
                                <h3 class="card-text"><a href="<?php echo BASEPATH;?>/doctor/action?id=<?php echo $single_doctor['doctor_id'];?>&action=view_profile" style="text-decoration: none;">Doctor Name: <?php echo $single_doctor['name']; ?></a></h3>
                                <h3 class="card-text">Doctor Phone: <?php echo $single_doctor['mobile']; ?></h3>
                                <h3 class="card-text">Doctor Email: <?php echo $single_doctor['email']; ?></h3>
                                <h3 class="card-text">Doctor Speciality: <?php echo $single_doctor['speciality']; ?></h3>
                                <h3 class="card-text">Appointment Date: <?php echo $appointment_details['shedule_date']; ?></h3>
                                <h3 class="card-text">Appointment Time : <?php echo $appointment_details['start_time']; ?> - <?php echo $appointment_details['end_time']; ?></h3> 
                            </div>
                        </div>
                        <div class="card mb-12">
                            <h3 class="card-text">Problem Details:</h3>
                            <div class="card-body">
                                <?php echo $appointment_details['description']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($appointment_details['doctor_comment']!=''){ ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-12">
                            <h3 class="card-text">Doctor Comment Details:</h3>
                            <div class="card-body">
                                <?php echo $appointment_details['doctor_comment']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <?php
                                if(isset($all_report) && $all_report>'0'){
                            ?>
                                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th width="20">Sl</th>
                                            <th align="center" width="40">Doctor Image</th>
                                            <th>Doctor Name</th>
                                            <th align="center" width="40">Patient Image</th>
                                            <th>Patient Name</th>
                                            <th>Report Type</th>
                                            <th>Report Date</th>
                                            <th width="100">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $i=1;
                                            foreach($all_report as $report){

                                                $doctor_image = "avatar.jpg";
                                                $patient_image = "avatar.jpg";

                                                if($report['doctor_image']!='')
                                                {
                                                    $doctor_image = $report['doctor_image'];
                                                }

                                                if($report['patient_image']!='')
                                                {
                                                    $patient_image = $report['patient_image'];
                                                }
                                        ?>
                                        <tr>
                                            <td align="center"><?php echo $i;?></td>
                                            <td align="center">
                                                <img width="30" src="<?php echo BASEPATH."/uploads/doctor/".$doctor_image;?>">
                                            </td>
                                            <td><?php echo $report['doctor_name'];?></td>
                                            <td align="center">
                                                <img width="30" src="<?php echo BASEPATH."/uploads/patient/".$patient_image;?>">
                                            </td>
                                            <td><?php echo $report['patient_name'];?></td>
                                            <td><?php echo $report['test_name'];?></td>
                                            <td><?php echo date("d-m-Y",strtotime($report['report_date']));?></td>
                                            <td align="center">
                                                <a href="<?php echo BASEPATH;?>/uploads/report/<?php echo $report['image'];?>" class="btn btn-primary btn-icon mg-r-5 mg-b-10">Download</a>
                                            </td>
                                        </tr>
                                        <?php
                                                $i++;
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                            <?php
                                }
                                else{
                            ?>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->       
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <?php require_once '../body/footer_content.php';?>
</div>
<?php require_once '../body/footer.php';?>