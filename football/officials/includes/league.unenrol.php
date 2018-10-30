<?php
//include connection to the database
include 'connection.php';

//get the variables
$enrol_id = $_POST['enrol_id'];
$league_id = $_POST['league_id'];
$team_id = $_POST['team_id'];

//display them out
echo $enrol_id."<br>";
echo $league_id."<br>";
echo $team_id;

//see if this team has been ever been in a match within this league
$query3 = "select * from match_fixtures where league_id='$league_id' and (team1_id='$team_id' or team2_id='$team_id')";
$result1 = $conn->query($query3);

if($result1->num_rows > 0){
	//it has been in a match
	//error
	echo "it has been in a match";
	header("location: ../list_league_2.php?id=$league_id?mesage=unenrol");
}else{ 
		//erase the record based on the enrolment id
		$stmt = $conn->prepare("DELETE FROM league_team WHERE enrol_id=?");
		$stmt->bind_param('i',$enrol_id);

		if($stmt->execute()===TRUE){
			echo "It worked";
			header("Location: ../list_league_2.php?id=$league_id?message=dels");
		}else{
			echo "error".$conn->error;
			header("location: ../list_league_2.php?id=$league_id?message=server_error");
		}

		$stmt->close();
}
