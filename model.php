<?php
session_start();
	class User{
		//private $connection;
		private $username;
		private $password;
		
		public function getUsername(){
			return $this->username;
		}

		public function setUsername($username){
			$this->username = $username;
		}
		
		public function getPassword(){
			return $this->password;
		}

		public function setPassword($password){
			$this->password = $password;
		}
		/**
		 * connection with database PDO
		 */
		function connect(){
			try{
				$server = "localhost";
				$user = "root";
				$pass = "";
				$database = "usersdb";
				$conn = new PDO("mysql:host=$server;dbname=$database", $user, $pass);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch(PDOException $e)
			{
				echo "Connetione have problems, connection fail: " . $e->getMessage();
				return false;
			}
			return $conn;
		}
		/**
		 * login user Prepare statments
		 */
		public function login(){
			$conn = $this->connect();
			if($conn){
				$query = "SELECT * FROM user WHERE username=:username AND password=:password";
				$stm = $conn->prepare($query);
				$stm->bindParam(":username",$this->username);
				$stm->bindParam(":password",$this->password);
				$stm->execute();
				if($stm->fetchAll()){
					$_SESSION['username'] = $this->username;
					$_SESSION['password'] = $this->password;
					header("Location:home.php");
				}
				else{
					echo "Wrong UserName/Password or this user doesn't exist. Try to Register your account";
				}
			}
		}
		/**
		 * register new user Prepare statmens for sql injection
		 */
		public function register(){
			$conn = $this->connect();
			if($this->checkUsername()){
				$time = date("Y-m-d H:i:s");
				$insert_user = "INSERT INTO user (username, password, created_date) VALUES(:username,:password,:time)";
				$stm = $conn->prepare($insert_user);
				$stm->bindParam(":username",$this->username);
				$stm->bindParam(":password",$this->password);
				$stm->bindParam(":time",$time);
				if($stm->execute()){
					echo "You have successfully registrated your account. You can Login now";
				}
				else{
					echo "Something went wrong. Please try again.";
				}
			}
			else{
				echo "This username is allready in use. You must chose another one.";
			}
		}
		/*
		 * check if user name is allready in use
		 * return false if username allready exist
		 */
		public function checkUsername(){
			$conn = $this->connect();
			if($conn){
				
				$query = "SELECT * FROM user WHERE username=:username";
				$stm = $conn->prepare($query);
				$stm->bindParam(":username",$this->username);
				$stm->execute();
				if(!empty($stm->FetchAll())){
					return false;
				}else{
					return true;
				}
			}
		}
		/** 
		 * return all users
		 */
		public function returnAllUsers(){
			$conn = $this->connect();
			$query = "SELECT * FROM user ORDER BY created_date DESC";
			$stm = $conn->query($query);
			if (!$stm->execute()) {
				echo "Query cant be executed : ";
				exit;
			}
			$result = $stm->fetchAll();
			if ($result==0) {
				echo "No results found";
				exit;
			}
				return $result;
			}
		}		 
?>