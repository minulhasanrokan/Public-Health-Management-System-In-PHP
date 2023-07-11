<?php require_once '../body/header.php';?>
<?php require_once '../body/left_menu.php';?>

<?php
	require_once __DIR__."/../../classes/Report.php";

	$report = new Report();

	$all_report = $report ->get_all_report($ofset=null, $limit=null,$appointment_id=null, $doctor_id=null,$patient_id=null,$date_con=null,$test_id=null);
?>
<title><?php echo $system_data_title;?> All Report Details</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        &nbsp;
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/laboratorist">Dashboard</a></li>
                                <li class="breadcrumb-item active">All Report Details</li>
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