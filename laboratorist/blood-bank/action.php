<?php
	if(isset($_POST["action"]) && $_POST["action"] == "add_blood_group"){

		require_once __DIR__."/../../classes/Blood.php";

		$blood = new Blood();

		$file = $_FILES['image'];

		$message = $blood ->add_blood_group_details($_POST,$file);

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

	if(isset($_GET["action"]) && $_GET["action"] == "edit_blood_group"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("blood_group_id", $_GET['id']);

		header("Location: edit");
	}

	if(isset($_POST["action"]) && $_POST["action"] == "update_blood_group"){

		require_once __DIR__."/../../classes/Blood.php";

		$blood = new Blood();

		$file = $_FILES['image'];

		$message = $blood ->update_blood_group_details($_POST,$file);

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

	if(isset($_GET["action"]) && $_GET["action"] == "view_blood_group"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("blood_group_id", $_GET['id']);

		header("Location: view");
	}

	if(isset($_GET["action"]) && $_GET["action"] == "change_blood_group_status"){

		require_once __DIR__."/../../classes/Blood.php";

		$nurse = new Blood();

		$id = $_GET['id'];

		$message = $nurse ->update_blood_group_status($id);

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

	if(isset($_GET["action"]) && $_GET["action"] == "delete_blood_group"){

		require_once __DIR__."/../../classes/Nurse.php";

		$nurse = new Nurse();

		$id = $_GET['id'];

		$message = $nurse ->delete_blood_group($id);

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