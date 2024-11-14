<html>
    <head>
	<title>Register</title>
	<?php include $_SERVER['DOCUMENT_ROOT'] . 'include/transactions.php'; ?>
	<?php include $_SERVER['DOCUMENT_ROOT'] . 'include/util.php'; ?>
	<link rel="stylesheet" href="/stylesheet.css<?php add_time_query(); ?>"/>
    </head>
    <body>
	<?php
	$name = $user = $pass = '';
	if ($_POST && ($user = $_POST['user']) == '')
	    echo "User is required<br>";

	if ($_POST && ($pass = $_POST['pass']) == '')
	    echo "Password is required<br>";

	if ($_POST && ($name = $_POST['name']) == '')
	    $name = $user;

	if ($user != '' && $pass != '') {
	    $h = password_hash($_POST['pass'], PASSWORD_BCRYPT);

	    if (add_user($name, $user, $h))
		header("Location: login.php?welcome=" . $user);	
	    else
		error("A user with that user already exists");
	}
	?>

	<form id="register-form" method="post">
	    <label for="pass">Display name:</label>
	    <input type="text" id="name" name="name" value="<?php echo $name; ?>">
            <br>
	    <label for="user">Username:</label>
	    <input type="text" id="user" name="user" value="<?php echo $user; ?>">
	    <br>
	    <label for="pass">Password:</label>
	    <input type="text" id="pass" name="pass" value="<?php echo $pass; ?>">
	    <br>
	    <input type="submit" value="Submit">
	</form>

	<a href="login.php">Login</a>
    </body>
</html>
