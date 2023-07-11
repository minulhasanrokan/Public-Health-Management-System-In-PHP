<?php

	include_once __DIR__.'/../lib/database.php';
	include_once __DIR__.'/../lib/Session.php';
	include_once __DIR__.'/../helpers/Format.php';
	include_once __DIR__.'/../helpers/Email.php';

	class Admit{

		private $database;
		private $dataFormat;
		private $email;
	 
		public function __construct(){
 
			//Session::checkSession();

			$this->database= new Database();
			$this->dataFormat= new Format();
			$this->email= new Email();
		}

		public function add_admit_details($data){

			$appointment_no = $this->dataFormat->data_validation($data['appointment_no']);
			$appointment_id = $this->dataFormat->data_validation($data['appointment_id']);
			$doctor_id = $this->dataFormat->data_validation($data['doctor_id']);
			$patient_id = $this->dataFormat->data_validation($data['patient_id']);
			$admit_date = $this->dataFormat->data_validation($data['admit_date']);
			$floor_id = $this->dataFormat->data_validation($data['floor_id']);
			$bed_id = $this->dataFormat->data_validation($data['bed_id']);
			$description = $this->dataFormat->data_validation($data['description']);


			if (isset($appointment_id) && $appointment_id!='' && isset($doctor_id) && $doctor_id!='' && isset($patient_id) && $patient_id!='' && isset($bed_id) && $bed_id!='') {

				$insertAdmitQuery ="INSERT INTO admit(appointment_no, appointment_id, doctor_id, patient_id, admit_date, floor_id, bed_id, description) VALUES ('$appointment_no','$appointment_id','$doctor_id','$patient_id','$admit_date','$floor_id','$bed_id','$description')";

				$insertAdmit= $this->database->insert($insertAdmitQuery);

				if ($insertAdmit) {

					$id = $this->database->last_insert_id();

					$updateBed = "UPDATE bed SET book_status=1 WHERE bed_id=$bed_id";

					$updateBed= $this->database->update($updateBed);

					$updateAppointment = "UPDATE appointment SET admit_id=$id WHERE appointment_id=$appointment_id";

					$updateAppointment= $this->database->update($updateAppointment);

					$meassage = "1***New Shedule Created Succesfully";
					return $meassage;
				}
				else{
					$meassage = "0***Something Went Wrong, Please Contact With Administator!!";
					return $meassage;
				}

			}
			else{

				$meassage = '0***Requested Field Must Not Be Empty!!!';

				return $meassage;
			}

		}

		public function get_all_admit($ofset=null, $limit=null,$appointment_id=null, $doctor_id=null,$nurse_id=null,$patient_id=null,$release_satus=0,$start_date=null,$end_date=null,$admit_id=null){


			$con = '';

			$cur_date = date('Y-m-d');

			if($appointment_id!=null){

				$con .= ' and a.appointment_id='.$appointment_id;
			}
			if($doctor_id!=null){

				$con .= ' and a.doctor_id='.$doctor_id;
			}
			if($nurse_id!=null){

				$con .= ' and b.nurse_id='.$nurse_id;
			}
			if($patient_id!=null){

				$con .= ' and a.patient_id='.$patient_id;
			}


			if($admit_id!=null){

				$con .= ' and a.admit_id='."'".$admit_id."'";
			}

			if($start_date!=null){

				$con .= ' and a.admit_date>='."'".$start_date."'";
			}

			if($end_date!=null){

				$con .= ' and a.admit_date<='."'".$end_date."'";
			}

			$con .= ' and a.release_status='.$release_satus;
			

			if($ofset==null AND $limit==null){

				$selectAdmit = "SELECT a.*, b.appointment_number, c.name as patient_name, c.image as patient_image, d.name as doctor_name, d.image as doctor_image, e.name as nurse_name, e.nurse_id, e.image as nurse_image from admit a, appointment b, patient c, doctor d, nurse e WHERE a.status=1 and a.appointment_id=b.appointment_id and b.status=1 and a.patient_id=c.patient_id and c.status=1 and c.v_status=1 and a.doctor_id=d.doctor_id and d.status=1 and d.v_status=1 and e.doctor_id=d.doctor_id and e.status=1 and e.v_status=1 and b.nurse_id=e.nurse_id $con ORDER BY a.admit_id DESC";

			}
			else{

				$selectAdmit = "SELECT a.*, b.appointment_number, c.name as patient_name, c.image as patient_image, d.name as doctor_name, d.image as doctor_image, e.name as nurse_name, e.nurse_id, e.image as nurse_image from admit a, appointment b, patient c, doctor d, nurse e WHERE a.status=1 and a.appointment_id=b.appointment_id and b.status=1 and a.patient_id=c.patient_id and c.status=1 and c.v_status=1 and a.doctor_id=d.doctor_id and d.status=1 and d.v_status=1 and e.doctor_id=d.doctor_id and e.status=1 and e.v_status=1 and b.nurse_id=e.nurse_id $con ORDER BY a.admit_id DESC LIMIT $ofset, $limit";
			}

			$allAdmit= $this->database->select($selectAdmit);

			if ($allAdmit>'0') {

				return $allAdmit;
			}
		}

		public function number_of_admit($appointment_id=null, $doctor_id=null,$nurse_id=null,$patient_id=null,$release_satus=0,$start_date=null,$end_date=null,$admit_id=null){

				$con = '';

			$cur_date = date('Y-m-d');

			if($appointment_id!=null){

				$con .= ' and a.appointment_id='.$appointment_id;
			}
			if($doctor_id!=null){

				$con .= ' and a.doctor_id='.$doctor_id;
			}
			if($nurse_id!=null){

				$con .= ' and b.nurse_id='.$nurse_id;
			}
			if($patient_id!=null){

				$con .= ' and a.patient_id='.$patient_id;
			}


			if($admit_id!=null){

				$con .= ' and a.admit_id='."'".$admit_id."'";
			}

			if($start_date!=null){

				$con .= ' and a.admit_date>='."'".$start_date."'";
			}

			if($end_date!=null){

				$con .= ' and a.admit_date<='."'".$end_date."'";
			}

			$selectAdmit = "SELECT a.*, b.appointment_number, c.name as patient_name, c.image as patient_image, d.name as doctor_name, d.image as doctor_image, e.name as nurse_name, e.nurse_id, e.image as nurse_image from admit a, appointment b, patient c, doctor d, nurse e WHERE a.status=1 and a.appointment_id=b.appointment_id and b.status=1 and a.patient_id=c.patient_id and c.status=1 and c.v_status=1 and a.doctor_id=d.doctor_id and d.status=1 and d.v_status=1 and e.doctor_id=d.doctor_id and e.status=1 and e.v_status=1 and b.nurse_id=e.nurse_id and a.release_status=0 $con ORDER BY a.admit_id DESC";

			$allAdmit= $this->database->select($selectAdmit);

			if ($allAdmit>'0') {
				$totalAdmit = mysqli_num_rows($allAdmit);
				return $totalAdmit;
			}
		}

		public function number_of_admit_month_curr_year($doctor_id=null,$nurse_id=null,$year=null){

			$con = '';

			$cur_year = date('Y');

			if($doctor_id!=''){

				$con .= ' and a.doctor_id='.$doctor_id;
			}
			if($nurse_id!=''){

				$con .= ' and b.nurse_id='.$nurse_id;
			}


			if($year!=''){

				$con .= ' and YEAR(a.admit_date)='."'".$year."'";
			}
			else{

				$con .= ' and YEAR(a.admit_date)='."'".$cur_year."'";
			}

			$selectAdmit = "SELECT count(a.admit_id) as total_admit, MONTH(a.admit_date) as admit_month from admit a, appointment b, patient c, doctor d, nurse e WHERE a.status=1 and a.appointment_id=b.appointment_id and b.status=1 and a.patient_id=c.patient_id and c.status=1 and c.v_status=1 and a.doctor_id=d.doctor_id and d.status=1 and d.v_status=1 and e.doctor_id=d.doctor_id and e.status=1 and e.v_status=1 and b.nurse_id=e.nurse_id $con group by MONTH(a.admit_date) ORDER BY MONTH(a.admit_date) ASC";

			$allAdmit= $this->database->select($selectAdmit);

			if ($allAdmit>'0') {

				return $allAdmit;
			}
		}

		public function release_patiant($id){

			$date = date('d-M-Y');

			$selectAdmit = "SELECT a.* from admit a WHERE  a.admit_id=$id";

			$admit= $this->database->select($selectAdmit);

			$admit = mysqli_fetch_array($admit);


			$updateAdmit = "UPDATE admit SET release_status=1, release_date='$date' WHERE admit_id =$id";

			$updateAdmit= $this->database->update($updateAdmit);

			if ($updateAdmit) {

					$bed_id = $admit['bed_id'];
					$updateBed = "UPDATE bed SET book_status=0 WHERE bed_id=$bed_id";

					$updateBed= $this->database->update($updateBed);

					return $meassage = "1***Patient Realese Succesfully.";
				}
				else{
					
					$errorMassage ="0***Something Wrong!!!";
					return $errorMassage;
				}
		}

	}
