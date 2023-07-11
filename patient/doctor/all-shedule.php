<?php require_once '../body/header.php';?>
<?php require_once '../body/left_menu.php';?>

<?php
	require_once __DIR__."/../../classes/Shedule.php";

	$shedule = new Shedule();


	$id = 0;

    if(isset($_SESSION['doctor_id'])){
        
        $id = $_SESSION['doctor_id'];
    }

	$all_shedule = $shedule ->get_all_shedule($ofset=null, $limit=null,$doctor_id=$id,$nurse_id=null,$appointment_id=null);
?>
<title><?php echo $system_data_title;?> All Shedule Details</title>
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
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/patient">Dashboard</a></li>
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
		                                    <th width="100">Action</th>
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
		                                    <td>
		                                    	<a href="<?php echo BASEPATH;?>/patient/doctor/action?id=<?php echo $shedule['doctor_id'];?>&action=view_doctor"><?php echo $shedule['doctor_name'];?></a>
		                                    </td>
		                                    <td><?php echo date("d-m-Y",strtotime($shedule['shedule_date']));?></td>
		                                    <td><?php echo date("g:i a", strtotime($shedule['start_time']));?></td>
		                                    <td><?php echo date("g:i a", strtotime($shedule['end_time']));?></td>
		                                    <td align="center">
		                                    	<a href="<?php echo BASEPATH;?>/patient/doctor/action?id=<?php echo $shedule['shedule_id'];?>&action=add_appointment" class="btn btn-info btn-icon mg-r-5 mg-b-10"><i class="mdi mdi-folder-edit"></i></a>
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