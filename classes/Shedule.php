<?php

	include_once __DIR__.'/../lib/database.php';
	include_once __DIR__.'/../lib/Session.php';
	include_once __DIR__.'/../helpers/Format.php';
	include_once __DIR__.'/../helpers/Email.php';

	class Shedule{

		private $database;
		private $dataFormat;
		private $email;
	 
		public function __construct(){

			//Session::checkSession();

			$this->database= new Database();
			$this->dataFormat= new Format();
			$this->email= new Email();
		}

		public function add_shedule_details($data){

			$nurse_id = $this->dataFormat->data_validation($data['nurse_id']);
			$doctor_id = $this->dataFormat->data_validation($data['doctor_id']);
			$shedule_date = $this->dataFormat->data_validation($data['shedule_date']);
			$start_time = $this->dataFormat->data_validation($data['start_time']);
			$end_time = $this->dataFormat->data_validation($data['end_time']);


			if (isset($doctor_id) && $doctor_id!='' && isset($shedule_date) && $shedule_date!='' && isset($start_time) && $start_time!='' && isset($end_time) && $end_time!='') {

				$getSheduleQuery = "SELECT shedule_id FROM shedule WHERE shedule_date='$shedule_date' and ((start_time<='$start_time' and end_time>='$start_time') or (start_time<='$end_time' and end_time>='$end_time')) and status=1 and doctor_id=$doctor_id";

				$getSheduleQuery= $this->database->select($getSheduleQuery);

				if ($getSheduleQuery>'0') {

					return $meassage = "0***Multiple Shedule Not Allowed At Same Time";
				}
				else{

					$insertSheduleQuery ="INSERT INTO shedule(nurse_id, doctor_id, shedule_date, start_time, end_time) VALUES ('$nurse_id','$doctor_id','$shedule_date','$start_time','$end_time')";

					$insertShedule= $this->database->insert($insertSheduleQuery);

					if ($insertShedule) {

						$meassage = "1***New Shedule Created Succesfully";
						return $meassage;
					}
					else{
						$meassage = "0***Something Went Wrong, Please Contact With Administator!!";
						return $meassage;
					}
				}

			}
			else{

				$meassage = '0***Doctor Name, Shedule Date And Time Field Must Not Be Empty!!!';

				return $meassage;
			}

		}

		public function add_shedule_details_new($data){

			$nurse_id = $this->dataFormat->data_validation($data['nurse_id']);
			$doctor_id = $this->dataFormat->data_validation($data['doctor_id']);
			$shedule_start_date = $this->dataFormat->data_validation($data['shedule_start_date']);
			$shedule_end_date = $this->dataFormat->data_validation($data['shedule_end_date']);
			$shedule_start_time = $this->dataFormat->data_validation($data['shedule_start_time']);
			$shedule_end_time = $this->dataFormat->data_validation($data['shedule_end_time']);
			$total_shedule = $this->dataFormat->data_validation($data['total_shedule']);

			$cur_date = date('Y-m-d');

			$shedule_start_date=date('Y-m-d',strtotime($shedule_start_date));
			$shedule_end_date=date('Y-m-d',strtotime($shedule_end_date));

			$datediff = strtotime($shedule_end_date) - strtotime($shedule_start_date);

			$total_day = round($datediff / (60 * 60 * 24))+1;

			$total_minute = ((strtotime($shedule_end_time)-strtotime($shedule_start_time))/60);

			if($cur_date>=$shedule_start_date){

				$meassage = "0***Shedule Date Can Not Be Less Than Or Equal Current Date";
			}

			if($shedule_end_date<$shedule_start_date){
				
				$meassage = "0***Shede End Date Can Not Be Less Than Shedule Start Date";
			}

			if(strtotime($shedule_end_date) <= strtotime($shedule_start_date)){
				
				$meassage = "0***Shede Start Time Can Not Be Less Than Shedule Start End Time";
			}

			if (isset($doctor_id) && $doctor_id!='' && isset($shedule_start_date) && $shedule_start_date!='' && isset($shedule_end_date) && $shedule_end_date!='' && isset($total_shedule) && $total_shedule!='' && isset($shedule_start_time) && $shedule_start_time!='' && isset($shedule_end_time) && $shedule_end_time!='') {

				$getSheduleQuery = "SELECT shedule_id FROM shedule WHERE (shedule_date between '$shedule_start_date' and '$shedule_end_date') and ((start_time<='$shedule_start_time' and end_time>='$shedule_start_time') or (start_time<='$shedule_end_time' and end_time>='$shedule_start_time')) and status=1 and doctor_id=$doctor_id";


				$getSheduleQuery= $this->database->select($getSheduleQuery);

				if ($getSheduleQuery>'0') {

					return $meassage = "0***Multiple Shedule Not Allowed At Same Time";
				}
				else{

					$total_shedule_minute = number_format($total_minute/$total_shedule);

					for($i=1;$i<=$total_day;$i++){

						for($j=1;$j<=$total_shedule;$j++){

							$shedule_date = date('Y-m-d', strtotime($shedule_start_date . ' +'.($i-1).' day'));

							if($j>1){

								$start_time = $end_time;

								$end_time = date('H:i:s', strtotime($end_time. ' +'.$total_shedule_minute.' minutes'));
							}
							else{
								$start_time = $shedule_start_time;

								$end_time = date('H:i:s', strtotime($shedule_start_time. ' +'.$total_shedule_minute.' minutes'));
							}

							$insertSheduleQuery ="INSERT INTO shedule(nurse_id, doctor_id, shedule_date, start_time, end_time) VALUES ('$nurse_id','$doctor_id','$shedule_date','$start_time','$end_time')";

							$insertShedule= $this->database->insert($insertSheduleQuery);
						}
					}

					if ($insertShedule) {

						$meassage = "1***New Shedule Created Succesfully";
						return $meassage;
					}
					else{
						$meassage = "0***Something Went Wrong, Please Contact With Administator!!";
						return $meassage;
					}
				}

			}
			else{

				$meassage = '0***Doctor Name, Shedule Date And Time Field Must Not Be Empty!!!';

				return $meassage;
			}

		}

		public function get_all_shedule($ofset=null, $limit=null,$doctor_id=null,$nurse_id=null,$appointment_id=null,$appointment_status=null){

			$con = '';

			if($nurse_id!=null)
			{
				$con .=" and a.nurse_id=$nurse_id";
			}

			if($doctor_id!=null)
			{
				$con .=" and a.doctor_id=$doctor_id";
			}

			if($appointment_status==0)
			{
				$con .=" and a.appointment_id is null";
			}
			else if($appointment_status==1){

				$con .=" and a.appointment_id is not null";

				if($appointment_id!=null){

					$con .=" and a.appointment_id=$appointment_id";
				}
			}


			$date = date("Y-m-d");

			$time = date('G:i:s');

			if($ofset==null AND $limit==null){

				$selectShedule = "SELECT a.*, b.doctor_id, b.name as doctor_name, b.image FROM shedule a, doctor b  WHERE b.status=1 and b.published_status=1 and b.doctor_id=a.doctor_id and a.status=1 and a.shedule_date>='$date' $con ORDER BY a.doctor_id DESC";
			}
			else{

				$selectShedule = "SELECT a.*, b.doctor_id, b.name as doctor_name, b.image FROM shedule a, doctor b  WHERE b.status=1 and b.published_status=1 and b.doctor_id=a.doctor_id and a.status=1 and a.shedule_date>='$date' $con ORDER BY a.doctor_id DESC LIMIT $ofset, $limit";
			}
			
			$allShedule= $this->database->select($selectShedule);

			if ($allShedule>'0') {

				return $allShedule;
			}

		}

		public function number_of_shedule($ofset=null, $limit=null,$doctor_id=null,$nurse_id=null,$appointment_id=null,$appointment_status=null){

			$con = '';

			if($nurse_id!=null)
			{
				$con .=" and a.nurse_id=$nurse_id";
			}

			if($doctor_id!=null)
			{
				$con .=" and a.doctor_id=$doctor_id";
			}

			if($appointment_status==0)
			{
				$con .=" and a.appointment_id is null";
			}
			else if($appointment_status==1){

				$con .=" and a.appointment_id is not null";

				if($appointment_id!=null){

					$con .=" and a.appointment_id=$appointment_id";
				}
			}


			$date = date("Y-m-d");

			$time = date('G:i:s');

			if($ofset==null AND $limit==null){

				$selectShedule = "SELECT a.*, b.doctor_id, b.name as doctor_name, b.image FROM shedule a, doctor b  WHERE b.status=1 and b.published_status=1 and b.doctor_id=a.doctor_id and a.status=1 and a.shedule_date>='$date' $con ORDER BY a.doctor_id DESC";
			}
			else{

				$selectShedule = "SELECT a.*, b.doctor_id, b.name as doctor_name, b.image FROM shedule a, doctor b  WHERE b.status=1 and b.published_status=1 and b.doctor_id=a.doctor_id and a.status=1 and a.shedule_date>='$date' $con ORDER BY a.doctor_id DESC LIMIT $ofset, $limit";
			}
			
			$allShedule= $this->database->select($selectShedule);

			if ($allShedule>'0') {
				$totalShedule = mysqli_num_rows($allShedule);
				return $totalShedule;
			}
		}

		public function get_single_shedule($shedule_id,$nurse_id=null,$doctor_id=null,$appointment_id){

			$con = '';

			if($shedule_id!=null)
			{
				$con .=" and a.shedule_id=$shedule_id";
			}

			if($nurse_id!=null)
			{
				$con .=" and a.nurse_id=$nurse_id";
			}

			if($doctor_id!=null)
			{
				$con .=" and a.doctor_id=$doctor_id";
			}

			$date = date("Y-m-d");

			$time = date('G:i:s');

			$selectShedule = "SELECT a.*, b.doctor_id, b.name as doctor_name, b.image FROM shedule a, doctor b  WHERE b.status=1 and b.published_status=1 and b.doctor_id=a.doctor_id and a.status=1 and a.shedule_date>='$date' $con ORDER BY a.doctor_id DESC";

			$allShedule= $this->database->select($selectShedule);

			if ($allShedule>'0') {

				return $allShedule;
			}

		}

		public function update_shedule_details($data){


			$nurse_id = $this->dataFormat->data_validation($data['nurse_id']);
			$doctor_id = $this->dataFormat->data_validation($data['doctor_id']);
			$shedule_date = $this->dataFormat->data_validation($data['shedule_date']);
			$start_time = $this->dataFormat->data_validation($data['start_time']);
			$end_time = $this->dataFormat->data_validation($data['end_time']);
			$shedule_id = $this->dataFormat->data_validation($data['shedule_id']);

			if (isset($shedule_id) && $shedule_id!='' && isset($doctor_id) && $doctor_id!='' && isset($shedule_date) && $shedule_date!='' && isset($start_time) && $start_time!='' && isset($end_time) && $end_time!='') {

				$getSheduleQuery = "SELECT shedule_id FROM shedule WHERE shedule_date='$shedule_date' and ((start_time<='$start_time' and end_time>='$start_time') or (start_time<='$end_time' and end_time>='$end_time')) and status=1 and doctor_id=$doctor_id and shedule_id!=$shedule_id";

				$getSheduleQuery= $this->database->select($getSheduleQuery);

				if ($getSheduleQuery>'0') {

					return $meassage = "0***Multiple Shedule Not Allowed At Same Time";
				}
				else{

					$updateShedule = "UPDATE shedule SET doctor_id='$doctor_id', nurse_id='$nurse_id', shedule_date='$shedule_date', start_time='$start_time', end_time='$end_time' WHERE shedule_id=$shedule_id";

					$updateShedule= $this->database->update($updateShedule);

					if ($updateShedule) {

						Session::initSession();
						Session::setSession("shedule_id", $shedule_id);

						return $meassage = "1***Shedule Details Updated Succesfully.";
					}
					else{
						
						$errorMassage ="0***Something Wrong!!!";
						return $errorMassage;
					}
				}

			}
			else{
				
				$meassage = '0***Doctor Name, Shedule Date And Time Field Must Not Be Empty!!!';
				return $meassage;
			}

		}

		public function delete_shedule($id){

			$shedule_data = $this->get_single_shedule($id);

			$shedule_data = mysqli_fetch_array($shedule_data);

			if($shedule_data['status']==1){

				$status = 0;
			}
			else{
				$status = 1;
			}

			$updateShedule = "UPDATE shedule SET status=0 WHERE shedule_id=$id";

			$updateShedule= $this->database->update($updateShedule);

			if ($updateShedule) {

				return $meassage = "1***Shedule Deleted Succesfully.";
			}
			else{
				
				$errorMassage ="0***Something Wrong!!!";
				return $errorMassage;
			}
		}
	}
