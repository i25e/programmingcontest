<?php
/*
 * Doing it this way is kind of unnecessarily complicated, but if we ever need
 * to change the way answers are submitted in the future, this is the only place
 * that needs to be done.
 */

function submit_form($puzzle, $prompt)
{
    if (isSet($_SESSION['user']))
	echo '
<form method="post" action="/puzzles/submission.php">
    <label for="answer">' . $prompt . '</label>
    <input type="text" id="answer" name="answer">
    <input type="hidden" id="puzzle" name="puzzle" value="' . $puzzle . '">
    <input type="submit" value="Submit">
</form>';
    else
	echo '<div class="warning">You must log in to submit an answer</div>';
}
