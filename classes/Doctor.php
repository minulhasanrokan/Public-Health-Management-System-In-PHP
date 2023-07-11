<?php

	include_once __DIR__.'/../lib/database.php';
	include_once __DIR__.'/../lib/Session.php';
	include_once __DIR__.'/../helpers/Format.php';
	include_once __DIR__.'/../helpers/Email.php';

	class Doctor{

		private $database;
		private $dataFormat;
		private $email;
	 
		public function __construct(){

			//Session::checkSession();

			$this->database= new Database();
			$this->dataFormat= new Format();
			$this->email= new Email();
		}

		public function add_doctor_details($data,$file,$certificate){

			$name = $this->dataFormat->data_validation($data['name']);
			$speciality = $this->dataFormat->data_validation($data['speciality']);
			$mobile = $this->dataFormat->data_validation($data['mobile']);
			$email = $this->dataFormat->data_validation($data['email']);
			$department = $this->dataFormat->data_validation($data['department']);
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

			    $imageName =$name."-doctor-".substr(md5(time()),0,10).'.'.$file_ext;
			    $imageName = str_replace(' ','-',$imageName);
			    $filePath = __DIR__.'../../uploads/doctor/'.$imageName; 
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

			$sl =1;
			$file_tmp_arr = array();
			$filePath_arr = array();
			$multi_image_name = '';

			foreach($certificate["tmp_name"] as $key=>$tmp_name) {

			    $s_file_name=$certificate["name"][$key];
			    $s_file_tmp=$certificate["tmp_name"][$key];
			    $s_file_size =$certificate['size'][$key];

			    $s_file_ext=pathinfo($s_file_name,PATHINFO_EXTENSION);

			    $s_imageName =$name."-certificate-".substr(md5(time()),0,10)."_".$sl.'.'.$s_file_ext;
			    $s_imageName = str_replace(' ','-',$s_imageName);
			    $s_filePath = __DIR__.'../../uploads/doctor/'.$s_imageName; 
			    $s_extensions= array("jpeg","jpg","png");

			    if(in_array($file_ext,$s_extensions)=== false){
				    	
			    	$meassage="0***File extension not allowed, please choose a jpeg ,jpg or png file.";
         			return $meassage;
			    }
			    elseif($s_file_size > 2097152){
	        
			        $meassage='0***File size must be excately 2 MB';
			        return $meassage;
			    }

			    if($multi_image_name!=''){

	                $multi_image_name .="***";
	            }

	            $multi_image_name .= $s_imageName;

			    $file_tmp_arr[] = $s_file_tmp;
			    $filePath_arr[] = $s_filePath;

			    $sl++;
			}

			if (isset($name) && $name!='' && isset($department) && $department!='' && isset($mobile) && $mobile!='' && isset($email) && $email!=''  && isset($certificate) && $certificate!='') {

				$getUserQuery = "SELECT doctor_id FROM doctor WHERE email='$email' OR mobile='$mobile'";

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

					$insertDoctorQuery ="INSERT INTO doctor(name, speciality, mobile, email, department, address, description, image, password, token, code, v_status, certificate) VALUES ('$name','$speciality','$mobile','$email','$department','$address','$description','$imageName','$passwordMd5','$token','$code', 1, '$multi_image_name')";

					$insertDoctor= $this->database->insert($insertDoctorQuery);

					if ($insertDoctor) {

						if(isset($filePath)){
							
							$fileUpload = move_uploaded_file($file_tmp, $filePath);
						}

						if(!empty($file_tmp_arr))
						{
							$l = 0;
							foreach($file_tmp_arr as $data){

								$fileUpload = move_uploaded_file($data, $filePath_arr[$l]);

								$l++;
							}
						}

						$id = $this->database->last_insert_id();

						$status = $this->email->send_verify_email($userName, $email, $token, $code,$user_type='doctor',$password);

						if($status==true){

							$meassage = "1***New Doctor Created Succesfully";
							return $meassage;
						}
						else{

							$deleteDoctorQuery = "delete from doctor where doctor_id=$id";
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

				$meassage = '0***Doctor Name, Department, Mobile And Email Field Must Not Be Empty!!!';

				return $meassage;
			}

		}

		public function get_all_doctor($ofset=null, $limit=null){

			if($ofset==null AND $limit==null){

				$selectDoctor = "SELECT a.*, b.department_id, b.name as department_name FROM doctor a, department b  WHERE b.status=1 and b.published_status=1 and b.department_id=a.department and a.status=1 and a.v_status=1 ORDER BY a.doctor_id DESC";
			}
			else{

				$selectDoctor = "SELECT a.*, b.department_id, b.name as department_name FROM doctor a, department b  WHERE b.status=1 and b.published_status=1 and b.department_id=a.department and a.status=1 and a.v_status=1 ORDER BY a.doctor_id DESC LIMIT $ofset, $limit";
			}

			$allDoctor= $this->database->select($selectDoctor);

			if ($allDoctor>'0') {

				return $allDoctor;
			}

		}

		public function get_all_edit_request_doctor($ofset=null, $limit=null){

			if($ofset==null AND $limit==null){

				$selectDoctor = "SELECT a.*, b.department_id, b.name as department_name, max(c.history_id) as history_id FROM doctor a, department b, doctor_history c WHERE b.status=1 and b.published_status=1 and b.department_id=a.department and a.status=1 and a.v_status=1 and a.doctor_id=c.doctor_id and c.ac_status=0 ORDER BY a.doctor_id DESC";
			}
			else{

				$selectDoctor = "SELECT a.*, b.department_id, b.name as department_name, max(c.history_id) as history_id FROM doctor a, department b, doctor_history c WHERE b.status=1 and b.published_status=1 and b.department_id=a.department and a.status=1 and a.v_status=1 and a.doctor_id=c.doctor_id and c.ac_status=0 ORDER BY a.doctor_id DESC LIMIT $ofset, $limit";
			}

			$allDoctor= $this->database->select($selectDoctor);

			if ($allDoctor>'0') {

				return $allDoctor;
			}
		}

		public function get_single_edit_doctor($id){

			$selectDoctor = "SELECT c.*, b.department_id, b.name as department_name, max(c.history_id) as history_id FROM doctor a, department b, doctor_history c WHERE b.status=1 and b.published_status=1 and b.department_id=a.department and a.status=1 and a.v_status=1 and c.history_id=$id and a.doctor_id=c.doctor_id and c.ac_status=0";

			$allDoctor= $this->database->select($selectDoctor);

			if ($allDoctor>'0') {

				return $allDoctor;
			}
		}

		public function number_of_doctor(){

			$selectDoctor = "SELECT a.*, b.department_id, b.name as department_name FROM doctor a, department b  WHERE b.status=1 and b.published_status=1 and b.department_id=a.department and a.status=1 and a.v_status=1 ORDER BY a.doctor_id DESC";

			$allDoctor= $this->database->select($selectDoctor);

			if ($allDoctor>'0') {
				$totalDoctor = mysqli_num_rows($allDoctor);
				return $totalDoctor;
			}
		} 

		public function get_single_doctor($id){

			$selectDoctor = "SELECT a.*, b.department_id, b.name as department_name FROM doctor a, department b  WHERE b.status=1 and b.published_status=1 and b.department_id=a.department and a.status=1 and a.v_status=1 and a.doctor_id=$id";

			$allDoctor= $this->database->select($selectDoctor);

			if ($allDoctor>'0') {

				return $allDoctor;
			}
		}

		public function get_all_active_doctor($ofset=null, $limit=null, $department_id=null){

			$department_con = '';

			if($department_id!=null)
			{
				$department_con = " and a.department=$department_id";
			}	

			if($ofset==null AND $limit==null){

				$selectDoctor = "SELECT a.*, b.department_id, b.name as department_name FROM doctor a, department b  WHERE b.status=1 and b.published_status=1 and b.department_id=a.department and a.status=1 and a.v_status=1 and a.published_status=1 $department_con ORDER BY a.doctor_id DESC";
			}
			else{

				$selectDoctor = "SELECT a.*, b.department_id, b.name as department_name FROM doctor a, department b  WHERE b.status=1 and b.published_status=1 and b.department_id=a.department and a.status=1 and a.v_status=1 and a.published_status=1  $department_con ORDER BY a.doctor_id DESC LIMIT $ofset, $limit";
			}

			$allDoctor= $this->database->select($selectDoctor);

			if ($allDoctor>'0') {

				return $allDoctor;
			}

		}

		public function number_of_active_doctor(){

			$selectDoctor = "SELECT a.*, b.department_id, b.name as department_name FROM doctor a, department b  WHERE b.status=1 and b.published_status=1 and b.department_id=a.department and a.status=1 and a.v_status=1 and a.published_status=1 ORDER BY a.doctor_id DESC";

			$allDoctor= $this->database->select($selectDoctor);

			if ($allDoctor>'0') {
				$totalDoctor = mysqli_num_rows($allDoctor);
				return $totalDoctor;
			}
		}

		public function update_doctor_details($data, $file,$certificate){

			$name = $this->dataFormat->data_validation($data['name']);
			$speciality = $this->dataFormat->data_validation($data['speciality']);
			$mobile = $this->dataFormat->data_validation($data['mobile']);
			$email = $this->dataFormat->data_validation($data['email']);
			$department = $this->dataFormat->data_validation($data['department']);
			$address = $this->dataFormat->data_validation($data['address']);
			$description = $this->dataFormat->data_validation($data['description']);
			$doctor_id = $this->dataFormat->data_validation($data['doctor_id']);


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

			    $imageName =$name."-doctor-".substr(md5(time()),0,10).'.'.$file_ext;
			    $imageName = str_replace(' ','-',$imageName);
			    $filePath = __DIR__.'../../uploads/doctor/'.$imageName; 
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

			$sl =1;
			$file_tmp_arr = array();
			$filePath_arr = array();
			$multi_image_name = '';

			$delete_image_value = $data['hidden_image'];
			$hidden_all_image = $data['hidden_all_image'];

	        if($delete_image_value!=''){

	        	if(!empty($data['imagevalue'])){

	        		foreach($data['imagevalue'] as $s_file){
                    
	                    if($multi_image_name!=''){

	                        $multi_image_name .="***";
	                    }

	                    $multi_image_name .= $s_file;
	                }
	        	}
	        }
	        else{

	            $multi_image_name .=$hidden_all_image;
	        }

	        if(!empty($certificate['name'][0])){

	        	echo 'dss0';

				foreach($certificate["tmp_name"] as $key=>$tmp_name) {

				    $s_file_name=$certificate["name"][$key];
				    $s_file_tmp=$certificate["tmp_name"][$key];
				    $s_file_size =$certificate['size'][$key];

				    $s_file_ext=pathinfo($s_file_name,PATHINFO_EXTENSION);

				    $s_imageName =$name."-certificate-".substr(md5(time()),0,10)."_".$sl.'.'.$s_file_ext;
				    $s_imageName = str_replace(' ','-',$s_imageName);
				    $s_filePath = __DIR__.'../../uploads/doctor/'.$s_imageName; 
				    $s_extensions= array("jpeg","jpg","png");

				    if(in_array($s_file_ext,$s_extensions)=== false){
					    	
				    	$meassage="0***File extension not allowed, please choose a jpeg ,jpg or png file.";
	         			return $meassage;
				    }
				    elseif($s_file_size > 2097152){
		        
				        $meassage='0***File size must be excately 2 MB';
				        return $meassage;
				    }

				    if($multi_image_name!=''){

		                $multi_image_name .="***";
		            }

		            $multi_image_name .= $s_imageName;

				    $file_tmp_arr[] = $s_file_tmp;
				    $filePath_arr[] = $s_filePath;

				    $sl++;
				}
			}

			$doctor_data = $this->get_single_doctor($doctor_id);

			$doctor_data = mysqli_fetch_array($doctor_data);

			if($imageName=='')
			{
				$imageName = $doctor_data['image'];
			}

			if (isset($doctor_id) && $doctor_id!='') {

				$getUserQuery = "SELECT doctor_id FROM doctor WHERE ( email='$email' OR mobile='$mobile')  and doctor_id!=$doctor_id";

				$getUserQuery= $this->database->select($getUserQuery);

				if ($getUserQuery>'0') {

					//Session::initSession();
					Session::setSession("doctor_id", $doctor_id);
					return $meassage = "0***Duplicate Mobile Or Email Not Allowed";
				}
				else{

					if(isset($data['edit_request']) && $data['edit_request']=='edit_request'){

						$insertHistoryQuery ="INSERT INTO doctor_history(name, speciality, mobile, email, department, address, description, image, certificate, doctor_id) VALUES ('$name','$speciality','$mobile','$email','$department','$address','$description','$imageName','$multi_image_name','$doctor_id')";

						$insertHistory= $this->database->insert($insertHistoryQuery);

						if ($insertHistory) {

							if(isset($filePath)){
								
								$fileUpload = move_uploaded_file($file_tmp, $filePath);

								if($doctor_data['image']!='')
					            {
					                $deletePhoto = __DIR__."../../uploads/doctor/".$doctor_data['image'];
					                
					                if(file_exists($deletePhoto)){

					                    unlink($deletePhoto);
					                }
					            }
							}

							if(!empty($file_tmp_arr))
							{
								$l = 0;
								foreach($file_tmp_arr as $data){

									$fileUpload = move_uploaded_file($data, $filePath_arr[$l]);

									$l++;
								}
							}

							$meassage = "1***Doctor Details Updated Succesfully. Please Wait For Admin Confirmation";
							return $meassage;
						}
						else{
							$meassage = "0***Something Went Wrong, Please Contact With Administator!!";
							return $meassage;
						}

					}
					else{

						$updateDoctor = "UPDATE doctor SET name='$name', speciality='$speciality', mobile='$mobile', email='$email', department='$department', address='$address', description='$description', image='$imageName', certificate='$multi_image_name' WHERE doctor_id=$doctor_id";

						$updateDoctor= $this->database->update($updateDoctor);

						if ($updateDoctor) {

							if(isset($filePath)){
								
								$fileUpload = move_uploaded_file($file_tmp, $filePath);

								if($doctor_data['image']!='')
					            {
					                $deletePhoto = __DIR__."../../uploads/doctor/".$doctor_data['image'];
					                
					                if(file_exists($deletePhoto)){

					                    unlink($deletePhoto);
					                }
					            }
							}

							if(!empty($file_tmp_arr))
							{
								$l = 0;
								foreach($file_tmp_arr as $data){

									$fileUpload = move_uploaded_file($data, $filePath_arr[$l]);

									$l++;
								}
							}

							$delete_image_value = explode("***",$delete_image_value);

				            foreach($delete_image_value as $value){

				            	if($value!=''){

				            		$deletePhoto = __DIR__."../../uploads/doctor/".$value;

			                        if(file_exists($deletePhoto))
			                        {
			                            unlink($deletePhoto);
			                        }
				            	}
		                    }

							Session::initSession();
							Session::setSession("doctor_id", $doctor_id);

							return $meassage = "1***Doctor Details Updated Succesfully.";
						}
						else{
							
							$errorMassage ="0***Something Wrong!!!";
							return $errorMassage;
						}
					}
				}

			}
			else{
				
				$errorMassage ="0***Something Wrong!!!";
				return $errorMassage;
			}

		}

		public function update_doctor_status($id){

			$doctor_data = $this->get_single_doctor($id);

			$doctor_data = mysqli_fetch_array($doctor_data);

			if($doctor_data['published_status']==1){

				$status = 0;
			}
			else{
				$status = 1;
			}

			$updateDepartment = "UPDATE doctor SET published_status=$status WHERE doctor_id=$id";
			
			$updateDepartment= $this->database->update($updateDepartment);

			if ($updateDepartment) {

				return $meassage = "1***Doctor Status Updated Succesfully.";
			}
			else{
				
				$errorMassage ="0***Something Wrong!!!";
				return $errorMassage;
			}
		}

		public function update_edit_request($id){

			$selectDoctor = "SELECT c.* FROM doctor_history c WHERE c.history_id=$id and c.ac_status=0";

			$doctor_data= $this->database->select($selectDoctor);

			if ($doctor_data>'0') {

				$doctor_data = mysqli_fetch_array($doctor_data);

				$name = $doctor_data['name'];
				$speciality = $doctor_data['speciality'];
				$mobile = $doctor_data['mobile'];
				$email = $doctor_data['email'];
				$department = $doctor_data['department'];
				$address = $doctor_data['address'];
				$description = $doctor_data['description'];
				$image = $doctor_data['image'];
				$certificate = $doctor_data['certificate'];

				$doctor_id = $doctor_data['doctor_id'];

				$history_id = $doctor_data['history_id'];

				$updateDoctor = "UPDATE doctor SET name='$name', speciality='$speciality', mobile='$mobile', email='$email', department='$department', address='$address', description='$description', image='$image', certificate='$certificate' WHERE doctor_id=$doctor_id";
				
				$updateDoctor= $this->database->update($updateDoctor);

				if ($updateDoctor) {

					$updateHistory = "UPDATE doctor_history SET ac_status='1' WHERE doctor_id=$doctor_id and ac_status=0";
				
					$updateHistory= $this->database->update($updateHistory);

					return $meassage = "1***Doctor Updated Succesfully.";
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

		public function reject_edit_request($id){

			$selectDoctor = "SELECT c.* FROM doctor_history c WHERE c.history_id=$id and c.ac_status=0";

			$doctor_data= $this->database->select($selectDoctor);

			if ($doctor_data>'0') {

				$updateHistory = "UPDATE doctor_history SET ac_status='2' WHERE history_id=$id";
				
				$updateHistory= $this->database->update($updateHistory);
				
				if ($updateHistory) {

					return $meassage = "1***Doctor Edit Request Rejected Succesfully.";
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

		public function delete_doctor($id){

			$doctor_data = $this->get_single_doctor($id);

			$doctor_data = mysqli_fetch_array($doctor_data);

			if($doctor_data['published_status']==1){

				$status = 0;
			}
			else{
				$status = 1;
			}

			$updateDoctor = "UPDATE doctor SET published_status=0, status=0, v_status=0 WHERE doctor_id=$id";

			$updateDoctor= $this->database->update($updateDoctor);

			if ($updateDoctor) {

				return $meassage = "1***Doctor Deleted Succesfully.";
			}
			else{
				
				$errorMassage ="0***Something Wrong!!!";
				return $errorMassage;
			}
		}

		public function add_add_doctor_fee_details($data){

			$doctor_id = $this->dataFormat->data_validation($data['doctor_id']);
			$doctor_fee = $this->dataFormat->data_validation($data['doctor_fee']);

			if (isset($doctor_id) && $doctor_id!='' && isset($doctor_fee) && $doctor_fee!='' && $doctor_fee>0) {

				$getUserQuery = "SELECT doctor_id FROM doctor_fee WHERE doctor_id='$doctor_id' and status=1";

				$getUserQuery= $this->database->select($getUserQuery);

				if ($getUserQuery>'0') {

					return $meassage = "0***Duplicate Fee Not Allowed";
				}
				else{

					$insertFeeQuery ="INSERT INTO doctor_fee(doctor_id, doctor_fee) VALUES ('$doctor_id','$doctor_fee')";

					$insertFee= $this->database->insert($insertFeeQuery);

					if ($insertFee) {

						$meassage = "1***New Doctor Fee Created Succesfully";
						return $meassage;
					}
					else{
						$meassage = "0***Something Went Wrong, Please Contact With Administator!!";
						return $meassage;
					}
				}

			}
			else{

				$meassage = '0***Doctor Name And Fee Field Must Not Be Empty!!!';

				return $meassage;
			}

		}

		public function get_all_active_doctor_in_fee($ofset=null, $limit=null, $department_id=null,$display=0){

			$department_con = '';
			$fee_con = '';

			if($department_id!=null)
			{
				$department_con = " and a.department=$department_id";
			}

			if($display==0)
			{
				$fee_con = " and a.doctor_id not in (select doctor_id from doctor_fee where status=1)";
			}
			else{

				$fee_con = " and a.doctor_id in (select doctor_id from doctor_fee where status=1)";
			}	

			if($ofset==null AND $limit==null){

				$selectDoctor = "SELECT a.*, b.department_id, b.name as department_name FROM doctor a, department b  WHERE b.status=1 and b.published_status=1 and b.department_id=a.department and a.status=1 and a.v_status=1 and a.published_status=1 $department_con $fee_con ORDER BY a.doctor_id DESC";
			}
			else{

				$selectDoctor = "SELECT a.*, b.department_id, b.name as department_name FROM doctor a, department b  WHERE b.status=1 and b.published_status=1 and b.department_id=a.department and a.status=1 and a.v_status=1 and a.published_status=1  $department_con $fee_con ORDER BY a.doctor_id DESC LIMIT $ofset, $limit";
			}

			$allDoctor= $this->database->select($selectDoctor);

			if ($allDoctor>'0') {

				return $allDoctor;
			}

		}

		public function get_all_active_doctor_fee($ofset=null, $limit=null, $department_id=null){

			$department_con = '';
			$fee_con = '';

			if($department_id!=null)
			{
				$department_con = " and a.department=$department_id";
			}


			if($ofset==null AND $limit==null){

				$selectDoctor = "SELECT a.*, b.department_id, b.name as department_name, c.doctor_fee, c.fee_id FROM doctor a, department b, doctor_fee c  WHERE b.status=1 and b.published_status=1 and b.department_id=a.department and a.status=1 and a.v_status=1 and a.published_status=1 and a.doctor_id=c.doctor_id and c.status=1 $department_con ORDER BY a.doctor_id DESC";
			}
			else{

				$selectDoctor = "SELECT a.*, b.department_id, b.name as department_name, c.doctor_fee, c.fee_id FROM doctor a, department b, doctor_fee c  WHERE b.status=1 and b.published_status=1 and b.department_id=a.department and a.status=1 and a.v_status=1 and a.published_status=1 and a.doctor_id=c.doctor_id and c.status=1  $department_con ORDER BY a.doctor_id DESC LIMIT $ofset, $limit";
			}

			$allDoctor= $this->database->select($selectDoctor);

			if ($allDoctor>'0') {

				return $allDoctor;
			}

		}

		public function get_single_doctor_fee($department_id=null,$fee_id=null){

			$where_con = '';

			if($department_id!=null)
			{
				$where_con .= " and a.department=$department_id";
			}

			if($fee_id!=null)
			{
				$where_con .= " and c.fee_id=$fee_id";
			}

			$selectDoctorfee = "SELECT a.*, b.department_id, b.name as department_name, c.doctor_fee, c.fee_id FROM doctor a, department b, doctor_fee c  WHERE b.status=1 and b.published_status=1 and b.department_id=a.department and a.status=1 and a.v_status=1 and a.published_status=1 and a.doctor_id=c.doctor_id and c.status=1 $where_con ORDER BY a.doctor_id DESC";

			$allDoctorfee= $this->database->select($selectDoctorfee);

			if ($allDoctorfee>'0') {

				return $allDoctorfee;
			}

		}

		public function update_doctor_fee_details($data){

			$doctor_id = $this->dataFormat->data_validation($data['doctor_id']);
			$doctor_fee = $this->dataFormat->data_validation($data['doctor_fee']);
			$fee_id = $this->dataFormat->data_validation($data['fee_id']);


			if (isset($doctor_id) && $doctor_id!='' && isset($doctor_fee) && $doctor_fee!='' && isset($fee_id) && $fee_id!='') {

				$updateDoctorFee = "UPDATE doctor_fee SET doctor_id='$doctor_id', doctor_fee='$doctor_fee' WHERE fee_id=$fee_id";

				$updateDoctorFee= $this->database->update($updateDoctorFee);

				if ($updateDoctorFee) {

					Session::initSession();
					Session::setSession("doctor_fee_id", $fee_id);

					return $meassage = "1***Doctor Fee Details Updated Succesfully.";
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

		public function number_of_doctor_fee(){

			$selectDoctorfee = "SELECT a.*, b.department_id, b.name as department_name, c.doctor_fee, c.fee_id FROM doctor a, department b, doctor_fee c  WHERE b.status=1 and b.published_status=1 and b.department_id=a.department and a.status=1 and a.v_status=1 and a.published_status=1 and a.doctor_id=c.doctor_id and c.status=1 ORDER BY a.doctor_id DESC";

			$allDoctorfee= $this->database->select($selectDoctorfee);

			if ($allDoctorfee>'0') {
				$totalDoctorfee = mysqli_num_rows($allDoctorfee);
				return $totalDoctorfee;
			}
		}

		public function delete_doctor_fee($id){


			$updateDoctorFee = "UPDATE doctor_fee SET status=0 WHERE fee_id=$id";

			$updateDoctorFee= $this->database->update($updateDoctorFee);

			if ($updateDoctorFee) {

				return $meassage = "1***Doctor Fee Deleted Succesfully.";
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
			if(isset($_SESSION['doctorId']))
			{
			    $user_id = $_SESSION['doctorId'];
			}

			$user_data = $this->get_single_doctor($user_id);

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
				$updateUser = "UPDATE doctor SET password='$new_password' WHERE doctor_id=$user_id";

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