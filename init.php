<?php
//Maintain the session.
session_save_path("/ceri/homes1/f/fef/.php_sessions");
session_start();

//Setup the template manager
require_once('view.php');
$t = new View();

if (isset($_SESSION['name'])) {
	$t->logged_in = True;
	$t->user_name = $_SESSION['name'];
} else {
	$t->logged_in = False;
}

?>
