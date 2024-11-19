<html>
    <head>
	<title>PSU programming contest 2024</title>
	<?php include $_SERVER['DOCUMENT_ROOT'] . 'include/transactions.php'; ?>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/util.php'; ?>
	<link rel="stylesheet" href="/stylesheet.css<?php add_time_query(); ?>"/>
	<?php session_start(); ?>
    </head>
    <body>
	<?php
	include $_SERVER['DOCUMENT_ROOT'] . 'common/topbar.php';
	topbar();
	?>

	<a href="puzzles/fall2024/">This year's puzzles</a>
	<br>
	<a href="puzzles/example/">Example puzzle</a>
    </body>
</html>
