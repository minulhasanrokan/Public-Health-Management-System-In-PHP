<?php require_once '../body/header.php';?>
<?php require_once '../body/left_menu.php';?>

<?php
	require_once __DIR__."/../../classes/Doctor.php";

	$doctor = new Doctor();


	$all_doctor = $doctor ->get_all_active_doctor_fee($ofset=null, $limit=null, $department_id=null);

?>
<title><?php echo $system_data_title;?> All Doctor Fee Details</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <a href="<?php echo BASEPATH?>/accountant/doctor-fee/add" class="btn btn-info">Add Doctor Fee </a>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/accountant">Dashboard</a></li>
                                <li class="breadcrumb-item active">All Doctor Fee Details</li>
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
                        		if(isset($all_doctor) && $all_doctor>'0'){
                        	?>
		                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		                                <thead>
		                                <tr>
		                                	<th width="20">Sl</th>
		                                	<th align="center" width="40">Image</th>
		                                    <th>Doctor Name</th>
		                                    <th>Department Name</th>
		                                    <th align="center" width="50">Mobile</th>
		                                    <th align="center" width="50">Fee</th>
		                                    <th width="100">Action</th>
		                                </tr>
		                                </thead>
		                                <tbody>
		                                <?php
		                                	$i=1;
		                                	foreach($all_doctor as $doctor){

		                                		$image = "avatar.jpg";

		                                		if($doctor['image']!='')
		                                		{
		                                			$image = $doctor['image'];
		                                		}
		                                ?>
		                                <tr>
		                                    <td align="center"><?php echo $i;?></td>
		                                    <td align="center">
		                                    	<img width="30" src="<?php echo BASEPATH."/uploads/doctor/".$image;?>">
		                                    </td>
		                                    <td><?php echo $doctor['name'];?></td>
		                                    <td><!--<a href="<?php echo BASEPATH;?>/admin/department/action?id=<?php echo $doctor['department_id']; ?>&action=view_department"><?php echo $doctor['department_name'];?></a>--><?php echo $doctor['department_name'];?></td>
		                                    <td align="center"><?php echo $doctor['mobile'];?></td>
		                                    <td align="right"><?php echo $doctor['doctor_fee'];?></td>
		                                    <td align="center">
		                                    	<a href="<?php echo BASEPATH;?>/accountant/doctor-fee/action?id=<?php echo $doctor['fee_id'];?>&action=edit_doctor_fee" class="btn btn-info btn-icon mg-r-5 mg-b-10"><i class="mdi mdi-folder-edit"></i></a>
		                                    	<a href="<?php echo BASEPATH;?>/accountant/doctor-fee/action?id=<?php echo $doctor['fee_id'];?>&action=delete_doctor_fee" class="btn btn-danger btn-icon mg-r-5 mg-b-10"><i class="mdi mdi-delete"></i></a>
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