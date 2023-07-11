<?php
	
	if(isset($_POST["action"]) && $_POST["action"] == "get_bed_by_floor"){

		require_once __DIR__."/../../classes/Floor.php";

		$floor = new Floor();

		$floor_id = $_POST["floor_id"];

		if($floor_id==''){
			$floor_id = 0;
		}

		$data_arr = $floor ->get_all_bed($ofset=null, $limit=null,$bed_id=null,$data=$floor_id,$book_status='0');

		$result = '';
		if($data_arr){

			$result .='<select name="bed_id" id="bed_id" class="form-control" required><option value="">Select Bed Number</option>';

			foreach($data_arr as $data){

				$result .='<option value="'.$data['bed_id'].'">'.$data['name'].'</option>';

			}

			$result .='</select>';
		}
		else{

			$result .='<select name="bed_id" id="bed_id" class="form-control" required><option value="">Select Bed Number</option></select>';
		}

		echo $result;
	}

	if(isset($_POST["action"]) && $_POST["action"] == "store_admit"){

		require_once __DIR__."/../../classes/Admit.php";

		$admit = new Admit();

		$message = $admit ->add_admit_details($_POST);

		$message_data = explode("***",$message);

		Session::initSession();

		if($message_data[0]==1){

			Session::setSession("message", $message_data[1]);
			Session::setSession("alert-type", "success");
			header("Location: all");


		}
		else{

			Session::setSession("message", $message_data[1]);
			Session::setSession("alert-type", "error");
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}