<?php
	if(isset($_POST["action"]) && $_POST["action"] == "add_shedule"){

		require_once __DIR__."/../../classes/Shedule.php";

		$shedule = new Shedule();

		Session::initSession();

		$id = 0;

	    if(isset($_SESSION['nurseId'])){
	        $id = $_SESSION['nurseId'];
	    }

		$_POST['nurse_id'] = $id;

		$message = $shedule ->add_shedule_details($_POST);

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

	if(isset($_POST["action"]) && $_POST["action"] == "add_shedule_details"){

		require_once __DIR__."/../../classes/Shedule.php";

		$shedule = new Shedule();

		Session::initSession();

		$id = 0;

	    if(isset($_SESSION['nurseId'])){
	        $id = $_SESSION['nurseId'];
	    }

		$_POST['nurse_id'] = $id;

		$message = $shedule ->add_shedule_details_new($_POST);

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

	if(isset($_GET["action"]) && $_GET["action"] == "edit_shedule"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("shedule_id", $_GET['id']);

		header("Location: edit-shedule");
	}

	if(isset($_POST["action"]) && $_POST["action"] == "update_shedule"){

		require_once __DIR__."/../../classes/Shedule.php";

		$shedule = new Shedule();

		Session::initSession();
		$id = 0;
	    if(isset($_SESSION['nurseId'])){
	        $id = $_SESSION['nurseId'];
	    }

		$_POST['nurse_id'] = $id;

		$message = $shedule ->update_shedule_details($_POST);

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

	if(isset($_GET["action"]) && $_GET["action"] == "view_shedule"){

		include_once __DIR__.'/../../lib/Session.php'; 

		Session::initSession();

		Session::setSession("shedule_id", $_GET['id']);

		header("Location: view-shedule");
	}

	if(isset($_GET["action"]) && $_GET["action"] == "delete_shedule"){

		require_once __DIR__."/../../classes/Shedule.php";

		$shedule = new Shedule();

		$id = $_GET['id'];

		$message = $shedule ->delete_shedule($id);

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

	if(isset($_GET["action"]) && $_GET["action"] == "appointment_details"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("appointment_id", $_GET['id']);

		header("Location: appointment-details");
	}