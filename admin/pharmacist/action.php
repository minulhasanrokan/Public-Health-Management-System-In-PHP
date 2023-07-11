<?php
	
	if(isset($_POST["action"]) && $_POST["action"] == "add_pharmacist"){

		require_once __DIR__."/../../classes/Pharmacist.php";

		$pharmacist = new Pharmacist();

		$file = $_FILES['image'];

		$message = $pharmacist ->add_pharmacist_details($_POST,$file);

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

	if(isset($_GET["action"]) && $_GET["action"] == "edit_pharmacist"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("pharmacist_id", $_GET['id']);

		header("Location: edit");
	}

	if(isset($_POST["action"]) && $_POST["action"] == "update_pharmacist"){

		require_once __DIR__."/../../classes/Pharmacist.php";

		$pharmacist = new Pharmacist();

		$file = $_FILES['image'];

		$message = $pharmacist ->update_pharmacist_details($_POST,$file);

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

	if(isset($_GET["action"]) && $_GET["action"] == "view_pharmacist"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("pharmacist_id", $_GET['id']);

		header("Location: view");
	}

	if(isset($_GET["action"]) && $_GET["action"] == "change_pharmacist_status"){

		require_once __DIR__."/../../classes/Pharmacist.php";

		$Pharmacist = new Pharmacist();

		$id = $_GET['id'];

		$message = $Pharmacist ->update_pharmacist_status($id);

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

	if(isset($_GET["action"]) && $_GET["action"] == "delete_pharmacist"){

		require_once __DIR__."/../../classes/Pharmacist.php";

		$pharmacist = new Pharmacist();

		$id = $_GET['id'];

		$message = $pharmacist ->delete_pharmacist($id);

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