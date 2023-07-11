<?php
	
	if(isset($_POST["action"]) && $_POST["action"] == "get_bed_by_floor"){

		require_once __DIR__."/../../classes/Floor.php";

		$floor = new Floor();

		$floor_id = $_POST["floor_id"];

		if($floor_id==''){
			$floor_id = 0;
		}

		$data_arr = $floor ->get_all_bed_in_fee($ofset=null, $limit=null, $department_id=null,$floor_id=$floor_id,$display=0);

		$result = '';
		if($data_arr){

			$result .='<select name="bed_id" id="bed_id" class="form-control" required><option value="">Select Bed Number</option>';

			foreach($data_arr as $data){

				$result .='<option value="'.$data['bed_id'].'">'.$data['name'].'</option>';

			}

			$result .='</select>';
		}
		else{

			$result .='<select name="bed_id" id="bed_id" class="form-control" required><option value="">Select Bed Number</option></select>';
		}

		echo $result;
	}

	if(isset($_POST["action"]) && $_POST["action"] == "add_bed_fee"){

		require_once __DIR__."/../../classes/Floor.php";

		$floor = new Floor();

		$message = $floor ->add_add_bed_fee_details($_POST);

		$message_data = explode("***",$message);

		Session::initSession();

		if($message_data[0]==1){

			Session::setSession("message", $message_data[1]);
			Session::setSession("alert-type", "success");
			header("Location: " . $_SERVER["HTTP_REFERER"]);


		}
		else{

			Session::setSession("message", $message_data[1]);
			Session::setSession("alert-type", "error");
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}

	if(isset($_GET["action"]) && $_GET["action"] == "edit_bed_fee"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("bed_fee_id", $_GET['id']);

		header("Location: edit-bed-fee");
	}

	if(isset($_POST["action"]) && $_POST["action"] == "update_bed_fee"){

		require_once __DIR__."/../../classes/Floor.php";

		$floor = new Floor();

		$message = $floor ->update_bed_fee_details($_POST);

		$message_data = explode("***",$message);

		Session::initSession();

		if($message_data[0]==1){

			Session::setSession("message", $message_data[1]);
			Session::setSession("alert-type", "success");
			header("Location: " . $_SERVER["HTTP_REFERER"]);


		}
		else{

			Session::setSession("message", $message_data[1]);
			Session::setSession("alert-type", "error");
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}

	if(isset($_GET["action"]) && $_GET["action"] == "delete_bed_fee"){

		require_once __DIR__."/../../classes/Floor.php";

		$floor = new Floor();

		$id = $_GET['id'];

		$message = $floor ->delete_bed_fee($id);

		$message_data = explode("***",$message);

		Session::initSession();

		if($message_data[0]==1){

			Session::setSession("message", $message_data[1]);
			Session::setSession("alert-type", "success");
			header("Location: " . $_SERVER["HTTP_REFERER"]);


		}
		else{

			Session::setSession("message", $message_data[1]);
			Session::setSession("alert-type", "error");
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}