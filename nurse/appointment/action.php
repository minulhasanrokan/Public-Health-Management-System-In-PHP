<?php

	if(isset($_GET["action"]) && $_GET["action"] == "accept_appointment"){

		require_once __DIR__."/../../classes/Appointment.php";

		$appointment = new Appointment();

		$message = $appointment ->accept_appointment($_GET['id']);

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

	if(isset($_GET["action"]) && $_GET["action"] == "reject_appointment"){

		require_once __DIR__."/../../classes/Appointment.php";

		$appointment = new Appointment();

		$message = $appointment ->reject_appointment($_GET['id']);

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

	if(isset($_GET["action"]) && $_GET["action"] == "view_appointment"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("appointment_id", $_GET['id']);

		header("Location: view-appointment");
	}


	if(isset($_GET["action"]) && $_GET["action"] == "add_admit"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("appointment_id", $_GET['id']);

		header("Location: ../admit/add");
	}