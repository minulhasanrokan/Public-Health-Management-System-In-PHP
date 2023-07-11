<?php

	include_once __DIR__.'/../lib/database.php';
	include_once __DIR__.'/../lib/Session.php';
	include_once __DIR__.'/../helpers/Format.php';

	class Medicine{

		private $database;
		private $dataFormat;
	 
		public function __construct(){

			//Session::checkSession();

			$this->database= new Database();
			$this->dataFormat= new Format();
		}

		public function add_medicine_category_details($data,$file){

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

			    $imageName =$name."-medicine-category-".substr(md5(time()),0,10).'.'.$file_ext;
			    $imageName = str_replace(' ','-',$imageName);
			    $filePath = __DIR__.'../../uploads/medicine/'.$imageName; 
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

				$insertCategoryQuery ="INSERT INTO medicine_category(name, title, description, image) VALUES ('$name','$title','$description','$imageName')";

				$insertCategory= $this->database->insert($insertCategoryQuery);

				if ($insertCategory) {

					if(isset($filePath)){
						
						$fileUpload = move_uploaded_file($file_tmp, $filePath);
					}

					$meassage = "1***New Medicine Category Created Succesfully";
					return $meassage;
				}
				else{
					$meassage = "0***Something Went Wrong, Please Contact With Administator!!";
					return $meassage;
				}

			}
			else{

				$meassage = '0***Medicine Category Name Field Must Not Be Empty!!!';

				return $meassage;
			}

		}

		public function get_all_medicine_category($ofset=null, $limit=null){

			if($ofset==null AND $limit==null){

				$selectCategory = "SELECT * FROM medicine_category  WHERE status=1 ORDER BY category_id DESC";
			}
			else{

				$selectCategory = "SELECT * FROM medicine_category  WHERE status=1 ORDER BY category_id DESC LIMIT $ofset, $limit";
			}

			$allCategory= $this->database->select($selectCategory);

			if ($allCategory>'0') {

				return $allCategory;
			}

		}

		public function get_single_medicine_category($id){

			$selectCategory  = "SELECT * FROM medicine_category  WHERE status=1 and category_id=$id ORDER BY category_id DESC";

			$allCategory= $this->database->select($selectCategory);

			if ($allCategory>'0') {

				return $allCategory;
			}
		}

		public function update_medicine_category_details($data, $file){


			$name = $this->dataFormat->data_validation($data['name']);
			$title = $this->dataFormat->data_validation($data['title']);
			$description = $this->dataFormat->data_validation($data['description']);
			$category_id = $this->dataFormat->data_validation($data['category_id']);

			$image = $file;
			$imageName = '';


			if($image['name']!=null){

				$file_name = $image['name'];
			    $file_size =$image['size'];
		        $file_tmp =$image['tmp_name'];
			    $file_type=$image['type'];

			    $file_ext = pathinfo($file_name,PATHINFO_EXTENSION);

			    $imageName =$name."-medicine-category-".substr(md5(time()),0,10).'.'.$file_ext;
			    $imageName = str_replace(' ','-',$imageName);
			    $filePath = __DIR__.'../../uploads/medicine/'.$imageName; 
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

			$category_data = $this->get_single_medicine_category($category_id);

			$category_data = mysqli_fetch_array($category_data);

			if($imageName=='')
			{
				$imageName = $category_data['image'];
			}

			if (isset($category_id) && $category_id!='') {

				$updateCategory = "UPDATE medicine_category SET name='$name', title='$title', description='$description', image='$imageName' WHERE category_id=$category_id";

				$updateCategory= $this->database->update($updateCategory);

				if ($updateCategory) {

					if(isset($filePath)){
						
						$fileUpload = move_uploaded_file($file_tmp, $filePath);

						if($category_data['image']!='')
			            {
			                $deletePhoto = __DIR__."../../uploads/medicine/".$category_data['image'];
			                
			                if(file_exists($deletePhoto)){

			                    unlink($deletePhoto);
			                }
			            }

					}
					Session::initSession();
					Session::setSession("medicine_category_id", $category_id);

					return $meassage = "1***Medicine Category Details Updated Succesfully.";
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

		public function update_medicine_category_status($id){

			$category_data = $this->get_single_medicine_category($id);

			$category_data = mysqli_fetch_array($category_data);

			if($category_data['published_status']==1){

				$status = 0;
			}
			else{
				$status = 1;
			}

			$updateCategory = "UPDATE medicine_category SET published_status=$status WHERE category_id=$id";
			
			$updateCategory= $this->database->update($updateCategory);

			if ($updateCategory) {

				return $meassage = "1***Medicine Category Status Updated Succesfully.";
			}
			else{
				
				$errorMassage ="0***Something Wrong!!!";
				return $errorMassage;
			}
		}

		public function delete_medicine_category($id){

			$category_data = $this->get_single_medicine_category($id);

			$category_data = mysqli_fetch_array($category_data);

			if($category_data['published_status']==1){

				$status = 0;
			}
			else{
				$status = 1;
			}

			$updateDepartment = "UPDATE medicine_category SET published_status=0, status=0 WHERE category_id=$id";

			$updateDepartment= $this->database->update($updateDepartment);

			if ($updateDepartment) {

				return $meassage = "1***Medicine Category Deleted Succesfully.";
			}
			else{
				
				$errorMassage ="0***Something Wrong!!!";
				return $errorMassage;
			}
		}

		public function number_of_pmedicine_category(){

			$selectCategory = "SELECT a.* FROM medicine_category a  WHERE a.status=1 ORDER BY a.category_id DESC";

			$allCategory= $this->database->select($selectCategory);

			if ($allCategory>'0') {
				$totalCategory = mysqli_num_rows($allCategory);
				return $totalCategory;
			}
		}

		public function get_all_active_medicine_category($ofset=null, $limit=null){

			if($ofset==null AND $limit==null){

				$selectCategory = "SELECT * FROM medicine_category  WHERE status=1 and published_status=1 ORDER BY category_id DESC";
			}
			else{

				$selectCategory = "SELECT * FROM medicine_category  WHERE status=1 and published_status=1 ORDER BY category_id DESC LIMIT $ofset, $limit";
			}

			$allCategory= $this->database->select($selectCategory);

			if ($allCategory>'0') {

				return $allCategory;
			}

		}

		public function add_medicine_details($data,$file){

			$name = $this->dataFormat->data_validation($data['name']);
			$category_id = $this->dataFormat->data_validation($data['category_id']);
			$description = $this->dataFormat->data_validation($data['description']);
			$buy_price = $this->dataFormat->data_validation($data['buy_price']);
			$regular_price = $this->dataFormat->data_validation($data['regular_price']);
			$sale_price = $this->dataFormat->data_validation($data['sale_price']);

			$image = $file;
			$imageName = '';

			if($image['name']!=null){

				$file_name = $image['name'];
			    $file_size =$image['size'];
		        $file_tmp =$image['tmp_name'];
			    $file_type=$image['type'];

			    $file_ext = pathinfo($file_name,PATHINFO_EXTENSION);

			    $imageName =$name."-medicine-".substr(md5(time()),0,10).'.'.$file_ext;
			    $imageName = str_replace(' ','-',$imageName);
			    $filePath = __DIR__.'../../uploads/medicine/'.$imageName; 
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

			if (isset($name) && $name!='' && isset($category_id) && $category_id!='') {

				$insertMedicineQuery ="INSERT INTO medicine(name, category_id, description, buy_price, regular_price, sale_price, image) VALUES ('$name','$category_id','$description','$buy_price','$regular_price','$sale_price','$imageName')";

				$insertMedicine= $this->database->insert($insertMedicineQuery);

				if ($insertMedicine) {

					if(isset($filePath)){
						
						$fileUpload = move_uploaded_file($file_tmp, $filePath);
					}

					$meassage = "1***New Medicine Created Succesfully";
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

		public function get_all_medicine($ofset=null, $limit=null){

			if($ofset==null AND $limit==null){

				$selectMedicine = "SELECT a.*, b.name as category_name, b.category_id as category_id FROM medicine
				a, medicine_category b WHERE a.status=1 and a.category_id=b.category_id and b.status=1 and b.published_status=1 ORDER BY a.medicine_id DESC";
			}
			else{

				$selectMedicine = "SELECT a.*, b.name as category_name, b.category_id as category_id FROM medicine
				a, medicine_category b WHERE a.status=1 and a.category_id=b.category_id and b.status=1 and b.published_status=1 ORDER BY a.medicine_id DESC LIMIT $ofset, $limit";
			}

			$allMedicine= $this->database->select($selectMedicine);

			if ($allMedicine>'0') {

				return $allMedicine;
			}

		}

		public function get_single_medicine($id){

			$selectMedicine = "SELECT a.*, b.name as category_name, b.category_id as category_id FROM medicine
				a, medicine_category b WHERE a.status=1 and a.category_id=b.category_id and b.status=1 and b.published_status=1 and a.medicine_id=$id ORDER BY a.medicine_id DESC";

			$allMedicine= $this->database->select($selectMedicine);

			if ($allMedicine>'0') {

				return $allMedicine;
			}
		}

		public function update_medicine_details($data, $file){


			$name = $this->dataFormat->data_validation($data['name']);
			$category_id = $this->dataFormat->data_validation($data['category_id']);
			$description = $this->dataFormat->data_validation($data['description']);
			$buy_price = $this->dataFormat->data_validation($data['buy_price']);
			$regular_price = $this->dataFormat->data_validation($data['regular_price']);
			$sale_price = $this->dataFormat->data_validation($data['sale_price']);
			$medicine_id = $this->dataFormat->data_validation($data['medicine_id']);

			$image = $file;
			$imageName = '';


			if($image['name']!=null){

				$file_name = $image['name'];
			    $file_size =$image['size'];
		        $file_tmp =$image['tmp_name'];
			    $file_type=$image['type'];

			    $file_ext = pathinfo($file_name,PATHINFO_EXTENSION);

			    $imageName =$name."-medicine-".substr(md5(time()),0,10).'.'.$file_ext;
			    $imageName = str_replace(' ','-',$imageName);
			    $filePath = __DIR__.'../../uploads/medicine/'.$imageName; 
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

			$medicine_data = $this->get_single_medicine($medicine_id);

			$medicine_data = mysqli_fetch_array($medicine_data);

			if($imageName=='')
			{
				$imageName = $medicine_data['image'];
			}

			if (isset($medicine_id) && $medicine_id!='') {

				$updateMedicine = "UPDATE medicine SET name='$name', category_id='$category_id', description='$description', buy_price='$buy_price', regular_price='$regular_price', sale_price='$sale_price', image='$imageName' WHERE medicine_id=$medicine_id";

				$updateMedicine= $this->database->update($updateMedicine);

				if ($updateMedicine) {

					if(isset($filePath)){
						
						$fileUpload = move_uploaded_file($file_tmp, $filePath);

						if($medicine_data['image']!='')
			            {
			                $deletePhoto = __DIR__."../../uploads/medicine/".$medicine_data['image'];
			                
			                if(file_exists($deletePhoto)){

			                    unlink($deletePhoto);
			                }
			            }

					}
					Session::initSession();
					Session::setSession("medicine_id", $medicine_id);

					return $meassage = "1***Medicine Details Updated Succesfully.";
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


		public function change_medicine_status($id){

			$medicine_data = $this->get_single_medicine($id);

			$medicine_data = mysqli_fetch_array($medicine_data);

			if($medicine_data['published_status']==1){

				$status = 0;
			}
			else{
				$status = 1;
			}

			$updateCategory = "UPDATE medicine SET published_status=$status WHERE medicine_id=$id";
			
			$updateCategory= $this->database->update($updateCategory);

			if ($updateCategory) {

				return $meassage = "1***Medicine Status Updated Succesfully.";
			}
			else{
				
				$errorMassage ="0***Something Wrong!!!";
				return $errorMassage;
			}
		}

		public function delete_medicine($id){

			$medicine_data = $this->get_single_medicine($id);

			$medicine_data = mysqli_fetch_array($medicine_data);

			if($medicine_data['published_status']==1){

				$status = 0;
			}
			else{
				$status = 1;
			}

			$updateDepartment = "UPDATE medicine SET published_status=0, status=0 WHERE medicine_id=$id";

			$updateDepartment= $this->database->update($updateDepartment);

			if ($updateDepartment) {

				return $meassage = "1***Medicine Deleted Succesfully.";
			}
			else{
				
				$errorMassage ="0***Something Wrong!!!";
				return $errorMassage;
			}
		}

		public function number_of_medicine(){

			$selectMedicine = "SELECT a.*, b.name as category_name, b.category_id as category_id FROM medicine
				a, medicine_category b WHERE a.status=1 and a.category_id=b.category_id and b.status=1 and b.published_status=1 ORDER BY a.medicine_id DESC";

			$allMedicine= $this->database->select($selectMedicine);

			if ($allMedicine>'0') {
				$totalMedicine = mysqli_num_rows($allMedicine);
				return $totalMedicine;
			}
		}
	}