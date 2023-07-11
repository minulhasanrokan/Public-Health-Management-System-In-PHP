<?php

	include_once __DIR__.'/../lib/database.php';
	include_once __DIR__.'/../lib/Session.php';
	include_once __DIR__.'/../helpers/Format.php';
	include_once __DIR__.'/../helpers/Email.php';

	class Notice{

		private $database;
		private $dataFormat;
		private $email;
	 
		public function __construct(){

			//Session::checkSession();

			$this->database= new Database();
			$this->dataFormat= new Format();
			$this->email= new Email();
		}

		public function add_notice_details($data,$file){

			$user_type = $this->dataFormat->data_validation($data['user_type']);
			$title = $this->dataFormat->data_validation($data['title']);
			$description = $this->dataFormat->data_validation($data['description']);
			$notice_date = $this->dataFormat->data_validation($data['notice_date']);
			$published_date = $this->dataFormat->data_validation($data['published_date']);


			$file = $file;
			$fileName = '';
			$file_ext = '';

			if($file['name']!=null){

				$file_name = $file['name'];
			    $file_size =$file['size'];
		        $file_tmp =$file['tmp_name'];
			    $file_type=$file['type'];

			    $file_ext = pathinfo($file_name,PATHINFO_EXTENSION);

			    $fileName =$name.substr(md5(time()),0,10).'.'.$file_ext;
			    $fileName = str_replace(' ','-',$fileName);
			    $filePath = __DIR__.'../../uploads/notice/'.$fileName;

			}

			if (isset($user_type) && $user_type!='' && isset($title) && $title!='' && isset($notice_date) && $notice_date!='' && isset($published_date) && $published_date!='') {

				$date = date('Y-m-d');

				if($date>$notice_date){

					$meassage = '0***Notice Date Can Not Be Less Than Current Date!!!';
					return $meassage;
				}
				else if($date>$published_date){

					$meassage = '0***Notice Published Date Can Not Be Less Than Current Date!!!';
					return $meassage;
				}
				else{

					$insertNoticeQuery ="INSERT INTO notice(user_type, title, description, notice_date, published_date, file_url,file_type) VALUES ('$user_type','$title','$description','$notice_date','$published_date','$fileName','$file_ext')";

					$insertNotice= $this->database->insert($insertNoticeQuery);

					if ($insertNotice) {

						if(isset($filePath)){
							
							$fileUpload = move_uploaded_file($file_tmp, $filePath);
						}

						$meassage = "1***New Notice Created Succesfully";
						return $meassage;
					}
					else{
						$meassage = "0***Something Went Wrong, Please Contact With Administator!!";
						return $meassage;
					}
				}


			}
			else{

				$meassage = '0***Notice For, Title, Date and Published Date Field Must Not Be Empty!!!';

				return $meassage;
			}
		}

		public function get_all_notice($ofset=null, $limit=null,$notice_for=null,$user_id=null,$notice_date=null,$published_date=null){

			$where_con = '';

			if($notice_for!=null){

				$where_con .= " and a.user_type in($notice_for,0)";
			}

			if($user_id!=null){

				$where_con .= " and a.user_id=$user_id";
			}

			if($notice_date!=null){

				$where_con .= " and a.notice_date=$notice_date";
			}

			if($published_date!=null){

				$where_con .= " and a.published_date=$published_date";
			}

			$date = date('Y-m-d');

			if($ofset==null AND $limit==null){

				$selectNotice = "SELECT a.* FROM notice a  WHERE a.status=1 and a.published_status=1 and a.notice_date>='$date' and a.published_date<='$date' $where_con ORDER BY a.notice_id ASC";
			}
			else{

				$selectNotice = "SELECT a.* FROM notice a  WHERE a.status=1 and a.published_status=1 and a.notice_date>='$date' and a.published_date<='$date' $where_con ORDER BY a.notice_id ASC LIMIT $ofset, $limit";
			}

			$allNotice= $this->database->select($selectNotice);

			if ($allNotice>'0') {

				return $allNotice;
			}

		}

		public function number_of_notice($notice_for=null,$user_id=null,$notice_date=null,$published_date=null){

			$where_con = '';

			if($notice_for!=null){

				$where_con .= " and a.user_type in($notice_for,0)";
			}

			if($user_id!=null){

				$where_con .= " and a.user_id=$user_id";
			}

			if($notice_date!=null){

				$where_con .= " and a.notice_date=$notice_date";
			}

			if($published_date!=null){

				$where_con .= " and a.published_date=$published_date";
			}

			$date = date('Y-m-d');

			$selectNotice = "SELECT a.* FROM notice a  WHERE a.status=1 and a.published_status=1 and a.notice_date>='$date' and a.published_date<='$date' $where_con";

			$allNotice= $this->database->select($selectNotice);

			if ($allNotice>'0') {

				$totalNotice = mysqli_num_rows($allNotice);
				return $totalNotice;
			}

		}

		public function get_single_notice($notice_id=null){

			$where_con = '';

			if($notice_id!=null){

				$where_con .= " and a.notice_id=$notice_id";
			}

			$date = date('Y-m-d');

			$selectNotice = "SELECT a.* FROM notice a  WHERE a.status=1 and a.published_status=1 $where_con ORDER BY a.notice_id ASC";

			$allNotice= $this->database->select($selectNotice);

			if ($allNotice>'0') {

				return $allNotice;
			}

		}
	}