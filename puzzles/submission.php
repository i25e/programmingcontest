<html>
    <head>
	<title>Submit puzzle answer</title>
	<?php include $_SERVER['DOCUMENT_ROOT'] . 'include/transactions.php'; ?>
	<?php include $_SERVER['DOCUMENT_ROOT'] . 'include/util.php'; ?>
	<link rel="stylesheet" href="/stylesheet.css<?php add_time_query(); ?>"/>
	<?php session_start(); ?>
    </head>
    <body>
	<?php
	assert_loggedin('You must log in to submit a puzzle answer');
	include $_SERVER['DOCUMENT_ROOT'] . 'common/topbar.php';
	topbar();

	if (!isSet($_GET['puzzle'])) {
	    echo "No puzzle selected.";
	    return;
	}

	if (!isSet($_GET['answer'])) {
	    echo "No answer provided.";
	    return;
	}

	$cached = get_answer($_SESSION['user'], $_GET['puzzle']);

	if (!$cached) {
	    $cached = exec(__DIR__ . '/' . $_GET['puzzle'] . '/impl/solution ' . $_SESSION['user']);
	    record_answer($_SESSION['user'], $_GET['puzzle'], $cached);
	    echo '<!-- Solution updated in database -->';
	}

	if ($cached != $_GET['answer']) {
	    echo 'Incorrect answer.';
	} else {
	    if (get_submitted_at($_SESSION['user'], $_GET['puzzle'])) {
		div('puzzle-success', 'Your answer was correct, but you already solved this problem.'); 
	    } else {
		record_submitted_at($_SESSION['user'], $_GET['puzzle'], time());
		div('puzzle-success', 'You got it right!');
	    }
	}
	?>

	<br>
	<a href="/puzzles/<?php echo $_GET['puzzle'] ?>/index.php">Back to puzzle</a>
    </body>
</html>
