<?php
	if(isset($_POST["action"]) && $_POST["action"] == "add_dead_report"){

		require_once __DIR__."/../../classes/Deadreport.php";

		$dead_report = new Deadreport();

		$file = $_FILES['image'];

		$message = $dead_report ->add_dead_report_details($_POST,$file);

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
