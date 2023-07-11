<?php require_once '../body/header.php';?>
<?php require_once '../body/left_menu.php';?>

<?php
	require_once __DIR__."/../../classes/Shedule.php";

	$shedule = new Shedule();

	$all_shedule = $shedule ->get_all_shedule($ofset=null, $limit=null,$doctor_id=null,$nurse_id=null,$appointment_id=null,$appointment_status=1);

?>
<title><?php echo $system_data_title;?> Add Shedule Details</title>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <a href="<?php echo BASEPATH?>/admin/shedule/add" class="btn btn-info">Add Shedule </a>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/admin">Dashboard</a></li>
                                <li class="breadcrumb-item active">All Shedule Details</li>
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
                        		if(isset($all_shedule) && $all_shedule>'0'){
                        	?>
		                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		                                <thead>
		                                <tr>
		                                	<th width="20">Sl</th>
		                                	<th align="center" width="40">Image</th>
		                                    <th>Doctor Name</th>
		                                    <th>Date</th>
		                                    <th>Start Time</th>
		                                    <th>End Time</th>
		                                    <th>Appointment Status</th>
		                                </tr>
		                                </thead>
		                                <tbody>
		                                <?php
		                                	$i=1;
		                                	foreach($all_shedule as $shedule){

		                                		$image = "avatar.jpg";

		                                		if($shedule['image']!='')
		                                		{
		                                			$image = $shedule['image'];
		                                		}
		                                ?>
		                                <tr>
		                                    <td align="center"><?php echo $i;?></td>
		                                    <td align="center">
		                                    	<img width="30" src="<?php echo BASEPATH."/uploads/doctor/".$image;?>">
		                                    </td>
		                                    <td><?php echo $shedule['doctor_name'];?></td>
		                                    <td><?php echo date("d-m-Y",strtotime($shedule['shedule_date']));?></td>
		                                    <td><?php echo date("g:i a", strtotime($shedule['start_time']));?></td>
		                                    <td><?php echo date("g:i a", strtotime($shedule['end_time']));?></td>
		                                    <td><?php if( $shedule['appointment_id']!=null || $shedule['appointment_id']!=''){ ?> <a href="<?php echo BASEPATH;?>/admin/shedule/action?id=<?php echo $shedule['appointment_id'];?>&action=appointment_details" class="btn btn-info btn-icon mg-r-5 mg-b-10">View Details</a> <?php } ?></td>
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