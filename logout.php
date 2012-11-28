<?php
// shop.php - Author Felix Farquharson (fef)

//set everything up...
include_once('init.php');

session_destroy();
header("location:index.php");
exit();
?>
