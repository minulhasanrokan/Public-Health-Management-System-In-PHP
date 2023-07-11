<?php require_once __DIR__.'/../body/header.php';?>
<?php require_once __DIR__.'/../body/left_menu.php';?>

<?php
	require_once __DIR__."/../../classes/Medicine.php";

	$medicine = new Medicine();
	$all_medicine = $medicine ->get_all_medicine($ofset=null, $limit=null);

?>
<title><?php echo $system_data_title;?> All Medicine Details</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <a href="<?php echo BASEPATH?>/admin/medicine/add-medicine" class="btn btn-info">Add Medicine </a>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/admin">Dashboard</a></li>
                                <li class="breadcrumb-item active">All Medicine Details</li>
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
                        		if(isset($all_medicine) && $all_medicine>'0'){
                        	?>
		                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		                                <thead>
		                                <tr>
		                                	<th width="20">Sl</th>
		                                	<th align="center" width="40">Image</th>
		                                    <th>Medicie Name</th>
		                                    <th>Category Name</th>
		                                    <th>Medicie Price</th>
		                                    <th align="center" width="50">Create Date</th>
		                                    <th align="center" width="50">Status</th>
		                                    <th width="100">Action</th>
		                                </tr>
		                                </thead>
		                                <tbody>
		                                <?php
		                                	$i=1;
		                                	foreach($all_medicine as $medicine){

		                                		$image = "avatar.jpg";

		                                		if($medicine['image']!='')
		                                		{
		                                			$image = $medicine['image'];
		                                		}
		                                ?>
		                                <tr>
		                                    <td align="center"><?php echo $i;?></td>
		                                    <td align="center">
		                                    	<img width="30" src="<?php echo BASEPATH."/uploads/medicine/".$image;?>">
		                                    </td>
		                                    <td><?php echo $medicine['name'];?></td>
		                                    <td>
		                                    	<a href="<?php echo BASEPATH;?>/admin/medicine/action?id=<?php echo $medicine['category_id'];?>&action=view_medicine_category"><?php echo $medicine['category_name'];?></a>		
		                                    </td>
		                                    <td align="right"><?php echo $medicine['sale_price'];?></td>
		                                    <td align="center"><?php echo date("d-m-Y", strtotime($medicine['created_at']));?></td>
		                                    <td align="center">
		                                    	<?php
		                                    	
			                                    	if($medicine['published_status']==1){
			                                    		echo "<span style='color:green'>Published</span>";
			                                    	}
			                                    	else{
			                                    		echo "<span style='color:red'>Un Published</span>";
			                                    	}
		                                    	?>
		                                    </td>
		                                    <td align="center">
		                                    	<a href="<?php echo BASEPATH;?>/admin/medicine/action?id=<?php echo $medicine['medicine_id'];?>&action=edit_medicine" class="btn btn-info btn-icon mg-r-5 mg-b-10"><i class="mdi mdi-folder-edit"></i></a>
		                                    	<a href="<?php echo BASEPATH;?>/admin/medicine/action?id=<?php echo $medicine['medicine_id'];?>&action=view_medicine" class="btn btn-primary btn-icon mg-r-5 mg-b-10"><i class="mdi mdi-monitor-eye"></i></a>
		                                    	<a href="<?php echo BASEPATH;?>/admin/medicine/action?id=<?php echo $medicine['medicine_id'];?>&action=change_medicine_status" class="btn btn-warning btn-icon mg-r-5 mg-b-10"><i class="mdi mdi-power"></i></a>
		                                    	<a href="<?php echo BASEPATH;?>/admin/medicine/action?id=<?php echo $medicine['medicine_id'];?>&action=delete_medicine" class="btn btn-danger btn-icon mg-r-5 mg-b-10"><i class="mdi mdi-delete"></i></a>
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





        