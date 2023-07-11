<?php

	include_once __DIR__.'/../lib/database.php';
	include_once __DIR__.'/../lib/Session.php';
	include_once __DIR__.'/../helpers/Format.php';

	class Login{

		private $database;
		private $dataFormat;
	 
		public function __construct(){

			$this->database= new Database();
			$this->dataFormat= new Format();
		}

		public function administrator_login($data){

			$email 		= $this->dataFormat->data_validation($data['user_name']);
			$password 	= $this->dataFormat->data_validation($data['password']);

			if ($email!='' && $password!='') {

				$password = $this->dataFormat->pass_md5($password);

				$loginQuery = "SELECT * FROM admin WHERE email ='$email' AND password ='$password' and status=1";

				$login= $this->database->select($loginQuery);

				if ($login>'0') {
					
					$loginData = mysqli_fetch_array($login);

					if ($loginData['status']==1) {

						$Status = $loginData['status'];
						$id = $loginData['admin_id'];
						$email = $loginData['email'];
						$name = $loginData['name'];

						Session::initSession();

						Session::setSession('login', true);

						Session::setSession('administratorStatus', $Status);

						Session::setSession('administratorId', $id);

						Session::setSession('administratorEmail', $email);

						Session::setSession('administratorName', $name);

						$status = $this->add_login_history(1,$id);

						if ($status==1) {
							
							$meassage = "1***".BASEPATH.'/admin';
						}
						else{

							unset($_SESSION);
							$meassage = "0***Something Went Wrong. Please Contact With Administator.";
						}

						return $meassage;

					}
					else{
						$meassage = "0***Wrong User Email Or Password. Please Try With Write User name Name Password.";
      					return $meassage;
					}
				}
				else{
					$meassage = "0***Wrong User Email Or Password. Please Try With Write User name Name Password.";
      				return $meassage;
				}
			}
			else{

				$meassage = "0***User Name Or Email and Password Must Not Be Empty";
	      		return $meassage;
			}
		}

		public function doctor_login($data){

			$email 		= $this->dataFormat->data_validation($data['user_name']);
			$password 	= $this->dataFormat->data_validation($data['password']);

			if ($email!='' && $password!='') {

				$password = $this->dataFormat->pass_md5($password);

				$loginQuery = "SELECT * FROM doctor WHERE email ='$email' AND password ='$password' and status=1 and v_status=1";

				$login= $this->database->select($loginQuery);

				if ($login>'0') {
					
					$loginData = mysqli_fetch_array($login);

					if ($loginData['status']==1) {

						$Status = $loginData['status'];
						$vStatus = $loginData['v_status'];
						$id = $loginData['doctor_id'];
						$email = $loginData['email'];
						$name = $loginData['name'];

						Session::initSession();

						Session::setSession('login', true);

						Session::setSession('doctorStatus', $Status);

						Session::setSession('doctorId', $id);

						Session::setSession('doctorEmail', $email);

						Session::setSession('doctorlName', $name);

						$status = $this->add_login_history(2,$id);

						if ($status==1) {
							
							$meassage = "1***".BASEPATH.'/doctor';
						}
						else{

							unset($_SESSION);
							$meassage = "0***Something Went Wrong. Please Contact With Administator.";
						}

						return $meassage;

					}
					else{
						$meassage = "0***Wrong User Email Or Password. Please Try With Write User name Name Password.";
      					return $meassage;
					}
				}
				else{
					$meassage = "0***Wrong User Email Or Password. Please Try With Write User name Name Password.";
      				return $meassage;
				}
			}
			else{

				$meassage = "0***User Name Or Email and Password Must Not Be Empty";
	      		return $meassage;
			}
		}

		public function nurse_login($data){

			$email 		= $this->dataFormat->data_validation($data['user_name']);
			$password 	= $this->dataFormat->data_validation($data['password']);

			if ($email!='' && $password!='') {

				$password = $this->dataFormat->pass_md5($password);

				$loginQuery = "SELECT * FROM nurse WHERE email ='$email' AND password ='$password' and status=1 and v_status=1";

				$login= $this->database->select($loginQuery);

				if ($login>'0') {
					
					$loginData = mysqli_fetch_array($login);

					if ($loginData['status']==1) {

						$Status = $loginData['status'];
						$vStatus = $loginData['v_status'];
						$id = $loginData['nurse_id'];
						$email = $loginData['email'];
						$name = $loginData['name'];

						Session::initSession();

						Session::setSession('login', true);

						Session::setSession('nurseStatus', $Status);

						Session::setSession('nurseId', $id);

						Session::setSession('nurseEmail', $email);

						Session::setSession('nurselName', $name);

						$status = $this->add_login_history(3,$id);

						if ($status==1) {
							
							$meassage = "1***".BASEPATH.'/nurse';
						}
						else{

							unset($_SESSION);
							$meassage = "0***Something Went Wrong. Please Contact With Administator.";
						}

						return $meassage;

					}
					else{
						$meassage = "0***Wrong User Email Or Password. Please Try With Write User name Name Password.";
      					return $meassage;
					}
				}
				else{
					$meassage = "0***Wrong User Email Or Password. Please Try With Write User name Name Password.";
      				return $meassage;
				}
			}
			else{

				$meassage = "0***User Name Or Email and Password Must Not Be Empty";
	      		return $meassage;
			}
		}

		public function pharmacist_login($data){

			$email 		= $this->dataFormat->data_validation($data['user_name']);
			$password 	= $this->dataFormat->data_validation($data['password']);

			if ($email!='' && $password!='') {

				$password = $this->dataFormat->pass_md5($password);

				$loginQuery = "SELECT * FROM pharmacist WHERE email ='$email' AND password ='$password' and status=1 and v_status=1";

				$login= $this->database->select($loginQuery);

				if ($login>'0') {
					
					$loginData = mysqli_fetch_array($login);

					if ($loginData['status']==1) {

						$Status = $loginData['status'];
						$vStatus = $loginData['v_status'];
						$id = $loginData['pharmacist_id'];
						$email = $loginData['email'];
						$name = $loginData['name'];

						Session::initSession();

						Session::setSession('login', true);

						Session::setSession('pharmacistStatus', $Status);

						Session::setSession('pharmacistId', $id);

						Session::setSession('pharmacistEmail', $email);

						Session::setSession('pharmacistName', $name);

						$status = $this->add_login_history(4,$id);

						if ($status==1) {
							
							$meassage = "1***".BASEPATH.'/pharmacist';
						}
						else{

							unset($_SESSION);
							$meassage = "0***Something Went Wrong. Please Contact With Administator.";
						}

						return $meassage;

					}
					else{
						$meassage = "0***Wrong User Email Or Password. Please Try With Write User name Name Password.";
      					return $meassage;
					}
				}
				else{
					$meassage = "0***Wrong User Email Or Password. Please Try With Write User name Name Password.";
      				return $meassage;
				}
			}
			else{

				$meassage = "0***User Name Or Email and Password Must Not Be Empty";
	      		return $meassage;
			}
		}

		public function Login_laboratorist($data){

			$email 		= $this->dataFormat->data_validation($data['user_name']); 
			$password 	= $this->dataFormat->data_validation($data['password']);

			if ($email!='' && $password!='') {

				$password = $this->dataFormat->pass_md5($password);

				$loginQuery = "SELECT * FROM laboratorist WHERE email ='$email' AND password ='$password' and status=1 and v_status=1";

				$login= $this->database->select($loginQuery);

				if ($login>'0') {
					
					$loginData = mysqli_fetch_array($login);

					if ($loginData['status']==1) {

						$Status = $loginData['status'];
						$vStatus = $loginData['v_status'];
						$id = $loginData['laboratorist_id'];
						$email = $loginData['email'];
						$name = $loginData['name'];

						Session::initSession();

						Session::setSession('login', true);

						Session::setSession('laboratoristStatus', $Status);

						Session::setSession('laboratoristId', $id);

						Session::setSession('laboratoristEmail', $email);

						Session::setSession('laboratoristName', $name);

						$status = $this->add_login_history(5,$id);

						if ($status==1) {
							
							$meassage = "1***".BASEPATH.'/laboratorist';
						}
						else{

							unset($_SESSION);
							$meassage = "0***Something Went Wrong. Please Contact With Administator.";
						}

						return $meassage;

					}
					else{
						$meassage = "0***Wrong User Email Or Password. Please Try With Write User name Name Password.";
      					return $meassage;
					}
				}
				else{
					$meassage = "0***Wrong User Email Or Password. Please Try With Write User name Name Password.";
      				return $meassage;
				}
			}
			else{

				$meassage = "0***User Name Or Email and Password Must Not Be Empty";
	      		return $meassage;
			}
		}

		public function login_accountant($data){

			$email 		= $this->dataFormat->data_validation($data['user_name']); 
			$password 	= $this->dataFormat->data_validation($data['password']);

			if ($email!='' && $password!='') {

				$password = $this->dataFormat->pass_md5($password);

				$loginQuery = "SELECT * FROM accountant WHERE email ='$email' AND password ='$password' and status=1 and v_status=1";

				$login= $this->database->select($loginQuery);

				if ($login>'0') {
					
					$loginData = mysqli_fetch_array($login);

					if ($loginData['status']==1) {

						$Status = $loginData['status'];
						$vStatus = $loginData['v_status'];
						$id = $loginData['accountant_id'];
						$email = $loginData['email'];
						$name = $loginData['name'];

						Session::initSession();

						Session::setSession('login', true);

						Session::setSession('accountantStatus', $Status);

						Session::setSession('accountantId', $id);

						Session::setSession('accountantEmail', $email);

						Session::setSession('accountantName', $name);

						$status = $this->add_login_history(6,$id);

						if ($status==1) {
							
							$meassage = "1***".BASEPATH.'/accountant';
						}
						else{

							unset($_SESSION);
							$meassage = "0***Something Went Wrong. Please Contact With Administator.";
						}

						return $meassage;

					}
					else{
						$meassage = "0***Wrong User Email Or Password. Please Try With Write User name Name Password.";
      					return $meassage;
					}
				}
				else{
					$meassage = "0***Wrong User Email Or Password. Please Try With Write User name Name Password.";
      				return $meassage;
				}
			}
			else{

				$meassage = "0***User Name Or Email and Password Must Not Be Empty";
	      		return $meassage;
			}
		}

		public function login_patient($data){

			$email 		= $this->dataFormat->data_validation($data['user_name']); 
			$password 	= $this->dataFormat->data_validation($data['password']);

			if ($email!='' && $password!='') {

				$password = $this->dataFormat->pass_md5($password);

				$loginQuery = "SELECT * FROM patient WHERE email ='$email' AND password ='$password' and status=1 and v_status=1";

				$login= $this->database->select($loginQuery);

				if ($login>'0') {
					
					$loginData = mysqli_fetch_array($login);

					if ($loginData['status']==1) {

						$Status = $loginData['status'];
						$vStatus = $loginData['v_status'];
						$id = $loginData['patient_id'];
						$email = $loginData['email'];
						$name = $loginData['name'];

						Session::initSession();

						Session::setSession('login', true);

						Session::setSession('patientStatus', $Status);

						Session::setSession('patientId', $id);

						Session::setSession('patientEmail', $email);

						Session::setSession('patientName', $name);

						$status = $this->add_login_history(7,$id);

						if ($status==1) {
							
							$meassage = "1***".BASEPATH.'/patient';
						}
						else{

							unset($_SESSION);
							$meassage = "0***Something Went Wrong. Please Contact With Administator.";
						}

						return $meassage;

					}
					else{
						$meassage = "0***Wrong User Email Or Password. Please Try With Write User name Name Password.";
      					return $meassage;
					}
				}
				else{
					$meassage = "0***Wrong User Email Or Password. Please Try With Write User name Name Password.";
      				return $meassage;
				}
			}
			else{

				$meassage = "0***User Name Or Email and Password Must Not Be Empty";
	      		return $meassage;
			}
		}

		public function add_login_history($user_type,$user_id){
			
			$user_type = $user_type;
			$user_id = $user_id;
			$login_status = 1;
			$ip_address = $_SERVER['REMOTE_ADDR'];

			$login_time = date('Y-m-d h:i:s a');

			$insertQuery ="INSERT INTO log_history(user_type, ip_address, login_status, login_time, user_id) VALUES ('$user_type', '$ip_address','$login_status', '$login_time', $user_id)";
			$insertQuery = $this->database->insert($insertQuery);

			if($insertQuery==true){

				return 1;
			}
			else{

				return 0;
			}
		}

		public function add_logout_history($user_type,$user_id){

			$ip_address = $_SERVER['REMOTE_ADDR'];

			$log_out_time = date('Y-m-d h:i:s a');

			$selectQuery = "SELECT MAX(ID) AS ID FROM log_history WHERE ip_address ='$ip_address' AND user_type ='$user_type' and user_id=$user_id";

			$select= $this->database->select($selectQuery);

			if ($select>'0') {
				
				$loginData = mysqli_fetch_array($select);

				$id = $loginData['ID'];

				$updateData = "update log_history set log_out_status=1, log_out_time='$log_out_time' where id=$id";

				$updateData= $this->database->update($updateData);

				if($updateData==true)
				{
					return 1;
				}
				else{

					return 0;
				}

			}
			else{

				$insertQuery ="INSERT INTO log_history(user_type, ip_address, log_out_status, log_out_time, user_id) VALUES ('$user_type', '$ip_address','1', '$log_out_time', $user_id)";

				$insertQuery = $this->database->insert($insertQuery);

				if($insertQuery==true){

					return 1;
				}
				else{

					return 0;
				}
			}
		}

		public function get_all_user_log_history($ofset=null, $limit=null, $data=null){

			$where_con = '';

			if($data!=null)
			{
				$user_type = '';

				if ($data=='Admin') {
					
					$user_type = 1;
				}
				else if ($data=='Doctor') {
					
					$user_type = 2;
				}
				else if ($data=='Nurse') {
					
					$user_type = 3;
				}
				else if ($data=='Pharmacist') {
					
					$user_type = 4;
				}
				else if ($data=='Laboratorist') {
					
					$user_type = 5;
				}
				else if ($data=='Accountant') {
					
					$user_type = 6;
				}
				else if ($data=='Patient') {
					
					$user_type = 7;
				}

				if($user_type!=''){

					$where_con .=" and a.user_type=$user_type";

				}
			}

			if($ofset==null AND $limit==null){

				$selectData = "SELECT a.* FROM log_history a WHERE a.status=1 $where_con ORDER BY a.id DESC";
			}
			else{

				$selectData = "SELECT a.* FROM log_history a WHERE a.status=1 $where_con ORDER BY a.id DESC LIMIT $ofset, $limit";
			}

			$allData= $this->database->select($selectData);

			if ($allData>'0') {

				return $allData;
			}
		}
	}