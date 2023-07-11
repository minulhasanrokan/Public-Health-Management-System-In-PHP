<?php

	if(isset($_POST["action"]) && $_POST["action"] == "add_doctor"){

		require_once __DIR__."/../../classes/Doctor.php";

		$doctor = new Doctor();

		$file = $_FILES['image'];
		$certificate = $_FILES['certificate'];

		$message = $doctor ->add_doctor_details($_POST,$file,$certificate);

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

	if(isset($_GET["action"]) && $_GET["action"] == "edit_doctor"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("doctor_id", $_GET['id']);

		header("Location: edit");
	}

	if(isset($_POST["action"]) && $_POST["action"] == "update_doctor"){

		require_once __DIR__."/../../classes/Doctor.php";

		$doctor = new Doctor();

		$file = $_FILES['image'];

		$certificate = $_FILES['certificate'];

		$message = $doctor ->update_doctor_details($_POST,$file,$certificate);

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

	if(isset($_GET["action"]) && $_GET["action"] == "view_doctor"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("doctor_id", $_GET['id']);

		header("Location: view");
	}

	if(isset($_GET["action"]) && $_GET["action"] == "view_edit_doctor"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("doctor_id", $_GET['id']);

		header("Location: edit_view");
	}

	if(isset($_GET["action"]) && $_GET["action"] == "change_doctor_status"){

		require_once __DIR__."/../../classes/Doctor.php";

		$doctor = new Doctor();

		$id = $_GET['id'];

		$message = $doctor ->update_doctor_status($id);

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

	if(isset($_GET["action"]) && $_GET["action"] == "approve"){

		require_once __DIR__."/../../classes/Doctor.php";

		$doctor = new Doctor();

		$id = $_GET['id'];

		$message = $doctor ->update_edit_request($id);

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

	if(isset($_GET["action"]) && $_GET["action"] == "reject"){

		require_once __DIR__."/../../classes/Doctor.php";

		$doctor = new Doctor();

		$id = $_GET['id'];

		$message = $doctor ->reject_edit_request($id);

		$message_data = explode("***",$message);

		Session::initSession();

		if($message_data[0]==1){

			Session::setSession("message", $message_data[1]);
			Session::setSession("alert-type", "success");
			header("Location: edit_request");


		}
		else{

			Session::setSession("message", $message_data[1]);
			Session::setSession("alert-type", "error");
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}

	if(isset($_GET["action"]) && $_GET["action"] == "delete_doctor"){

		require_once __DIR__."/../../classes/Doctor.php";

		$doctor = new Doctor();

		$id = $_GET['id'];

		$message = $doctor ->delete_doctor($id);

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