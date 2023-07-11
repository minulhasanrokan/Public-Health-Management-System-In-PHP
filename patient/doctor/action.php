<?php

	if(isset($_GET["action"]) && $_GET["action"] == "view_department"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("department_id", $_GET['id']);

		header("Location: view-department");
	}

	if(isset($_GET["action"]) && $_GET["action"] == "view_doctor"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("doctor_id", $_GET['id']);

		header("Location: view-doctor");
	}

	if(isset($_GET["action"]) && $_GET["action"] == "view_shedule"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("doctor_id", $_GET['id']);

		header("Location: all-shedule");
	}

	if(isset($_GET["action"]) && $_GET["action"] == "add_appointment"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("shedule_id", $_GET['id']);

		header("Location: add-appointment");
	}

	if(isset($_POST["action"]) && $_POST["action"] == "save_appointment"){

		require_once __DIR__."/../../classes/Appointment.php";

		$appointment = new Appointment();

		$message = $appointment ->add_appointment_details($_POST);

		$message_data = explode("***",$message);

		Session::initSession();

		if($message_data[0]==1){

			Session::setSession("message", $message_data[1]);
			Session::setSession("alert-type", "success");
			header("Location: all-shedule");


		}
		else{

			Session::setSession("message", $message_data[1]);
			Session::setSession("alert-type", "error");
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}