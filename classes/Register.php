<?php

	include_once __DIR__.'/../lib/database.php';
	include_once __DIR__.'/../lib/Session.php';
	include_once __DIR__.'/../helpers/Format.php';
	include_once __DIR__.'/../helpers/Email.php';

	class Register{

		private $database;
		private $dataFormat;
		private $email;
	 
		public function __construct(){

			//Session::checkSession();

			$this->database= new Database();
			$this->dataFormat= new Format();
			$this->email= new Email();
		}

		public function patient_register($data){

			$mobile = $this->dataFormat->data_validation($data['mobile']);
			$email = $this->dataFormat->data_validation($data['email']);
			$password = $this->dataFormat->data_validation($data['password']);
			$c_password = $this->dataFormat->data_validation($data['c_password']);
			$customCheck1 = $this->dataFormat->data_validation($data['customCheck1']);

			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			  	
			  	$meassage = "0***Please Enter Valid Email Address!!";
				return $meassage;
			}

			if($password!=$c_password){

				$meassage = "0***Confirmation Password Does Not Match!!";
				return $meassage;
			}

			if (isset($mobile) && $mobile!='' && isset($email) && $email!='' && isset($customCheck1) && $customCheck1=='on' && isset($password) && $password!='') {

				// strong pass check
				$uppercase = preg_match('@[A-Z]@', $password);
				$lowercase = preg_match('@[a-z]@', $password);
				$number    = preg_match('@[0-9]@', $password);
				$specialChars = preg_match('@[^\w]@', $password);

				if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
				    return $meassage= '0***Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
				}

				$getUserQuery = "SELECT patient_id FROM patient WHERE email='$email' OR mobile='$mobile'";

				$getUserQuery= $this->database->select($getUserQuery);

				if (!empty($getUserQuery)) {

					return $meassage = "0***You Have A Already An Account. Please Login Your Acount";
				}
				else{

					$passwordMd5 = $this->dataFormat->pass_md5($password);

					$token = $this->dataFormat->pass_md5(rand());

					$code = rand(000000,999999);

					$insertPatientQuery ="INSERT INTO patient(email, mobile, password, token, v_code) VALUES ('$email','$mobile','$passwordMd5','$token','$code')";

					$insertPatient= $this->database->insert($insertPatientQuery);

					if ($insertPatient) {

						$id = $this->database->last_insert_id();

						$status = $this->email->send_user_verify_email($userName, $email, $token, $code,$user_type='patient');

						if($status==true){

							$meassage = "1***Your Acount Created Succesfully. Please Check Your Email To Verify Your Acount";
							return $meassage;
						}
						else{

							$deletePatientQuery = "delete from patient where patient_id=$id";
							$deletePatient= $this->database->delete($deletePatientQuery);
							
							$meassage = "0***Something Went Wrong, Please Contact With Administator!!";
							return $meassage;
						}
					}
					else{
						$meassage = "0***Something Went Wrong, Please Contact With Administator!!";
						return $meassage;
					}

				}
			}
			else{

				$meassage = '0*** Mobile, Email And Password Field Must Not Be Empty!!!';

				return $meassage;
			}
		}

		public function add_patient_data($data,$file){

			$name = $this->dataFormat->data_validation($data['name']);
			$mobile = $this->dataFormat->data_validation($data['mobile']);
			$email = $this->dataFormat->data_validation($data['email']);
			$birth_date = $this->dataFormat->data_validation($data['birth_date']);
			$blood_group = $this->dataFormat->data_validation($data['blood_group']);
			$sex = $this->dataFormat->data_validation($data['sex']);
			$address = $this->dataFormat->data_validation($data['address']);
			$description = $this->dataFormat->data_validation($data['description']);

			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			  	
			  	$meassage = "0***Please Enter Valid Email Address!!";
				return $meassage;
			}

			if (isset($mobile) && $mobile!='' && isset($email) && $email!='' && isset($name) && $name!='') {

				$getUserQuery = "SELECT patient_id FROM patient WHERE email='$email' OR mobile='$mobile'";

				$getUserQuery= $this->database->select($getUserQuery);

				if ($getUserQuery>'0') {

					return $meassage = "0***Already An Account. Please Login Your Acount";
				}
				else{

					$image = $file;
					$imageName = '';

					if($image['name']!=null){

						$file_name = $image['name'];
					    $file_size =$image['size'];
				        $file_tmp =$image['tmp_name'];
					    $file_type=$image['type'];

					    $file_ext = pathinfo($file_name,PATHINFO_EXTENSION);

					    $imageName =$name."-".substr(md5(time()),0,10).'.'.$file_ext;
					    $imageName = str_replace(' ','-',$imageName);
					    $filePath = __DIR__.'../../uploads/patient/'.$imageName; 
					    $extensions= array("jpeg","jpg","png");

					    if(in_array($file_ext,$extensions)=== false){
						    	
					    	$meassage="0***File extension not allowed, please choose a jpeg ,jpg or png file.";
		         			return $meassage;
					    }
					    elseif($file_size > 2097152){
			        
					        $meassage='0***File size must be excately 2 MB';
					        return $meassage;
					    }

					}

					$comb = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&.';
					$pass = array(); 
					$combLen = strlen($comb) - 1; 
					for ($i = 0; $i < 8; $i++) {
					    
					    $n = rand(0, $combLen);
					    $pass[] = $comb[$n];
					}
					$password = implode($pass);

					$passwordMd5 = $this->dataFormat->pass_md5($password);

					$token = $this->dataFormat->pass_md5(rand());

					$code = rand(000000,999999);

					$insertPatientQuery ="INSERT INTO patient(name, email, password, address, mobile, sex, birth_date, blood_group, token, v_code, image, description) VALUES ('$name','$email','$passwordMd5','$address','$mobile','$sex','$birth_date','$blood_group','$token','$code','$imageName','$description')";

					$insertPatient= $this->database->insert($insertPatientQuery);

					if ($insertPatient) {

						$id = $this->database->last_insert_id();

						$status = $this->email->send_patient_verify_email($mobile, $email, $token, $code,$id,$password);

						if($status==true){

							$meassage = "1***Patient Acount Created Succesfully. Please Check Email To Verify Acount";
							return $meassage;
						}
						else{

							$deletePatientQuery = "delete from patient where patient_id=$id";
							$deletePatient= $this->database->delete($deletePatientQuery);
							
							$meassage = "0***Something Went Wrong, Please Contact With Administator!!";
							return $meassage;
						}
					}
					else{
						$meassage = "0***Something Went Wrong, Please Contact With Administator!!";
						return $meassage;
					}

				}
			}
			else{

				$meassage = '0*** Mobile, Email And Name Field Must Not Be Empty!!!';

				return $meassage;
			}
		}

		/// re set password.......
		public function re_set_password($data){

			$email = $this->dataFormat->data_validation($data['user_name']);

			if ($email!='') {
				
				$getUserQuery = "SELECT * FROM patient WHERE email='$email' and status=1";

				$getUserQuery= $this->database->select($getUserQuery);

				if ($getUserQuery>'0') {

					$userData = mysqli_fetch_array($getUserQuery);

					if ($userData['v_status']==1) {

						$patient_id = $userData['patient_id'];

						$v_code = rand(000000,999999);
						$v_token = $this->dataFormat->pass_md5(rand());

						$updatePatient = "UPDATE patient SET v_code='$v_code', token='$v_token' WHERE patient_id=$patient_id";

						$updatePatient= $this->database->update($updatePatient);

						if ($updatePatient) {

							$userName = $userData['name'];
							$email = $userData['email'];
							$token = $v_token;
							$code = $v_code;

							$this->email->send_re_set_password_email($userName, $email, $token, $code,$user_type='patient');

							if($email==true){

								return $meassage = "1***Check Your Email to Reset Your Acount Password. Then Try to Login Your Account";
							}
							else{
								$meassage = "0***Something Went Wrong, Please Contact With Administator!!";
								return $meassage;
							}
						}
						else{
						
							$meassage ="0***Something Wrong!!!";
							return $meassage;
						}
					}
					else{

						$userName = $userData['name'];
						$email = $userData['email'];
						$token = $userData['token'];
						$code = $userData['v_code'];

						$this->email->send_user_verify_email($userName, $email, $token, $code,$user_type='patient');

						if($email==true){

							return $meassage = "0***Check Your Email to Verify Your Acount. Then Try to Reset Your Password";
						}
						else{
							$meassage = "0***Something Went Wrong, Please Contact With Administator!!";
							return $meassage;
						}
					}

				}
				else{
					return $meassage = "0***No Account Foun!!!  Please At Fast Create An Account";
				}
			}
			else{
				return $meassage = '0***Email Field Must Not Be Empty!!!';
			}
		}

		// verify account.........
		public function verify_account($vToken,$vCode,$email,$user_type){

			if ($vToken!='' && $vCode!='' && $email!='') {

				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			  	
				  	$meassage = "0***Please Enter Valid Email Address!!";
					return $meassage;
				}
				
				$getUserQuery = "SELECT * FROM patient WHERE token='$vToken' and v_code='$vCode' and email='$email' and status=1";

				$getUserQuery= $this->database->select($getUserQuery);

				if ($getUserQuery>'0') {

					$userData = mysqli_fetch_array($getUserQuery);
				
					if ($userData['v_status']==1) {

						return $meassage = "0***You Have Already Verify Your Acount. Please Sign In Your Acount";
					}
					else if($userData['token']==$vToken && $userData['v_code']==$vCode){

						$token = $this->dataFormat->pass_md5(rand());

						$code = rand(000000,999999);

						$updateUserStatus = "UPDATE patient SET v_status=1, token='$token', v_code='$code' WHERE v_code='$vCode' AND token='$vToken' AND v_status=0";

						$updateUserStatus= $this->database->update($updateUserStatus);

						if ($updateUserStatus) {

							return $meassage = "1***Your Account Ativated Succesfully.";
						}
						else{
							$errorMassage ="0***Something Wrong!!!";
							return $errorMassage;
						}
					}
					else{

						return $meassage = "0***No Account Foun!!!  Please At Fast Create An Account";
					}
				}
				else{
					return $meassage = "0***No Account Foun!!!  Please At Fast Create An Account";

				}
			}
			else{
				
				return $meassage = 'Something Went Wrong!!!';
			}
		}

		public function update_password($vToken,$vCode,$email,$user_type,$new_pass1,$new_pass2){

			$vToken = $this->dataFormat->data_validation($vToken);
			$code = $this->dataFormat->data_validation($vCode);
			$email = $this->dataFormat->data_validation($email);
			$user_type = $this->dataFormat->data_validation($user_type);
			$new_pass1 = $this->dataFormat->data_validation($new_pass1);
			$new_pass2 = $this->dataFormat->data_validation($new_pass2);

			$vToken = $vToken;

			if ($new_pass1!='' && $new_pass2!='' && $code!='') {

				if ($new_pass1==$new_pass2) {

					// strong pass check
					$uppercase = preg_match('@[A-Z]@', $new_pass1);
					$lowercase = preg_match('@[a-z]@', $new_pass1);
					$number    = preg_match('@[0-9]@', $new_pass1);
					$specialChars = preg_match('@[^\w]@', $new_pass1);

					if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($new_pass1) < 8) {
					    return $meassage= '0***Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
					}
					else{
						
						$getUserQuery = "SELECT * FROM patient WHERE token='$vToken' && v_code='$code' && email='$email' and status=1";

						$getUserQuery= $this->database->select($getUserQuery);

						if ($getUserQuery>'0') {

							$userData = mysqli_fetch_array($getUserQuery);

							if ($userData['v_status']==1) {

								$id = $userData['patient_id'];

								$token = $this->dataFormat->pass_md5(rand());

								$password = $this->dataFormat->pass_md5($new_pass1);

								$code = rand(000000,999999);

								$updateUserPassword = "UPDATE patient SET v_status=1, token='$token', v_code='$code', password='$password' WHERE patient_id=$id";

								$updateUserPassword= $this->database->update($updateUserPassword);

								if ($updateUserPassword) {

									return $meassage = "1***Your Password Reset Succesfully.";
								}
								else{
									$errorMassage ="0***Something Wrong!!!";
									return $errorMassage;
								}
							}
							else{

								$userName = $userData['name'];
								$email = $userData['email'];
								$token = $userData['token'];
								$code = $userData['v_code'];

								$email = $this->email->send_user_verify_email($userName, $email, $token, $code,$user_type='patient');

								if($email==true){

									return $meassage = "0***Check Your Email to Verify Your Acount. Then Try to Reset Your Password";
								}
								else{
									$meassage = "0***Something Went Wrong, Please Contact With Administator!!";
									return $meassage;
								}
							}
						}
						else{
							return $meassage = "0***No Account Foun!!!  Please At Fast Create An Account";
						}
					}
					
				}
				else{
					return $meassage = '0***Retype Password Does Not match!!!';
				}
				
			}
			else{
				return $meassage = '0***Input Field Must Not Be Empty!!!';
			}

		}
	}