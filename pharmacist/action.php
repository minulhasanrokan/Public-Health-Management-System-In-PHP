<?php

	if(isset($_GET["action"]) && $_GET["action"] == "edit_profile"){

		include_once __DIR__.'/../../lib/Session.php';

		header("Location: edit-profile");
	}

	if(isset($_POST["action"]) && $_POST["action"] == "update_pharmacist"){

		include_once __DIR__.'/../lib/Session.php';

		require_once __DIR__."/../classes/Pharmacist.php";

		Session::initSession();

		$doctor = new Pharmacist();

		$file = $_FILES['image'];

		$id = 0;

	    if(isset($_SESSION['pharmacistId'])){
	        $id = $_SESSION['pharmacistId'];
	    }

		$_POST['pharmacist_id'] = $id;

		$message = $doctor ->update_pharmacist_details($_POST,$file);
		$message_data = explode("***",$message);

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

	if(isset($_GET["action"]) && $_GET["action"] == "view_profile"){

		include_once __DIR__.'/../../lib/Session.php';

		header("Location: profile");
	}

	if(isset($_POST["action"]) && $_POST["action"] == "update_password"){

		require_once __DIR__."/../classes/Pharmacist.php";

		$pharmacist = new Pharmacist();

		$message = $pharmacist ->update_password($_POST);

		$message_data = explode("***",$message);

		Session::initSession();

		if($message_data[0]==1){

			Session::destroySession();

			Session::initSession();
			Session::setSession("message", $message_data[1]);
			Session::setSession("alert-type", "success");
			header("Location: " .BASEPATH);


		}
		else{

			Session::setSession("message", $message_data[1]);
			Session::setSession("alert-type", "error");
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}