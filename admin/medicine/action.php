<?php

	if(isset($_POST["action"]) && $_POST["action"] == "add_medicine_category"){

		require_once __DIR__."/../../classes/Medicine.php";

		$medicine = new Medicine();

		$file = $_FILES['image'];

		$message = $medicine ->add_medicine_category_details($_POST,$file);

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

	if(isset($_GET["action"]) && $_GET["action"] == "edit_medicine_category"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("medicine_category_id", $_GET['id']);

		header("Location: edit-medicine-category");
	}

	if(isset($_POST["action"]) && $_POST["action"] == "update_medicine_category"){

		require_once __DIR__."/../../classes/Medicine.php";

		$medicine = new Medicine();

		$file = $_FILES['image'];

		$message = $medicine ->update_medicine_category_details($_POST,$file);

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

	if(isset($_GET["action"]) && $_GET["action"] == "view_medicine_category"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("medicine_category_id", $_GET['id']);

		header("Location: view-medicine-categoty");
	}

	if(isset($_GET["action"]) && $_GET["action"] == "change_medicine_category_status"){

		require_once __DIR__."/../../classes/Medicine.php";

		$medicine = new Medicine();

		$id = $_GET['id'];

		$message = $medicine ->update_medicine_category_status($id);

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

	if(isset($_GET["action"]) && $_GET["action"] == "delete_medicine_category"){

		require_once __DIR__."/../../classes/Medicine.php";

		$medicine = new Medicine();

		$id = $_GET['id'];

		$message = $medicine ->delete_medicine_category($id);

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

	if(isset($_POST["action"]) && $_POST["action"] == "add_medicine"){

		require_once __DIR__."/../../classes/Medicine.php";

		$medicine = new Medicine();

		$file = $_FILES['image'];

		$message = $medicine ->add_medicine_details($_POST,$file);

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

	if(isset($_GET["action"]) && $_GET["action"] == "edit_medicine"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("medicine_id", $_GET['id']);

		header("Location: edit-medicine");
	}

	if(isset($_POST["action"]) && $_POST["action"] == "update_medicine"){

		require_once __DIR__."/../../classes/Medicine.php";

		$medicine = new Medicine();

		$file = $_FILES['image'];

		$message = $medicine ->update_medicine_details($_POST,$file);

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

	if(isset($_GET["action"]) && $_GET["action"] == "view_medicine"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("medicine_id", $_GET['id']);

		header("Location: view-medicine");
	}

	if(isset($_GET["action"]) && $_GET["action"] == "change_medicine_status"){

		require_once __DIR__."/../../classes/Medicine.php";

		$medicine = new Medicine();

		$id = $_GET['id'];

		$message = $medicine ->change_medicine_status($id);

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

	if(isset($_GET["action"]) && $_GET["action"] == "delete_medicine"){

		require_once __DIR__."/../../classes/Medicine.php";

		$medicine = new Medicine();

		$id = $_GET['id'];

		$message = $medicine ->delete_medicine($id);

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