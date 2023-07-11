<?php

	include_once __DIR__.'/../lib/database.php';
	include_once __DIR__.'/../lib/Session.php';
	include_once __DIR__.'/../helpers/Format.php';
	include_once __DIR__.'/../helpers/Email.php';

	class Report{

		private $database;
		private $dataFormat;
		private $email;
	 
		public function __construct(){

			//Session::checkSession();

			$this->database= new Database();
			$this->dataFormat= new Format();
			$this->email= new Email();
		}

		public function add_report_details($data,$file){

			$appointment_no = $this->dataFormat->data_validation($data['appointment_no']);
			$appointment_id = $this->dataFormat->data_validation($data['appointment_id']);
			$doctor_id = $this->dataFormat->data_validation($data['doctor_id']);
			$patient_id = $this->dataFormat->data_validation($data['patient_id']);
			$report_date = $this->dataFormat->data_validation($data['report_date']);
			$description = $this->dataFormat->data_validation($data['description']);
			$test_id = $this->dataFormat->data_validation($data['test_id']);

			Session::initSession();
			$laboratorist_id = $_SESSION['laboratoristId'];


			$image = $file;
			$imageName = '';
 
			if($image['name']!=null){

				$file_name = $image['name'];
			    $file_size =$image['size'];
		        $file_tmp =$image['tmp_name'];
			    $file_type=$image['type'];

			    $file_ext = pathinfo($file_name,PATHINFO_EXTENSION);

			    $imageName =$appointment_no."-".substr(md5(time()),0,10).'.'.$file_ext;
			    $imageName = str_replace(' ','-',$imageName);
			    $filePath = __DIR__.'../../uploads/report/'.$imageName;
			}

			if (isset($appointment_no) && $appointment_no!='' && isset($appointment_id) && $appointment_id!='' && isset($test_id) && $test_id!='' && isset($report_date) && $report_date!='' && $imageName!='') {

				$insertReportQuery ="INSERT INTO report(appointment_no, appointment_id, doctor_id, patient_id, report_date, description, laboratorist_id, image, test_id) VALUES ('$appointment_no','$appointment_id','$doctor_id','$patient_id','$report_date','$description','$laboratorist_id','$imageName','$test_id')";

				$insertReport= $this->database->insert($insertReportQuery);

				if ($insertReport) {

					if(isset($filePath)){
						
						$fileUpload = move_uploaded_file($file_tmp, $filePath);
					}

					$id = $this->database->last_insert_id();

					$updateAppointment = "update appointment set report_status=1 where appointment_id=$appointment_id";

					$updateAppointment= $this->database->update($updateAppointment);

					if($updateAppointment==true){

						$meassage = "1***New Report Created Succesfully";
						return $meassage;
					}
					else{

						$deleteReportQuery = "delete from report where report_id=$id";
						$deleteReport= $this->database->delete($deleteReportQuery);

						if($deleteReport==true){

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
			else{

				$meassage = '0***Test Type, Report Date And File Field Must Not Be Empty!!!';

				return $meassage;
			}

		}

		public function get_all_report($ofset=null, $limit=null,$appointment_id=null, $doctor_id=null,$patient_id=null,$date_con=null,$test_id=null){

			$con = '';

			if($date_con!=null){

				$con .= ' and a.report_date='."'".$cur_date."'";
			}

			if($test_id!=null){

				$con .= ' and a.test_id='."'".$test_id."'";
			}

			if($patient_id!=null){

				$con .= ' and a.patient_id='."'".$patient_id."'";
			}

			if($doctor_id!=null){

				$con .= ' and a.doctor_id='."'".$doctor_id."'";
			}

			if($appointment_id!=null){

				$con .= ' and a.appointment_id='."'".$appointment_id."'";
			}

			if($ofset==null AND $limit==null){

				$selectReport = "SELECT a.*, b.name as patient_name, b.image as patient_image, c.name as doctor_name, c.image as doctor_image, d.name as test_name, d.image as test_image FROM report a, patient b, doctor c, test_type d  WHERE a.status=1 and b.patient_id=a.patient_id and c.doctor_id=a.doctor_id and d.test_id=a.test_id and b.status=1 and b.v_status=1 and c.status=1 and c.v_status=1 and d.status=1 $con ORDER BY a.report_id DESC";
			}
			else{

				$selectReport = "SELECT a.*, b.name as patient_name, b.image as patient_image, c.name as doctor_name, c.image as doctor_image, d.name as test_name, d.image as test_image FROM report a, patient b, doctor c, test_type d  WHERE a.status=1 and b.patient_id=a.patient_id and c.doctor_id=a.doctor_id and d.test_id=a.test_id and b.status=1 and b.v_status=1 and c.status=1 and c.v_status=1 and d.status=1 $con ORDER BY a.report_id DESC LIMIT $ofset, $limit";
			}
			
			$allReport= $this->database->select($selectReport);

			if ($allReport>'0') {

				return $allReport;
			}
		}

		public function get_all_appointment_report($ofset=null, $limit=null,$appointment_id=null, $doctor_id=null,$nurse_id=null,$patient_id=null,$date_con=null,$complete_status=null,$next_visit_date=null,$doctor_comment=null){

			$con = '';

			$cur_date = date('Y-m-d');

			if($appointment_id!=null){

				$con .= ' and a.appointment_id='.$appointment_id;
			}
			if($doctor_id!=null){

				$con .= ' and a.doctor_id='.$doctor_id;
			}
			if($nurse_id!=null){

				$con .= ' and a.nurse_id='.$nurse_id;
			}
			if($patient_id!=null){

				$con .= ' and a.patient_id='.$patient_id;
			}

			if($date_con!=null){

				$con .= ' and a.shedule_date='."'".$cur_date."'";
			}

			if($complete_status!=null){

				$con .= ' and a.complete_status='."'".$complete_status."'";
			}

			if($doctor_comment!=null){

				$con .= ' and a.doctor_comment='."'".$doctor_comment."'";
			}

			if($ofset==null AND $limit==null){

				$selectAppointment = "SELECT a.*, b.name as patient_name, b.image as patient_image, c.name as doctor_name, c.image as doctor_image, d.name as nurse_name, d.image as nurse_image FROM appointment a, patient b, doctor c, nurse d  WHERE a.status=1 and b.patient_id=a.patient_id and c.doctor_id=a.doctor_id and d.nurse_id=a.nurse_id and c.doctor_id=d.doctor_id and b.status=1 and b.v_status=1 and c.status=1 and c.v_status=1 and d.status=1 and d.v_status=1 and a.accept_status=1 $con ORDER BY a.appointment_id DESC";
			}
			else{

				$selectAppointment = "SELECT a.*, b.name as patient_name, b.image as patient_image, c.name as doctor_name, c.image as doctor_image, d.name as nurse_name, d.image as nurse_image FROM appointment a, patient b, doctor c, nurse d  WHERE a.status=1 and b.patient_id=a.patient_id and c.doctor_id=a.doctor_id and d.nurse_id=a.nurse_id and c.doctor_id=d.doctor_id and b.status=1 and b.v_status=1 and c.status=1 and c.v_status=1 and d.status=1 and d.v_status=1 and a.accept_status=1 $con ORDER BY a.appointment_id DESC LIMIT $ofset, $limit";
			}

			$allAppointment= $this->database->select($selectAppointment);

			if ($allAppointment>'0') {

				return $allAppointment;
			}

		}
	}