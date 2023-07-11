<?php

	if(isset($_GET["action"]) && $_GET["action"] == "add_report_details"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("appointment_id", $_GET['id']);

		header("Location: add-report");
	}

	if(isset($_POST["action"]) && $_POST["action"] == "store_report"){

		require_once __DIR__."/../../classes/Report.php";

		$report = new Report();

		$file = $_FILES['image'];

		$message = $report ->add_report_details($_POST,$file);

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