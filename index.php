<html>
    <head>
	<title>PSU programming contest 2024</title>
	<?php include $_SERVER['DOCUMENT_ROOT'] . 'include/transactions.php'; ?>
	<?php include __DIR__ . '/include/util.php'; ?>
	<link rel="stylesheet" href="/stylesheet.css<?php add_time_query(); ?>"/>
	<?php session_start(); ?>
    </head>
    <body>
	<?php
	include $_SERVER['DOCUMENT_ROOT'] . 'common/topbar.php';
	topbar();
	?>

	This year's puzzles:

	<ol id ="puzzle-list">
	    <li><a href="puzzles/example/">Example puzzle</a></li>
	</ol>
    </body>
</html>
