<?php require_once __DIR__.'/../body/header.php';?>
<?php require_once __DIR__.'/../body/left_menu.php';?>

<?php
	require_once __DIR__."/../../classes/Notice.php";

	$notice = new Notice();

	$all_notice = $notice ->get_all_notice($ofset=null, $limit=null,$notice_for=null,$user_id=null,$notice_date=null,$published_date=null);

	$notice_for_arr = array("0"=>"All","1"=>"Patient","2"=>"Doctor","3"=>"Nurse","4"=>"Pharmacist","5"=>"Laboratorist","6"=>"Accountant",
            );
?>
<title><?php echo $system_data_title;?> All Notice Details</title>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <a href="<?php echo BASEPATH?>/admin/notice/add" class="btn btn-info">Add Notice </a>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/admin">Dashboard</a></li>
                                <li class="breadcrumb-item active">All Notice Details</li>
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
                        		if(isset($all_notice) && $all_notice>'0'){
                        	?>
		                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		                                <thead>
		                                <tr>
		                                	<th width="20">Sl</th>
		                                	<th width="40">Notice For</th>
		                                    <th>Title</th>
		                                    <th align="center" width="50">Notice Date</th>
		                                    <th align="center" width="50">Published date</th>
		                                    <th align="center" width="50">Status</th>
		                                    <th width="100">Action</th>
		                                </tr>
		                                </thead>
		                                <tbody>
		                                <?php
		                                	$i=1;
		                                	foreach($all_notice as $notice){
		                                ?>
		                                <tr>
		                                    <td align="center"><?php echo $i;?></td>
		                                    <td><?php echo $notice_for_arr[$notice['user_type']];?></td>
		                                    <td><?php echo substr($notice['title'],0,40); ?></td>
		                                    <td><?php echo date("d-m-Y",strtotime($notice['notice_date']));?></td>
		                                    <td><?php echo date("d-m-Y",strtotime($notice['published_date']));?></td>
		                                    <td align="center">
		                                    	<?php
		                                    	
			                                    	if($notice['published_status']==1){
			                                    		echo "<span style='color:green'>Active</span>";
			                                    	}
			                                    	else{
			                                    		echo "<span style='color:red'>In Active</span>";
			                                    	}
		                                    	?>
		                                    </td>
		                                    <td align="center">
		                                    	<a href="<?php echo BASEPATH;?>/admin/notice/action?id=<?php echo $notice['notice_id'];?>&action=edit_notice" class="btn btn-info btn-icon mg-r-5 mg-b-10"><i class="mdi mdi-folder-edit"></i></a>
		                                    	<a href="<?php echo BASEPATH;?>/admin/notice/action?id=<?php echo $notice['notice_id'];?>&action=view_notice" class="btn btn-primary btn-icon mg-r-5 mg-b-10"><i class="mdi mdi-monitor-eye"></i></a>
		                                    	<a href="<?php echo BASEPATH;?>/admin/notice/action?id=<?php echo $notice['notice_id'];?>&action=change_notice_status" class="btn btn-warning btn-icon mg-r-5 mg-b-10"><i class="mdi mdi-power"></i></a>
		                                    	<a href="<?php echo BASEPATH;?>/admin/notice/action?id=<?php echo $notice['notice_id'];?>&action=delete_notice" class="btn btn-danger btn-icon mg-r-5 mg-b-10"><i class="mdi mdi-delete"></i></a>
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