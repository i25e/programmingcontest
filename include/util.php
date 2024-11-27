<?php
# If there is no user logged in, display an error and nothing else
function assert_loggedin($msg)
{
    if (!isSet($_SESSION['user'])) {
        div("error", $msg);
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

function error($s) { div('error', $s); }
function info($s) { div('info', $s); }

function basename_n($dir, $n)
{
    $r = basename($dir);
    while (--$n) {
        $dir = dirname($dir);
        $r = basename($dir) . '/' . $r;
    }
    
    return $r;
}

function puzzle_input_script($puzzle)
{
    return $_SERVER["DOCUMENT_ROOT"] . "/puzzles/" . $puzzle . "/impl/input";
}

function puzzle_solution_script($puzzle)
{
    return $_SERVER["DOCUMENT_ROOT"] . "/puzzles/" . $puzzle . "/impl/solution";
}
