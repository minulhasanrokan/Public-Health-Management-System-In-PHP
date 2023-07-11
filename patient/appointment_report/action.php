<?php

	if(isset($_GET["action"]) && $_GET["action"] == "view_details"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("appointment_id", $_GET['id']);

		header("Location: view-details");
	}

	if(isset($_GET["action"]) && $_GET["action"] == "print-appointment-details"){

		include_once __DIR__.'/../../lib/Session.php';
		require_once __DIR__."/../../classes/PDF.php";

		/*$print_report = new Printreport();

		Session::initSession();

		Session::setSession("appointment_id", $_GET['id']);

		$ptint_appointment_deatils = $print_report->ptint_appointment_deatils($_GET['id']);*/

		//header("Location: view-details");
	}