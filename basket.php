<?php
// basket.php - Author Felix Farquharson (fef)

//set everything up...
include_once('init.php');

if ($t->logged_in == False){
    header("location:login.php");
}

if($_POST){
	 if(isset($_POST['basketRemoveSelected'])){
	   foreach ($_POST["basketSelect"] as $removeValue) {
	   	foreach ($_SESSION["basket"] as $basketValue) {
	   		if($removeValue == $basketValue){
	   			$_SESSION["basket"] = array_diff(
	   				$_SESSION["basket"], array($removeValue));
	   		}
	   	}
	   }
	 } else if(isset($_POST['basketClear'])){
 	$_SESSION['basket'] = array();
 } else if (isset($_POST['basketCheckout'])){

 }
}
//instantiate a read only connection to the
//specified database.
$conn = pg_connect("host=db.dcs.aber.ac.uk port=5432
      dbname=teaching user=csguest password=rohishe");

//set the query to find all games on the
//relavant games table from the specification.
$res = pg_query($conn, "select * from CSGames");

//create an empty array that will eventually
//hold all of the games we read as an 
//array of arrays from the database.
//we have to have a seperate variable to do this
//because reading the information into the 
//View class was returning NULL (don't know
//why...)
$games_array = array();
$basket_games = array();

//So we check if there is a connection, would
//have used || die("something wrong") but that
//for some reason turned $conn into a bool.
if (!$conn){
	die("db connection unavailable");
} else {
	while ($rowarray = pg_fetch_array($res)){
		$games_array[] = $rowarray;
	}
	foreach($_SESSION['basket'] as $basket_number){
		foreach ($games_array as $value) {
			if ($value["refnumber"]==$basket_number){
				$basket_games[] = $value;
				break;
			}
		}
	}
}

//assign the array of arrays that holds the
//games into our instance of the view class
//the "view" will do all the rendering.
$t->basket_games = $basket_games;

//Render the template without any special
//attributes because this is a "flat" page.
$t->render('basket.phtml');
?>