<?php
	

	if(isset($_POST["action"]) && $_POST["action"] == "update_admin_profile"){

		require_once __DIR__."/../classes/Admin.php";

		$admin = new Admin();

		$file = $_FILES['image'];

		$message = $admin ->update_admin_details($_POST,$file);

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

	if(isset($_POST["action"]) && $_POST["action"] == "update_system_setting"){

		require_once __DIR__."/../classes/Setting.php";

		$setting = new Setting();

		$logo = $_FILES['image'];
		$icon = $_FILES['icon'];

		$message = $setting ->update_system_details($_POST,$logo,$icon);

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

	if(isset($_POST["action"]) && $_POST["action"] == "update_password"){

		require_once __DIR__."/../classes/Admin.php";

		$admin = new Admin();

		$message = $admin ->update_password($_POST);

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



?>