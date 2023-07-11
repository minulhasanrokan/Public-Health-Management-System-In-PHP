<?php

	include_once __DIR__.'/../lib/database.php';
	include_once __DIR__.'/../lib/Session.php';
	include_once __DIR__.'/../helpers/Format.php';

	class Setting{

		private $database;
		private $dataFormat;
	 
		public function __construct(){

			//Session::checkSession();

			$this->database= new Database();
			$this->dataFormat= new Format();
		}

		public function get_system_data($id=null){

			$id = $this->dataFormat->data_validation($id);

			$settingQuery = "SELECT * FROM setting WHERE setting_id =$id and status=1";

			$settingQuery= $this->database->select($settingQuery);

			if ($settingQuery>'0') {
				return $settingQuery;
			}
		}

		public function update_system_details($data,$logo,$icon){

			$name = $this->dataFormat->data_validation($data['name']);
			$title = $this->dataFormat->data_validation($data['title']);
			$setting_id = $this->dataFormat->data_validation($data['setting_id']);
			$mobile = $this->dataFormat->data_validation($data['mobile']);
			$email = $this->dataFormat->data_validation($data['email']);
			$address = $this->dataFormat->data_validation($data['address']);
			$description = $this->dataFormat->data_validation($data['description']);

			$logo = $logo;
			$logoName = '';

			$icon = $icon;
			$iconName = '';

			if($logo['name']!=null){

				$file_name = $logo['name'];
			    $file_size =$logo['size'];
		        $file_tmp =$logo['tmp_name'];
			    $file_type=$logo['type'];

			    $file_ext = pathinfo($file_name,PATHINFO_EXTENSION);

			    $logoName =$name."-logo-".substr(md5(time()),0,10).'.'.$file_ext;
			    $logoName = str_replace(' ','-',$logoName);
			    $logoPath = __DIR__.'/../uploads/Setting/'.$logoName; 
			    $extensions= array("jpeg","jpg","png");

			    if(in_array($file_ext,$extensions)=== false){
				    	
			    	$meassage="0***Logo File extension not allowed, please choose a jpeg ,jpg or png file.";
         			return $meassage;
			    }
			    elseif($file_size > 2097152){
	        
			        $meassage='0***Logo File size must be excately 2 MB';
			        return $meassage;
			    }

			}

			if($icon['name']!=null){

				$file_name = $icon['name'];
			    $file_size =$icon['size'];
		        $file_tmp =$icon['tmp_name'];
			    $file_type=$icon['type'];

			    $file_ext = pathinfo($file_name,PATHINFO_EXTENSION);

			    $iconName =$name."-icon-".substr(md5(time()),0,10).'.'.$file_ext;
			    $iconName = str_replace(' ','-',$iconName);
			    $iconPath = __DIR__.'/../uploads/setting/'.$iconName; 
			    $extensions= array("jpeg","jpg","png");

			    if(in_array($file_ext,$extensions)=== false){
				    	
			    	$meassage="0***Icon extension not allowed, please choose a jpeg ,jpg or png file.";
         			return $meassage;
			    }
			    elseif($file_size > 2097152){
	        
			        $meassage='0***Icon size must be excately 2 MB';
			        return $meassage;
			    }

			}

			$system_data = $this->get_system_data($setting_id);

			$system_data = mysqli_fetch_array($system_data);

			if($logoName=='')
			{
				$logoName = $system_data['image'];
			}

			if($iconName=='')
			{
				$iconName = $system_data['icon'];
			}

			if (isset($setting_id) && $setting_id!='') {

				$updateSetting = "UPDATE setting SET name='$name', title='$title', phone='$mobile', email='$email', address='$address', description='$description', image='$logoName', icon='$iconName' WHERE setting_id=$setting_id";

				$updateSetting= $this->database->update($updateSetting);

				if ($updateSetting) {

					if(isset($logoPath)){
						
						$fileUpload = move_uploaded_file($file_tmp, $logoPath);

						if($system_data['image']!='')
			            {
			                $deletePhoto = __DIR__."../uploads/setting/".$system_data['image'];
			                
			                if(file_exists($deletePhoto)){

			                    unlink($deletePhoto);
			                }
			            }

					}

					if(isset($iconPath)){
						
						$fileUpload = move_uploaded_file($file_tmp, $iconPath);

						if($system_data['icon']!='')
			            {
			                $deletePhoto = __DIR__."../uploads/setting/".$system_data['icon'];
			                
			                if(file_exists($deletePhoto)){

			                    unlink($deletePhoto);
			                }
			            }

					}

					return $meassage = "1***System Details Updated Succesfully.";
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