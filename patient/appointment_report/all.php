<?php require_once '../body/header.php';?>
<?php require_once '../body/left_menu.php';?>

<?php
	require_once __DIR__."/../../classes/Report.php";

	$report = new Report();

	$id = 0;
    if(isset($_SESSION['patientId'])){
        $id = $_SESSION['patientId'];
    }

    $complete_status = null;
    if(isset($_GET['comlete_status']))
    {
    	
    	$complete_status = $_GET['comlete_status'];
    }


    $date_con = null;
    if(isset($_GET['today']))
    {
    	
    	$date_con = $_GET['today'];
    }

	$all_report = $report ->get_all_appointment_report($ofset=null, $limit=null,$appointment_id=null, $doctor_id=null,$nurse_id=null,$patient_id=$id,$date_con=$date_con,$complete_status=$complete_status,$next_visit_date=null,$doctor_comment=null);
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
	                        <a href="<?php echo BASEPATH?>/patient/appointment_report/all?comlete_status=1" class="btn btn-info">Completed</a>
	                        <a href="<?php echo BASEPATH?>/patient/appointment_report/all?comlete_status=0" class="btn btn-danger">Running</a>
	                        <a href="<?php echo BASEPATH?>/patient/appointment_report/all?today=1" class="btn btn-success">Today</a>
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
		                                	<th align="center" width="40">Appointment No</th>
		                                	<th align="center" width="40">Doctor Image</th>
		                                    <th>Doctor Name</th>
		                                    <th align="center" width="40">Patient Image</th>
		                                    <th>Patient Name</th>
		                                    <th>Status</th>
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
		                                    	<?php echo $report['appointment_number'];?>
		                                    </td>
		                                    <td align="center">
		                                    	<img width="30" src="<?php echo BASEPATH."/uploads/doctor/".$doctor_image;?>">
		                                    </td>
		                                    <td><?php echo $report['doctor_name'];?></td>
		                                    <td align="center">
		                                    	<img width="30" src="<?php echo BASEPATH."/uploads/patient/".$patient_image;?>">
		                                    </td>
		                                    <td><?php echo $report['patient_name'];?></td>
		                                    <td>
		                                    	<?php
	                                    			if($report['complete_status']==1)
	                                    			{
	                                    				echo "Completed";
	                                    			}
	                                    			else{
	                                    				echo "Running";
	                                    			}
		                                    	?>		
		                                   	</td>
		                                   	<td>
		                                   		<a href="<?php echo BASEPATH;?>/patient/appointment_report/action?id=<?php echo $report['appointment_id'];?>&action=view_details" class="btn btn-primary btn-icon mg-r-5 mg-b-10"><i class="mdi mdi-monitor-eye"></i></a>
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