<html>
<head>
	<title>Login and Registration</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">

</head>
<body>
	<div class="container">
		<div class="register">
			<!-- <a href="/Users/logoff">Logoff</a> -->
<?php 		$this->load->view("partials/flash_message");
?>
			<h3>Register</h3>
			<form action="/Users/create_user" method="post">
				<label>First Name:</label>
				<input type="text" name="first_name">
				<label>Last Name:</label>
				<input type="text" name="last_name">
				<label>Username:</label>
				<input type="text" name="username">
				<label>Email:</label>
				<input type="email" name="email">
				<label>Password</label>
				<input type="password" name="password">
				<label>Confirm Password</label>
				<input type="password" name="confirm_password">
<!-- 				<label>Date of Hire:</label>
				<input type="date" name="hire_date"> -->
				<input type="submit" value="Register">
			</form>
		</div> <!-- end of register -->
		<div class="login">
			<h3>Login</h3>
			<form action="/Users/login" method="post">
				<label>Email:</label>
				<input type="email" name="email">
				<label>Password:</label>
				<input type="password" name="password">
				<input type="submit" value="Login">
			</form>
		</div> <!-- end of login -->

	</div> <!-- end of container -->
</body>
</html>