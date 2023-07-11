<?php

	if(isset($_GET["action"]) && $_GET["action"] == "appointment_bill_add_form"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("appointment_id", $_GET['id']);

		header("Location: appointment-bill-add-form");
	}

	if(isset($_POST["action"]) && $_POST["action"] == "add_doctor_bill"){

		require_once __DIR__."/../../classes/Bill.php";

		$doctor = new Bill();

		$message = $doctor ->add_add_bill_details($_POST);

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