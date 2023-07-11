<?php
	if(isset($_POST["action"]) && $_POST["action"] == "add_floor"){

		require_once __DIR__."/../../classes/Floor.php";

		$floor = new Floor();

		$file = $_FILES['image'];

		$message = $floor ->add_floor_details($_POST,$file);

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

	if(isset($_GET["action"]) && $_GET["action"] == "edit_floor"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("floor_id", $_GET['id']);

		header("Location: edit");
	}

	if(isset($_POST["action"]) && $_POST["action"] == "update_floor"){

		require_once __DIR__."/../../classes/Floor.php";

		$floor = new Floor();

		$file = $_FILES['image'];

		$message = $floor ->update_floor_details($_POST,$file);

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

	if(isset($_GET["action"]) && $_GET["action"] == "view_floor"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("floor_id", $_GET['id']);

		header("Location: view");
	}

	if(isset($_GET["action"]) && $_GET["action"] == "change_floor_status"){

		require_once __DIR__."/../../classes/Floor.php";

		$doctor = new Floor();

		$id = $_GET['id'];

		$message = $doctor ->update_floor_status($id);

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

	if(isset($_GET["action"]) && $_GET["action"] == "delete_floor"){

		require_once __DIR__."/../../classes/Floor.php";

		$floor = new Floor();

		$id = $_GET['id'];

		$message = $floor ->delete_floor($id);

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