<html>
    <head>
	<title>The example puzzle</title>
	<?php include $_SERVER['DOCUMENT_ROOT'] . 'include/transactions.php'; ?>
	<?php include $_SERVER['DOCUMENT_ROOT'] . 'include/util.php'; ?>
	<link rel="stylesheet" href="/stylesheet.css<?php add_time_query(); ?>"/>
	<?php session_start(); ?>
    </head>

    <body>
	<?php
	include $_SERVER['DOCUMENT_ROOT'] . 'common/topbar.php';
	topbar();

	if (isSet($_SESSION['user']))
	    record_start_time($_SESSION['user'], basename(__DIR__), time());
	?>

	<div class="puzzle-description">
	    <p>
		This is the example puzzle.
	    </p>
	    <code>
		<pre>
int
main(void)
{
    puts("This is an example code block.");
    return 0;
}
		</pre>
	    </code>
	    <p>	
		Some info about the puzzle will go here, along with some example
		input/output.
	    </p>
	    <div class="output">
	    	<pre>
$ ./test.py
This is an example of preformatted input/output.
		</pre>
	    </div>
	</div>

	<div class="puzzle-description">
	    The answer for this particular puzzle is <span id="spoiler">"puzzle solution"</span>
	</div>

	<a href="/puzzles/input.php?puzzle=example">Get your input</a>

	<?php
	include $_SERVER['DOCUMENT_ROOT'] . 'common/submit_form.php';
	submit_form(basename(__DIR__), 'Answer');
	?>
    </body>
</html>
