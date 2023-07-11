<?php

	if(isset($_POST["action"]) && $_POST["action"] == "patient_register"){

		include_once __DIR__.'/../../lib/Session.php';
		include_once __DIR__."/../../classes/Register.php";

    	$register = new Register();

    	$file = $_FILES['image'];

		$meassage = $register ->add_patient_data($_POST,$file);

		$meassage_data = explode("***",$meassage);

		if($meassage_data[0]==1){

			Session::initSession();
			Session::setSession("meassage_data", $meassage_data);

			header("location: ".$_SERVER["HTTP_REFERER"]);
		}
		else{

			Session::initSession();
			Session::setSession("meassage_data", $meassage_data);

			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
		
	}

	if(isset($_GET["action"]) && $_GET["action"] == "edit_patient"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("patient_id", $_GET['id']);

		header("Location: edit");
	}

	if(isset($_POST["action"]) && $_POST["action"] == "update_patient"){

		include_once __DIR__.'/../../lib/Session.php';

		require_once __DIR__."/../../classes/Patient.php";

		Session::initSession();

		$patient = new Patient();

		$file = $_FILES['image'];

		$message = $patient ->update_patient_details($_POST,$file);
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

	if(isset($_GET["action"]) && $_GET["action"] == "view_patient"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("patient_id", $_GET['id']);

		header("Location: view");
	}

	if(isset($_GET["action"]) && $_GET["action"] == "change_patient_status"){

		require_once __DIR__."/../../classes/Patient.php";

		$patient = new Patient();

		$id = $_GET['id'];

		$message = $patient ->change_patient_status($id);

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

	if(isset($_GET["action"]) && $_GET["action"] == "delete_patient"){

		require_once __DIR__."/../../classes/Patient.php";

		$patient = new Patient();

		$id = $_GET['id'];

		$message = $patient ->delete_patient($id);

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