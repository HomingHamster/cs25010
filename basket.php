<?php
// basket.php - Author Felix Farquharson (fef)

//set everything up...
include_once('init.php');

//we don't want the user here if they are not logged
//in to the system.
if ($t->logged_in == False){
    header("location:login.php");
}

//If there has been a form posted to the page then
//we need to process it with this.
if($_POST){

	//this is the code to remove the objects that
	//have been posted as selected..
	if(isset($_POST['basketRemoveSelected'])){
		foreach ($_POST["basketSelect"] as $removeValue) {
			foreach ($_SESSION["basket"] as $basketValue) {
				if($removeValue == $basketValue){
					$_SESSION["basket"] = array_diff(
							$_SESSION["basket"], 
							array($removeValue));
				}
			}
		}

	//another thing the user might want to do is
	//clear the basket completely, this empties the
	//basket completely on this ocation.
	} else if(isset($_POST['basketClear'])){
	 	$_SESSION['basket'] = array();

 	//maybe the user wants to check out the items in the
 	//basket. Here is where we do that.
	} else if (isset($_POST['basketCheckout'])){
		//render the checkout page and quit
		$total_cost = 0.00;
		$basket_games = array();
		foreach ($basket_games as $value) {
			$total_cost += $value["price"];
		}
		$t->total_cost = $total_cost;
		$t->render('checkout.phtml');
		exit;
	} else if (isset($_POST["confirmCheckout"])){
		//TODO:server side validation.
		$t->render('congratulations.phtml');
		exit;
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

	//I'm well aware this isn't the best way to do it,
	//but i was in a rish i'm afraid.
	//should have made a custom SQL command..
	foreach($_SESSION['basket'] as $basket_number){
		foreach ($games_array as $value) {
			if ($value["refnumber"]==$basket_number){
				$basket_games[] = $value;
				break;
			}
		}
	}
}

//logic to total the cost of the items that have 
//been bought. I should write this into a function.
$total_cost = 0.00;
foreach ($basket_games as $value) {
	$total_cost += $value["price"];
}

//make the template aware of the cost.
$t->total_cost = $total_cost;

//assign the array of arrays that holds the
//games into our instance of the view class
//the "view" will do all the rendering.
$t->basket_games = $basket_games;

//Render the template without any special
//attributes because this is a "flat" page.
$t->render('basket.phtml');
?>