<?php require_once '../body/header.php';?>
<?php require_once '../body/left_menu.php';?>

<?php
	require_once __DIR__."/../../classes/Bill.php";

	$bill = new Bill();

	$all_bill = $bill ->get_all_bill($ofset=null, $limit=null, $year=null);

?>
<title><?php echo $system_data_title;?> All Bill Details</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    	<a href="<?php echo BASEPATH?>/accountant/bill/appointment-bill-add" class="btn btn-info">Add Bill </a>
                        &nbsp;
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/accountant">Dashboard</a></li>
                                <li class="breadcrumb-item active">All Bill Details</li>
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
                        		if(isset($all_bill) && $all_bill>'0'){
                        	?>
		                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		                                <thead>
		                                <tr>
		                                	<th width="20">Sl</th>
		                                	<th align="center" width="40">Particular Type</th>
		                                	<th align="center" width="40">Particular No</th>
		                                    <th>Bill Amount</th>
		                                    <th>Bill Pay Date</th>
		                                    <th width="10">Pay Type</th>
		                                    <th width="100">Action</th>
		                                </tr>
		                                </thead>
		                                <tbody>
		                                <?php
		                                	$i=1;
		                                	foreach($all_bill as $bill){
		                                ?>
		                                <tr>
		                                    <td align="center"><?php echo $i;?></td>
		                                    <td><?php echo ucwords(str_replace("_"," ",$bill['bill_type']));?></td>
		                                    <td><?php echo $bill['particular_no'];?></td>
		                                    <td><?php echo $bill['fee'];?></td>
		                                    <td><?php echo date("d-m-Y",strtotime($bill['create_time']));?></td>
		                                    <td><?php echo $bill['pay_type'];?></td>
		                                    <td align="center">
		                                    	<a href="<?php echo BASEPATH;?>/accountant/bill/action?id=<?php echo $bill['bill_id'];?>&action=print_bill" class="btn btn-info btn-icon mg-r-5 mg-b-10">Print Bill</a>
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