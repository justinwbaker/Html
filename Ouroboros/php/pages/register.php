<?php $title = 'Ouroboros'; ?>
<?php $metaTags = 'tag1 tag2'; ?>
<?php $currentPage = 'Register'; ?>
<!DOCTYPE html>
<html>
<head>
	<?php include('includes/head.php'); ?>
</head>
<body>
	<?php include('includes/nav-bar.php'); ?>
	<div class="content">
		<h1>Register</h1>
		<form action="../user/register.php" method="POST">
			<div class="container">
			  	<label for="name"><b>Name</b></label>
				<input type="text" placeholder="Enter Name" name="name" required>

				<label for="lastname"><b>Last Name</b></label>
				<input type="text" placeholder="Enter Last Name" name="lastname" required>

				<label for="age"><b>Age</b></label>
				<br>
				<input type="number" placeholder="Enter Age" name="age" min="13" max="120" required>
				<br>
				<label for="gender"><b>Gender</b></label>
				<input type="text" placeholder="Enter Gender" name="gender">

				<label for="username"><b>Gamer Tag</b></label>
				<input type="text" placeholder="Enter Username" name="username" required>

				<label for="password"><b>Password</b></label>
				<input type="password" placeholder="Enter Password" name="password" required>

				<label for="password"><b>Confirm Password</b></label>
				<input type="password" placeholder="Re-Enter Password" name="confirm_password" required>

				<button type="submit">Register</button>
				<label>
					<input type="checkbox" checked="checked" name="remember"> Remember me
				<span class="psw">Forgot <a href="#">password?</a></span>
				</label>
			</div>
		</form>
	</div>
		<?php include('includes/footer.php'); ?>
</body>
</html>