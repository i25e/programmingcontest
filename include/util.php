<?php
# If there is no user logged in, display an error and nothing else
function assert_loggedin($msg)
{
    if (!isSet($_SESSION['user'])) {
	error($msg);
	echo '<a href="../login.php">Login</a>';
        exit();
    }
}

function add_time_query()
{
    echo '?v=' . time();
}

function div($class, $s)
{
    echo '<div class="' . $class . '">' . $s . '</div>';
}

function error($s)
{
    div('error', $s);
}

function info($s)
{
    div('info', $s);
}
