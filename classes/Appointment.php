<?php

	include_once __DIR__.'/../lib/database.php';
	include_once __DIR__.'/../lib/Session.php';
	include_once __DIR__.'/../helpers/Format.php';
	include_once __DIR__.'/../helpers/Email.php';

	class Appointment{

		private $database;
		private $dataFormat;
		private $email;
	 
		public function __construct(){

			//Session::checkSession();

			$this->database= new Database();
			$this->dataFormat= new Format();
			$this->email= new Email();
		}

		public function add_appointment_details($data){

			$patient_id = $this->dataFormat->data_validation($data['patient_id']);
			$doctor_id = $this->dataFormat->data_validation($data['doctor_id']);
			$nurse_id = $this->dataFormat->data_validation($data['nurse_id']);
			$shedule_id = $this->dataFormat->data_validation($data['shedule_id']);
			$shedule_date = $this->dataFormat->data_validation($data['shedule_date']);
			$start_time = $this->dataFormat->data_validation($data['start_time']);
			$end_time = $this->dataFormat->data_validation($data['end_time']);
			$description = $this->dataFormat->data_validation($data['description']);

			if (isset($patient_id) && $patient_id!='' && isset($doctor_id) && $doctor_id!='' && isset($shedule_id) && $shedule_id!='' && isset($description) && $description!='') {

				$next_id= $this->database->return_next_id("appointment_id", "appointment", 1);

				$appointment_number = "AP-".$shedule_date."-".str_pad($next_id, 5, 0, STR_PAD_LEFT);

				$selectShedule = "select a.* from shedule a  WHERE a.status=1  and a.appointment_id is not null and a.shedule_id=$shedule_id";

				$allShedule= $this->database->select($selectShedule);

				if($allShedule){

					$meassage = "0***Something Wddddent Wrong, Please Contact With Administator!!";
					return $meassage;
					die;
				}

				$insertAppointmentQuery ="INSERT INTO appointment(appointment_id,appointment_number,patient_id, doctor_id, nurse_id, shedule_id, shedule_date, start_time, end_time, description, accept_status) VALUES ($next_id,'$appointment_number','$patient_id','$doctor_id','$nurse_id','$shedule_id','$shedule_date','$start_time','$end_time','$description',1)";

				$insertAppointment= $this->database->insert($insertAppointmentQuery);

				if ($insertAppointment) {

					$status = $this->email->send_appointment_email($next_id,1);

					if($status==true){

						$updateShedule = "update shedule set appointment_id=$next_id where shedule_id=$shedule_id";

						$updateShedule= $this->database->update($updateShedule);

						if($updateShedule){

							$meassage = "1***New Appointment Created Succesfully";
							return $meassage;
						}
						else{

							$deleteAppointmentQuery = "delete from appointment where appointment_id=$next_id";
							$deleteAppointment= $this->database->delete($deleteAppointmentQuery);
							
							$meassage = "0***Something Wddddent Wrong, Please Contact With Administator!!";
							return $meassage;
						}

					}
					else{

						$deleteAppointmentQuery = "delete from appointment where appointment_id=$next_id";
						$deleteAppointment= $this->database->delete($deleteAppointmentQuery);
						
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

				$meassage = '0***Patient Name, Doctor Name, Time And Appointment Description Field Must Not Be Empty!!!';

				return $meassage;
			}

		}

		public function get_single_appointment($id){

			$selectAppointment = "SELECT a.* FROM appointment a WHERE a.status=1 and a.appointment_id=$id";

			$allAppointment= $this->database->select($selectAppointment);

			if ($allAppointment>'0') {

				return $allAppointment;
			}
		}

		public function get_all_appointment_request($ofset=null, $limit=null,$appointment_id=null, $doctor_id=null,$nurse_id=null,$patient_id=null,$shedule_id=null,$accept_status=null,$date_con=null,$need_to_admit=null,$next_visit_date=null,$admit_id=null){


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
			if($shedule_id!=null){

				$con .= ' and a.shedule_id='.$shedule_id;
			}

			if($accept_status==1 || $accept_status==0){

				$con .= ' and a.accept_status='."'".$accept_status."'";
			}

			if($admit_id==1 || $admit_id==0){

				$con .= ' and a.admit_id='."'".$admit_id."'";
			}

			if($date_con!=null){

				$con .= ' and a.shedule_date>='."'".$cur_date."'";
			}

			if($need_to_admit!=null){

				$con .= ' and a.need_to_admit='."'".$need_to_admit."'";
			}
			else{

				$con .= ' and a.need_to_admit=0';
			}

			if($ofset==null AND $limit==null){

				$selectAppointment = "SELECT a.*, b.name as patient_name, b.image as patient_image, c.name as doctor_name, c.image as doctor_image, d.name as nurse_name, d.image as nurse_image FROM appointment a, patient b, doctor c, nurse d  WHERE a.status=1 and b.patient_id=a.patient_id and c.doctor_id=a.doctor_id and d.nurse_id=a.nurse_id and c.doctor_id=d.doctor_id and b.status=1 and b.v_status=1 and c.status=1 and c.v_status=1 and d.status=1 and d.v_status=1 $con ORDER BY a.appointment_id DESC";
			}
			else{

				$selectAppointment = "SELECT a.*, b.name as patient_name, b.image as patient_image, c.name as doctor_name, c.image as doctor_image, d.name as nurse_name, d.image as nurse_image FROM appointment a, patient b, doctor c, nurse d  WHERE a.status=1 and b.patient_id=a.patient_id and c.doctor_id=a.doctor_id and d.nurse_id=a.nurse_id and c.doctor_id=d.doctor_id and b.status=1 and b.v_status=1 and c.status=1 and c.v_status=1 and d.status=1 and d.v_status=1 $con ORDER BY a.appointment_id DESC LIMIT $ofset, $limit";
			}

			$allAppointment= $this->database->select($selectAppointment);

			if ($allAppointment>'0') {

				return $allAppointment;
			}
		}

		public function get_all_appointment_details($ofset=null, $limit=null,$appointment_id=null, $doctor_id=null,$nurse_id=null,$patient_id=null,$shedule_id=null,$accept_status=null,$date_con=null,$need_to_admit=null,$next_visit_date=null,$admit_id=null){

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
			if($shedule_id!=null){

				$con .= ' and a.shedule_id='.$shedule_id;
			}

			if($accept_status==1 || $accept_status==0){

				$con .= ' and a.accept_status='."'".$accept_status."'";
			}

			if($admit_id==1 || $admit_id==0){

				$con .= ' and a.admit_id='."'".$admit_id."'";
			}

			if($date_con!=null){

				$con .= ' and a.shedule_date>='."'".$cur_date."'";
			}

			if($need_to_admit!=null){

				$con .= ' and a.need_to_admit='."'".$need_to_admit."'";
			}

			if($ofset==null AND $limit==null){

				$selectAppointment = "SELECT a.*, b.name as patient_name, b.image as patient_image, c.name as doctor_name, c.image as doctor_image, d.name as nurse_name, d.image as nurse_image, b.mobile as patient_mobile, b.email as patient_email, b.birth_date, b.address FROM appointment a, patient b, doctor c, nurse d  WHERE a.status=1 and b.patient_id=a.patient_id and c.doctor_id=a.doctor_id and d.nurse_id=a.nurse_id and c.doctor_id=d.doctor_id and b.status=1 and b.v_status=1 and c.status=1 and c.v_status=1 and d.status=1 and d.v_status=1 $con ORDER BY a.appointment_id DESC";
			}
			else{

				$selectAppointment = "SELECT a.*, b.name as patient_name, b.image as patient_image, c.name as doctor_name, c.image as doctor_image, d.name as nurse_name, d.image as nurse_image, b.mobile as patient_mobile, b.email as patient_email, b.birth_date, b.address FROM appointment a, patient b, doctor c, nurse d  WHERE a.status=1 and b.patient_id=a.patient_id and c.doctor_id=a.doctor_id and d.nurse_id=a.nurse_id and c.doctor_id=d.doctor_id and b.status=1 and b.v_status=1 and c.status=1 and c.v_status=1 and d.status=1 and d.v_status=1 $con ORDER BY a.appointment_id DESC LIMIT $ofset, $limit";
			}

			$allAppointment= $this->database->select($selectAppointment);

			if ($allAppointment>'0') {

				return $allAppointment;
			}
		}

		public function next_visit_date_appointment($ofset=null, $limit=null,$appointment_id=null, $doctor_id=null,$nurse_id=null,$patient_id=null,$shedule_id=null,$accept_status=null,$date_con=null,$next_visit_date=null){


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
			if($shedule_id!=null){

				$con .= ' and a.shedule_id='.$shedule_id;
			}

			if($accept_status==1 || $accept_status==0){

				$con .= ' and a.accept_status='."'".$accept_status."'";
			}

			if($date_con!=null){

				$con .= ' and a.shedule_date='."'".$cur_date."'";
			}

			if($next_visit_date!=null){

				$con .= ' and a.next_visit_date is not null';
			}


			if($ofset==null AND $limit==null){

				$selectAppointment = "SELECT a.*, b.name as patient_name, b.image as patient_image, c.name as doctor_name, c.image as doctor_image, d.name as nurse_name, d.image as nurse_image FROM appointment a, patient b, doctor c, nurse d  WHERE a.status=1 and b.patient_id=a.patient_id and c.doctor_id=a.doctor_id and d.nurse_id=a.nurse_id and c.doctor_id=d.doctor_id and b.status=1 and b.v_status=1 and c.status=1 and c.v_status=1 and d.status=1 and d.v_status=1 and a.complete_status=0 $con ORDER BY a.appointment_id DESC";
			}
			else{

				$selectAppointment = "SELECT a.*, b.name as patient_name, b.image as patient_image, c.name as doctor_name, c.image as doctor_image, d.name as nurse_name, d.image as nurse_image FROM appointment a, patient b, doctor c, nurse d  WHERE a.status=1 and b.patient_id=a.patient_id and c.doctor_id=a.doctor_id and d.nurse_id=a.nurse_id and c.doctor_id=d.doctor_id and b.status=1 and b.v_status=1 and c.status=1 and c.v_status=1 and d.status=1 and d.v_status=1 and a.complete_status=0 $con ORDER BY a.appointment_id DESC LIMIT $ofset, $limit";
			}

			$allAppointment= $this->database->select($selectAppointment);

			if ($allAppointment>'0') {

				return $allAppointment;
			}
		}

		public function get_all_appointment_for_add_report($ofset=null, $limit=null,$appointment_id=null, $doctor_id=null,$nurse_id=null,$patient_id=null,$shedule_id=null,$accept_status=null,$date_con=null,$doctor_comment=null,$report_status=null){

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
			if($shedule_id!=null){

				$con .= ' and a.shedule_id='.$shedule_id;
			}

			if($accept_status==1 || $accept_status==0){

				$con .= ' and a.accept_status='."'".$accept_status."'";
			}

			if($date_con!=null){

				$con .= ' and a.shedule_date='."'".$cur_date."'";
			}

			if($doctor_comment!=null){

				$con .= ' and a.doctor_comment_status='."'".$doctor_comment."'";
			}
			else{

				$con .= ' and a.doctor_comment_status=null';
			}


			if($report_status!=null){

				$con .= ' and a.report_status='."'".$report_status."'";
			}
			else{

				$con .= ' and a.report_status=null';
			}

			if($ofset==null AND $limit==null){

				$selectAppointment = "SELECT a.*, b.name as patient_name, b.image as patient_image, c.name as doctor_name, c.image as doctor_image, d.name as nurse_name, d.image as nurse_image FROM appointment a, patient b, doctor c, nurse d  WHERE a.status=1 and b.patient_id=a.patient_id and c.doctor_id=a.doctor_id and d.nurse_id=a.nurse_id and c.doctor_id=d.doctor_id and b.status=1 and b.v_status=1 and c.status=1 and c.v_status=1 and d.status=1 and d.v_status=1 $con ORDER BY a.appointment_id DESC";
			}
			else{

				$selectAppointment = "SELECT a.*, b.name as patient_name, b.image as patient_image, c.name as doctor_name, c.image as doctor_image, d.name as nurse_name, d.image as nurse_image FROM appointment a, patient b, doctor c, nurse d  WHERE a.status=1 and b.patient_id=a.patient_id and c.doctor_id=a.doctor_id and d.nurse_id=a.nurse_id and c.doctor_id=d.doctor_id and b.status=1 and b.v_status=1 and c.status=1 and c.v_status=1 and d.status=1 and d.v_status=1 $con ORDER BY a.appointment_id DESC LIMIT $ofset, $limit";
			}

			$allAppointment= $this->database->select($selectAppointment);

			if ($allAppointment>'0') {

				return $allAppointment;
			}
		}

		public function accept_appointment($id){

			$updateAppointment = "update appointment set accept_status=1 where appointment_id=$id";

			$updateAppointment= $this->database->update($updateAppointment);

			if($updateAppointment){

				$status = $this->email->send_appointment_email($id,1);

				$meassage = "1***Appointment Accepted Succesfully";
				return $meassage;
			}
			else{

				$meassage = "0***Something Went Wrong, Please Contact With Administator!!";
				return $meassage;
			}
		}

		public function reject_appointment($id){

			$updateAppointment = "update appointment set accept_status=2 where appointment_id=$id";

			$updateAppointment= $this->database->update($updateAppointment);

			if($updateAppointment){

				$status = $this->email->send_appointment_email($id,2);

				$meassage = "1***Appointment Rejected Succesfully";
				return $meassage;
			}
			else{

				$meassage = "0***Something Went Wrong, Please Contact With Administator!!";
				return $meassage;
			}
		}

		public function add_doctor_comment($data){

			$doctor_comment = $this->dataFormat->data_validation($data['doctor_comment']);
			$next_visit_date = $this->dataFormat->data_validation($data['next_visit_date']);
			$need_to_admit = $this->dataFormat->data_validation($data['need_to_admit']);
			$appointment_id = $this->dataFormat->data_validation($data['appointment_id']);


			if (isset($doctor_comment) && $doctor_comment!='' && isset($need_to_admit) && $need_to_admit!='' && isset($appointment_id) && $appointment_id!='') {

				if($next_visit_date=='')
				{
					$updateAppointment = "UPDATE appointment SET doctor_comment='$doctor_comment', next_visit_date='$next_visit_date', need_to_admit='$need_to_admit', doctor_comment_status=1, complete_status=1 WHERE appointment_id=$appointment_id";
				}
				else
				{
					$updateAppointment = "UPDATE appointment SET doctor_comment='$doctor_comment', next_visit_date='$next_visit_date', need_to_admit='$need_to_admit', doctor_comment_status=1 WHERE appointment_id=$appointment_id";
				}
				

				$updateAppointment= $this->database->update($updateAppointment);

				if ($updateAppointment) {

					Session::initSession();
					Session::setSession("appointment_id", $appointment_id);

					return $meassage = "1***Appointment Details Updated Succesfully.";
				}
				else{
					$meassage = "0***Something Went Wrong, Please Contact With Administator!!";
					return $meassage;
				}

			}
			else{

				$meassage = '0***Something Wddddent Wrong, Please Contact With Administator!!';

				return $meassage;
			}

		}

		public function get_all_appointment_for_bill($ofset=null, $limit=null,$appointment_id=null, $doctor_id=null,$nurse_id=null,$patient_id=null,$shedule_id=null,$bill_status=null){


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
			if($shedule_id!=null){

				$con .= ' and a.shedule_id='.$shedule_id;
			}

			if($bill_status!=null){

				$con .= ' and a.bill_status='.$bill_status;
			}

			if($ofset==null AND $limit==null){

				$selectAppointment = "SELECT a.*, b.name as patient_name, b.image as patient_image, c.name as doctor_name, c.image as doctor_image, d.name as nurse_name, d.image as nurse_image FROM appointment a, patient b, doctor c, nurse d  WHERE a.status=1 and b.patient_id=a.patient_id and c.doctor_id=a.doctor_id and d.nurse_id=a.nurse_id and c.doctor_id=d.doctor_id and b.status=1 and b.v_status=1 and c.status=1 and c.v_status=1 and d.status=1 and a.doctor_comment_status=1 and a.complete_status=1 and d.v_status=1 and a.accept_status=1 $con ORDER BY a.appointment_id DESC";
			}
			else{

				$selectAppointment = "SELECT a.*, b.name as patient_name, b.image as patient_image, c.name as doctor_name, c.image as doctor_image, d.name as nurse_name, d.image as nurse_image FROM appointment a, patient b, doctor c, nurse d  WHERE a.status=1 and b.patient_id=a.patient_id and c.doctor_id=a.doctor_id and d.nurse_id=a.nurse_id and c.doctor_id=d.doctor_id and b.status=1 and b.v_status=1 and c.status=1 and c.v_status=1 and d.status=1 and a.doctor_comment_status=1 and a.complete_status=1 and d.v_status=1 and a.accept_status=1 $con ORDER BY a.appointment_id DESC LIMIT $ofset, $limit";
			}

			$allAppointment= $this->database->select($selectAppointment);

			if ($allAppointment>'0') {

				return $allAppointment;
			}
		}

	}