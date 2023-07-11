<?php require_once '../body/header.php';?>
<?php require_once '../body/left_menu.php';?>

<?php
	require_once __DIR__."/../../classes/Appointment.php";
	require_once __DIR__."/../../classes/Doctor.php";

	$appointment = new Appointment();
	$doctor = new Doctor();

	$all_fee = $doctor ->get_all_active_doctor_fee($ofset=null, $limit=null, $department_id=null);

	$doctor_fee_arr =array();

	foreach($all_fee as $fee)
	{
		$doctor_fee_arr[$fee['doctor_id']] = $fee['doctor_fee'];
	}

	$all_appointment = $appointment ->get_all_appointment_for_bill($ofset=null, $limit=null,$appointment_id=null, $doctor_id=null,$nurse_id=null,$patient_id=null,$shedule_id=null,$bill_status='0');

?>
<title><?php echo $system_data_title;?> All Appointment Details</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    	<a href="<?php echo BASEPATH?>/accountant/bill/appointment-bill-all" class="btn btn-info">All Bill </a>
                        &nbsp;
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/accountant">Dashboard</a></li>
                                <li class="breadcrumb-item active">All Appointment Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                        	<?php
                        		if(isset($all_appointment) && $all_appointment>'0'){
                        	?>
		                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		                                <thead>
		                                <tr>
		                                	<th width="20">Sl</th>
		                                	<th align="center" width="40">Doctor Image</th>
		                                    <th>Doctor Name</th>
		                                    <th align="center" width="40">Patient Image</th>
		                                    <th>Patient Name</th>
		                                    <th>Appointment Number</th>
		                                    <th>Date</th>
		                                    <th width="10">Appointment Fee</th>
		                                    <th width="100">Action</th>
		                                </tr>
		                                </thead>
		                                <tbody>
		                                <?php
		                                	$i=1;
		                                	foreach($all_appointment as $appointment){

		                                		$doctor_image = "avatar.jpg";
		                                		$patient_image = "avatar.jpg";

		                                		if($appointment['doctor_image']!='')
		                                		{
		                                			$doctor_image = $appointment['doctor_image'];
		                                		}

		                                		if($appointment['patient_image']!='')
		                                		{
		                                			$patient_image = $appointment['patient_image'];
		                                		}
		                                ?>
		                                <tr>
		                                    <td align="center"><?php echo $i;?></td>
		                                    <td align="center">
		                                    	<img width="30" src="<?php echo BASEPATH."/uploads/doctor/".$doctor_image;?>">
		                                    </td>
		                                    <td><?php echo $appointment['doctor_name'];?></td>
		                                    <td align="center">
		                                    	<img width="30" src="<?php echo BASEPATH."/uploads/patient/".$patient_image;?>">
		                                    </td>
		                                    <td><?php echo $appointment['patient_name'];?></td>
		                                    <td><?php echo $appointment['appointment_number'];?></td>
		                                    <td><?php echo date("d-m-Y",strtotime($appointment['shedule_date']));?></td>
		                                    <td align="right"><?php echo $doctor_fee_arr[$appointment['doctor_id']];?></td>
		                                    <td align="center">
		                                    	<a href="<?php echo BASEPATH;?>/accountant/bill/action?id=<?php echo $appointment['appointment_id'];?>&action=appointment_bill_add_form" class="btn btn-info btn-icon mg-r-5 mg-b-10">Add Bill</a>
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