<?php

	if(isset($_POST["action"]) && $_POST["action"] == "add_notice"){

		require_once __DIR__."/../../classes/Notice.php";

		$notice = new Notice();

		$file = $_FILES['file'];

		$message = $notice ->add_notice_details($_POST,$file);

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

	if(isset($_GET["action"]) && $_GET["action"] == "edit_notice"){

		include_once __DIR__.'/../../lib/Session.php';

		Session::initSession();

		Session::setSession("notice_id", $_GET['id']);

		header("Location: edit-notice");
	}