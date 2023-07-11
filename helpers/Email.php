<?php 

	require_once __DIR__."/../PHPMailer/PHPMailer.php";
	require_once __DIR__."/../PHPMailer/SMTP.php";
	require_once __DIR__."/../PHPMailer/Exception.php";
	require_once __DIR__."/../config/config.php";

	use PHPMailer\PHPMailer\PHPMailer;

	class Email{

		function send_email($email, $subject,$body){
        
	        $name = "Public helth management System";  
	        $to = $email; 
	        $subject = $subject;
	        $body = $body;
	        $from = "test@gmail.com";  
	        $password = "test"; 

	        $mail = new PHPMailer(true);

	        $mail->isSMTP();
	                       
	        $mail->Host = "smtp.gmail.com"; // smtp address of your email
	        $mail->SMTPAuth = true;
	        $mail->Username = $from;
	        $mail->Password = $password;
	        $mail->Port = 587;  // port
	        $mail->SMTPSecure = "tls";  // tls or ssl
	        $mail->smtpConnect([
	        'tls' => [
	            'verify_peer' => false,
	            'verify_peer_name' => false,
	            'allow_self_signed' => true
	            ]
	        ]);

	        //Email Settings
	        $mail->isHTML(true);
	        $mail->setFrom($from, $name);
	        $mail->addAddress($to); 
	        $mail->Subject = ("$subject");
	        $mail->Body = $body;
	        if ($mail->send()) {
	            return true;
	        } else {
	            return false;
	        }
	    }

	    // reset password
	    public function send_re_set_password_email($userName, $email, $token, $code,$user_type){

	        $subject = "Reset Your Password";

	        $body ='Hello,<br/>'.$userName.'<br/>Please click the Reset Password link we sent to your email<a href="'.BASEPATH.'/reset-user?v_token='.$token.'"> Click Here To Reset Your Password</a><br/>Your Verification Code is:'.$code;

	        $sentEmail = self::send_email($email, $subject,$body);

	        if ($sentEmail) {
	            return true;
	        }
	        else{
	            return false;
	        }
	    }

	    function send_user_verify_email($name, $email, $userVToken, $code,$user_type){

	        $subject = "Active Your Acount";

	        $body ='Hello,<br/>'.$name.'<br/>Please click the activation link we sent to your email<a href="'.BASEPATH.'/user-activation?v_token='.$userVToken.'"> Click Here To Active Your Acount</a><br/>Your Verification Code is:'.$code;
	        $sentEmail = self::send_email($email, $subject,$body);

	        if ($sentEmail) {
	            return true;
	        }
	        else{
	            return false;
	        }
	    }

	     function send_verify_email($name, $email, $userVToken, $code,$user_type,$password){

	        $subject = "Your Acount Details: ";

	        $body ='Hello,<br/>'.$name.'<br/>Your Password is:'.$password;
	        $sentEmail = self::send_email($email, $subject,$body);

	        if ($sentEmail) {
	            return true;
	        }
	        else{
	            return false;
	        }
	    }

	    public function send_appointment_email($appointment_id,$status=0){

	    	require_once __DIR__."/../classes/Appointment.php";
	    	require_once __DIR__."/../classes/Patient.php";
	    	require_once __DIR__."/../classes/Doctor.php";
	    	require_once __DIR__."/../classes/Nurse.php";

	    	$appointment = new Appointment();
	    	$patient = new Patient();
	    	$doctor = new Doctor();
	    	$nurse = new Nurse();

	    	$single_appointment = $appointment ->get_single_appointment($appointment_id);

	    	$single_appointment = mysqli_fetch_array($single_appointment);

	    	$single_doctor = $doctor ->get_single_doctor($single_appointment['doctor_id']);

	    	$single_doctor = mysqli_fetch_array($single_doctor);

	    	$single_patient = $patient ->get_single_patient($single_appointment['patient_id']);

	    	$single_patient = mysqli_fetch_array($single_patient);

	    	$single_nurse = $nurse ->get_single_nurse($single_appointment['nurse_id']);

	    	$single_nurse = mysqli_fetch_array($single_nurse);

	    	$subject = "Appointment Information";

	    	if($status==1)
	    	{

	    		$body ='Hello,<br/>'.$single_patient['name'].'<br/>Your Appointment Is Accepted Succesfully With Doctor '.$single_doctor['name'].'.<br>Your Appointment Number  Is:'.$single_appointment['appointment_number'];

		        $sentEmail = self::send_email($single_patient['email'], $subject,$body);

		        if($sentEmail){

        			return true;
        		}
        		else{

        			return false;
        		}
	    	}
	    	else if($status==0){

		        $body ='Hello,<br/>'.$single_patient['name'].'<br/>Your Appointment Is Created Succesfully With Doctor '.$single_doctor['name'].'. Please Wait For Confirmation Message.<br>Your Appointment Number  Is:'.$single_appointment['appointment_number'];

		        $sentEmail = self::send_email($single_patient['email'], $subject,$body);

		        if ($sentEmail) {

		        	$body ='Hello,<br/>'.$single_doctor['name'].'<br/>You Have A Appointment With '.$single_patient['name'].'. Please Check And Confirm .<br>Appointment Number  Is:'.$single_appointment['appointment_number'];

		        	$sentEmail = self::send_email($single_doctor['email'], $subject,$body);

		        	if ($sentEmail) {

		        		$body ='Hello,<br/>'.$single_nurse['name'].'<br/>'.$single_doctor['name'].' Have A Appointment With '.$single_patient['name'].'. Please Check And Confirm .<br>Appointment Number  Is:'.$single_appointment['appointment_number'];

		        		$sentEmail = self::send_email($single_nurse['email'], $subject,$body);

		        		if($sentEmail){

		        			return true;
		        		}
		        		else{

		        			return false;
		        		}
		        	}
		        	else{
			            return false;
			        }
		        }
		        else{
		            return false;
		        }
		    }
		    if($status==2)
	    	{

	    		$body ='Hello,<br/>'.$single_patient['name'].'<br/>Your Appointment Is Rejected With Doctor '.$single_doctor['name'];

		        $sentEmail = self::send_email($single_patient['email'], $subject,$body);

		        if($sentEmail){

        			return true;
        		}
        		else{

        			return false;
        		}
	    	}

	    }
	}