<?php

	include_once __DIR__.'/../lib/database.php';
	include_once __DIR__.'/../lib/Session.php';
	include_once __DIR__.'/../helpers/Format.php';
	include_once __DIR__.'/../helpers/Email.php';

	class Nurse{

		private $database;
		private $dataFormat;
		private $email;
	 
		public function __construct(){

			//Session::checkSession();

			$this->database= new Database();
			$this->dataFormat= new Format();
			$this->email= new Email();
		}

		public function add_nurse_details($data,$file){

			$name = $this->dataFormat->data_validation($data['name']);
			$speciality = $this->dataFormat->data_validation($data['speciality']);
			$mobile = $this->dataFormat->data_validation($data['mobile']);
			$email = $this->dataFormat->data_validation($data['email']);
			$doctor_id = $this->dataFormat->data_validation($data['doctor_id']);
			$address = $this->dataFormat->data_validation($data['address']);
			$description = $this->dataFormat->data_validation($data['description']);

	
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

			    $imageName =$name."-nurse-".substr(md5(time()),0,10).'.'.$file_ext;
			    $imageName = str_replace(' ','-',$imageName);
			    $filePath = __DIR__.'../../uploads/nurse/'.$imageName; 
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

			if (isset($name) && $name!='' && isset($doctor_id) && $doctor_id!='' && isset($mobile) && $mobile!='' && isset($email) && $email!='') {

				$getUserQuery = "SELECT nurse_id FROM nurse WHERE email='$email' OR mobile='$mobile'";

				$getUserQuery= $this->database->select($getUserQuery);

				if ($getUserQuery>'0') {

					return $meassage = "0***Duplicate Mobile Or Email Not Allowed";
				}
				else{

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

					$insertDoctorQuery ="INSERT INTO nurse(name, speciality, mobile, email, doctor_id, address, description, image, password, token, code, v_status) VALUES ('$name','$speciality','$mobile','$email','$doctor_id','$address','$description','$imageName','$passwordMd5','$token','$code',1)";

					$insertDoctor= $this->database->insert($insertDoctorQuery);

					if ($insertDoctor) {

						if(isset($filePath)){
							
							$fileUpload = move_uploaded_file($file_tmp, $filePath);
						}

						$id = $this->database->last_insert_id();

						$status = $this->email->send_verify_email($userName, $email, $token, $code,$user_type='doctor',$password);

						if($status==true){

							$meassage = "1***New Nurse Created Succesfully";
							return $meassage;
						}
						else{

							$deleteDoctorQuery = "delete from Nurse where nurse_id=$id";
							$deletetDoctor= $this->database->delete($deleteDoctorQuery);

							if($fileUpload==true){

								unlink($filePath);
							}
							
							$meassage = "0***Something Wddddent Wrong, Please Contact With Administator!!";
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

				$meassage = '0***Nurse Name, Doctor Name, Mobile And Email Field Must Not Be Empty!!!';

				return $meassage;
			}

		}

		public function get_all_nurse($ofset=null, $limit=null){

			if($ofset==null AND $limit==null){

				$selectNurse = "SELECT a.*, b.doctor_id, b.name as doctor_name FROM nurse a, doctor b  WHERE b.status=1 and b.published_status=1 and b.doctor_id=a.doctor_id and a.status=1 and a.v_status=1 ORDER BY a.doctor_id DESC";
			}
			else{

				$selectNurse = "SELECT a.*, b.doctor_id, b.name as doctor_name FROM nurse a, doctor b  WHERE b.status=1 and b.published_status=1 and b.doctor_id=a.doctor_id and a.status=1 and a.v_status=1 ORDER BY a.doctor_id DESC LIMIT $ofset, $limit";
			}

			$allNurse= $this->database->select($selectNurse);

			if ($allNurse>'0') {

				return $allNurse;
			}

		}

		public function get_single_nurse($id){

			$selectNurse = "SELECT a.*, b.doctor_id, b.name as doctor_name FROM nurse a, doctor b  WHERE b.status=1 and b.published_status=1 and b.doctor_id=a.doctor_id and a.status=1 and a.v_status=1 and nurse_id=$id";

			$allNurse= $this->database->select($selectNurse);

			if ($allNurse>'0') {

				return $allNurse;
			}
		}

		public function update_nurse_details($data, $file){


			$name = $this->dataFormat->data_validation($data['name']);
			$speciality = $this->dataFormat->data_validation($data['speciality']);
			$mobile = $this->dataFormat->data_validation($data['mobile']);
			$email = $this->dataFormat->data_validation($data['email']);
			$doctor_id = $this->dataFormat->data_validation($data['doctor_id']);
			$address = $this->dataFormat->data_validation($data['address']);
			$description = $this->dataFormat->data_validation($data['description']);
			$nurse_id = $this->dataFormat->data_validation($data['nurse_id']);


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

			    $imageName =$name."-nurse-".substr(md5(time()),0,10).'.'.$file_ext;
			    $imageName = str_replace(' ','-',$imageName);
			    $filePath = __DIR__.'../../uploads/nurse/'.$imageName; 
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

			$nurse_data = $this->get_single_nurse($nurse_id);

			$nurse_data = mysqli_fetch_array($nurse_data);

			if($imageName=='')
			{
				$imageName = $nurse_data['image'];
			}

			if (isset($nurse_id) && $nurse_id!='') {

				$getUserQuery = "SELECT nurse_id FROM nurse WHERE ( email='$email' OR mobile='$mobile')  and nurse_id!=$nurse_id";

				$getUserQuery= $this->database->select($getUserQuery);

				if ($getUserQuery>'0') {

					Session::initSession();
					Session::setSession("doctor_id", $doctor_id);
					return $meassage = "0***Duplicate Mobile Or Email Not Allowed";
				}
				else{

					$updateDoctor = "UPDATE nurse SET name='$name', speciality='$speciality', mobile='$mobile', email='$email', doctor_id='$doctor_id', address='$address', description='$description', image='$imageName' WHERE nurse_id=$nurse_id";

					$updateDoctor= $this->database->update($updateDoctor);

					if ($updateDoctor) {

						if(isset($filePath)){
							
							$fileUpload = move_uploaded_file($file_tmp, $filePath);

							if($doctor_data['image']!='')
				            {
				                $deletePhoto = __DIR__."../../uploads/nurse/".$doctor_data['image'];
				                
				                if(file_exists($deletePhoto)){

				                    unlink($deletePhoto);
				                }
				            }

						}
						Session::initSession();
						Session::setSession("nurse_id", $nurse_id);

						return $meassage = "1***Nurse Details Updated Succesfully.";
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

		public function update_nurse_status($id){

			$single_nurse = $this->get_single_nurse($id);

			$single_nurse = mysqli_fetch_array($single_nurse);

			if($single_nurse['published_status']==1){

				$status = 0;
			}
			else{
				$status = 1;
			}

			$updateNurse = "UPDATE nurse SET published_status=$status WHERE nurse_id=$id";
			
			$updateNurse= $this->database->update($updateNurse);

			if ($updateNurse) {

				return $meassage = "1***Nurse Status Updated Succesfully.";
			}
			else{
				
				$errorMassage ="0***Something Wrong!!!";
				return $errorMassage;
			}
		}

		public function delete_nurse($id){

			$single_nurse = $this->get_single_nurse($id);

			$single_nurse = mysqli_fetch_array($single_nurse);

			if($single_nurse['published_status']==1){

				$status = 0;
			}
			else{
				$status = 1;
			}

			$updateNurse = "UPDATE nurse SET published_status=0, status=0, v_status=0 WHERE nurse_id=$id";

			$updateNurse= $this->database->update($updateNurse);

			if ($updateNurse) {

				return $meassage = "1***Nurse Deleted Succesfully.";
			}
			else{
				
				$errorMassage ="0***Something Wrong!!!";
				return $errorMassage;
			}
		}

		public function number_of_nurse(){

			$selectNurse = "SELECT a.*, b.doctor_id, b.name as doctor_name FROM nurse a, doctor b  WHERE b.status=1 and b.published_status=1 and b.doctor_id=a.doctor_id and a.status=1 and a.v_status=1";

			$allNurse= $this->database->select($selectNurse);

			if ($allNurse>'0') {
				$totalNurse = mysqli_num_rows($allNurse);
				return $totalNurse;
			}
		}

		public function number_of_doctor_nurse($doctor_id){

			$selectNurse = "SELECT a.*, b.doctor_id, b.name as doctor_name FROM nurse a, doctor b  WHERE b.status=1 and b.published_status=1 and b.doctor_id=a.doctor_id and a.status=1 and a.v_status=1 and a.doctor_id=$doctor_id";

			$allNurse= $this->database->select($selectNurse);

			if ($allNurse>'0') {
				$totalNurse = mysqli_num_rows($allNurse);
				return $totalNurse;
			}
		}

		public function get_all_nurse_by_doctor($ofset=null, $limit=null,$doctor_id){

			if($ofset==null AND $limit==null){

				$selectNurse = "SELECT a.*, b.doctor_id, b.name as doctor_name FROM nurse a, doctor b  WHERE b.status=1 and b.published_status=1 and b.doctor_id=a.doctor_id and a.status=1 and a.v_status=1 and a.doctor_id=$doctor_id ORDER BY a.doctor_id DESC";
			}
			else{

				$selectNurse = "SELECT a.*, b.doctor_id, b.name as doctor_name FROM nurse a, doctor b  WHERE b.status=1 and b.published_status=1 and b.doctor_id=a.doctor_id and a.status=1 and a.v_status=1 and a.doctor_id=$doctor_id ORDER BY a.doctor_id DESC LIMIT $ofset, $limit";
			}

			$allNurse= $this->database->select($selectNurse);

			if ($allNurse>'0') {

				return $allNurse;
			}

		}

		public function update_password($data){

			$password = md5($this->dataFormat->data_validation($data['password']));
			$new_password = $this->dataFormat->data_validation($data['new_password']);
			$c_password = $this->dataFormat->data_validation($data['c_password']);


			Session::initSession();

			$user_id = 0;
			if(isset($_SESSION['nurseId']))
			{
			    $user_id = $_SESSION['nurseId'];
			}

			$user_data = $this->get_single_nurse($user_id);

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
				$updateUser = "UPDATE nurse SET password='$new_password' WHERE nurse_id=$user_id";

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