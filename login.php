<?php
// shop.php - Author Felix Farquharson (fef)

//set everything up...
include_once('init.php');

//if there has been a form post that
//contans a name, then we need to
//remember it in the session and make
//it available so that later code can 
//use it.
if (isset($_POST['name'])){
    $_SESSION['name'] = $_POST['name'];
    $t->user_name = $_POST['name'];
    //if the user is sucessful, put
    //them where they need to be.
	header("location:shop.php");
} else {
	//if this is happening then the
	//form is somehow incorrect, or
	//there is no spoon (form).
	echo "log in now!!!!!";
}

?>
