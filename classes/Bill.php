<?php

	include_once __DIR__.'/../lib/database.php';
	include_once __DIR__.'/../lib/Session.php';
	include_once __DIR__.'/../helpers/Format.php';
	include_once __DIR__.'/../helpers/Email.php';

	class Bill{ 

		private $database;
		private $dataFormat;
		private $email;
	 
		public function __construct(){

			//Session::checkSession();

			$this->database= new Database();
			$this->dataFormat= new Format();
			$this->email= new Email();
		}

		public function add_add_bill_details($data){

			$particular_no = $this->dataFormat->data_validation($data['particular_no']);
			$particular_id = $this->dataFormat->data_validation($data['particular_id']);
			$bill_type = $this->dataFormat->data_validation($data['bill_type']);
			$fee = $this->dataFormat->data_validation($data['fee']);
			$pay_type = $this->dataFormat->data_validation($data['pay_type']);

			if (isset($particular_no) && $particular_no!='' && isset($particular_id) && $particular_id!='' && isset($bill_type) && $bill_type!='' && isset($fee) && $fee!='' && isset($pay_type) && $pay_type!='') {

				$insertBillQuery ="INSERT INTO bill(particular_no, particular_id, bill_type, fee, pay_type) VALUES ('$particular_no','$particular_id','$bill_type','$fee','$pay_type')";

				$insertBill= $this->database->insert($insertBillQuery);

				if ($insertBill) {

					if($bill_type=='doctor_appointment_bill'){

						$updateParticular = "update appointment set bill_status=1 where appointment_id=$particular_id";

					}

					$updateParticular= $this->database->update($updateParticular);

					$meassage = "1***Bill Created Succesfully";
					return $meassage;
				}
				else{
					$meassage = "0***Something Went Wrong, Please Contact With Administator!!";
					return $meassage;
				}
				
			}
			else{

				$meassage = "0***Something Went Wrong, Please Contact With Administator!!";
				return $meassage;
			}
		}

		public function number_of_bill_month_curr_year($year=null){

			$con = '';

			$cur_year = date('Y');

			if($year!=''){

				$con .= ' and YEAR(a.create_time)='."'".$year."'";
			}
			else{

				$con .= ' and YEAR(a.create_time)='."'".$cur_year."'";
			}

			$selectData = "SELECT sum(a.fee) as total_bill, MONTH(a.create_time) as month, a.bill_type from bill a WHERE a.status=1 $con group by MONTH(a.create_time), a.bill_type ORDER BY MONTH(a.create_time) ASC";

			$allData= $this->database->select($selectData);

			if ($allData>'0') {

				return $allData;
			}
		}

		public function get_all_bill($ofset=null, $limit=null, $year=null){

			$con = '';

			$cur_year = date('Y');

			if($year!=''){

				$con .= ' and YEAR(a.create_time)='."'".$year."'";
			}
			else{

				$con .= ' and YEAR(a.create_time)='."'".$cur_year."'";
			}

			if($ofset==null AND $limit==null){
				
				$selectData = "SELECT a.* from bill a WHERE a.status=1 $con group by MONTH(a.create_time), a.bill_type ORDER BY MONTH(a.create_time) ASC";
			}
			else{

				$selectData = "SELECT a.* from bill a WHERE a.status=1 $con group by MONTH(a.create_time), a.bill_type ORDER BY MONTH(a.create_time) DESC LIMIT $ofset, $limit";
			}

			$allData= $this->database->select($selectData);

			if ($allData>'0') {

				return $allData;
			}
		}
	}