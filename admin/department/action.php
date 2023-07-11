<?php
	

	if(isset($_POST["action"]) && $_POST["action"] == "add_depertment"){

		require_once __DIR__."/../../classes/Department.php";

		$department = new Department();

		$file = $_FILES['image'];

		$message = $department ->add_department_details($_POST,$file);

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

	if(isset($_GET["action"]) && $_GET["action"] == "edit_department"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("department_id", $_GET['id']);

		header("Location: edit");
	}

	if(isset($_GET["action"]) && $_GET["action"] == "view_department"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("department_id", $_GET['id']);

		header("Location: view");
	}

	if(isset($_POST["action"]) && $_POST["action"] == "update_depertment"){

		require_once __DIR__."/../../classes/Department.php";

		$department = new Department();

		$file = $_FILES['image'];

		$message = $department ->update_department_details($_POST,$file);

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

	if(isset($_GET["action"]) && $_GET["action"] == "change_department_status"){

		require_once __DIR__."/../../classes/Department.php";

		$department = new Department();

		$id = $_GET['id'];

		$message = $department ->update_department_status($id);

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

	if(isset($_GET["action"]) && $_GET["action"] == "delete_department"){

		require_once __DIR__."/../../classes/Department.php";

		$department = new Department();

		$id = $_GET['id'];

		$message = $department ->delete_department($id);

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
