<?php

	include_once __DIR__.'/../lib/database.php';
	include_once __DIR__.'/../lib/Session.php';
	include_once __DIR__.'/../helpers/Format.php';
	include_once __DIR__.'/../helpers/Email.php';

	class Floor{

		private $database;
		private $dataFormat;
		private $email;
	 
		public function __construct(){

			//Session::checkSession();

			$this->database= new Database();
			$this->dataFormat= new Format();
			$this->email= new Email();
		}

		public function add_floor_details($data,$file){

			$name = $this->dataFormat->data_validation($data['name']);
			$department = $this->dataFormat->data_validation($data['department']);
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
			    $filePath = __DIR__.'../../uploads/floor/'.$imageName; 
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

			if (isset($name) && $name!='' && isset($department) && $department!='') {

				$getFloorQuery = "SELECT floor_id FROM floor WHERE name='$name' OR department='$department'";

				$getFloorQuery= $this->database->select($getFloorQuery);

				if ($getFloorQuery>'0') {

					return $meassage = "0***Duplicate Floor Or Department Not Allowed";
				}
				else{

					$insertFloor ="INSERT INTO floor(name, department, description, image) VALUES ('$name','$department','$description','$imageName')";

					$insertFloor= $this->database->insert($insertFloor);

					if ($insertFloor) {

						if(isset($filePath)){
							
							$fileUpload = move_uploaded_file($file_tmp, $filePath);
						}

						$meassage = "1***New Floor Created Succesfully";
						return $meassage;
					}
					else{
						$meassage = "0***Something Went Wrong, Please Contact With Administator!!";
						return $meassage;
					}
				}

			}
			else{

				$meassage = '0***Floor Name And Department Field Must Not Be Empty!!!';

				return $meassage;
			}

		}

		public function get_all_floor($ofset=null, $limit=null){

			if($ofset==null AND $limit==null){

				$selectFloor = "SELECT a.*, b.department_id, b.name as department_name FROM floor a, department b  WHERE b.status=1 and b.published_status=1 and b.department_id=a.department and a.status=1 ORDER BY a.floor_id DESC";
			}
			else{

				$selectFloor = "SELECT a.*, b.department_id, b.name as department_name FROM floor a, department b  WHERE b.status=1 and b.published_status=1 and b.department_id=a.department and a.status=1 ORDER BY a.floor_id DESC LIMIT $ofset, $limit";
			}

			$allFloor= $this->database->select($selectFloor);

			if ($allFloor>'0') {

				return $allFloor;
			}

		}

		public function get_all_active_floor($ofset=null, $limit=null){

			if($ofset==null AND $limit==null){

				$selectFloor = "SELECT a.*, b.department_id, b.name as department_name FROM floor a, department b  WHERE b.status=1 and b.published_status=1 and b.department_id=a.department and a.status=1 and a.published_status=1 ORDER BY a.floor_id DESC";
			}
			else{

				$selectFloor = "SELECT a.*, b.department_id, b.name as department_name FROM floor a, department b  WHERE b.status=1 and b.published_status=1 and b.department_id=a.department and a.status=1 and a.published_status=1 ORDER BY a.floor_id DESC LIMIT $ofset, $limit";
			}

			$allFloor= $this->database->select($selectFloor);

			if ($allFloor>'0') {

				return $allFloor;
			}

		}

		public function get_single_floor($id){

			$selectFloor = "SELECT a.*, b.department_id, b.name as department_name FROM floor a, department b  WHERE b.status=1 and b.published_status=1 and b.department_id=a.department and a.status=1 and a.floor_id=$id";

			$allFloor= $this->database->select($selectFloor);

			if ($allFloor>'0') {

				return $allFloor;
			}
		}

		public function update_floor_details($data, $file){

			$name = $this->dataFormat->data_validation($data['name']);
			$department = $this->dataFormat->data_validation($data['department']);
			$description = $this->dataFormat->data_validation($data['description']);
			$floor_id = $this->dataFormat->data_validation($data['floor_id']);

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
			    $filePath = __DIR__.'../../uploads/floor/'.$imageName; 
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
			$floor_data = $this->get_single_floor($floor_id);

			$floor_data = mysqli_fetch_array($floor_data);

			if($imageName=='')
			{
				$imageName = $floor_data['image'];
			}

			if (isset($floor_id) && $floor_id!='' && isset($name) && $name!=''  && isset($department) && $department!='') {

				$getFloorQuery = "SELECT floor_id FROM floor WHERE ( name='$name' OR department='$department')  and floor_id!=$floor_id";

				$getFloorQuery= $this->database->select($getFloorQuery);

				if ($getFloorQuery>'0') {

					Session::initSession();
					Session::setSession("floor_id", $floor_id);
					return $meassage = "0***Duplicate Name Or Floor Not Allowed";
				}
				else{

					$updateFloor = "UPDATE floor SET name='$name', department='$department', description='$description', image='$imageName' WHERE floor_id=$floor_id";

					$updateFloor= $this->database->update($updateFloor);

					if ($updateFloor) {

						if(isset($filePath)){
							
							$fileUpload = move_uploaded_file($file_tmp, $filePath);

							if($floor_data['image']!='')
				            {
				                $deletePhoto = __DIR__."../../uploads/floor/".$floor_data['image'];
				                
				                if(file_exists($deletePhoto)){

				                    unlink($deletePhoto);
				                }
				            }

						}
						Session::initSession();
						Session::setSession("floor_id", $floor_id);

						return $meassage = "1***Floor Details Updated Succesfully.";
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

		public function update_floor_status($id){

			$floor_data = $this->get_single_floor($id);

			$floor_data = mysqli_fetch_array($floor_data);

			if($floor_data['published_status']==1){

				$status = 0;
			}
			else{
				$status = 1;
			}

			$updateDepartment = "UPDATE floor SET published_status=$status WHERE floor_id=$id";
			
			$updateDepartment= $this->database->update($updateDepartment);

			if ($updateDepartment) {

				return $meassage = "1***Floor Status Updated Succesfully.";
			}
			else{
				
				$errorMassage ="0***Something Wrong!!!";
				return $errorMassage;
			}
		}

		public function delete_floor($id){

			$floor_data = $this->get_single_floor($id);

			$floor_data = mysqli_fetch_array($floor_data);

			if($floor_data['published_status']==1){

				$status = 0;
			}
			else{
				$status = 1;
			}

			$updateDoctor = "UPDATE floor SET published_status=0, status=0 WHERE floor_id=$id";

			$updateDoctor= $this->database->update($updateDoctor);

			if ($updateDoctor) {

				return $meassage = "1***Floor Deleted Succesfully.";
			}
			else{
				
				$errorMassage ="0***Something Wrong!!!";
				return $errorMassage;
			}
		}

		public function number_of_floor(){

			$selectFloor = "SELECT a.*, b.department_id, b.name as department_name FROM floor a, department b  WHERE b.status=1 and b.published_status=1 and b.department_id=a.department and a.status=1 ORDER BY a.floor_id DESC";

			$allFloor= $this->database->select($selectFloor);

			if ($allFloor>'0') {
				$totalFloor = mysqli_num_rows($allFloor);
				return $totalFloor;
			}
		}


		public function add_bed_details($data,$file){

			$name = $this->dataFormat->data_validation($data['name']);
			$floor_id = $this->dataFormat->data_validation($data['floor_id']);
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
			    $filePath = __DIR__.'../../uploads/bed/'.$imageName; 
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

			if (isset($name) && $name!='' && isset($floor_id) && $floor_id!='') {

				$getBedQuery = "SELECT floor_id FROM bed WHERE name='$name' and floor_id='$floor_id'";

				$getBedQuery= $this->database->select($getBedQuery);

				if ($getBedQuery>'0') {

					return $meassage = "0***Duplicate Bed Or Floor Not Allowed";
				}
				else{

					$insertBed ="INSERT INTO bed(name, floor_id, description, image) VALUES ('$name','$floor_id','$description','$imageName')";

					$insertBed= $this->database->insert($insertBed);

					if ($insertBed) {

						if(isset($filePath)){
							
							$fileUpload = move_uploaded_file($file_tmp, $filePath);
						}

						$meassage = "1***New Bed Created Succesfully";
						return $meassage;
					}
					else{
						$meassage = "0***Something Went Wrong, Please Contact With Administator!!";
						return $meassage;
					}
				}

			}
			else{

				$meassage = '0***Floor Name And Department Field Must Not Be Empty!!!';

				return $meassage;
			}

		}

		public function get_all_bed($ofset=null, $limit=null,$bed_id=null,$data=null,$book_status=null){

			$con = '';
			if($data!=null && $data>=0){

				$con .= " and a.floor_id=$data";
			}

			if($book_status!=null){

				$con .= " and a.book_status=$book_status";
			}

			if($ofset==null AND $limit==null){

				$selectBed = "SELECT a.*, b.floor_id, b.name as floor_name, c.department_id, c.name as department_name FROM bed a, floor b, department c  WHERE b.status=1 and b.published_status=1 and b.floor_id=a.floor_id and a.status=1 and c.department_id=b.department and c.status=1 and c.published_status=1 $con ORDER BY a.bed_id DESC";
			}
			else{

				$selectBed = "SELECT a.*, b.floor_id, b.name as floor_name, c.department_id, c.name as department_name FROM bed a, floor b, department c  WHERE b.status=1 and b.published_status=1 and b.floor_id=a.floor_id and a.status=1 and c.department_id=b.department and c.status=1 and c.published_status=1 $con ORDER BY a.bed_id DESC LIMIT $ofset, $limit";
			}

			$allBed= $this->database->select($selectBed);

			if ($allBed>'0') {

				return $allBed;
			}

		}

		public function number_of_bed(){

			$selectBed = "SELECT a.*, b.floor_id, b.name as floor_name, c.department_id, c.name as department_name FROM bed a, floor b, department c  WHERE b.status=1 and b.published_status=1 and b.floor_id=a.floor_id and a.status=1 and c.department_id=b.department and c.status=1 and c.published_status=1 ORDER BY a.bed_id DESC";

			$allBed= $this->database->select($selectBed);

			if ($allBed>'0') {
				$totalBed = mysqli_num_rows($allBed);
				return $totalBed;
			}
		}

		public function get_single_bed($id){

			$selectBed = "SELECT a.*, b.floor_id, b.name as floor_name, c.department_id, c.name as department_name FROM bed a, floor b, department c  WHERE b.status=1 and b.published_status=1 and b.floor_id=a.floor_id and a.status=1 and c.department_id=b.department and c.status=1 and c.published_status=1 and a.bed_id=$id";

			$allBed= $this->database->select($selectBed);

			if ($allBed>'0') {

				return $allBed;
			}
		}

		public function update_bed_details($data, $file){

			$name = $this->dataFormat->data_validation($data['name']);
			$floor_id = $this->dataFormat->data_validation($data['floor_id']);
			$description = $this->dataFormat->data_validation($data['description']);
			$bed_id = $this->dataFormat->data_validation($data['bed_id']);

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
			    $filePath = __DIR__.'../../uploads/bed/'.$imageName; 
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
			$bed_data = $this->get_single_bed($bed_id);

			$bed_data = mysqli_fetch_array($bed_data);

			if($imageName=='')
			{
				$imageName = $bed_data['image'];
			}

			if (isset($bed_id) && $bed_id!='' && isset($name) && $name!=''  && isset($floor_id) && $floor_id!='') {

				$getBedQuery = "SELECT bed_id FROM bed WHERE ( name='$name' and floor_id='$floor_id')  and bed_id!=$bed_id";

				$getBedQuery= $this->database->select($getBedQuery);

				if ($getBedQuery>'0') {

					Session::initSession();
					Session::setSession("bed_id", $bed_id);
					return $meassage = "0***Duplicate Name Or Floor Not Allowed";
				}
				else{

					$updateBed = "UPDATE bed SET name='$name', floor_id='$floor_id', description='$description', image='$imageName' WHERE bed_id=$bed_id";

					$updateBed= $this->database->update($updateBed);

					if ($updateBed) {

						if(isset($filePath)){
							
							$fileUpload = move_uploaded_file($file_tmp, $filePath);

							if($bed_data['image']!='')
				            {
				                $deletePhoto = __DIR__."../../uploads/bed/".$floor_data['image'];
				                
				                if(file_exists($deletePhoto)){

				                    unlink($deletePhoto);
				                }
				            }

						}
						Session::initSession();
						Session::setSession("bed_id", $bed_id);

						return $meassage = "1***Bed Details Updated Succesfully.";
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

		public function update_bed_status($id){

			$bed_data = $this->get_single_bed($id);

			$bed_data = mysqli_fetch_array($bed_data);

			if($bed_data['published_status']==1){

				$status = 0;
			}
			else{
				$status = 1;
			}

			$updateBed = "UPDATE bed SET published_status=$status WHERE bed_id=$id";
			
			$updateBed= $this->database->update($updateBed);

			if ($updateBed) {

				return $meassage = "1***Bed Status Updated Succesfully.";
			}
			else{
				
				$errorMassage ="0***Something Wrong!!!";
				return $errorMassage;
			}
		}

		public function delete_bed($id){

			$bed_data = $this->get_single_bed($id);

			$bed_data = mysqli_fetch_array($bed_data);

			if($bed_data['published_status']==1){

				$status = 0;
			}
			else{
				$status = 1;
			}

			$updateBed = "UPDATE bed SET published_status=0, status=0 WHERE bed_id=$id";

			$updateBed= $this->database->update($updateBed);

			if ($updateBed) {

				return $meassage = "1***Bed Deleted Succesfully.";
			}
			else{
				
				$errorMassage ="0***Something Wrong!!!";
				return $errorMassage;
			}
		}

		public function add_add_bed_fee_details($data){

			$floor_id = $this->dataFormat->data_validation($data['floor_id']);
			$bed_id = $this->dataFormat->data_validation($data['bed_id']);
			$bed_fee = $this->dataFormat->data_validation($data['bed_fee']);

			if (isset($floor_id) && $floor_id!='' && isset($bed_id) && $bed_id!='' && isset($bed_fee) && $bed_fee>0) {

				$getQuery = "SELECT bed_id FROM bed_fee WHERE bed_id='$bed_id' and floor_id='$floor_id' and status=1";

				$getQuery= $this->database->select($getQuery);

				if ($getQuery>'0') {

					return $meassage = "0***Duplicate Fee Not Allowed";
				}
				else{

					$insertFeeQuery ="INSERT INTO bed_fee(floor_id, bed_id, bed_fee) VALUES ('$floor_id','$bed_id','$bed_fee')";

					$insertFee= $this->database->insert($insertFeeQuery);

					if ($insertFee) {

						$meassage = "1***New Bed Fee Created Succesfully";
						return $meassage;
					}
					else{
						$meassage = "0***Something Went Wrong, Please Contact With Administator!!";
						return $meassage;
					}
				}

			}
			else{

				$meassage = '0***Flor Number, Bed Number And Fee Field Must Not Be Empty!!!';

				return $meassage;
			}

		}

		public function get_all_bed_in_fee($ofset=null, $limit=null, $department_id=null,$floor_id=null,$display=0){

			$where_con = '';
			$fee_con = '';

			if($department_id!=null)
			{
				$where_con .= " and c.department=$department_id";
			}

			if($floor_id!=null)
			{
				$where_con .= " and b.floor_id=$floor_id";
			}

			if($display==0)
			{
				$fee_con = " and a.bed_id not in (select bed_id from bed_fee where status=1)";
			}
			else{

				$fee_con = " and a.bed_id in (select bed_id from bed_fee where status=1)";
			}

			if($ofset==null AND $limit==null){

				$selectBed = "SELECT a.*, b.floor_id, b.name as floor_name, c.department_id, c.name as department_name FROM bed a, floor b, department c  WHERE b.status=1 and b.published_status=1 and b.floor_id=a.floor_id and a.status=1 and c.department_id=b.department and c.status=1 and c.published_status=1 $where_con $fee_con ORDER BY a.bed_id DESC";
			}
			else{

				$selectBed = "SELECT a.*, b.floor_id, b.name as floor_name, c.department_id, c.name as department_name FROM bed a, floor b, department c  WHERE b.status=1 and b.published_status=1 and b.floor_id=a.floor_id and a.status=1 and c.department_id=b.department and c.status=1 and c.published_status=1 $where_con $fee_con ORDER BY a.bed_id DESC LIMIT $ofset, $limit";
			}

			$allBed= $this->database->select($selectBed);

			if ($allBed>'0') {

				return $allBed;
			}

		}

		public function get_all_active_bed_fee($ofset=null, $limit=null, $department_id=null, $floor_id=null, $fee_id=null){

			$where_con = '';
			$fee_con = '';

			if($department_id!=null)
			{
				$where_con .= " and c.department_id=$department_id";
			}

			if($floor_id!=null)
			{
				$where_con .= " and b.floor_id=$floor_id";
			}

			if($fee_id!=null)
			{
				$where_con .= " and a.fee_id=$fee_id";
			}


			if($ofset==null AND $limit==null){

				$selectBedFee = "SELECT a.*, b.floor_id as floor_id, b.name as floor_name, c.department_id as department_id, c.name as department_name, d.bed_id as bed_id, d.name as bed_name FROM bed_fee a, floor b, department c, bed d  WHERE a.status=1 and b.status=1 and c.status=1 and c.published_status=1 and b.department=c.department_id and a.floor_id=b.floor_id and d.floor_id=b.floor_id and d.bed_id=a.bed_id and d.status=1 $where_con ORDER BY a.bed_id DESC";
			}
			else{

				$selectBedFee = "SELECT a.*, b.floor_id as floor_id, b.name as floor_name, c.department_id as department_id, c.name as department_name, d.bed_id as bed_id, d.name as bed_name FROM bed_fee a, floor b, department c, bed d  WHERE a.status=1 and b.status=1 and c.status=1 and c.published_status=1 and b.department=c.department_id and a.floor_id=b.floor_id and d.floor_id=b.floor_id and d.bed_id=a.bed_id and d.status=1  $where_con ORDER BY a.bed_id DESC LIMIT $ofset, $limit";
			}

			$allBedFee= $this->database->select($selectBedFee);

			if ($allBedFee>'0') {

				return $allBedFee;
			}

		}

		public function update_bed_fee_details($data){

			$floor_id = $this->dataFormat->data_validation($data['floor_id']);
			$bed_id = $this->dataFormat->data_validation($data['bed_id']);
			$bed_fee = $this->dataFormat->data_validation($data['bed_fee']);
			$fee_id = $this->dataFormat->data_validation($data['fee_id']);

			if (isset($floor_id) && $floor_id!='' && isset($bed_id) && $bed_id!='' && isset($bed_fee) && $bed_fee>0 && isset($fee_id) && $fee_id!='') {

				$updateBedFee = "UPDATE bed_fee SET floor_id='$floor_id', bed_id='$bed_id', bed_fee='$bed_fee' WHERE fee_id=$fee_id";

				$updateBedFee= $this->database->update($updateBedFee);

				if ($updateBedFee) {

					Session::initSession();
					Session::setSession("bed_fee_id", $fee_id);

					return $meassage = "1***Bed Fee Details Updated Succesfully.";
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

		public function delete_bed_fee($id){


			$updateDoctorFee = "UPDATE bed_fee SET status=0 WHERE fee_id=$id";

			$updateDoctorFee= $this->database->update($updateDoctorFee);

			if ($updateDoctorFee) {

				return $meassage = "1***Doctor Fee Deleted Succesfully.";
			}
			else{
				
				$errorMassage ="0***Something Wrong!!!";
				return $errorMassage;
			}
		}

		public function number_of_bed_fee(){

			$selectBedFee = "SELECT a.*, b.floor_id as floor_id, b.name as floor_name, c.department_id as department_id, c.name as department_name, d.bed_id as bed_id, d.name as bed_name FROM bed_fee a, floor b, department c, bed d  WHERE a.status=1 and b.status=1 and c.status=1 and c.published_status=1 and b.department=c.department_id and a.floor_id=b.floor_id and d.floor_id=b.floor_id and d.bed_id=a.bed_id and d.status=1 ORDER BY a.bed_id DESC";

			$allBedfee= $this->database->select($selectBedFee);

			if ($allBedfee>'0') {
				$totalBedfee = mysqli_num_rows($allBedfee);
				return $totalBedfee;
			}
		}

	}
