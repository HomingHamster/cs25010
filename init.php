<?php
//Maintain the session.
session_save_path(
	"/ceri/homes1/f/fef/.php_sessions");
session_start();

//Setup the view manager so that we can
//abstract the views later (ie. like 
//templates).
require_once('view.php');
$t = new View();

//Later on in the code we will probably
//need to know if the user is "logged in"
//and if they are, what their username is.
//This statement finds out and sets the 
//correct vars in the instance of view.
if (isset($_SESSION['name'])) {
	$t->logged_in = True;
	$t->user_name = $_SESSION['name'];
} else {
	$t->logged_in = False;
}

?>
