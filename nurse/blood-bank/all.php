<?php require_once '../body/header.php';?>
<?php require_once '../body/left_menu.php';?>

<?php
	require_once __DIR__."/../../classes/Blood.php";

	$blood = new Blood();

	if(isset($_GET['display']) && $_GET['display']!=''){

		if($_GET['display']=='available'){

			$all_blood_group = $blood ->get_all_blood_group_by_available($ofset=null, $limit=null, $id=null);
		}
		else{

			$data = $_GET['display'];

			$all_blood_group = $blood ->get_all_blood_group_by_group($ofset=null, $limit=null, $id=null, $data);
		}
	}
	else{

		$all_blood_group = $blood ->get_all_blood_group($ofset=null, $limit=null);
	}

?>
<title><?php echo $system_data_title;?> All Blood Group Details</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    	<div class="page-title-left">
	                        <a href="<?php echo BASEPATH?>/nurse/blood-bank/add" class="btn btn-info">Add Blood Group</a>
	                        <a href="<?php echo BASEPATH?>/nurse/blood-bank/all" class="btn btn-danger">All Blood Group</a>
	                        <a href="<?php echo BASEPATH?>/nurse/blood-bank/all?display=available" class="btn btn-primary">Available Blood Group</a>
	                        <a href="<?php echo BASEPATH?>/nurse/blood-bank/all?display=A+" class="btn btn-success">A+</a>
	                        <a href="<?php echo BASEPATH?>/nurse/blood-bank/all?display=A-" class="btn btn-warning">A-</a>
	                        <a href="<?php echo BASEPATH?>/nurse/blood-bank/all?display=B+" class="btn btn-danger">B+</a>
	                        <a href="<?php echo BASEPATH?>/nurse/blood-bank/all?display=B-" class="btn btn-info">B-</a>
	                        <a href="<?php echo BASEPATH?>/nurse/blood-bank/all?display=O+" class="btn btn-primary">O+</a>
	                        <a href="<?php echo BASEPATH?>/nurse/blood-bank/all?display=O-" class="btn btn-success">O-</a>
	                        <a href="<?php echo BASEPATH?>/nurse/blood-bank/all?display=AB+" class="btn btn-warning">AB+</a>
	                        <a href="<?php echo BASEPATH?>/nurse/blood-bank/all?display=AB-" class="btn btn-danger">AB-</a>
	                    </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/nurse">Dashboard</a></li>
                                <li class="breadcrumb-item active">All Blood Group Details</li>
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
                        		if(isset($all_blood_group) && $all_blood_group>'0'){
                        	?>
		                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		                                <thead>
		                                <tr>
		                                	<th width="20">Sl</th>
		                                	<th align="center" width="40">Image</th>
		                                    <th>Name</th>
		                                    <th>Email</th>
		                                    <th>Mobile</th>
		                                    <th>Group</th>
		                                    <th align="center" width="50">Last Given Date</th>
		                                    <th align="center" width="50">Status</th>
		                                    <th width="100">Action</th>
		                                </tr>
		                                </thead>
		                                <tbody>
		                                <?php
		                                	$i=1;
		                                	foreach($all_blood_group as $blood){

		                                		$image = "avatar.jpg";

		                                		if($blood['image']!='')
		                                		{
		                                			$image = $blood['image'];
		                                		}
		                                ?>
		                                <tr>
		                                    <td align="center"><?php echo $i;?></td>
		                                    <td align="center">
		                                    	<img width="30" src="<?php echo BASEPATH."/uploads/blood_group/".$image;?>">
		                                    </td>
		                                    <td><?php echo $blood['name'];?></td>
		                                    <td><?php echo $blood['email'];?></td>
		                                    <td><?php echo $blood['mobile'];?></td>
		                                    <td><?php echo $blood['blood_group'];?></td>
		                                    <td align="center"><?php echo date("d-m-Y", strtotime($blood['date_of_last_given_blood']));?></td>
		                                    <td align="center">
		                                    	<?php
		                                    	
			                                    	if($blood['published_status']==1){
			                                    		echo "<span style='color:green'>Active</span>";
			                                    	}
			                                    	else{
			                                    		echo "<span style='color:red'>In Active</span>";
			                                    	}
		                                    	?>
		                                    </td>
		                                    <td align="center">
		                                    	<a href="<?php echo BASEPATH;?>/nurse/blood-bank/action?id=<?php echo $blood['blood_group_id'];?>&action=edit_blood_group" class="btn btn-info btn-icon mg-r-5 mg-b-10"><i class="mdi mdi-folder-edit"></i></a>
		                                    	<a href="<?php echo BASEPATH;?>/nurse/blood-bank/action?id=<?php echo $blood['blood_group_id'];?>&action=view_blood_group" class="btn btn-primary btn-icon mg-r-5 mg-b-10"><i class="mdi mdi-monitor-eye"></i></a>
		                                    	<a href="<?php echo BASEPATH;?>/nurse/blood-bank/action?id=<?php echo $blood['blood_group_id'];?>&action=change_blood_group_status" class="btn btn-warning btn-icon mg-r-5 mg-b-10"><i class="mdi mdi-power"></i></a>
		                                    	<a href="<?php echo BASEPATH;?>/nurse/blood-bank/action?id=<?php echo $blood['blood_group_id'];?>&action=delete_blood_group" class="btn btn-danger btn-icon mg-r-5 mg-b-10"><i class="mdi mdi-delete"></i></a>
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





        