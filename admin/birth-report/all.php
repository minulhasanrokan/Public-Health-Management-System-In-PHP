<?php require_once '../body/header.php';?>
<?php require_once '../body/left_menu.php';?>

<?php
	require_once __DIR__."/../../classes/Birthreport.php";

	$birth_report = new Birthreport();

	$all_birth_report = $birth_report ->get_all_birth_report($ofset=null, $limit=null);
?>
<title><?php echo $system_data_title;?> All Birth Report Details</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="page-title-left">
	                        <a href="<?php echo BASEPATH?>/admin/birth-report/add" class="btn btn-info">Add Birth Report</a>
	                    </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/admin">Dashboard</a></li>
                                <li class="breadcrumb-item active">All Birth Report Details</li>
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
                        		if(isset($all_birth_report) && $all_birth_report>'0'){
                        	?>
		                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		                                <thead>
			                                <tr>
			                                	<th width="20">Sl</th>
			                                    <th align="center" width="40">Patient Image</th>
			                                    <th>Patient Name</th>
			                                    <th>Birth Date</th>
			                                    <th>Report File</th>
			                                </tr>
		                                </thead>
		                                <tbody>
		                                <?php
		                                	$i=1;
		                                	foreach($all_birth_report as $report){

		                                		$image = "avatar.jpg";

		                                		if($report['image']!='')
		                                		{
		                                			$image = $report['image'];
		                                		}
		                                ?>
		                                <tr>
		                                    <td align="center"><?php echo $i;?></td>
		                                    <td align="center">
		                                    	<img width="30" src="<?php echo BASEPATH."/uploads/patient/".$image;?>">
		                                    </td>
		                                    <td><?php echo $report['name'];?></td>
		                                    <td><?php echo $report['report_date'];?></td>
		                                    <td align="center">
		                                    	<a href="<?php echo BASEPATH."/uploads/patient/";?><?php echo $report['image'];?>">FILE</a>
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