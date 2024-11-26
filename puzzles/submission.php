<html>
    <head>
	<title>Submit puzzle answer</title>
	<?php include $_SERVER["DOCUMENT_ROOT"] . "include/transactions.php"; ?>
	<?php include $_SERVER["DOCUMENT_ROOT"] . "include/util.php"; ?>
	<link rel="stylesheet" href="/stylesheet.css<?php add_time_query(); ?>"/>
	<?php session_start(); ?>
    </head>
    <body>
	<?php
	assert_loggedin("You must log in to submit a puzzle answer");
	include $_SERVER["DOCUMENT_ROOT"] . "common/topbar.php";
	topbar();

	if (!isSet($_POST["puzzle"])) {
	    echo "No puzzle selected.";
	    return;
	}

	if (!isSet($_POST["answer"])) {
	    echo "No answer provided.";
	    return;
	}

	$cached = get_answer($_SESSION["user"], $_POST["puzzle"]);

	if (!$cached) {
	    $input = puzzle_input_script($_POST["puzzle"]) . " " . $_SESSION["user"];
	    $solution = puzzle_solution_script($_POST["puzzle"]);
	    $cached = exec($input . " | " . $solution);

	    record_answer($_SESSION["user"], $_POST["puzzle"], $cached);
	    echo "<!-- Solution updated in database -->";
	}

	$submittedat = get_submitted_at($_SESSION["user"], $_POST["puzzle"]);

	if ($cached != $_POST["answer"]) {
	    if ($submittedat)
		div("puzzle-fail", "Incorrect answer. But you have already solved this problem.");
	    else
		div("puzzle-fail", "Incorrect answer");
	} else {
	    if ($submittedat) {
		div("puzzle-success", "Your answer was correct, but you already solved this problem."); 
	    } else {
		div("puzzle-success", "You got it right!");
		record_submitted_at($_SESSION["user"], $_POST["puzzle"], time());
	    }
	}
	?>

	<br>
	<a href="/puzzles/<?php echo $_POST["puzzle"] ?>/index.php">Back to puzzle</a>
    </body>
</html>
