<?php require_once '../body/header.php';?>
<?php require_once '../body/left_menu.php';?>

<?php
	require_once __DIR__."/../../classes/Login.php";
	require_once __DIR__."/../../classes/Admin.php";
	require_once __DIR__."/../../classes/Doctor.php";
	require_once __DIR__."/../../classes/Nurse.php";
	require_once __DIR__."/../../classes/Accountant.php";
	require_once __DIR__."/../../classes/Laboratorist.php";
	require_once __DIR__."/../../classes/Pharmacist.php";
	require_once __DIR__."/../../classes/Patient.php";

	$login = new Login();

	if(isset($_GET['display']) && $_GET['display']!=''){

		$data = $_GET['display'];

		$all_user_log_history = $login ->get_all_user_log_history($ofset=null, $limit=null, $data);
		
	}
	else{

		$all_user_log_history = $login ->get_all_user_log_history($ofset=null, $limit=null, $data=null);
	}

	$admin = new admin();

	$all_admin = $admin ->get_all_admin($ofset=null, $limit=null);

	$all_user_arr = array();

	if(isset($all_admin) && $all_admin>'0'){

		foreach($all_admin as $data){

			$all_user_arr[1][$data['admin_id']]['name'] = $data['name'];
			$all_user_arr[1][$data['admin_id']]['image'] = BASEPATH."/uploads/users/".$data['image'];
		}
	}

	$doctor = new Doctor();

	$all_doctor = $doctor ->get_all_doctor($ofset=null, $limit=null);

	if(isset($all_doctor) && $all_doctor>'0'){

		foreach($all_doctor as $data){

			$all_user_arr[2][$data['doctor_id']]['name'] = $data['name'];
			$all_user_arr[2][$data['doctor_id']]['image'] = BASEPATH."/uploads/doctor/".$data['image'];
		}
	}

	$nurse = new Nurse();

	$all_nurse = $nurse ->get_all_nurse($ofset=null, $limit=null);

	if(isset($all_nurse) && $all_doctor>'0'){

		foreach($all_nurse as $data){

			$all_user_arr[3][$data['nurse_id']]['name'] = $data['name'];
			$all_user_arr[3][$data['nurse_id']]['image'] = BASEPATH."/uploads/nurse/".$data['image'];
		}
	}

	$pharmacist = new Pharmacist();

	$all_pharmacist = $pharmacist ->get_all_pharmacist($ofset=null, $limit=null);

	if(isset($all_pharmacist) && $all_pharmacist>'0'){

		foreach($all_pharmacist as $data){

			$all_user_arr[4][$data['pharmacist_id']]['name'] = $data['name'];
			$all_user_arr[4][$data['pharmacist_id']]['image'] = BASEPATH."/uploads/pharmacist/".$data['image'];
		}
	}

	$laboratorist = new Laboratorist();

	$all_laboratorist = $laboratorist ->get_all_laboratorist($ofset=null, $limit=null);

	if(isset($all_laboratorist) && $all_laboratorist>'0'){

		foreach($all_laboratorist as $data){

			$all_user_arr[5][$data['laboratorist_id']]['name'] = $data['name'];
			$all_user_arr[5][$data['laboratorist_id']]['image'] = BASEPATH."/uploads/laboratorist/".$data['image'];
		}
	}

	$accountant = new Accountant();

	$all_accountant = $accountant ->get_all_accountant($ofset=null, $limit=null);

	if(isset($all_accountant) && $all_accountant>'0'){

		foreach($all_accountant as $data){

			$all_user_arr[6][$data['accountant_id']]['name'] = $data['name'];
			$all_user_arr[6][$data['accountant_id']]['image'] = BASEPATH."/uploads/accountant/".$data['image'];
		}
	}

	$patient = new Patient();

	$all_patient = $patient ->get_all_active_patient($ofset=null, $limit=null);

	if(isset($all_patient) && $all_patient>'0'){

		foreach($all_patient as $data){

			$all_user_arr[7][$data['patient_id']]['name'] = $data['name'];
			$all_user_arr[7][$data['patient_id']]['image'] = BASEPATH."/uploads/patient/".$data['image'];
		}
	}
?>
<title><?php echo $system_data_title;?> All User Log Details</title>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    	<div class="page-title-left">
	                        <a href="<?php echo BASEPATH?>/admin/log_report/view?display=all" class="btn btn-primary">All User</a>
	                        <a href="<?php echo BASEPATH?>/admin/log_report/view?display=Patient" class="btn btn-success">Patient</a>
	                        <a href="<?php echo BASEPATH?>/admin/log_report/view?display=Admin" class="btn btn-warning">Admin</a>
	                        <a href="<?php echo BASEPATH?>/admin/log_report/view?display=Doctor" class="btn btn-danger">Doctor</a>
	                        <a href="<?php echo BASEPATH?>/admin/log_report/view?display=Nurse" class="btn btn-info">Nurse</a>
	                        <a href="<?php echo BASEPATH?>/admin/log_report/view?display=Pharmacist" class="btn btn-primary">Pharmacist</a>
	                        <a href="<?php echo BASEPATH?>/admin/log_report/view?display=Laboratorist" class="btn btn-success">Laboratorist</a>
	                    </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?php echo BASEPATH;?>/admin">Dashboard</a></li>
                                <li class="breadcrumb-item active">All User Log Details</li>
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
                        		if(isset($all_user_log_history) && $all_user_log_history>'0'){
                        	?>
		                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		                                <thead>
		                                <tr>
		                                	<th width="20">Sl</th>
		                                	<th align="center" width="40">User Type</th>
		                                    <th>Name</th>
		                                    <th>Image</th>
		                                    <th>IP Address</th>
		                                    <th>Login Time</th>
		                                    <th>Login Status</th>
		                                    <th>Logout Time</th>
		                                    <th>Logout Status</th>
		                                </tr>
		                                </thead>
		                                <tbody>
		                                <?php
		                                	$i=1;

		                                	$login_out_status = array(0=>"No",1=>'Yes');

		                                	$user_type_arr = array(1=>"Admin",2=>"Doctor",3=>"Nurse",4=>"Pharmacist",5=>"Laboratorist",6=>"Accountant",7=>"Patient");

		                                	foreach($all_user_log_history as $data){

		                                		$image = '';	
		                                		$name = '';	

		                                		if(isset($all_user_arr[$data['user_type']][$data['user_id']]['name'])){

		                                			$name = $all_user_arr[$data['user_type']][$data['user_id']]['name'];
		                                		}

		                                		if(isset($all_user_arr[$data['user_type']][$data['user_id']]['image'])){

		                                			$image = $all_user_arr[$data['user_type']][$data['user_id']]['image'];
		                                		}
		                                ?>
		                                <tr>
		                                    <td align="center"><?php echo $i;?></td>
		                                    <td><?php echo $user_type_arr[$data['user_type']];?></td>
		                                    <td><?php echo $name;?></td>
		                                    <td align="center">
		                                    	<img width="30" src="<?php echo $image;?>">
		                                    </td>
		                                    <td><?php echo $data['ip_address'];?></td>
		                                    <td><?php echo $data['login_time'];?></td>
		                                    <td><?php echo $login_out_status[$data['login_status']];?></td>
		                                    <td><?php echo $data['log_out_time'];?></td>
		                                    <td><?php echo $login_out_status[$data['log_out_status']];?></td>

		                                    
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





        