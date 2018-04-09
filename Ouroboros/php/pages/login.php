<?php $title = 'Ouroboros'; ?>
<?php $metaTags = 'tag1 tag2'; ?>
<?php $currentPage = 'Login'; ?>
<!DOCTYPE html>
<html>
<head>
	<?php include('includes/head.php'); ?>
</head>
<body>
	<?php include('includes/nav-bar.php'); ?>
	<div class="content">
		<h1>Login</h1>
		<form action="../user/login.php" method="POST">

		  <div class="container">
		    <label for="username"><b>Username</b></label>
		    <input type="text" placeholder="Enter Username" name="username" required>

		    <label for="password"><b>Password</b></label>
		    <input type="password" placeholder="Enter Password" name="password" required>
		        
		    <button type="submit">Login</button>
		    <label>
		      <input type="checkbox" checked="checked" name="remember"> Remember me
		    </label>

		    <p>Forgot <a href="">Password</a>?</p>
			<p>Are you an <a href="admin-login.php">Admin</a>?</p>
		  </div>
		</form>
	</div>
		<?php include('includes/footer.php'); ?>
</body>
</html>