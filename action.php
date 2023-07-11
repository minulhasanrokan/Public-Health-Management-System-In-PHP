<?php
	
	if(isset($_POST["action"]) && $_POST["action"] == "login_admin"){

		include_once __DIR__."/lib/Session.php";
		include_once __DIR__."/classes/Login.php";

    	$login = new Login();

		$meassage = $login ->administrator_login($_POST);

		$meassage_data = explode("***",$meassage);

		if($meassage_data[0]==1){

			Session::initSession();
			Session::setSession("message", "Admin Login Success");
			Session::setSession("alert-type", "success");

			header("location: ".$meassage_data[1]);
		}
		else{

			Session::initSession();
			Session::setSession("meassage_data", $meassage_data[1]);

			Session::setSession("message", $meassage_data[1]);
			Session::setSession("alert-type", "error");

			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
		
	}

	if(isset($_POST["action"]) && $_POST["action"] == "login_doctor"){

		include_once __DIR__."/lib/Session.php";
		include_once __DIR__."/classes/Login.php";

    	$login = new Login();

		$meassage = $login ->doctor_login($_POST);

		$meassage_data = explode("***",$meassage);

		if($meassage_data[0]==1){

			Session::initSession();
			Session::setSession("message", "Doctor Login Success");
			Session::setSession("alert-type", "success");

			header("location: ".$meassage_data[1]);
		}
		else{

			Session::initSession();
			Session::setSession("meassage_data", $meassage_data[1]);

			Session::setSession("message", $meassage_data[1]);
			Session::setSession("alert-type", "error");

			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
		
	}

	if(isset($_POST["action"]) && $_POST["action"] == "login_nurse"){

		include_once __DIR__."/lib/Session.php";
		include_once __DIR__."/classes/Login.php";

    	$login = new Login();

		$meassage = $login ->nurse_login($_POST);

		$meassage_data = explode("***",$meassage);

		if($meassage_data[0]==1){

			Session::initSession();
			Session::setSession("message", "Nurse Login Success");
			Session::setSession("alert-type", "success");

			header("location: ".$meassage_data[1]);
		}
		else{

			Session::initSession();
			Session::setSession("meassage_data", $meassage_data[1]);

			Session::setSession("message", $meassage_data[1]);
			Session::setSession("alert-type", "error");

			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
		
	}

	if(isset($_POST["action"]) && $_POST["action"] == "login_pharmacist"){

		include_once __DIR__."/lib/Session.php";
		include_once __DIR__."/classes/Login.php";

    	$login = new Login();

		$meassage = $login ->pharmacist_login($_POST);

		$meassage_data = explode("***",$meassage);

		if($meassage_data[0]==1){

			Session::initSession();
			Session::setSession("message", "Pharmacist Login Success");
			Session::setSession("alert-type", "success");

			header("location: ".$meassage_data[1]);
		}
		else{

			Session::initSession();
			Session::setSession("meassage_data", $meassage_data[1]);

			Session::setSession("message", $meassage_data[1]);
			Session::setSession("alert-type", "error");

			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
		
	}

	if(isset($_POST["action"]) && $_POST["action"] == "login_laboratorist"){

		include_once __DIR__."/lib/Session.php";
		include_once __DIR__."/classes/Login.php";

    	$login = new Login();

		$meassage = $login ->Login_laboratorist($_POST);

		$meassage_data = explode("***",$meassage);

		if($meassage_data[0]==1){

			Session::initSession();
			Session::setSession("message", "laboratorist Login Success");
			Session::setSession("alert-type", "success");

			header("location: ".$meassage_data[1]);
		}
		else{

			Session::initSession();
			Session::setSession("meassage_data", $meassage_data[1]);

			Session::setSession("message", $meassage_data[1]);
			Session::setSession("alert-type", "error");

			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
		
	}

	if(isset($_POST["action"]) && $_POST["action"] == "login_accountant"){

		include_once __DIR__."/lib/Session.php";
		include_once __DIR__."/classes/Login.php";

    	$login = new Login();

		$meassage = $login ->login_accountant($_POST);

		$meassage_data = explode("***",$meassage);

		if($meassage_data[0]==1){

			Session::initSession();
			Session::setSession("message", "Accountant Login Success");
			Session::setSession("alert-type", "success");

			header("location: ".$meassage_data[1]);
		}
		else{

			Session::initSession();
			Session::setSession("meassage_data", $meassage_data[1]);

			Session::setSession("message", $meassage_data[1]);
			Session::setSession("alert-type", "error");

			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
		
	}

	if(isset($_POST["action"]) && $_POST["action"] == "login_patient"){

		include_once __DIR__."/lib/Session.php";
		include_once __DIR__."/classes/Login.php";

    	$login = new Login();

		$meassage = $login ->login_patient($_POST);

		$meassage_data = explode("***",$meassage);

		if($meassage_data[0]==1){

			Session::initSession();
			Session::setSession("message", "Patient Login Success");
			Session::setSession("alert-type", "success");

			header("location: ".$meassage_data[1]);
		}
		else{

			Session::initSession();
			Session::setSession("meassage_data", $meassage_data[1]);

			Session::setSession("message", $meassage_data[1]);
			Session::setSession("alert-type", "error");

			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
		
	}

	if(isset($_POST["action"]) && $_POST["action"] == "patient_register"){

		include_once __DIR__."/lib/Session.php";
		include_once __DIR__."/classes/Register.php";

    	$register = new Register();

		$meassage = $register ->patient_register($_POST);

		$meassage_data = explode("***",$meassage);

		if($meassage_data[0]==1){

			Session::initSession();
			Session::setSession("meassage_data", $meassage_data[1]);

			header("location: ".$_SERVER["HTTP_REFERER"]);
		}
		else{

			Session::initSession();
			Session::setSession("meassage_data", $meassage_data[1]);

			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
		
	}

	if($_POST['action'] == 'forgot_password'){

		$_POST['user_type']=1;

		include_once __DIR__.'/classes/Register.php';

	    $forgotPassword = new Register();
	    
	    if ($_SERVER['REQUEST_METHOD']=="POST") {
	        if ($_POST['user_type']==1) {
	            $meassage = $forgotPassword->re_set_password($_POST);
	        }
	        else if($_POST['user_type']==2){
	            $meassage = $forgotPassword->re_set_doctor_password($_POST);
	        }
	        else if($_POST['user_type']==3){
	            $meassage = $forgotPassword->re_set_hospital_password($_POST);
	        }
	        else{
	            $meassage = "0***Please Select User Type";
	        }
	    }
	    else{
	    	$meassage = "0***Something Went Wrong!!!. Please Select Right User Type and try again to Reset Your Password";
	    }

	    $meassage_data = explode("***",$meassage);

		if($meassage_data[0]==1){

			Session::initSession();
			Session::setSession("meassage_data", $meassage_data[1]);

			header("location: ".$_SERVER["HTTP_REFERER"]);
		}
		else{

			Session::initSession();
			Session::setSession("meassage_data", $meassage_data[1]);

			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}

	if($_POST['action'] == 'account_activation'){

		if(isset($_POST['v_token'])){

	        $vToken = $_POST['v_token'];

	        include_once __DIR__.'/classes/Register.php';

	        $verify = new Register();

	        if ($_SERVER['REQUEST_METHOD']=="POST"){
	            
	            $vCode = $_POST['v_code'];
	            $email = $_POST['user_name'];
	            $user_type = $_POST['user_type'];

	            $meassage = $verify->verify_account($vToken,$vCode,$email,$user_type);
	        }
	    }
	    else{
	        header("location:login.php");
	    }

	    $meassage_data = explode("***",$meassage);

		if($meassage_data[0]==1){

			Session::initSession();
			Session::setSession("meassage_data", $meassage_data[1]);

			header("location: index ");
		}
		else{

			Session::initSession();
			Session::setSession("meassage_data", $meassage_data[1]);

			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}

	if($_POST['action'] == 'reset_password'){

		if(isset($_POST['v_token'])){

	        $vToken = $_POST['v_token'];

	        include_once __DIR__.'/classes/Register.php';

	        $verify = new Register();

	        if ($_SERVER['REQUEST_METHOD']=="POST"){
	            
	            $vCode = $_POST['v_code'];
	            $email = $_POST['user_name'];
	            $new_pass1 = $_POST['new_pass1'];
	            $new_pass2 = $_POST['new_pass2'];
	            $user_type = $_POST['user_type'];

	            $meassage = $verify->update_password($vToken,$vCode,$email,$user_type,$new_pass1,$new_pass2);
	        }
	    }
	    else{
	        header("location:login.php");
	    }

	    $meassage_data = explode("***",$meassage);

		if($meassage_data[0]==1){

			Session::initSession();
			Session::setSession("meassage_data", $meassage_data[1]);

			header("location: index ");
		}
		else{

			Session::initSession();
			Session::setSession("meassage_data", $meassage_data[1]);

			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}

?>