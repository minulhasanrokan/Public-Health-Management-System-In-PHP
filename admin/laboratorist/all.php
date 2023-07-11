<?php require_once __DIR__.'/../body/header.php';?>
<?php require_once __DIR__.'/../body/left_menu.php';?>

<?php
	require_once __DIR__."/../../classes/Laboratorist.php";

	$laboratorist = new Laboratorist();

	$all_laboratorist = $laboratorist ->get_all_laboratorist($ofset=null, $limit=null);

?>
<title><?php echo $system_data_title;?> All Laboratorist Details</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <a href="<?php echo BASEPATH?>/admin/laboratorist/add" class="btn btn-info">Add Laboratorist </a>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/admin">Dashboard</a></li>
                                <li class="breadcrumb-item active">All Laboratorist Details</li>
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
                        		if(isset($all_laboratorist) && $all_laboratorist>'0'){
                        	?>
		                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		                                <thead>
		                                <tr>
		                                	<th width="20">Sl</th>
		                                	<th align="center" width="40">Image</th>
		                                    <th>Pharmacist Name</th>
		                                    <th align="center" width="100">Mobile</th>
		                                    <th align="center" width="100">Status</th>
		                                    <th width="100">Action</th>
		                                </tr>
		                                </thead>
		                                <tbody>
		                                <?php
		                                	$i=1;
		                                	foreach($all_laboratorist as $laboratorist){

		                                		$image = "avatar.jpg";

		                                		if($laboratorist['image']!='')
		                                		{
		                                			$image = $laboratorist['image'];
		                                		}
		                                ?>
		                                <tr>
		                                    <td align="center"><?php echo $i;?></td>
		                                    <td align="center">
		                                    	<img width="30" src="<?php echo BASEPATH."/uploads/laboratorist/".$image;?>">
		                                    </td>
		                                    <td><?php echo $laboratorist['name'];?></td>
		                                    <td align="center"><?php echo $laboratorist['mobile'];?></td>
		                                    <td align="center">
		                                    	<?php
		                                    	
			                                    	if($laboratorist['published_status']==1){
			                                    		echo "<span style='color:green'>Active</span>";
			                                    	}
			                                    	else{
			                                    		echo "<span style='color:red'>In Active</span>";
			                                    	}
		                                    	?>
		                                    </td>
		                                    <td align="center">
		                                    	<a href="<?php echo BASEPATH;?>/admin/laboratorist/action?id=<?php echo $laboratorist['laboratorist_id'];?>&action=edit_laboratorist" class="btn btn-info btn-icon mg-r-5 mg-b-10"><i class="mdi mdi-folder-edit"></i></a>
		                                    	<a href="<?php echo BASEPATH;?>/admin/laboratorist/action?id=<?php echo $laboratorist['laboratorist_id'];?>&action=view_laboratorist" class="btn btn-primary btn-icon mg-r-5 mg-b-10"><i class="mdi mdi-monitor-eye"></i></a>
		                                    	<a href="<?php echo BASEPATH;?>/admin/laboratorist/action?id=<?php echo $laboratorist['laboratorist_id'];?>&action=change_laboratorist_status" class="btn btn-warning btn-icon mg-r-5 mg-b-10"><i class="mdi mdi-power"></i></a>
		                                    	<a href="<?php echo BASEPATH;?>/admin/laboratorist/action?id=<?php echo $laboratorist['laboratorist_id'];?>&action=delete_laboratorist" class="btn btn-danger btn-icon mg-r-5 mg-b-10"><i class="mdi mdi-delete"></i></a>
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
    <?php require_once __DIR__.'/../body/footer_content.php';?>
</div>
<?php require_once __DIR__.'/../body/footer.php';?>





        