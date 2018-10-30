<?php

//include connection to the database
include 'connection.php';

//get the variables
$team_id = $_POST['team_id'];
$league_id = $_POST['league_id'];

echo $team_id."<br>";
echo $league_id."<br>";

//insert the record into the db
$stmt = $conn->prepare("insert into league_team (league_id,team_id) values (?,?) ");
$stmt->bind_param('ii',$league_id,$team_id);

//check if its inserted correctly
//send the league id via the url
if($stmt->execute() === TRUE){
	echo "it worked";
	header("location: ../list_league_2.php?id=$league_id?mesage=enrolled");
}else{
	echo "it did not work".$conn->error;
	header("location: ../list_league_2.php?id=$league_id?message=server_error");
}

