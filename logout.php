<html>
    <head>
	<title>Log out</title>
	<?php include $_SERVER['DOCUMENT_ROOT'] . 'include/transactions.php'; ?>
	<?php include $_SERVER['DOCUMENT_ROOT'] . 'include/util.php'; ?>
	<link rel="stylesheet" href="/stylesheet.css<?php add_time_query(); ?>"/>
    </head>
    <body>
	<?php
	include $_SERVER['DOCUMENT_ROOT'] . 'common/topbar.php';
	topbar();

	session_start();
	if (session_destroy())
	    echo "You have successfully logged out";
	else
	    echo "An error occured while trying to log out";
	?>
    </body>
</html>
