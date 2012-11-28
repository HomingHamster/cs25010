<?php
// shop.php - Author Felix Farquharson (fef)

//set everything up...
include_once('init.php');

if (isset($_POST['name'])){
	$_SESSION['name'] = $_POST['name'];
	$t->user_name = $_POST['name'];
} else if (isset($_SESSION['name'])){
	$t->user_name = $_SESSION['name'];
}
	
$t->render('shop.phtml');
?>