<?php
//include the database conection
include 'connection.php';

//lets check the type of user
$usertype = $_POST['usertype'];
echo $usertype."<br>";

//this the referee
if($usertype === 'ref'){
		//store the variables
	$ref_id = $_POST['ref_id'];
	$status = $_POST['status'];

	//echo the following values
	echo $ref_id;
	echo $status;

	//we update the data in the database
	$stmt = $conn->prepare("update referee set status=? where ref_id=?");
	$stmt->bind_param('si', $status,$ref_id);

	if($stmt->execute() === TRUE){
		echo "it worked";
		header("location: ../list_referee.php?message=success");
	}else{
		echo "ERROR".$conn->error;
		header("location: ../list_referee.php?message=server_error");
	}

	//Leagues	
}else if($usertype === 'league'){
	//start a session to store the current id
	$_SESSION['leg_id'] = $_POST['league_id'];

	//store the variables
	$league_name = $_POST['league_name'];
	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];
	$league_id = $_POST['league_id'];

	echo $league_name."<br>";
	echo $start_date."<br>";
	echo $end_date;
	echo $_SESSION['leg_id'];

	if(empty($league_name) || empty($start_date)){
		//error cannot be empty
		header("location: ../list_league_2.php?id=$league_id?mesage=empty");
	}else{
		//check end date cannot be greater than start date
		if($end_date<=$start_date){
			//error end date has to be greater than start date
			echo "Imposible";
			header("location: ../list_league_2.php?id=$league_id?mesage=dates");
		}else{
			//update the table
			$stmt = $conn->prepare("update league set league_name=?,start_date=?,end_date=? where league_id=?");
			$stmt->bind_param('sssi', $league_name,$start_date,$end_date,$league_id);

			//execute query
			if($stmt->execute() === TRUE){
				echo "it worked";
				header("location: ../list_league_2.php?id=$league_id?mesage=success");
			}else{
				echo "ERROR".$conn->error;
				header("location: ../list_league_2.php?id=$league_id?message=server_error");
			}
		}
	}

}if($usertype === 'fixture'){
		//store the variables
	$match_fixture_id = $_POST['match_fixture_id'];
	$match_date = $_POST['match_date'];
	$referee = $_POST['referee'];
	$venue = filter_var($_POST['venue'], FILTER_SANITIZE_STRING);;

	//echo the following values
	echo $match_fixture_id."<br>";
	echo $match_date."<br>";
	echo $referee."<br>";
	echo $venue;

	//validation
	if(empty($match_fixture_id) || empty($match_date) || empty($referee) || empty($venue)){
		//error cannot be empty

	}else{
		//we update the data in the database
		$stmt = $conn->prepare("update match_fixtures set match_date=?, referee_id=?, venue=? where match_fixture_id=?");
		$stmt->bind_param('sisi', $match_date,$referee,$venue,$match_fixture_id);

		if($stmt->execute() === TRUE){
			echo "it worked";
			header("location: ../list_fixtures1.php?message=success");
		}else{
			echo "ERROR".$conn->error;
			header("location: ../list_fixtures1.php?message=server_error");
		}
		
		}
}

//teams

