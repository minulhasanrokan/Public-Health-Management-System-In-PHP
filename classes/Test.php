<?php

	include_once __DIR__.'/../lib/database.php';
	include_once __DIR__.'/../lib/Session.php';
	include_once __DIR__.'/../helpers/Format.php';

	class Test{

		private $database;
		private $dataFormat;
	 
		public function __construct(){

			//Session::checkSession();

			$this->database= new Database();
			$this->dataFormat= new Format();
		}

		public function add_test_type_details($data,$file){

			$name = $this->dataFormat->data_validation($data['name']);
			$description = $this->dataFormat->data_validation($data['description']);

			$image = $file;
			$imageName = '';

			if($image['name']!=null){

				$file_name = $image['name'];
			    $file_size =$image['size'];
		        $file_tmp =$image['tmp_name'];
			    $file_type=$image['type'];

			    $file_ext = pathinfo($file_name,PATHINFO_EXTENSION);

			    $imageName =$name."-test-".substr(md5(time()),0,10).'.'.$file_ext;
			    $imageName = str_replace(' ','-',$imageName);
			    $filePath = __DIR__.'../../uploads/test/'.$imageName; 
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

			if (isset($name) && $name!='' && isset($description) && $description!='') {

				$insertTestQuery ="INSERT INTO test_type(name, description, image) VALUES ('$name','$description','$imageName')";

				$insertTest= $this->database->insert($insertTestQuery);

				if ($insertTest) {

					if(isset($filePath)){
						
						$fileUpload = move_uploaded_file($file_tmp, $filePath);
					}

					$meassage = "1***New Test Type Created Succesfully";
					return $meassage;
				}
				else{
					$meassage = "0***Something Went Wrong, Please Contact With Administator!!";
					return $meassage;
				}

			}
			else{

				$meassage = '0***Medicine Name And Category Field Must Not Be Empty!!!';

				return $meassage;
			}

		}

		public function get_all_test_type($ofset=null, $limit=null){

			if($ofset==null AND $limit==null){

				$selectTest = "SELECT * FROM test_type  WHERE status=1 ORDER BY test_id DESC";
			}
			else{

				$selectTest = "SELECT * FROM test_type  WHERE status=1 ORDER BY test_id DESC LIMIT $ofset, $limit";
			}

			$allTest= $this->database->select($selectTest);

			if ($allTest>'0') {

				return $allTest;
			}

		}

		public function get_single_test($id){

			$selectTest  = "SELECT * FROM test_type  WHERE status=1 and test_id=$id ORDER BY test_id DESC";

			$allTest= $this->database->select($selectTest);

			if ($allTest>'0') {

				return $allTest;
			}
		}

		public function update_test_type_details($data, $file){

			$name = $this->dataFormat->data_validation($data['name']);
			$description = $this->dataFormat->data_validation($data['description']);
			$test_id = $this->dataFormat->data_validation($data['test_id']);

			$image = $file;
			$imageName = '';

			if($image['name']!=null){

				$file_name = $image['name'];
			    $file_size =$image['size'];
		        $file_tmp =$image['tmp_name'];
			    $file_type=$image['type'];

			    $file_ext = pathinfo($file_name,PATHINFO_EXTENSION);

			    $imageName =$name."-test-".substr(md5(time()),0,10).'.'.$file_ext;
			    $imageName = str_replace(' ','-',$imageName);
			    $filePath = __DIR__.'../../uploads/test/'.$imageName; 
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

			$test_data = $this->get_single_test($test_id);

			$test_data = mysqli_fetch_array($test_data);

			if($imageName=='')
			{
				$imageName = $test_data['image'];
			}

			if (isset($test_id) && $test_id!='') {

				$updateTest = "UPDATE test_type SET name='$name', description='$description', image='$imageName' WHERE test_id=$test_id";

				$updateTest= $this->database->update($updateTest);

				if ($updateTest) {

					if(isset($filePath)){
						
						$fileUpload = move_uploaded_file($file_tmp, $filePath);

						if($test_data['image']!='')
			            {
			                $deletePhoto = __DIR__."../../uploads/test/".$test_data['image'];
			                
			                if(file_exists($deletePhoto)){

			                    unlink($deletePhoto);
			                }
			            }

					}
					Session::initSession();
					Session::setSession("test_id", $test_id);

					return $meassage = "1***Test Type Details Updated Succesfully.";
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

		public function delete_test_type($id){

			$test_data = $this->get_single_test($id);

			$test_data = mysqli_fetch_array($test_data);

			if($test_data['published_status']==1){

				$status = 0;
			}
			else{
				$status = 1;
			}

			$updateTest = "UPDATE test_type SET published_status=0, status=0 WHERE test_id=$id";

			$updateTest= $this->database->update($updateTest);

			if ($updateTest) {

				return $meassage = "1***Test Type Deleted Succesfully.";
			}
			else{
				
				$errorMassage ="0***Something Wrong!!!";
				return $errorMassage;
			}
		}

		public function change_test_status($id){

			$test_data = $this->get_single_test($id);

			$test_data = mysqli_fetch_array($test_data);

			if($test_data['published_status']==1){

				$status = 0;
			}
			else{
				$status = 1;
			}

			$updateTest = "UPDATE test_type SET published_status=$status WHERE test_id=$id";
			
			$updateTest= $this->database->update($updateTest);

			if ($updateTest) {

				return $meassage = "1***Test Type Status Updated Succesfully.";
			}
			else{
				
				$errorMassage ="0***Something Wrong!!!";
				return $errorMassage;
			}
		}

		public function number_of_test(){

			$selectTest = "SELECT a.* FROM test_type a  WHERE a.status=1 ORDER BY a.test_id DESC";

			$allTest= $this->database->select($selectTest);

			if ($allTest>'0') {
				$totalTest = mysqli_num_rows($allTest);
				return $totalTest;
			}
		} 

		public function get_all_active_test_in_fee($ofset=null, $limit=null,$display=0){

			$fee_con = '';

			if($display==0)
			{
				$fee_con = " and a.test_id not in (select test_id from test_fee where status=1)";
			}
			else{

				$fee_con = " and a.test_id in (select test_id from test_fee where status=1)";
			}	

			if($ofset==null AND $limit==null){

				$selectTest = "SELECT a.* FROM test_type a WHERE a.status=1 and a.published_status=1 $fee_con ORDER BY a.test_id DESC";
			}
			else{

				$selectTest = "SELECT a.* FROM test_type a WHERE a.status=1 and a.published_status=1  $fee_con ORDER BY a.test_id DESC LIMIT $ofset, $limit";
			}

			$allTest= $this->database->select($selectTest);

			if ($allTest>'0') {

				return $allTest;
			}

		}

		public function add_test_fee_details($data){

			$test_id = $this->dataFormat->data_validation($data['test_id']);
			$test_fee = $this->dataFormat->data_validation($data['test_fee']);

			if (isset($test_id) && $test_id!='' && isset($test_fee) && $test_fee!='' && $test_fee>0) {

				$getQuery = "SELECT test_id FROM test_fee WHERE test_id='$test_id' and status=1";

				$getQuery= $this->database->select($getQuery);

				if ($getQuery>'0') {

					return $meassage = "0***Duplicate Fee Not Allowed";
				}
				else{

					$insertFeeQuery ="INSERT INTO test_fee(test_id, test_fee) VALUES ('$test_id','$test_fee')";

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

				$meassage = '0***Test Name And Fee Field Must Not Be Empty!!!';

				return $meassage;
			}

		}

		public function get_all_active_test_fee($ofset=null, $limit=null,$test_id=null){

			$where_con = '';
			$fee_con = '';

			if($test_id!=null)
			{
				$where_con .= " and a.department=$test_id";
			}

			if($ofset==null AND $limit==null){

				$selectTest = "SELECT a.*, b.test_id, b.name as test_name FROM test_fee a, test_type b  WHERE b.status=1 and b.published_status=1 and a.status=1 and a.test_id=b.test_id $where_con ORDER BY a.test_id DESC";
			}
			else{

				$selectTest = "SELECT a.*, b.test_id, b.name as test_name FROM test_fee a, test_type b  WHERE b.status=1 and b.published_status=1 and a.status=1 and a.test_id=b.test_id $where_con ORDER BY a.test_id DESC LIMIT $ofset, $limit";
			}

			$allTest= $this->database->select($selectTest);

			if ($allTest>'0') {

				return $allTest;
			}

		}

		public function get_single_test_fee($fee_id=null){

			$where_con = '';

			if($fee_id!=null)
			{
				$where_con .= " and a.fee_id=$fee_id";
			}

			$selectTest = "SELECT a.*, b.test_id, b.name as test_name FROM test_fee a, test_type b  WHERE b.status=1 and b.published_status=1 and a.status=1 and a.test_id=b.test_id $where_con";

			$allTest= $this->database->select($selectTest);

			if ($allTest>'0') {

				return $allTest;
			}

		}

		public function update_test_fee_details($data){

			$test_id = $this->dataFormat->data_validation($data['test_id']);
			$test_fee = $this->dataFormat->data_validation($data['test_fee']);
			$fee_id = $this->dataFormat->data_validation($data['fee_id']);


			if (isset($test_id) && $test_id!='' && isset($test_fee) && $test_fee!='' && isset($fee_id) && $fee_id!='') {

				$updateTestFee = "UPDATE test_fee SET test_id='$test_id', test_fee='$test_fee' WHERE fee_id=$fee_id";

				$updateTestFee= $this->database->update($updateTestFee);

				if ($updateTestFee) {

					Session::initSession();
					Session::setSession("test_fee_id", $fee_id);

					return $meassage = "1***Test Fee Details Updated Succesfully.";
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

		public function delete_test_fee($id){

			$updateTestFee = "UPDATE test_fee SET status=0 WHERE fee_id=$id";

			$updateTestFee= $this->database->update($updateTestFee);

			if ($updateTestFee) {

				return $meassage = "1***Test Fee Deleted Succesfully.";
			}
			else{
				
				$errorMassage ="0***Something Wrong!!!";
				return $errorMassage;
			}
		}

		public function number_of_test_fee(){

			$selectTest = "SELECT a.*, b.test_id, b.name as test_name FROM test_fee a, test_type b  WHERE b.status=1 and b.published_status=1 and a.status=1 and a.test_id=b.test_id";

			$allTestfee= $this->database->select($selectTest);

			if ($allTestfee>'0') {
				$totalTestfee = mysqli_num_rows($allTestfee);
				return $totalTestfee;
			}
		}
	}