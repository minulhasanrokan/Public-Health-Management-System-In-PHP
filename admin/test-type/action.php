<?php
	if(isset($_POST["action"]) && $_POST["action"] == "add_test_type"){

		require_once __DIR__."/../../classes/Test.php";

		$test = new Test();

		$file = $_FILES['image'];

		$message = $test ->add_test_type_details($_POST,$file);

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

	if(isset($_POST["action"]) && $_POST["action"] == "update_test_type"){

		require_once __DIR__."/../../classes/Test.php";

		$test = new Test();

		$file = $_FILES['image'];

		$message = $test ->update_test_type_details($_POST,$file);

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

	if(isset($_GET["action"]) && $_GET["action"] == "edit_test"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("test_id", $_GET['id']);

		header("Location: edit-test-type");
	}

	if(isset($_GET["action"]) && $_GET["action"] == "view_test_type"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("test_id", $_GET['id']);

		header("Location: view-test-type");
	}

	if(isset($_GET["action"]) && $_GET["action"] == "change_test_status"){

		require_once __DIR__."/../../classes/Test.php";

		$test = new Test();

		$id = $_GET['id'];

		$message = $test ->change_test_status($id);

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

	if(isset($_GET["action"]) && $_GET["action"] == "delete_test_type"){

		require_once __DIR__."/../../classes/Test.php";

		$test = new Test();

		$id = $_GET['id'];

		$message = $test ->delete_test_type($id);

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