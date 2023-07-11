<?php

	include_once __DIR__.'/../lib/database.php';
	include_once __DIR__.'/../lib/Session.php';
	include_once __DIR__.'/../helpers/Format.php';

	class Admin{

		private $database;
		private $dataFormat;
	 
		public function __construct(){

			//Session::checkSession();

			$this->database= new Database();
			$this->dataFormat= new Format();
		}

		public function get_admin_data($id=null){

			$id = $this->dataFormat->data_validation($id);

			$adminQuery = "SELECT * FROM admin WHERE admin_id =$id and status=1";

			$adminQuery= $this->database->select($adminQuery);

			if ($adminQuery>'0') {
				return $adminQuery;
			}
		}

		public function update_admin_details($data, $file){

			$name = $this->dataFormat->data_validation($data['name']);
			$admin_id = $this->dataFormat->data_validation($data['admin_id']);
			$mobile = $this->dataFormat->data_validation($data['mobile']);
			$email = $this->dataFormat->data_validation($data['email']);
			$address = $this->dataFormat->data_validation($data['address']);
			$description = $this->dataFormat->data_validation($data['description']);

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
			    $filePath = __DIR__.'/../uploads/users/'.$imageName; 
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

			$user_data = $this->get_admin_data($admin_id);

			$user_data = mysqli_fetch_array($user_data);

			if($imageName=='')
			{
				$imageName = $user_data['image'];
			}

			if (isset($admin_id) && $admin_id!='') {

				$updateAdmin = "UPDATE admin SET name='$name', phone='$mobile', email='$email', address='$address', description='$description', image='$imageName' WHERE admin_id=$admin_id";

				$updateAdmin= $this->database->update($updateAdmin);

				if ($updateAdmin) {

					if(isset($filePath)){
						
						$fileUpload = move_uploaded_file($file_tmp, $filePath);

						if($user_data['image']!='')
			            {
			                $deletePhoto = __DIR__."../uploads/users/".$user_data['image'];
			                
			                if(file_exists($deletePhoto)){

			                    unlink($deletePhoto);
			                }
			            }

					}

					return $meassage = "1***Admin Details Updated Succesfully.";
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

		public function update_password($data){

			$password = md5($this->dataFormat->data_validation($data['password']));
			$new_password = $this->dataFormat->data_validation($data['new_password']);
			$c_password = $this->dataFormat->data_validation($data['c_password']);


			Session::initSession();

			$user_id = 0;
			if(isset($_SESSION['administratorId']))
			{
			    $user_id = $_SESSION['administratorId'];
			}

			$user_data = $this->get_admin_data($user_id);

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
				$updateUser = "UPDATE admin SET password='$new_password' WHERE admin_id=$user_id";

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

		public function get_all_admin($ofset=null, $limit=null){

			if($ofset==null AND $limit==null){

				$selectAdmin = "SELECT a.* FROM admin a  WHERE a.status=1";
			}
			else{

				$selectAdmin = "SELECT a.* FROM admin a  WHERE a.status=1 LIMIT $ofset, $limit";
			}

			$allAdmin= $this->database->select($selectAdmin);

			if ($allAdmin>'0') {

				return $allAdmin;
			}

		}
	}