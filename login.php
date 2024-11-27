<html>
    <head>
	<title>Log in</title>
	<?php include $_SERVER["DOCUMENT_ROOT"] . "/include/transactions.php"; ?>
	<?php include $_SERVER["DOCUMENT_ROOT"] . "/include/util.php"; ?>
	<link rel="stylesheet" href="/stylesheet.css<?php add_time_query(); ?>"/>
    </head>
    <body>
	<?php
	if (isSet($_GET['welcome']) && ($welcome = $_GET['welcome']) != '')
	    echo "You may now log in with the username '" . $welcome . "'<br>";

	$user = $pass = '';
	if ($_POST && ($user = $_POST['user']) == '')
	    echo "User is required<br>";

	if ($_POST && ($pass = $_POST['pass']) == '')
	    echo "Password is required<br>";

	if ($user != '' && $pass != '') {
	    if (authenticate_user($user, $pass)) {  # authenticate user
		info("success!");
		session_start();
		$_SESSION['user'] = $user;
		header("Location: index.php"); # user logs in here
	    } else {
		error("Invalid username or password");
	    }
	}
	?>

	<form id="login-form" method="post">
	    <label for="user">Username:</label>
	    <input type="text" id="user" name="user" value="<?php echo $user; ?>">
	    <br>
	    <label for="pass">Password:</label>
	    <input type="password" id="pass" name="pass" value="<?php echo $pass; ?>">
	    <br>
	    <input type="submit" value="Log in">
	</form>
	<a href="register.php">Register</a>
    </body>
</html>
