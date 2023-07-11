<?php

	if(isset($_GET["action"]) && $_GET["action"] == "view_doctor"){

		header("Location: ../profile");
	}

	if(isset($_GET["action"]) && $_GET["action"] == "view_nurse"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("nurse_id", $_GET['id']);

		header("Location: view");
	}

	if(isset($_GET["action"]) && $_GET["action"] == "view_doctor"){

		include_once __DIR__.'/../../lib/Session.php';

		header("Location: ../profile");
	}