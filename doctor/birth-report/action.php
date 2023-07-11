<?php
	if(isset($_POST["action"]) && $_POST["action"] == "add_birth_report"){

		require_once __DIR__."/../../classes/Birthreport.php";

		$birth_report = new Birthreport();

		$file = $_FILES['image'];

		$message = $birth_report ->add_birth_report_details($_POST,$file);

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
