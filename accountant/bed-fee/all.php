<?php require_once '../body/header.php';?>
<?php require_once '../body/left_menu.php';?>

<?php
	require_once __DIR__."/../../classes/Floor.php";

	$floor = new Floor();

	$all_bed = $floor ->get_all_active_bed_fee($ofset=null, $limit=null, $department_id=null, $floor_id=null, $fee_id=null);

?>
<title><?php echo $system_data_title;?> All Bed Fee Details</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <a href="<?php echo BASEPATH?>/accountant/bed-fee/add" class="btn btn-info">Add Bed Fee </a>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/accountant">Dashboard</a></li>
                                <li class="breadcrumb-item active">All Bed Fee Details</li>
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
		                                    <th>Department Name</th>
		                                    <th>Floor Name</th>
		                                    <th align="center" width="50">Bed Number</th>
		                                    <th align="center" width="50">Fee</th>
		                                    <th width="100">Action</th>
		                                </tr>
		                                </thead>
		                                <tbody>
		                                <?php
		                                	$i=1;
		                                	foreach($all_bed as $bed){
		                                ?>
		                                <tr>
		                                    <td align="center"><?php echo $i;?></td>
		                                    <td><?php echo $bed['department_name'];?></td>
		                                    <td><?php echo $bed['floor_name'];?></td>
		                                    <td align="center"><?php echo $bed['bed_name'];?></td>
		                                    <td align="right"><?php echo $bed['bed_fee'];?></td>
		                                    <td align="center">
		                                    	<a href="<?php echo BASEPATH;?>/accountant/bed-fee/action?id=<?php echo $bed['fee_id'];?>&action=edit_bed_fee" class="btn btn-info btn-icon mg-r-5 mg-b-10"><i class="mdi mdi-folder-edit"></i></a>
		                                    	<a href="<?php echo BASEPATH;?>/accountant/bed-fee/action?id=<?php echo $bed['fee_id'];?>&action=delete_bed_fee" class="btn btn-danger btn-icon mg-r-5 mg-b-10"><i class="mdi mdi-delete"></i></a>
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