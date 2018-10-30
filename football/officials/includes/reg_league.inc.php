<?php

//include database connection
include 'connection.php';

//get the variables from the inputs
$league_name = $_POST['league_name'];
$starting_date = $_POST['starting_date'];

//get the official's id from the session of the current logged in user
$official_id = $_POST['official_id'];

//echo them to confirm
echo $league_name;
echo $starting_date;

/*
	verify data using php
	in this case make sure its not empty
*/

	if(empty($league_name)|| empty($starting_date)){

		//return the use to the league registration page with an error
		header("Location: ../reg_league.php?message=empty");
	}else{

		//insert into the db
		$stmt = $conn->prepare("INSERT INTO league(official_id, league_name, start_date) VALUES (?,?,?)");
		$stmt->bind_param("iss",$official_id,$league_name,$starting_date);
		$stmt->execute();

		//return to the previous page with a success message
		header("Location: ../reg_league.php?message=good");
	}