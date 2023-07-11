<?php


	if(isset($_GET["action"]) && $_GET["action"] == "edit_profile"){

		include_once __DIR__.'/../../lib/Session.php';

		header("Location: edit-profile");
	}

	if(isset($_POST["action"]) && $_POST["action"] == "update_nurse"){

		include_once __DIR__.'/../lib/Session.php';

		require_once __DIR__."/../classes/Nurse.php";

		Session::initSession();

		$nurse = new Nurse();

		$file = $_FILES['image'];

		$id = 0;

	    if(isset($_SESSION['nurseId'])){
	        $id = $_SESSION['nurseId'];
	    }

		$_POST['nurse_id'] = $id;

		$message = $nurse ->update_nurse_details($_POST,$file);
		$message_data = explode("***",$message);

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

	if(isset($_POST["action"]) && $_POST["action"] == "get_notice_data_by_pagination"){

		require_once __DIR__."/body/notice.php";

	}

	if(isset($_POST["action"]) && $_POST["action"] == "download_file"){

		$filepath = '';

		if($_POST["title"]=='notice'){

			$filepath = "../uploads/notice/".$_POST["data"];
		}

		header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        flush(); // Flush system output buffer
        readfile($filepath);

	}

	if(isset($_POST["action"]) && $_POST["action"] == "update_password"){

		require_once __DIR__."/../classes/Nurse.php";

		$nurse = new Nurse();

		$message = $nurse ->update_password($_POST);

		$message_data = explode("***",$message);

		Session::initSession();

		if($message_data[0]==1){

			Session::destroySession();

			Session::initSession();
			Session::setSession("message", $message_data[1]);
			Session::setSession("alert-type", "success");
			header("Location: " .BASEPATH);


		}
		else{

			Session::setSession("message", $message_data[1]);
			Session::setSession("alert-type", "error");
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}