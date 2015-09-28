<?php

session_start();

echo "<h1>Homepage</h1>";

if (isset($_SESSION["user_id"])) {
	echo "<a href='/logout'>Logout</a>";
} else {
	echo "<a href='/login'>Log in</a>";
}
?>