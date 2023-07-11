<?php

	if(isset($_GET["action"]) && $_GET["action"] == "view_appointment"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("appointment_id", $_GET['id']);

		header("Location: view-appointment");
	}