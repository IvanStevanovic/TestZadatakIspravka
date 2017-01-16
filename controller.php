<?php
include('model.php'); 
class Controller{
	public $model;
	
	public function __construct(){
		$this->model = new User();
	}
	
	//this is controller function for index.php-view
	//check if has posted login or posted register
	//login or register with regex control.
	public function index(){
		if(isset($_POST["login"])){
			$username = $_POST["username"];
			$password = $_POST["password"];
			if(!empty($username) && !empty($password)){
				//check if regex match
				if(preg_match('/^[A-Za-z][A-Za-z0-9]{2,14}$/', $username) && preg_match('/^[A-Za-z][A-Za-z0-9]{2,14}$/', $password)){;
					$user = $this->model;
					$user->setUsername($username);
					$user->setPassword($password);
					$user->login();
				}
				else{
					echo"<span class='spec'>USERNAME and PASSWORD </span><ul class='kec'><li>Must start with letter</li><li>3-15 characters</li><li>Letters and numbers only</li></ul>";
				}
;
			}	
			else{
				echo "Pleas do not leave empty fields!";
			}
		}
		if(isset($_POST["register"])){
			$username = $_POST["username"];
			$password = $_POST["password"];
			if(!empty($username) && !empty($password)){
				if(preg_match('/^[A-Za-z][A-Za-z0-9]{2,14}$/', $username) && preg_match('/^[A-Za-z][A-Za-z0-9]{2,14}$/', $password)){
				$user = $this->model;
				$user->setUsername($username);
				$user->setPassword($password);
				$user->register();
				}
				else{
					echo"<span>USERNAME and PASSWORD </span><ul><li>Must start with letter</li><li>3-15 characters</li><li>Letters and numbers only</li></ul>";
				}
			}	
			else{
				echo "Pleas do not leave empty fields!";
			}
		}								
	}
	//this is controller function for home.php - view
	//control $_GET and $_SESSION variables
	public function home(){
		if(isset($_GET["all"])){
			$user = $this->model;
			$user = new User();
			$users = $user->returnAllUsers();
			return $users;
		}
		if(isset($_GET["logout"])){
			session_destroy();
			header("Location:index.php");
			return 0;
		}
	}
	//control $_GET and $_SESSION variables
	//then return user name
	public function user_name_home(){
		if(!isset($_GET["all"])){
			return "Hello " . $_SESSION["username"];
		}
		else{
			return "<h2>All Users</h2>";
		}
	}
}
			
	
 ?>