<?php

	include_once __DIR__.'/../lib/database.php';
	include_once __DIR__.'/../lib/Session.php';
	include_once __DIR__.'/../helpers/Format.php';
	include_once __DIR__.'/../helpers/Email.php';

	class Deadreport{

		private $database;
		private $dataFormat;
		private $email;
	 
		public function __construct(){
 
			//Session::checkSession();

			$this->database= new Database();
			$this->dataFormat= new Format();
			$this->email= new Email();
		}

		public function add_dead_report_details($data,$file){

			$patient_id = $this->dataFormat->data_validation($data['patient_id']);
			$report_date = $this->dataFormat->data_validation($data['report_date']);
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
			    $filePath = __DIR__.'../../uploads/dead_report/'.$imageName; 
			    $extensions= array("jpeg","jpg","png","pdf");

			    if(in_array($file_ext,$extensions)=== false){
				    	
			    	$meassage="0***File extension not allowed, please choose a jpeg ,jpg, png or pdf file.";
         			return $meassage;
			    }
			    elseif($file_size > 2097152){
	        
			        $meassage='0***File size must be excately 2 MB';
			        return $meassage;
			    }

			}

			if (isset($patient_id) && $patient_id!='' && isset($report_date) && $report_date!='' && isset($description) && $description!='') {

				$insertDeadReportQuery ="INSERT INTO dead_report(patient_id, report_date, description, image) VALUES ('$patient_id','$report_date','$description','$imageName')";

				$insertDeadReport= $this->database->insert($insertDeadReportQuery);

				if ($insertDeadReport) {

					$updatePatient = "UPDATE patient SET dead_status=1 WHERE patient_id=$patient_id";

					$updatePatient= $this->database->update($updatePatient);

					if(isset($filePath)){
						
						$fileUpload = move_uploaded_file($file_tmp, $filePath);
					}

					$meassage = "1***New Dead Report Created Succesfully";
					return $meassage;
				}
				else{
					$meassage = "0***Something Went Wrong, Please Contact With Administator!!";
					return $meassage;
				}
			}
			else{

				$meassage = '0***All Field Must Not Be Empty!!!';

				return $meassage;
			}

		}

		public function get_all_dead_report($ofset=null, $limit=null){

			if($ofset==null AND $limit==null){

				$selectDeadReport = "SELECT a.*, b.* FROM dead_report a, patient b  WHERE a.status=1 and b.patient_id=a.patient_id ORDER BY a.dead_report_id  DESC";
			}
			else{

				$selectDeadReport = "SELECT a.*, b.* FROM dead_report a, patient b  WHERE a.status=1 and b.patient_id=a.patient_id ORDER BY a.dead_report_id  DESC LIMIT $ofset, $limit";
			}

			$allDeadReport= $this->database->select($selectDeadReport);

			if ($allDeadReport>'0') {

				return $allDeadReport;
			}

		}

		public function number_of_dead_report(){

			$selectDead = "SELECT a.* FROM dead_report a WHERE a.status=1";

			$allDead= $this->database->select($selectDead);

			if ($allDead>'0') {
				$totalDead = mysqli_num_rows($allDead);
				return $totalDead;
			}
		}
	}