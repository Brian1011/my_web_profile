<?php
include 'connection.php';

//get the data from the form
//we will take the id's and not the names
$first_team = $_POST['first_team'];
$second_team = $_POST['second_team'];
$ref_id = $_POST['referee'];
$match_date = $_POST['match_date'];
$venue = $_POST['venue'];

//get the id of the current league
$league_id = $_POST['league_id'];

echo $first_team."<br>";
echo $second_team."<br>";
echo $ref_id."<br>";
echo $league_id."<br>";
echo $match_date."<br>";

//validation

//make sure that the dropdowns have values
if( ($first_team == 'empty') || ($second_team == 'empty') || ($ref_id == 'empty') || (empty($league_id)) || (empty($match_date)) ){
	//empty error
	header("location: ../set_fixtures_p2.php?id=$league_id?message=empty");
}else{
	//first team should not be equal to second team
	if($first_team == $second_team){
		header("location: ../set_fixtures_p2.php?id=$league_id?message=same");
	}else{
		//continue
		//set match date cannot be later than today
		$today = date("Y-m-d");
		
		if($match_date < $today){
			//error this not possible
			header("location: ../set_fixtures_p2.php?id=$league_id?message=dates");
		}else{
			//the dates are fine
			
			//insert into the match_fixtures table
			$stmt = $conn->prepare("insert into match_fixtures(match_date,team1_id,team2_id,league_id,referee_id,venue)values(?,?,?,?,?,?) ");
			$stmt->bind_param('siiiis',$match_date,$first_team,$second_team,$league_id,$ref_id,$venue);
			if($stmt->execute() === TRUE){
				header("location: ../set_fixtures_p2.php?id=$league_id?message=success");
			}else{
				header("location: ../set_fixtures_p2.php?id=$league_id?message=server_error");
			}
		}
	}
}

