<?php
	
	if(isset($_POST["action"]) && $_POST["action"] == "add_laboratorist"){

		require_once __DIR__."/../../classes/Laboratorist.php"; 

		$laboratorist = new Laboratorist();

		$file = $_FILES['image'];

		$message = $laboratorist ->add_laboratorist_details($_POST,$file);

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

	if(isset($_GET["action"]) && $_GET["action"] == "edit_laboratorist"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("laboratorist_id", $_GET['id']);

		header("Location: edit");
	}

	if(isset($_POST["action"]) && $_POST["action"] == "update_laboratorist"){

		require_once __DIR__."/../../classes/Laboratorist.php";

		$laboratorist = new Laboratorist();

		$file = $_FILES['image'];

		$message = $laboratorist ->update_laboratorist_details($_POST,$file);

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

	if(isset($_GET["action"]) && $_GET["action"] == "view_laboratorist"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("laboratorist_id", $_GET['id']);

		header("Location: view");
	}

	if(isset($_GET["action"]) && $_GET["action"] == "change_laboratorist_status"){

		require_once __DIR__."/../../classes/Laboratorist.php";

		$Laboratorist = new Laboratorist();

		$id = $_GET['id'];

		$message = $Laboratorist ->change_laboratorist_status($id);

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

	if(isset($_GET["action"]) && $_GET["action"] == "delete_laboratorist"){

		require_once __DIR__."/../../classes/Laboratorist.php";

		$Laboratorist = new Laboratorist();

		$id = $_GET['id'];

		$message = $Laboratorist ->delete_laboratorist($id);

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
