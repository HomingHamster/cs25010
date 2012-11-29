<?php
// shop.php - Author Felix Farquharson (fef)

//set everything up...
include_once('init.php');

if ($t->logged_in == False){
    header("location:login.php");
}

$conn = pg_connect("host=db.dcs.aber.ac.uk port=5432
      dbname=teaching user=csguest password=rohishe");

$res = pg_query($conn, "select * from CSGames");

$games_array = array();

if (!$conn){
    die("db connection unavailable");
} else {
    while ($rowarray = pg_fetch_array($res)){
        $games_array[] = $rowarray;
    }
}
$t->games = $games_array;
$t->render('shop.phtml');
?>
