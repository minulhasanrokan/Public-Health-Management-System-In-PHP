<?php require_once '../body/header.php';?>
<?php require_once '../body/left_menu.php';?>

<?php
	require_once __DIR__."/../../classes/Nurse.php";

	$nurse = new Nurse();


	$all_nurse = $nurse ->get_all_nurse_by_doctor($ofset=null, $limit=null,$_SESSION['doctorId']);

?>
<title><?php echo $system_data_title;?> All Nurse Details</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between" style="float:right;">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/doctor">Dashboard</a></li>
                                <li class="breadcrumb-item active">All Nurse Details</li>
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
                        		if(isset($all_nurse) && $all_nurse>'0'){
                        	?>
		                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		                                <thead>
		                                <tr>
		                                	<th width="20">Sl</th>
		                                	<th align="center" width="40">Image</th>
		                                    <th>Nurse Name</th>
		                                    <th>Doctor Name</th>
		                                    <th align="center" width="50">Mobile</th>
		                                    <th align="center" width="50">Status</th>
		                                    <th width="100">Action</th>
		                                </tr>
		                                </thead>
		                                <tbody>
		                                <?php
		                                	$i=1;
		                                	foreach($all_nurse as $nurse){

		                                		$image = "avatar.jpg";

		                                		if($nurse['image']!='')
		                                		{
		                                			$image = $nurse['image'];
		                                		}
		                                ?>
		                                <tr>
		                                    <td align="center"><?php echo $i;?></td>
		                                    <td align="center">
		                                    	<img width="30" src="<?php echo BASEPATH."/uploads/nurse/".$image;?>">
		                                    </td>
		                                    <td><?php echo $nurse['name'];?></td>
		                                    <td><a href="<?php echo BASEPATH;?>/doctor/nurse/action?id=<?php echo $nurse['doctor_id']; ?>&action=view_doctor"><?php echo $nurse['doctor_name'];?></a></td>
		                                    <td align="center"><?php echo $nurse['mobile'];?></td>
		                                    <td align="center">
		                                    	<?php
		                                    	
			                                    	if($nurse['published_status']==1){
			                                    		echo "<span style='color:green'>Active</span>";
			                                    	}
			                                    	else{
			                                    		echo "<span style='color:red'>In Active</span>";
			                                    	}
		                                    	?>
		                                    </td>
		                                    <td align="center">
		                                    	<a href="<?php echo BASEPATH;?>/doctor/nurse/action?id=<?php echo $nurse['nurse_id'];?>&action=view_nurse" class="btn btn-primary btn-icon mg-r-5 mg-b-10"><i class="mdi mdi-monitor-eye"></i></a>
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





        