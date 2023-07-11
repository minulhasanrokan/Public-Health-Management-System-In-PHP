<?php

	if(isset($_POST["action"]) && $_POST["action"] == "add_test_fee"){

		require_once __DIR__."/../../classes/Test.php";

		$test = new Test();

		$message = $test ->add_test_fee_details($_POST);

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

	if(isset($_GET["action"]) && $_GET["action"] == "edit_test_fee"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("test_fee_id", $_GET['id']);

		header("Location: edit-test-fee");
	}

	if(isset($_POST["action"]) && $_POST["action"] == "update_test_fee"){

		require_once __DIR__."/../../classes/Test.php";

		$test = new Test();

		$message = $test ->update_test_fee_details($_POST);

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

	if(isset($_GET["action"]) && $_GET["action"] == "delete_test_fee"){

		require_once __DIR__."/../../classes/Test.php";

		$test = new Test();

		$id = $_GET['id'];

		$message = $test ->delete_test_fee($id);

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