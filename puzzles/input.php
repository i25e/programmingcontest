<html>
    <head>
	<title>Puzzle input</title>
	<?php include $_SERVER['DOCUMENT_ROOT'] . 'include/transactions.php'; ?>
	<?php include $_SERVER['DOCUMENT_ROOT'] . 'include/util.php'; ?>
	<link rel="stylesheet" href="/stylesheet.css<?php add_time_query(); ?>"/>
	<?php session_start(); ?>
    </head>
    <body>
	<?php
	assert_loggedin('You must log in before receiving puzzle input');

	if (!isSet($_GET['puzzle']) || ($puzzle = $_GET['puzzle']) == '') {
	    error('No puzzle selected');
	    return;
	}

	# can't use div() because passthru() doesn't return a string
	echo '<div class="puzzle-input"><pre>';
	echo passthru(__DIR__ . '/' . $_GET['puzzle'] . '/impl/input ' . $_SESSION['user']);
	echo '</pre></div>';
	?>
    </body>
</html>
