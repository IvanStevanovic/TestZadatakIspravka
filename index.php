<?php include('controller.php'); ?>
<html>
	<head>
		<link href="css/style.css" rel="stylesheet"/>
	</head>
	<body>
		<div class="form">
			<form method="POST">
			<label for="username">USERNAME: </label><input type="text" id="username" name="username"/><br/><br/>
			<label for="password">PASSWORD: </label><input type="password" id="password" name="password"/><br/><br/>
			<input type="submit" value="LOGIN" name="login"/>
			<input type="submit" value="REGISTER" name="register"/>
			<br>
			<br>
			<li>Must start with letter</li>
			<li>3-15 characters</li>
			<li>Letters and numbers only</li>
			</form>
		</div>
		<div class="message">
		<?php
		//call controller for login or register on index.php view page.
			$user_controller = new Controller();
			$user_controller->index();
		?>
		</div>
	</body>
</html>