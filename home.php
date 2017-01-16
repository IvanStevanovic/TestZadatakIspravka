<html>
	<head>
		<link href="css/style.css" rel="stylesheet"/>
	</head>
	<body>
		<div class="menu">
			<a href="home.php"> home </a>|
			<a href="?all"> all users </a>|
			<a href="?logout"> logout </a>
			<br>
		<?php 
			include("controller.php");
			/* check if user is logged in then call controller for home.php -view page*/
			$controler_home = new Controller();
			echo $controler_home->user_name_home();
			$data = $controler_home->home();
			if($data!=0){
			echo"<table><tr><th>Username</th><th>Password</th><th>Register Date</th></tr>";
			foreach($data as $key => $users_data){
				print "<tr><td>$users_data[username]</td><td>$users_data[password]</td><td>$users_data[created_date]</td></tr>";
			}
			}
		?>
	</body>
</html>