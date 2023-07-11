<?php require_once '../body/header.php';?>
<?php require_once '../body/left_menu.php';?>

<?php
	require_once __DIR__."/../../classes/Floor.php";

	$floor = new Floor();

	$data = null;
	if(isset($_GET['display'])){

		$data = $_GET['display'];
	}

	$all_bed = $floor ->get_all_bed($ofset=null, $limit=null,$bed_id=null,$data);

	$all_floor = $floor ->get_all_floor($ofset=null, $limit=null);


?>
<title><?php echo $system_data_title;?> All Bed Details</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    	<div class="page-title-left">
                            <a href="<?php echo BASEPATH?>/admin/bed/add" class="btn btn-info">Add Bed </a>
                            <a href="<?php echo BASEPATH?>/admin/bed/all" class="btn btn-warning">All Bed </a>
                            <?php
                            	if(isset($all_floor) && $all_floor>'0'){

                            		foreach($all_floor as $floor){
                            ?>
                            	<a href="<?php echo BASEPATH?>/admin/bed/all?display=<?php echo $floor['floor_id']; ?>" class="btn btn-primary"><?php echo $floor['name']; ?></a>
                            <?php
                            		}
                            	}
                            ?>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/admin">Dashboard</a></li>
                                <li class="breadcrumb-item active">All Bed Details</li>
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
                        		if(isset($all_bed) && $all_bed>'0'){
                        	?>
		                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		                                <thead>
		                                <tr>
		                                	<th width="20">Sl</th>
		                                	<th align="center" width="40">Image</th>
		                                    <th>Bed Name</th>
		                                    <th>Floor Name</th>
		                                    <th>Department Name</th>
		                                    <th align="center" width="50">Status</th>
		                                    <th width="100">Action</th>
		                                </tr>
		                                </thead>
		                                <tbody>
		                                <?php
		                                	$i=1;
		                                	foreach($all_bed as $bed){

		                                		$image = "avatar.jpg";

		                                		if($bed['image']!='')
		                                		{
		                                			$image = $bed['image'];
		                                		}
		                                ?>
		                                <tr>
		                                    <td align="center"><?php echo $i;?></td>
		                                    <td align="center">
		                                    	<img width="30" src="<?php echo BASEPATH."/uploads/bed/".$image;?>">
		                                    </td>
		                                    <td><?php echo $bed['name'];?></td>
		                                    <td><?php echo $bed['floor_name'];?></td>
		                                    <td><?php echo $bed['department_name'];?></td>
		                                    <td align="center">
		                                    	<?php
		                                    	
			                                    	if($bed['published_status']==1){
			                                    		echo "<span style='color:green'>Active</span>";
			                                    	}
			                                    	else{
			                                    		echo "<span style='color:red'>In Active</span>";
			                                    	}
		                                    	?>
		                                    </td>
		                                    <td align="center">
		                                    	<a href="<?php echo BASEPATH;?>/admin/bed/action?id=<?php echo $bed['bed_id'];?>&action=edit_bed" class="btn btn-info btn-icon mg-r-5 mg-b-10"><i class="mdi mdi-folder-edit"></i></a>
		                                    	<a href="<?php echo BASEPATH;?>/admin/bed/action?id=<?php echo $bed['bed_id'];?>&action=view_bed" class="btn btn-primary btn-icon mg-r-5 mg-b-10"><i class="mdi mdi-monitor-eye"></i></a>
		                                    	<a href="<?php echo BASEPATH;?>/admin/bed/action?id=<?php echo $bed['bed_id'];?>&action=change_bed_status" class="btn btn-warning btn-icon mg-r-5 mg-b-10"><i class="mdi mdi-power"></i></a>
		                                    	<a href="<?php echo BASEPATH;?>/admin/bed/action?id=<?php echo $bed['bed_id'];?>&action=delete_bed" class="btn btn-danger btn-icon mg-r-5 mg-b-10"><i class="mdi mdi-delete"></i></a>
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





        