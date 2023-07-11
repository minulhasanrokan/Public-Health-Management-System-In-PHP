<?php

	include_once __DIR__.'/../lib/database.php';
	include_once __DIR__.'/../lib/Session.php';
	include_once __DIR__.'/../helpers/Format.php';

	class Department{

		private $database;
		private $dataFormat;
	 
		public function __construct(){

			//Session::checkSession();

			$this->database= new Database();
			$this->dataFormat= new Format();
		}

		public function add_department_details($data,$file){

			$name = $this->dataFormat->data_validation($data['name']);
			$title = $this->dataFormat->data_validation($data['title']);
			$description = $this->dataFormat->data_validation($data['description']);

			$image = $file;
			$imageName = '';

			if($image['name']!=null){

				$file_name = $image['name'];
			    $file_size =$image['size'];
		        $file_tmp =$image['tmp_name'];
			    $file_type=$image['type'];

			    $file_ext = pathinfo($file_name,PATHINFO_EXTENSION);

			    $imageName =$name."-department-".substr(md5(time()),0,10).'.'.$file_ext;
			    $imageName = str_replace(' ','-',$imageName);
			    $filePath = __DIR__.'../../uploads/department/'.$imageName; 
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

			if (isset($name) && $name!='') {

				$insertDepartmentQuery ="INSERT INTO department(name, title, description, image) VALUES ('$name','$title','$description','$imageName')";

				$insertDepartment= $this->database->insert($insertDepartmentQuery);

				if ($insertDepartment) {

					if(isset($filePath)){
						
						$fileUpload = move_uploaded_file($file_tmp, $filePath);
					}

					$meassage = "1***New Department Created Succesfully";
					return $meassage;
				}
				else{
					$meassage = "0***Something Went Wrong, Please Contact With Administator!!";
					return $meassage;
				}

			}
			else{

				$meassage = '0***Department Name Field Must Not Be Empty!!!';

				return $meassage;
			}

		}

		public function get_all_department($ofset=null, $limit=null){

			if($ofset==null AND $limit==null){

				$selectDepartment = "SELECT * FROM department  WHERE status=1 ORDER BY department_id DESC";
			}
			else{

				$selectDepartment = "SELECT * FROM department  WHERE status=1 ORDER BY department_id DESC LIMIT $ofset, $limit";
			}

			$allDepartment= $this->database->select($selectDepartment);

			if ($allDepartment>'0') {

				return $allDepartment;
			}

		}

		public function get_all_active_department($ofset=null, $limit=null){

			if($ofset==null AND $limit==null){

				$selectDepartment = "SELECT * FROM department  WHERE status=1 and published_status=1 ORDER BY department_id DESC";
			}
			else{

				$selectDepartment = "SELECT * FROM department  WHERE status=1 and published_status=1 ORDER BY department_id DESC LIMIT $ofset, $limit";
			}

			$allDepartment= $this->database->select($selectDepartment);

			if ($allDepartment>'0') {

				return $allDepartment;
			}

		}

		public function get_single_department($id){

			$selectDepartment = "SELECT * FROM department  WHERE status=1 and department_id=$id ORDER BY department_id DESC";

			$allDepartment= $this->database->select($selectDepartment);

			if ($allDepartment>'0') {

				return $allDepartment;
			}
		}

		public function update_department_details($data, $file){


			$name = $this->dataFormat->data_validation($data['name']);
			$title = $this->dataFormat->data_validation($data['title']);
			$department_id = $this->dataFormat->data_validation($data['department_id']);
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
			    $filePath = __DIR__.'../../uploads/department/'.$imageName; 
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

			$department_data = $this->get_single_department($department_id);

			$department_data = mysqli_fetch_array($department_data);

			if($imageName=='')
			{
				$imageName = $department_data['image'];
			}

			if (isset($department_id) && $department_id!='') {

				$updateDepartment = "UPDATE department SET name='$name', title='$title', description='$description', image='$imageName' WHERE department_id=$department_id";

				$updateDepartment= $this->database->update($updateDepartment);

				if ($updateDepartment) {

					if(isset($filePath)){
						
						$fileUpload = move_uploaded_file($file_tmp, $filePath);

						if($department_data['image']!='')
			            {
			                $deletePhoto = __DIR__."../../uploads/department/".$department_data['image'];
			                
			                if(file_exists($deletePhoto)){

			                    unlink($deletePhoto);
			                }
			            }

					}
					Session::initSession();
					Session::setSession("department_id", $department_id);

					return $meassage = "1***Department Details Updated Succesfully.";
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

		public function update_department_status($id){

			$department_data = $this->get_single_department($id);

			$department_data = mysqli_fetch_array($department_data);

			if($department_data['published_status']==1){

				$status = 0;
			}
			else{
				$status = 1;
			}

			$updateDepartment = "UPDATE department SET published_status=$status WHERE department_id=$id";
			
			$updateDepartment= $this->database->update($updateDepartment);

			if ($updateDepartment) {

				return $meassage = "1***Department Status Updated Succesfully.";
			}
			else{
				
				$errorMassage ="0***Something Wrong!!!";
				return $errorMassage;
			}
		}

		public function delete_department($id){

			$department_data = $this->get_single_department($id);

			$department_data = mysqli_fetch_array($department_data);

			if($department_data['published_status']==1){

				$status = 0;
			}
			else{
				$status = 1;
			}

			$updateDepartment = "UPDATE department SET published_status=0, status=0 WHERE department_id=$id";

			$updateDepartment= $this->database->update($updateDepartment);

			if ($updateDepartment) {

				return $meassage = "1***Department Deleted Succesfully.";
			}
			else{
				
				$errorMassage ="0***Something Wrong!!!";
				return $errorMassage;
			}
		}

		public function number_of_department(){

			$selectDepartment = "SELECT a.* FROM department a  WHERE a.status=1 ORDER BY a.department_id DESC";

			$allDepartment= $this->database->select($selectDepartment);

			if ($allDepartment>'0') {
				$totalDepartment = mysqli_num_rows($allDepartment);
				return $totalDepartment;
			}
		}

		public function number_of_active_department(){

			$selectDepartment = "SELECT count(distinct b.department_id) as total_department FROM doctor a, department b  WHERE b.status=1 and b.published_status=1 and b.department_id=a.department and a.status=1 and a.v_status=1 and a.published_status=1 ORDER BY a.doctor_id DESC";

			$allDepartment= $this->database->select($selectDepartment);

			if ($allDepartment>'0') {

				$allDepartment = mysqli_fetch_array($allDepartment);
				return $allDepartment;
			}
		}

		public function get_all_active_department_with_doctor($ofset=null, $limit=null){

			if($ofset==null AND $limit==null){

				$selectDepartment = "SELECT b.* FROM doctor a, department b  WHERE b.status=1 and b.published_status=1 and b.department_id=a.department and a.status=1 and a.v_status=1 and a.published_status=1 group by a.department ORDER BY a.doctor_id DESC";
			}
			else{

				$selectDepartment = "SELECT b.* FROM doctor a, department b  WHERE b.status=1 and b.published_status=1 and b.department_id=a.department and a.status=1 and a.v_status=1 and a.published_status=1 group by a.department ORDER BY a.doctor_id DESC $ofset, $limit";
			}

			$allDepartment= $this->database->select($selectDepartment);

			if ($allDepartment>'0') {

				return $allDepartment;
			}

		}
	}