<?php

	if(isset($_POST["action"]) && $_POST["action"] == "add_doctor_fee"){

		require_once __DIR__."/../../classes/Doctor.php";

		$doctor = new Doctor();

		$message = $doctor ->add_add_doctor_fee_details($_POST);

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

	if(isset($_GET["action"]) && $_GET["action"] == "edit_doctor_fee"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("doctor_fee_id", $_GET['id']);

		header("Location: edit-doctor-fee");
	}

	if(isset($_POST["action"]) && $_POST["action"] == "update_doctor_fee"){

		require_once __DIR__."/../../classes/Doctor.php";

		$blood = new Doctor();

		$message = $blood ->update_doctor_fee_details($_POST);

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

	if(isset($_GET["action"]) && $_GET["action"] == "delete_doctor_fee"){

		require_once __DIR__."/../../classes/Doctor.php";

		$doctor = new Doctor();

		$id = $_GET['id'];

		$message = $doctor ->delete_doctor_fee($id);

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