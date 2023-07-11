<?php
	include_once __DIR__.'/../config/config.php';

	Class Database{
		// database details...
		public $host = HOST;
		public $user = USER;
		public $pass = PASSWORD;
		public $database = DATABASE;

		public $link;
		public $error;

		public function __construct(){
			
			$this->dbConnect();
		}

		public function dbConnect(){
			
			$this->link = mysqli_connect($this->host, $this->user, $this->pass, $this->database);
			
			if (!$this->link) {
				
				$this->error = "Database Connecton Faild";
				return false;
			}
		}

		// select query
		public function select($query){

			$result  = mysqli_query($this->link,$query) or die($this->link->error.__LINE__);
			
			if (mysqli_num_rows($result)) {
				
				return $result;
			}
			else{
				
				return false;
			}
		}

		// insert query
		public function insert($query){

			$result  = mysqli_query($this->link,$query) or die($this->link->error.__LINE__);
			
			if ($result) {
				return $result;
			}
			else{
				
				return false;
			}
		}

		// update query
		public function update($query){

			$result  = mysqli_query($this->link,$query) or die($this->link->error.__LINE__);
			
			if ($result) {
				
				return $result;
			}
			else{
				
				return false;
			}
		}

		// delete query
		public function delete($query){

			$result  = mysqli_query($this->link,$query) or die($this->link->error.__LINE__);
			
			if ($result) {
				
				return $result;
			}
			else{
				
				return false;
			}
		}

		public function last_insert_id(){

			return $last_id = $this->link->insert_id;
		}

		public function roll_back_databse(){

			return $rollBack = mysqli_rollback($this->link);

			mysqli_close($this->link);

		}

		public function return_next_id($field_name, $table_name, $max_row = 1) // Checked   3
		{
			$increment = 1;
			$queryText = "select max(" . $field_name . ") as " . $field_name . "  from " . $table_name . " ";
			$nameArray = $this->select($queryText);
			foreach ($nameArray as $result) {
				return ($result[$field_name] + $increment);
			}
		}
	}