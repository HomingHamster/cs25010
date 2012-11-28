<?php
// shop.php - Author Felix Farquharson (fef)

//set everything up...
include_once('init.php');

if (isset($_POST['name'])){
	$_SESSION['name'] = $_POST['name'];
	$t->user_name = $_POST['name'];
}
	
$t->render('shop.phtml');
?>