<?php

class Db{

	private $conn;
	private $dataBaseExist = false;

    public function __construct($host,$user,$pass){
    	$connection = $this->dbConeention($host,$user,$pass);
    	if($connection) $this->createDatabase();
	}

	public function dbConeention($host, $user, $pass, $db = null){
		if($db){
			$this->conn=new mysqli($host,$user,$pass, $db);
		}else{
			$this->conn=new mysqli($host,$user,$pass);
		}

		if($this->conn->connect_errno){
			return false;
		}
		return true;
	}

	private function createDatabase(){

		$sql = "CREATE DATABASE buyer_form";
		if ($this->conn->query($sql) === TRUE) {
		  $this->dataBaseExist = true;
		}else{
		  $this->dataBaseExist = $this->conn->error;
		}

		if($this->dataBaseExist){
			$this->conn->close();
			$connTable = $this->dbConeention("localhost","root","",'buyer_form');
			if($connTable) $this->createTable();
		}

	}

	private function createTable(){
		$sql ="CREATE TABLE IF NOT EXISTS buyer_info (
	        id bigint(20) NOT NULL AUTO_INCREMENT,
	        amount int(10) DEFAULT NULL,
	        buyer varchar(255) DEFAULT NULL,
	        receipt_id varchar(20) DEFAULT NULL,
	        items varchar(255) DEFAULT NULL,
	        buyer_email varchar(50) DEFAULT NULL,
	        buyer_ip varchar(20) DEFAULT NULL,
	        note text DEFAULT NULL,
	        city varchar(20) DEFAULT NULL,
	        phone varchar(20) DEFAULT NULL,
	        hash_key varchar(255) DEFAULT NULL,
	        entry_at date DEFAULT NULL,
	        entry_by int(10) DEFAULT NULL,
	        PRIMARY KEY  (id)
        )";

       $this->conn->query($sql);
	}

	public function Insert($table,$cols){
		$sql="INSERT INTO $table SET $cols";
		$result=$this->conn->query($sql);
		if($this->conn->affected_rows>0){
			return true;
		}
		return false;
	}

	public function getAll($table,$cols){
		$sql="SELECT $cols FROM $table";
		$result=$this->conn->query($sql);
		if($result->num_rows>0){
			return $result->fetch_all(MYSQLI_ASSOC);
		}
		return false;

	}

	public function getByDate($table,$cols,$condition){
		$sql="SELECT $cols FROM $table WHERE $condition";
		$result=$this->conn->query($sql);
		if($result->num_rows>0){
			return $result->fetch_all(MYSQLI_ASSOC);
		}
		return false;

	}

}

$db = new Db("localhost","root","");

