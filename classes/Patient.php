<?php

	include_once __DIR__.'/../lib/database.php';
	include_once __DIR__.'/../lib/Session.php';
	include_once __DIR__.'/../helpers/Format.php';
	include_once __DIR__.'/../helpers/Email.php';

	class Patient{

		private $database;
		private $dataFormat;
		private $email;
	 
		public function __construct(){

			//Session::checkSession();

			$this->database= new Database();
			$this->dataFormat= new Format();
			$this->email= new Email();
		}

		public function get_single_patient($id){

			$selectPatient = "SELECT a.* FROM patient a WHERE a.status=1 and a.v_status=1 and a.patient_id=$id";

			$allPatient= $this->database->select($selectPatient);

			if ($allPatient>'0') {

				return $allPatient;
			}
		}

		public function get_all_active_patient($ofset=null, $limit=null){

			if($ofset==null AND $limit==null){

				$selectPatient = "SELECT a.* FROM patient a WHERE a.status=1 and a.v_status=1";
			}
			else{

				$selectPatient = "SELECT a.* FROM patient a WHERE a.status=1 and a.v_status=1 $ofset, $limit";
			}

			$allPatient= $this->database->select($selectPatient);

			if ($allPatient>'0') {

				return $allPatient;
			}
		}

		public function get_all_active_patient_for_dead($ofset=null, $limit=null){

			if($ofset==null AND $limit==null){

				$selectPatient = "SELECT a.* FROM patient a WHERE a.status=1 and a.v_status=1 and a.dead_status=0 ";
			}
			else{

				$selectPatient = "SELECT a.* FROM patient a WHERE a.status=1 and a.v_status=1 and a.dead_status=0 $ofset, $limit";
			}

			$allPatient= $this->database->select($selectPatient);

			if ($allPatient>'0') {

				return $allPatient;
			}
		}

		public function get_all_active_patient_for_birth_report($ofset=null, $limit=null){

			if($ofset==null AND $limit==null){

				$selectPatient = "SELECT a.* FROM patient a WHERE a.status=1 and a.v_status=1 and a.dead_status=0 and a.sex='Female' ";
			}
			else{

				$selectPatient = "SELECT a.* FROM patient a WHERE a.status=1 and a.v_status=1 and a.dead_status=0 and a.sex='Female' $ofset, $limit";
			}

			$allPatient= $this->database->select($selectPatient);

			if ($allPatient>'0') {

				return $allPatient;
			}
		}

		public function update_patient_details($data, $file){


			$name = $this->dataFormat->data_validation($data['name']);
			$mobile = $this->dataFormat->data_validation($data['mobile']);
			$email = $this->dataFormat->data_validation($data['email']);
			$birth_date = $this->dataFormat->data_validation($data['birth_date']);
			$blood_group = $this->dataFormat->data_validation($data['blood_group']);
			$sex = $this->dataFormat->data_validation($data['sex']);
			$address = $this->dataFormat->data_validation($data['address']);
			$description = $this->dataFormat->data_validation($data['description']);
			$patient_id = $this->dataFormat->data_validation($data['patient_id']);


			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			  	
			  	$meassage = "0***Please Enter Valid Email Address!!";
				return $meassage;
			}

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

			$patient_data = $this->get_single_patient($patient_id);

			$patient_data = mysqli_fetch_array($patient_data);

			if($imageName=='')
			{
				$imageName = $patient_data['image'];
			}

			if (isset($patient_id) && $patient_id!=''  && isset($email) && $email!='' && isset($mobile) && $mobile!='') {

				$getUserQuery = "SELECT patient_id FROM patient WHERE ( email='$email' OR mobile='$mobile')  and patient_id!=$patient_id";

				$getUserQuery= $this->database->select($getUserQuery);

				if ($getUserQuery>'0') {

					Session::initSession();
					Session::setSession("patient_id", $patient_id);
					return $meassage = "0***Duplicate Mobile Or Email Not Allowed";
				}
				else{

					$updatePatient = "UPDATE patient SET name='$name', mobile='$mobile', email='$email', birth_date='$birth_date', blood_group='$blood_group', sex='$sex', address='$address', description='$description', image='$imageName' WHERE patient_id=$patient_id";

					$updatePatient= $this->database->update($updatePatient);

					if ($updatePatient) {

						if(isset($filePath)){
							
							$fileUpload = move_uploaded_file($file_tmp, $filePath);

							if($patient_data['image']!='')
				            {
				                $deletePhoto = __DIR__."../../uploads/patient/".$patient_data['image'];
				                
				                if(file_exists($deletePhoto)){

				                    unlink($deletePhoto);
				                }
				            }

						}
						Session::initSession();
						Session::setSession("patient_id", $patient_id);

						return $meassage = "1***Patient Details Updated Succesfully.";
					}
					else{
						
						$errorMassage ="0***Something Wrong!!!";
						return $errorMassage;
					}
				}

			}
			else{
				
				$errorMassage ="0***Something Wrong!!!";
				return $errorMassage;
			}

		}

		public function number_of_patient(){

			$selectPatient = "SELECT a.* FROM patient a WHERE a.status=1 and a.v_status=1";

			$allPatient = $this->database->select($selectPatient);

			if ($allPatient>'0') {
				$totalPatient = mysqli_num_rows($allPatient);
				return $totalPatient;
			}
		}

		public function change_patient_status($id){

			$patient_data = $this->get_single_patient($id);

			$patient_data = mysqli_fetch_array($patient_data);

			if($patient_data['v_status']==1){

				$status = 0;
			}
			else{
				$status = 1;
			}

			$updatePatient = "UPDATE patient SET v_status=$status WHERE patient_id=$id";
			
			$updatePatient= $this->database->update($updatePatient);

			if ($updatePatient) {

				return $meassage = "1***Patient Status Updated Succesfully.";
			}
			else{
				
				$errorMassage ="0***Something Wrong!!!";
				return $errorMassage;
			}
		}

		public function delete_patient($id){

			$patient_data = $this->get_single_patient($id);

			$patient_data = mysqli_fetch_array($patient_data);

			if($patient_data['v_status']==1){

				$status = 0;
			}
			else{
				$status = 1;
			}

			$updatePatient = "UPDATE patient SET status=0, v_status=0 WHERE patient_id=$id";

			$updatePatient= $this->database->update($updatePatient);

			if ($updatePatient) {

				return $meassage = "1***Patient Deleted Succesfully.";
			}
			else{
				
				$errorMassage ="0***Something Wrong!!!";
				return $errorMassage;
			}
		}

		public function update_password($data){

			$password = md5($this->dataFormat->data_validation($data['password']));
			$new_password = $this->dataFormat->data_validation($data['new_password']);
			$c_password = $this->dataFormat->data_validation($data['c_password']);


			Session::initSession();

			$user_id = 0;
			if(isset($_SESSION['patientId']))
			{
			    $user_id = $_SESSION['patientId'];
			}

			$user_data = $this->get_single_patient($user_id);

			$user_data = mysqli_fetch_array($user_data);

			$current_password = $user_data['password'];

			if($password!=$current_password){
				
				return $meassage = "0***Current Password Not Match.";

				die();
			}

			if($new_password!=$c_password){
				
				return $meassage = "0***Confirmation Password Does Not Match.";

				die();
			}

			$pass_length = strlen($c_password);

			if($pass_length<8){

				return $meassage = "0***Password Length Can Not Be Less Than 8 Digit.";

				die();
			}

			if (isset($new_password) && $new_password!='' && isset($c_password) && $c_password!='' && isset($password) && $password!=''){

				$new_password = md5($new_password);
				$updateUser = "UPDATE patient SET password='$new_password' WHERE patient_id=$user_id";

				$updateUser= $this->database->update($updateUser);

				if ($updateUser) {

					return $meassage = "1***Password Updated Succesfully. Please Login Your Acount";
				}
				else{
					
					$errorMassage ="0***Something Wrong!!!";
					return $errorMassage;
				}
			}
			else{
				
				$errorMassage ="0***Something Wrong!!!";
				return $errorMassage;
			}

		}
	}