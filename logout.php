<?php
// shop.php - Author Felix Farquharson (fef)

//set everything up... (and make sure we're
//using the same session)
include_once('init.php');

//remove all session information saved,
//will include the name and all basket info.
//                                    ;(
session_destroy();

//puts the user back on the homepage,
header("location:index.php");
exit();
?>
