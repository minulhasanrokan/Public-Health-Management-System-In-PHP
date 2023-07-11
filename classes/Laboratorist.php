<?php

	include_once __DIR__.'/../lib/database.php';
	include_once __DIR__.'/../lib/Session.php';
	include_once __DIR__.'/../helpers/Format.php';
	include_once __DIR__.'/../helpers/Email.php';

	class Laboratorist{

		private $database;
		private $dataFormat;
		private $email;
	 
		public function __construct(){

			//Session::checkSession();

			$this->database= new Database();
			$this->dataFormat= new Format();
			$this->email= new Email();
		}

		public function add_laboratorist_details($data,$file){

			$name = $this->dataFormat->data_validation($data['name']);
			$speciality = $this->dataFormat->data_validation($data['speciality']);
			$mobile = $this->dataFormat->data_validation($data['mobile']);
			$email = $this->dataFormat->data_validation($data['email']);
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

			    $imageName =$name.substr(md5(time()),0,10).'.'.$file_ext;
			    $imageName = str_replace(' ','-',$imageName);
			    $filePath = __DIR__.'../../uploads/laboratorist/'.$imageName; 
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

			if (isset($name) && $name!='' && isset($mobile) && $mobile!='' && isset($email) && $email!='') {

				$getLaboratoristQuery = "SELECT laboratorist_id FROM laboratorist WHERE email='$email' OR mobile='$mobile'";

				$getLaboratoristQuery= $this->database->select($getLaboratoristQuery);

				if ($getLaboratoristQuery>'0') {

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

					$insertLaboratorist ="INSERT INTO laboratorist(name, speciality, mobile, email, address, description, image, password, token, code, v_status) VALUES ('$name','$speciality','$mobile','$email','$address','$description','$imageName','$passwordMd5','$token','$code',1)";

					$insertLaboratorist= $this->database->insert($insertLaboratorist);

					if ($insertLaboratorist) {

						if(isset($filePath)){
							
							$fileUpload = move_uploaded_file($file_tmp, $filePath);
						}

						$id = $this->database->last_insert_id();

						$status = $this->email->send_verify_email($userName, $email, $token, $code,$user_type='doctor',$password);

						if($status==true){

							$meassage = "1***New Laboratorist Created Succesfully";
							return $meassage;
						}
						else{

							$deleteDoctorQuery = "delete from laboratorist where laboratorist_id=$id";
							$deletetDoctor= $this->database->delete($deleteDoctorQuery);
							
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

				$meassage = '0***Laboratorist Name, Mobile And Email Field Must Not Be Empty!!!';

				return $meassage;
			}

		}

		public function get_all_laboratorist($ofset=null, $limit=null){

			if($ofset==null AND $limit==null){

				$selectLaboratorist = "SELECT a.* FROM laboratorist a WHERE a.status=1 and a.v_status=1 ORDER BY a.laboratorist_id DESC";
			}
			else{

				$selectLaboratorist = "SELECT a.* FROM laboratorist a WHERE a.status=1 and a.v_status=1 ORDER BY a.laboratorist_id DESC LIMIT $ofset, $limit";
			}

			$allPLaboratorist= $this->database->select($selectLaboratorist);

			if ($allPLaboratorist>'0') {

				return $allPLaboratorist;
			}

		}

		public function get_single_laboratorist($id){

			$selectLaboratorist = "SELECT a.* FROM laboratorist a WHERE a.status=1 and a.v_status=1 and a.laboratorist_id=$id ORDER BY a.laboratorist_id DESC";

			$allLaboratorist= $this->database->select($selectLaboratorist);

			if ($allLaboratorist>'0') {

				return $allLaboratorist;
			}
		}

		public function update_laboratorist_details($data, $file){


			$name = $this->dataFormat->data_validation($data['name']);
			$speciality = $this->dataFormat->data_validation($data['speciality']);
			$mobile = $this->dataFormat->data_validation($data['mobile']);
			$email = $this->dataFormat->data_validation($data['email']);
			$address = $this->dataFormat->data_validation($data['address']);
			$description = $this->dataFormat->data_validation($data['description']);
			$laboratorist_id = $this->dataFormat->data_validation($data['laboratorist_id']);


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

			    $imageName =$name.substr(md5(time()),0,10).'.'.$file_ext;
			    $imageName = str_replace(' ','-',$imageName);
			    $filePath = __DIR__.'../../uploads/laboratorist/'.$imageName; 
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

			$laboratorist_data = $this->get_single_laboratorist($laboratorist_id);

			$laboratorist_data = mysqli_fetch_array($laboratorist_data);

			if($imageName=='')
			{
				$imageName = $laboratorist_data['image'];
			}

			if (isset($laboratorist_id) && $laboratorist_id!='') {

				$getLaboratoristQuery = "SELECT laboratorist_id FROM laboratorist WHERE ( email='$email' OR mobile='$mobile')  and laboratorist_id!=$laboratorist_id";

				$getLaboratoristQuery= $this->database->select($getLaboratoristQuery);

				if ($getLaboratoristQuery>'0') {

					Session::initSession();
					Session::setSession("laboratorist_id", $laboratorist_id);
					return $meassage = "0***Duplicate Mobile Or Email Not Allowed";
				}
				else{

					$updateLaboratorist = "UPDATE laboratorist SET name='$name', speciality='$speciality', mobile='$mobile', email='$email', address='$address', description='$description', image='$imageName' WHERE laboratorist_id=$laboratorist_id";

					$updateLaboratorist= $this->database->update($updateLaboratorist);

					if ($updateLaboratorist) {

						if(isset($filePath)){
							
							$fileUpload = move_uploaded_file($file_tmp, $filePath);

							if($laboratorist_data['image']!='')
				            {
				                $deletePhoto = __DIR__."../../uploads/laboratorist/".$laboratorist_data['image'];
				                
				                if(file_exists($deletePhoto)){

				                    unlink($deletePhoto);
				                }
				            }

						}
						Session::initSession();
						Session::setSession("laboratorist_id", $laboratorist_id);

						return $meassage = "1***Laboratorist Details Updated Succesfully.";
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

		public function change_laboratorist_status($id){

			$laboratorist = $this->get_single_laboratorist($id);

			$laboratorist = mysqli_fetch_array($laboratorist);

			if($laboratorist['published_status']==1){

				$status = 0;
			}
			else{
				$status = 1;
			}

			$updateLaboratorist = "UPDATE laboratorist SET published_status=$status WHERE laboratorist_id=$id";
			
			$updateLaboratorist= $this->database->update($updateLaboratorist);

			if ($updateLaboratorist) {

				return $meassage = "1***Laboratorist Status Updated Succesfully.";
			}
			else{
				
				$errorMassage ="0***Something Wrong!!!";
				return $errorMassage;
			}
		}

		public function delete_laboratorist($id){

			$laboratorist_data = $this->get_single_pharmacist($id);

			$laboratorist_data = mysqli_fetch_array($laboratorist_data);

			if($laboratorist_data['published_status']==1){

				$status = 0;
			}
			else{
				$status = 1;
			}

			$updateLaboratorist = "UPDATE laboratorist SET published_status=0, status=0, v_status=0 WHERE laboratorist_id=$id";

			$updateLaboratorist= $this->database->update($updateLaboratorist);

			if ($updateLaboratorist) {

				return $meassage = "1***Laboratorist Deleted Succesfully.";
			}
			else{
				
				$errorMassage ="0***Something Wrong!!!";
				return $errorMassage;
			}
		}

		public function number_of_laboratorist(){

			$selectLaboratorist = "SELECT a.* FROM laboratorist a WHERE a.status=1 and a.v_status=1 ORDER BY a.laboratorist_id DESC";

			$allLaboratorist= $this->database->select($selectLaboratorist);

			if ($allLaboratorist>'0') {
				$totalLaboratorist = mysqli_num_rows($allLaboratorist);
				return $totalLaboratorist;
			}
		}

		public function update_password($data){

			$password = md5($this->dataFormat->data_validation($data['password']));
			$new_password = $this->dataFormat->data_validation($data['new_password']);
			$c_password = $this->dataFormat->data_validation($data['c_password']);


			Session::initSession();

			$user_id = 0;
			if(isset($_SESSION['laboratoristId']))
			{
			    $user_id = $_SESSION['laboratoristId'];
			}

			$user_data = $this->get_single_laboratorist($user_id);

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
				$updateUser = "UPDATE laboratorist SET password='$new_password' WHERE laboratorist_id=$user_id";

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