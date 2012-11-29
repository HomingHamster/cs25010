<?php
// shop.php - Author Felix Farquharson (fef)

//set everything up...
include_once('init.php');

//we dont want to see the users here if they
//are not logged in.
if ($t->logged_in == False){
    header("location:login.php");
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

//So we check if there is a connection, would
//have used || die("something wrong") but that
//for some reason turned $conn into a bool.
if (!$conn){
    die("db connection unavailable");
} else {
	//we loop though all of the rows in the table
	//as an array and add them into the array we
	//just created.
    while ($rowarray = pg_fetch_array($res)){
        $games_array[] = $rowarray;
    }
}

//assign the array of arrays that holds the
//games into our instance of the view class
//the "view" will do all the rendering.
$t->games = $games_array;

//State the template to be rendered, and
//render it.
$t->render('shop.phtml');
?>
