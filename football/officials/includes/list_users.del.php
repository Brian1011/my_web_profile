<?php
//include the database conection
include 'connection.php';

//start a session
session_start();

//lets check the type of user
$usertype = $_POST['usertype'];

echo $usertype."<br>";

if($usertype === 'ref'){
	$ref_username = $_POST['uname'];
	$ref_id = $_POST['ref_id'];

	echo $ref_username."<br>";
	echo $ref_id."<br>";

	//check if the ref has supervised any game before
	$total_count = $conn->query("SELECT COUNT(*) FROM match_results where ref_id ='$ref_id' ")->fetch_row()[0];
	echo $total_count;

	//check if ref has been any game
	$fixtures_count = $conn->query("SELECT COUNT(*) FROM match_fixtures where referee_id ='$ref_id' ")->fetch_row()[0];
	echo $fixtures_count;

	//if total_count > 0 record exists we cannot erase record
	if( ($total_count>0) || ($fixtures_count>0)){
		//cannot erase record
		header("Location: ../list_referee.php?error=erase");
	}else{
		//erase record
		//has foriegn keys 
		//begin with logins table
		$stmt = $conn->prepare("DELETE FROM logins WHERE uname=?");
		$stmt->bind_param('s',$ref_username);

		if($stmt->execute()===TRUE){
			echo "It worked";
		}else{
			echo "error".$conn->error;
		}

		$stmt->close();
		//now erase the record from the referee table

		$stmt = $conn->prepare("DELETE FROM referee WHERE uname=?");
		$stmt->bind_param('s',$ref_username);

		if($stmt->execute()===TRUE){
			echo "It worked";
			header("Location: ../list_referee.php?message=dels");
		}else{
			echo "error".$conn->error;
			header("location: ../list_referee.php?message=server_error");
		}

		$stmt->close();
	}

//officials
}else if($usertype === 'official'){
	$official_id = $_POST['official_id'];
	$official_uname = $_POST['uname'];

	echo $official_id."<br>";
	echo $official_uname."<br>";

	//check if this official has ever registered a league
	$total_count = $conn->query("SELECT COUNT(*) FROM league where official_id ='$official_id' ")->fetch_row()[0];
	echo $total_count;

	//if has regisered a league do not erase data
	if($total_count>0){
		//do not erase data
		header("location: ../list_officials.php?error=erase");
	}else{
		//erase the data

		$stmt = $conn->prepare("DELETE FROM logins WHERE uname=?");
		$stmt->bind_param('s',$official_uname);

		if($stmt->execute() === TRUE){
			echo "It worked";
		}else{
			echo "error".$conn->error;
		}

		$stmt->close();
		//now erase the record from the referee table

		$stmt = $conn->prepare("DELETE FROM officials WHERE uname=?");
		$stmt->bind_param('s',$official_uname);

		if($stmt->execute()===TRUE){
			echo "It worked";
			header("Location: ../list_officials.php?message=dels");
		}else{
			echo "error".$conn->error;
			header("location: ../list_officials?message=server_error");
		}

		$stmt->close();

	}

//leagues
}else if($usertype === 'league'){
	$league_id = $_POST['league_id'];
	echo $league_id."<br>";

	//check if this league has any fixtures or matches
	$total_count = $conn->query("SELECT COUNT(*) FROM match_results where league_id ='$league_id' ")->fetch_row()[0];
	echo $total_count;

	$fixtures_count = $conn->query("SELECT COUNT(*) FROM match_fixtures where league_id ='$league_id' ")->fetch_row()[0];
	echo $fixtures_count;

	//check if this league has any team enrolled to it
	$league_teams_count  = $conn->query("SELECT COUNT(*) FROM league_team where league_id ='$league_id' ")->fetch_row()[0];
	echo $league_teams_count ;

	//if total_count > 0 record exists we cannot erase record
	if( ($total_count>0) || ($fixtures_count>0) || ($league_teams_count>0)){
		//send back to the lists
		header("location: ../list_league.php?error=erase");
	}else{
		//erase the data

		$stmt = $conn->prepare("DELETE FROM league WHERE league_id=?");
		$stmt->bind_param('i',$league_id);

		if($stmt->execute() === TRUE){
			echo "It worked";
			header("Location: ../list_league.php?message=dels");
		}else{
			echo "error".$conn->error;
			header("location: ../list_league.php?message=server_error");
		}

		$stmt->close();
		//now erase the record from the referee table

	}

//teams
}else if($usertype === 'team'){
	$team_id = $_POST['team_id'];
	$team_uname = $_POST['team_uname'];
	echo $team_id."<br>";

	//check if this team has any fixtures or matches
	$total_count = $conn->query("SELECT COUNT(*) FROM match_results where team_id ='$team_id' ")->fetch_row()[0];
	echo $total_count.'<br>';

	$fixtures_count = $conn->query("SELECT COUNT(*) FROM match_fixtures where team1_id ='$team_id' or team2_id='$team_id' ")->fetch_row()[0];
	echo $fixtures_count.'<br>';

	//check if this team has enrolled to any league 
	$league_teams_count  = $conn->query("SELECT COUNT(*) FROM league_team where team_id ='$team_id' ")->fetch_row()[0];
	echo $league_teams_count.'<br>' ;

	//check if any student has been enrolled to this team
	$player_counts = $conn->query("SELECT COUNT(*) FROM players where current_team_id='$team_id' ")->fetch_row()[0];
	echo "player count: ".$player_counts;

	//check if any player in the transfers is asssociated with this player
	$player_transfers_count = $conn->query("SELECT COUNT(*) FROM transfers where from_team_id='$team_id' or to_team_id='$team_id' ")->fetch_row()[0]; 
	echo $player_transfers_count;

	//if total_count > 0 record exists we cannot erase record
	if( ($total_count>0) || ($fixtures_count>0) || ($league_teams_count>0) || ($player_counts>0) || ($player_transfers_count>0)){
		//send back to the lists
		echo "you cannot erase this record";
		header("location: ../list_teams.php?error=erase");
	}else{
		//erase the data
		echo "you can erase this record";

		//erase the login creditianls
		$stmt = $conn->prepare("DELETE FROM logins WHERE uname=?");
		$stmt->bind_param('s',$team_uname);

		if($stmt->execute() === TRUE){
			echo "It worked";
		}else{
			echo "error".$conn->error;
		}

		$stmt->close();
		//now erase the record from the team table

		$stmt = $conn->prepare("DELETE FROM team WHERE uname=?");
		$stmt->bind_param('s',$team_uname);

		if($stmt->execute()===TRUE){
			echo "It worked";
			header("Location: ../list_teams.php?message=dels");
		}else{
			echo "error".$conn->error;
			header("location: ../list_teams.php?message=server_error");
		}

		$stmt->close();
	}

}

//fixtures
if($usertype === 'fixture'){
	//get the data
	$match_fixture_id = $_POST['match_fixture_id'];
	echo $match_fixture_id."<br>";

	//prepare the statement
		$stmt = $conn->prepare("DELETE FROM match_fixtures WHERE match_fixture_id=?");
		$stmt->bind_param('i',$match_fixture_id);

	//execute the statement
		if($stmt->execute()===TRUE){
			echo "It worked";
			header("Location: ../list_fixtures1.php?message=dels");
		}else{
			echo "error".$conn->error;
			header("location: ../list_fixtures1.php?message=server_error");
		}

		$stmt->close();
}

