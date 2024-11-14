<?php
function topbar()
{
    echo '
<ul id="topbar">
    <li><a href="/">Puzzle Index</a></li>';

    if (!isSet($_SESSION['user']))
	echo'
    <li><a href="/login.php">Login</a></li>
    <li><a href="/register.php">Register</a></li>';
    else {
	echo '
    <li>Logged in as: <span class="user">' . $_SESSION['user'] . '</span></li>
    <li><a href="/logout.php">(logout)</a></li>';
    }

    echo'
</ul>';
}
?>
