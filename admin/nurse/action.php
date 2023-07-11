<?php
	if(isset($_POST["action"]) && $_POST["action"] == "add_nurse"){

		require_once __DIR__."/../../classes/Nurse.php";

		$doctor = new Nurse();

		$file = $_FILES['image'];

		$message = $doctor ->add_nurse_details($_POST,$file);

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

	if(isset($_GET["action"]) && $_GET["action"] == "edit_nurse"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("nurse_id", $_GET['id']);

		header("Location: edit");
	}

	if(isset($_POST["action"]) && $_POST["action"] == "update_nurse"){

		require_once __DIR__."/../../classes/Nurse.php";

		$doctor = new Nurse();

		$file = $_FILES['image'];

		$message = $doctor ->update_nurse_details($_POST,$file);

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

	if(isset($_GET["action"]) && $_GET["action"] == "view_nurse"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("nurse_id", $_GET['id']);

		header("Location: view");
	}

	if(isset($_GET["action"]) && $_GET["action"] == "change_nurse_status"){

		require_once __DIR__."/../../classes/Nurse.php";

		$nurse = new Nurse();

		$id = $_GET['id'];

		$message = $nurse ->update_nurse_status($id);

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

	if(isset($_GET["action"]) && $_GET["action"] == "delete_nurse"){

		require_once __DIR__."/../../classes/Nurse.php";

		$nurse = new Nurse();

		$id = $_GET['id'];

		$message = $nurse ->delete_nurse($id);

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