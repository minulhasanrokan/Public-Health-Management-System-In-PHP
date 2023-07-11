<?php
	if(isset($_POST["action"]) && $_POST["action"] == "add_accountant"){

		require_once __DIR__."/../../classes/Accountant.php";

		$accountant = new Accountant();

		$file = $_FILES['image'];

		$message = $accountant ->add_accountant_details($_POST,$file);

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

	if(isset($_GET["action"]) && $_GET["action"] == "edit_accountant"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("accountant_id", $_GET['id']);

		header("Location: edit");
	}

	if(isset($_POST["action"]) && $_POST["action"] == "update_accountant"){

		require_once __DIR__."/../../classes/Accountant.php";

		$accountant = new Accountant();

		$file = $_FILES['image'];

		$message = $accountant ->update_accountant_details($_POST,$file);

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

	if(isset($_GET["action"]) && $_GET["action"] == "view_accountant"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("accountant_id", $_GET['id']);

		header("Location: view");
	}

	if(isset($_GET["action"]) && $_GET["action"] == "change_accountant_status"){

		require_once __DIR__."/../../classes/Accountant.php";

		$nurse = new Accountant();

		$id = $_GET['id'];

		$message = $nurse ->update_accountant_status($id);

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

	if(isset($_GET["action"]) && $_GET["action"] == "delete_accountant"){

		require_once __DIR__."/../../classes/Accountant.php";

		$accountant = new Accountant();

		$id = $_GET['id'];

		$message = $accountant ->delete_accountant($id);

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