<?php

if(isset($_GET["action"]) && $_GET["action"] == "view_doctor"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("doctor_id", $_GET['id']);

		header("Location: view");
	}