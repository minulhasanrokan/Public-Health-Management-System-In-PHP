<?php

	include_once __DIR__.'/../lib/database.php';
	include_once __DIR__.'/../lib/Session.php';
	include_once __DIR__.'/../helpers/Format.php';

	class Blood{

		private $database;
		private $dataFormat;
	 
		public function __construct(){

			//Session::checkSession();

			$this->database= new Database();
			$this->dataFormat= new Format();
		}

		public function add_blood_group_details($data,$file){

			$name = $this->dataFormat->data_validation($data['name']);
			$mobile = $this->dataFormat->data_validation($data['mobile']);
			$email = $this->dataFormat->data_validation($data['email']);
			$date_of_birth = $this->dataFormat->data_validation($data['date_of_birth']);
			$date_of_last_given_blood = $this->dataFormat->data_validation($data['date_of_last_given_blood']);
			$blood_group = $this->dataFormat->data_validation($data['blood_group']);
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
			    $filePath = __DIR__.'../../uploads/blood_group/'.$imageName; 
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

			if (isset($name) && $name!='' && isset($mobile) && $mobile!='' & isset($email) && $email!='') {

				$getBloodGroupQuery = "SELECT blood_group_id FROM blood_group WHERE email='$email' OR mobile='$mobile'";

				$getBloodGroupQuery= $this->database->select($getBloodGroupQuery);

				if ($getBloodGroupQuery>'0') {

					return $meassage = "0***Duplicate Mobile Or Email Not Allowed";
				}
				else{

					$insertBloodGroupQuery ="INSERT INTO blood_group(name, mobile, email, date_of_birth, date_of_last_given_blood, blood_group, address, description, image) VALUES ('$name','$mobile','$email','$date_of_birth','$date_of_last_given_blood','$blood_group','$address','$description','$imageName')";

					$insertBloodGroup= $this->database->insert($insertBloodGroupQuery);

					if ($insertBloodGroup) {

						if(isset($filePath)){
							
							$fileUpload = move_uploaded_file($file_tmp, $filePath);
						}

						$meassage = "1***New Blood Group Created Succesfully";
						return $meassage;
					}
					else{
						$meassage = "0***Something Went Wrong, Please Contact With Administator!!";
						return $meassage;
					}
				}

			}
			else{

				$meassage = '0***Name, Mobile And Email Field Must Not Be Empty!!!';

				return $meassage;
			}

		}

		public function get_all_blood_group($ofset=null, $limit=null){

			if($ofset==null AND $limit==null){

				$selectBloodGroup = "SELECT * FROM blood_group  WHERE status=1 ORDER BY blood_group_id DESC";
			}
			else{

				$selectBloodGroup = "SELECT * FROM blood_group  WHERE status=1 ORDER BY blood_group_id DESC LIMIT $ofset, $limit";
			}

			$allBloodGroup= $this->database->select($selectBloodGroup);

			if ($allBloodGroup>'0') {

				return $allBloodGroup;
			}

		}

		public function get_single_blood_group($id){

			$selectBloodGroup = "SELECT * FROM blood_group  WHERE status=1 and blood_group_id=$id ORDER BY blood_group_id DESC";

			$allBloodGroup= $this->database->select($selectBloodGroup);

			if ($allBloodGroup>'0') {

				return $allBloodGroup;
			}
		}

		public function update_blood_group_details($data, $file){


			$name = $this->dataFormat->data_validation($data['name']);
			$mobile = $this->dataFormat->data_validation($data['mobile']);
			$email = $this->dataFormat->data_validation($data['email']);
			$date_of_birth = $this->dataFormat->data_validation($data['date_of_birth']);
			$date_of_last_given_blood = $this->dataFormat->data_validation($data['date_of_last_given_blood']);
			$blood_group = $this->dataFormat->data_validation($data['blood_group']);
			$address = $this->dataFormat->data_validation($data['address']);
			$description = $this->dataFormat->data_validation($data['description']);
			$blood_group_id = $this->dataFormat->data_validation($data['blood_group_id']);


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
			    $filePath = __DIR__.'../../uploads/blood_group/'.$imageName; 
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

			$blood_group_data = $this->get_single_blood_group($blood_group_id);

			$blood_group_data = mysqli_fetch_array($blood_group_data);

			if($imageName=='')
			{
				$imageName = $blood_group_data['image'];
			}

			if (isset($name) && $name!='' && isset($mobile) && $mobile!='' && isset($email) && $email!='' && isset($blood_group_id) && $blood_group_id!='') {

				$getBloodGroupQuery = "SELECT blood_group_id FROM blood_group WHERE ( email='$email' OR mobile='$mobile')  and blood_group_id!=$blood_group_id";

				$getBloodGroupQuery= $this->database->select($getBloodGroupQuery);

				if ($getBloodGroupQuery>'0') {

					Session::initSession();
					Session::setSession("blood_group_id", $blood_group_id);
					return $meassage = "0***Duplicate Mobile Or Email Not Allowed";
				}
				else{

					$updateBloodGroup = "UPDATE blood_group SET name='$name', email='$email', mobile='$mobile', date_of_birth='$date_of_birth', date_of_last_given_blood='$date_of_last_given_blood', blood_group='$blood_group', address='$address', description='$description', image='$imageName' WHERE blood_group_id=$blood_group_id";

					$updateBloodGroup= $this->database->update($updateBloodGroup);

					if ($updateBloodGroup) {

						if(isset($filePath)){
							
							$fileUpload = move_uploaded_file($file_tmp, $filePath);

							if($blood_group_data['image']!='')
				            {
				                $deletePhoto = __DIR__."../../uploads/blood_group/".$blood_group_data['image'];
				                
				                if(file_exists($deletePhoto)){

				                    unlink($deletePhoto);
				                }
				            }

						}
						Session::initSession();
						Session::setSession("blood_group_id", $blood_group_id);

						return $meassage = "1***Blood Group Details Updated Succesfully.";
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

		public function update_blood_group_status($id){

			$single_blood_group = $this->get_single_blood_group($id);

			$single_blood_group = mysqli_fetch_array($single_blood_group);

			if($single_blood_group['published_status']==1){

				$status = 0;
			}
			else{
				$status = 1;
			}

			$updateBloodGroup = "UPDATE blood_group SET published_status=$status WHERE blood_group_id=$id";
			
			$updateBloodGroup= $this->database->update($updateBloodGroup);

			if ($updateBloodGroup) {

				return $meassage = "1***Blood Group Status Updated Succesfully.";
			}
			else{
				
				$errorMassage ="0***Something Wrong!!!";
				return $errorMassage;
			}
		}

		public function delete_blood_group($id){

			$single_blood_group = $this->get_single_blood_group($id);

			$single_blood_group = mysqli_fetch_array($single_blood_group);

			if($single_blood_group['published_status']==1){

				$status = 0;
			}
			else{
				$status = 1;
			}

			$updateBloodGroup = "UPDATE blood_group SET published_status=0, status=0 WHERE blood_group_id=$id";

			$updateBloodGroup= $this->database->update($updateBloodGroup);

			if ($updateBloodGroup) {

				return $meassage = "1***Blood Group Deleted Succesfully.";
			}
			else{
				
				$errorMassage ="0***Something Wrong!!!";
				return $errorMassage;
			}
		}

		public function number_of_blood_group(){

			$selectBloodGroup = "SELECT * FROM blood_group  WHERE status=1  ORDER BY blood_group_id DESC";

			$allBloodGroup= $this->database->select($selectBloodGroup);

			if ($allBloodGroup>'0') {
				$totalBloodGroup = mysqli_num_rows($allBloodGroup);
				return $totalBloodGroup;
			}
		}

		public function get_all_blood_group_by_available($ofset=null, $limit=null, $id=null){

			$date = date('Y-m-d');
			$test_date = date_create($date);
			date_sub($test_date, date_interval_create_from_date_string('120 days'));

			$date1=  date_format($test_date, 'Y-m-d');
			$selectBloodGroup = "SELECT * FROM blood_group  WHERE status=1 and published_status=1 and (date_of_last_given_blood=null or date_of_last_given_blood<='$date1') ORDER BY blood_group_id DESC";

			$allBloodGroup= $this->database->select($selectBloodGroup);

			if ($allBloodGroup>'0') {

				return $allBloodGroup;
			}
		}

		public function get_all_blood_group_by_group($ofset=null, $limit=null, $id=null, $data){

			$data = $data;

			$selectBloodGroup = "SELECT * FROM blood_group  WHERE status=1 and published_status=1 and blood_group='$data' ORDER BY blood_group_id DESC";

			$allBloodGroup= $this->database->select($selectBloodGroup);

			if ($allBloodGroup>'0') {

				return $allBloodGroup;
			}
		}
	}