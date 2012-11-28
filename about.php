<?php
// about.php - Author Felix Farquharson (fef)

//Maintain the session.
session_start();

//Setup the template manager
include_once('view.php');
$t = new View();

//Render the template without any special
//attributes because this is a "flat" page.
$t->render('about.phtml');
?>