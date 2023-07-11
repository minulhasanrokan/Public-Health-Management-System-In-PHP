<?php

	include_once __DIR__.'/../lib/database.php';
	include_once __DIR__.'/../lib/Session.php';
	include_once __DIR__.'/../helpers/Format.php';
	include_once __DIR__.'/../helpers/Email.php';

	class Accountant{

		private $database;
		private $dataFormat;
		private $email;
	 
		public function __construct(){

			//Session::checkSession();

			$this->database= new Database();
			$this->dataFormat= new Format();
			$this->email= new Email();
		}

		public function add_accountant_details($data,$file){

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

			    $imageName =$name."-".substr(md5(time()),0,10).'.'.$file_ext;
			    $imageName = str_replace(' ','-',$imageName);
			    $filePath = __DIR__.'../../uploads/accountant/'.$imageName; 
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

				$getUserQuery = "SELECT accountant_id FROM accountant WHERE email='$email' OR mobile='$mobile'";

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

					$insertAccountantQuery ="INSERT INTO accountant(name, speciality, mobile, email, address, description, image, password, token, code, v_status) VALUES ('$name','$speciality','$mobile','$email','$address','$description','$imageName','$passwordMd5','$token','$code',1)";

					$insertAccountant= $this->database->insert($insertAccountantQuery);

					if ($insertAccountant) {

						if(isset($filePath)){
							
							$fileUpload = move_uploaded_file($file_tmp, $filePath);
						}

						$id = $this->database->last_insert_id();

						$status = $this->email->send_verify_email($userName, $email, $token, $code,$user_type='doctor',$password);

						if($status==true){

							$meassage = "1***New Accountant Created Succesfully";
							return $meassage;
						}
						else{

							$deleteAccountantQuery = "delete from accountant where accountant_id=$id";
							$deletetAccountant= $this->database->delete($deleteAccountantQuery);

							if($deletetAccountant==true){

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

				$meassage = '0***Accountant Name, Mobile And Email Field Must Not Be Empty!!!';

				return $meassage;
			}

		}

		public function get_all_accountant($ofset=null, $limit=null){

			if($ofset==null AND $limit==null){

				$selectAccountant = "SELECT a.* FROM accountant a  WHERE a.status=1 and a.v_status=1 ORDER BY a.accountant_id DESC";
			}
			else{

				$selectAccountant = "SELECT a.* FROM accountant a  WHERE a.status=1 and a.v_status=1 ORDER BY a.accountant_id DESC LIMIT $ofset, $limit";
			}

			$allAccountant= $this->database->select($selectAccountant);

			if ($allAccountant>'0') {

				return $allAccountant;
			}

		}

		public function get_single_accountant($id){

			$selectAccountant = "SELECT a.* FROM accountant a WHERE a.status=1 and a.v_status=1 and accountant_id=$id";

			$allAccountant= $this->database->select($selectAccountant);

			if ($allAccountant>'0') {

				return $allAccountant;
			}
		}

		public function update_accountant_details($data, $file){


			$name = $this->dataFormat->data_validation($data['name']);
			$speciality = $this->dataFormat->data_validation($data['speciality']);
			$mobile = $this->dataFormat->data_validation($data['mobile']);
			$email = $this->dataFormat->data_validation($data['email']);
			$address = $this->dataFormat->data_validation($data['address']);
			$description = $this->dataFormat->data_validation($data['description']);
			$accountant_id = $this->dataFormat->data_validation($data['accountant_id']);


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
			    $filePath = __DIR__.'../../uploads/accountant/'.$imageName; 
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

			$accountant_data = $this->get_single_accountant($accountant_id);

			$accountant_data = mysqli_fetch_array($accountant_data);

			if($imageName=='')
			{
				$imageName = $accountant_data['image'];
			}

			if (isset($accountant_id) && $accountant_id!='') {

				$getUserQuery = "SELECT accountant_id FROM accountant WHERE ( email='$email' OR mobile='$mobile')  and accountant_id!=$accountant_id";

				$getUserQuery= $this->database->select($getUserQuery);

				if ($getUserQuery>'0') {

					Session::initSession();
					Session::setSession("accountant_id", $accountant_id);
					return $meassage = "0***Duplicate Mobile Or Email Not Allowed";
				}
				else{

					$updateAccountant = "UPDATE accountant SET name='$name', speciality='$speciality', mobile='$mobile', email='$email', address='$address', description='$description', image='$imageName' WHERE accountant_id=$accountant_id";

					$updateAccountant= $this->database->update($updateAccountant);

					if ($updateAccountant) {

						if(isset($filePath)){
							
							$fileUpload = move_uploaded_file($file_tmp, $filePath);

							if($accountant_data['image']!='')
				            {
				                $deletePhoto = __DIR__."../../uploads/accountant/".$accountant_data['image'];
				                
				                if(file_exists($deletePhoto)){

				                    unlink($deletePhoto);
				                }
				            }

						}
						Session::initSession();
						Session::setSession("accountant_id", $accountant_id);

						return $meassage = "1***Accountant Details Updated Succesfully.";
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

		public function update_accountant_status($id){

			$accountant_data = $this->get_single_accountant($id);

			$accountant_data = mysqli_fetch_array($accountant_data);

			if($accountant_data['published_status']==1){

				$status = 0;
			}
			else{
				$status = 1;
			}

			$updateAccountant = "UPDATE accountant SET published_status=$status WHERE accountant_id=$id";
			
			$updateAccountant= $this->database->update($updateAccountant);

			if ($updateAccountant) {

				return $meassage = "1***Accountant Status Updated Succesfully.";
			}
			else{
				
				$errorMassage ="0***Something Wrong!!!";
				return $errorMassage;
			}
		}

		public function delete_accountant($id){

			$accountant_data = $this->get_single_accountant($id);

			$accountant_data = mysqli_fetch_array($accountant_data);

			if($accountant_data['published_status']==1){

				$status = 0;
			}
			else{
				$status = 1;
			}

			$updateAccountant = "UPDATE accountant SET published_status=0, status=0, v_status=0 WHERE accountant_id=$id";

			$updateAccountant= $this->database->update($updateAccountant);

			if ($updateAccountant) {

				return $meassage = "1***Accountant Deleted Succesfully.";
			}
			else{
				
				$errorMassage ="0***Something Wrong!!!";
				return $errorMassage;
			}
		}

		public function number_of_accountant(){

			$selectAccountant = "SELECT a.* FROM accountant a WHERE a.status=1 and a.v_status=1";

			$allAccountant= $this->database->select($selectAccountant);

			if ($allAccountant>'0') {
				$totalAccountant = mysqli_num_rows($allAccountant);
				return $totalAccountant;
			}
		}

		public function update_password($data){

			$password = md5($this->dataFormat->data_validation($data['password']));
			$new_password = $this->dataFormat->data_validation($data['new_password']);
			$c_password = $this->dataFormat->data_validation($data['c_password']);


			Session::initSession();

			$user_id = 0;
			if(isset($_SESSION['accountantId']))
			{
			    $user_id = $_SESSION['accountantId'];
			}

			$user_data = $this->get_single_accountant($user_id);

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
				$updateUser = "UPDATE accountant SET password='$new_password' WHERE accountant_id=$user_id";

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