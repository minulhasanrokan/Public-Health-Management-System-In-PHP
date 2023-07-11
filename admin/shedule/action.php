<?php
	if(isset($_POST["action"]) && $_POST["action"] == "add_shedule"){

		require_once __DIR__."/../../classes/Shedule.php";

		$shedule = new Shedule();

		$message = $shedule ->add_shedule_details($_POST);

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

	if(isset($_POST["action"]) && $_POST["action"] == "add_shedule_details"){

		require_once __DIR__."/../../classes/Shedule.php";

		$shedule = new Shedule();

		$message = $shedule ->add_shedule_details_new($_POST);

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

	if(isset($_GET["action"]) && $_GET["action"] == "edit_shedule"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("shedule_id", $_GET['id']);

		header("Location: edit-shedule");
	}

	if(isset($_GET["action"]) && $_GET["action"] == "appointment_details"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("appointment_id", $_GET['id']);

		header("Location: appointment-details");
	}

	if(isset($_POST["action"]) && $_POST["action"] == "update_shedule"){

		require_once __DIR__."/../../classes/Shedule.php";

		$shedule = new Shedule();

		$message = $shedule ->update_shedule_details($_POST);

		$message_data = explode("***",$message);


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

	if(isset($_GET["action"]) && $_GET["action"] == "view_shedule"){

		include_once __DIR__.'/../../lib/Session.php'; 

		Session::initSession();

		Session::setSession("shedule_id", $_GET['id']);

		header("Location: view-shedule");
	}

	if(isset($_GET["action"]) && $_GET["action"] == "delete_shedule"){

		require_once __DIR__."/../../classes/Shedule.php";

		$shedule = new Shedule();

		$id = $_GET['id'];

		$message = $shedule ->delete_shedule($id);

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

	if(isset($_GET["action"]) && $_GET["action"] == "get_nurse_by_doctor"){


		require_once __DIR__."/../../classes/Nurse.php";

		$nurse = new Nurse();

		$all_nurse = $nurse ->get_all_nurse_by_doctor($ofset=null, $limit=null,$_GET['doctor_id']);

		if($all_nurse==true){

			echo '<select onchange="check_doctor(this.value);" name="nurse_id" id="nurse_id" class="form-control" required><option value="">Select Nurse</option>';
			?>
			<?php
				foreach($all_nurse as $nurse){

					echo '<option value="'.$nurse['nurse_id'].'">'.$nurse['name'].'</option>';
				}
			?>
			<?php
                 echo '</select>';
		}
		else{

			echo '<select onchange="check_doctor(this.value);" name="nurse_id" id="nurse_id" class="form-control" required>
                    <option value="">Select Nurse</option>
                </select>';
		}
	}