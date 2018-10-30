<?php
include('connection.php');

$location = $_POST['location'];

if($location === 'one' ){
	//the first form or second has been clicked
//get the variables
$team1_id = $_POST['team1_id'];
$team2_id = $_POST['team2_id'];
$team1_scores = $_POST['team1_scores'];
$team2_scores = $_POST['team2_scores'];
$team1_points = $_POST['team1_points'];
$team2_points = $_POST['team2_points'];
$player = $_POST['team1_player'];
$activity = $_POST['activity'];
$match_fixture_id = $_POST['match_fixture_id'];
$league_id = $_POST['league_id'];
$current_team_id = $_POST['current_team_id'];
$ref_id = $_POST['ref_id'];
$team1_points = 0;
$team2_points = 0;


echo "Team 1 id: ".$team1_id;
echo "<br> Team 2 id".$team2_id;
echo "<br> Team 1 score:".$team1_scores;
echo "<br> Team 2 score:".$team2_scores;
echo "<br> Team 1 points:".$team1_points;
echo "<br> Team 2 points:".$team2_points;
echo "<br> Player ".$player;
echo "<br> Activity".$activity;
echo "<br> Match Fixture Id".$match_fixture_id;
echo "<br> League Id: ".$league_id."<br>";
echo "<br> Ref Id: ".$ref_id."<br>";

//set timezone time
date_default_timezone_set('Africa/Nairobi');

$now_n = date("Y-m-d H:i:s");
echo $now_n; 

$red_card = 'red';


			//initialize the team scores
			if(empty($team1_scores)){
				$team1_scores = 0;
			}
			if(empty($team2_scores)) {
				$team2_scores = 0;
			}

			//calculate the points
				if($team1_scores == $team2_scores){
					$team1_points = 1;
					$team2_points = 1;
				}elseif ($team1_scores>$team2_scores){
					$team1_points = 3;
					$team2_points = 0;
				}elseif ($team2_scores>$team1_scores){
					$team2_points = 3;
					$team1_points = 0;
				}

				//before we check the activity we have to check if this player has a red card
				$query = "SELECT COUNT(cards) FROM player_stats WHERE cards='red' and player_id='$player' and match_fixture_id= '$match_fixture_id' ";
				$total_red = $conn->query($query)->fetch_row()[0];

				//or if he has been injured before in this game
				$query = "SELECT COUNT(injured) FROM player_stats WHERE injured='yes' and player_id='$player' and match_fixture_id= '$match_fixture_id'";
				$total_injured = $conn->query($query)->fetch_row()[0];


			if( ($total_red>0) || ($total_injured>0)){
				//an error
				//a player with a red card cannot play again
				if($total_red>0){
					header("location: ../my_match_fixtures_2.php?id=$match_fixture_id?message=red");
				}else if($total_injured>0){
					header("location: ../my_match_fixtures_2.php?id=$match_fixture_id?message=injury");
				}
				
			}else{
				//check the player activity
				//echo "Total red is ".$total_red;
				if($activity === 'goal'){
					//increase the score of the current team and calculate the points
					$goal = 1;
					if($current_team_id == $team1_id){
						$team1_scores = $team1_scores + 1;
					}else if($current_team_id == $team2_id){
						$team2_scores = $team2_scores + 1;
					}

					//calculate the points again
					if($team1_scores==$team2_scores){
						$team1_points =1;
						$team2_points = 1;
					}elseif ($team1_scores>$team2_scores){
						$team1_points = 3;
						$team2_points = 0;
					}elseif ($team2_scores>$team1_scores){
						$team2_points = 3;
						$team1_points = 0;
					}
					//query to insert a goal into the player stats
					$stmt=$conn->prepare("INSERT INTO `player_stats`(`match_fixture_id`, `player_id`, `team_id`, `goals`, `match_time`) VALUES (?,?,?,?,?) ");
					$stmt->bind_param("iiiis",$match_fixture_id,$player,$current_team_id,$goal,$now_n);

				}elseif( ($activity === 'yellow') ) {
						//check how many yellows this player has
					$query = "SELECT COUNT(cards) FROM player_stats WHERE cards='yellow' and player_id='$player' and match_fixture_id= '$match_fixture_id' ";
					$total_yellow = $conn->query($query)->fetch_row()[0];
					//echo "Total yellow is ".$total_yellow;
					if($total_yellow == 2){
						//yellow cards cannot be more than one
						header("location: ../my_match_fixtures_2.php?id=$match_fixture_id?message=yellow");
					}else if($total_yellow == 1){
						//add a another yellow plus a red card
						//2 yellow cards == red card
						$stmt =$conn->prepare( "INSERT INTO `player_stats`(`match_fixture_id`, `player_id`, `team_id`, `match_time`,`cards`) VALUES (?,?,?,?,?)");
						$stmt->bind_param("iiiss",$match_fixture_id,$player,$current_team_id,$now_n,$activity);

						$stmt1 =$conn->prepare( "INSERT INTO `player_stats`(`match_fixture_id`, `player_id`, `team_id`, `match_time`,`cards`) VALUES (?,?,?,?,?)");
						$stmt1->bind_param("iiiss",$match_fixture_id,$player,$current_team_id,$now_n,$red_card);
					}else if($total_yellow == 0){
						$stmt =$conn->prepare( "INSERT INTO `player_stats`(`match_fixture_id`, `player_id`, `team_id`, `match_time`,`cards`) VALUES (?,?,?,?,?)");
						$stmt->bind_param("iiiss",$match_fixture_id,$player,$current_team_id,$now_n,$activity);
					}

						
				}elseif ($activity === 'red') {
					//insert it into the db
					$stmt =$conn->prepare( "INSERT INTO `player_stats`(`match_fixture_id`, `player_id`, `team_id`, `match_time`,`cards`) VALUES (?,?,?,?,?)");
					$stmt->bind_param("iiiss",$match_fixture_id,$player,$current_team_id,$now_n,$red_card);
					
				}else{
					//activity is injured
					$new_activity = 'yes';
					$query4 = "SELECT COUNT(injured) as total FROM player_stats WHERE player_id='$player' and injured ='yes' and match_fixture_id='$match_fixture_id' ";
	    			$total_injuries = $conn->query($query4)->fetch_row()[0];

	    			if($total_injuries > 0){
	    				//error a player cannot be injured twice
	    				//header("location: ../my_match_fixtures_2.php?id=$match_fixture_id?message=injury");
	    			}else{
	    				//insert into the db
	    				$stmt =$conn->prepare( "INSERT INTO `player_stats`(`match_fixture_id`, `player_id`, `team_id`, `match_time`,`injured`) VALUES (?,?,?,?,?)");
						$stmt->bind_param("iiiss",$match_fixture_id,$player,$current_team_id,$now_n,$new_activity);
	    			}
	    			

				}	
				

				//our final step is to check if this match has results
				//execute 3 queries
				$query3 = "SELECT  COUNT(*) FROM `match_results` where match_fixture_id = '$match_fixture_id' ";
				$total = $conn->query($query3)->fetch_row()[0];
				echo "Total:".$total;
				if($total > 0 ){
					//do an update
					$stmt2 = $conn->prepare("UPDATE `match_results` SET scores=?,points=? where match_fixture_id=? and team_id=?");
					$stmt2->bind_param('iiii',$team1_scores,$team1_points,$match_fixture_id,$team1_id);

					$stmt3 = $conn->prepare("UPDATE `match_results` SET scores=?,points=? where match_fixture_id=? and team_id=?");
					$stmt3->bind_param('iiii',$team2_scores,$team2_points,$match_fixture_id,$team2_id);
				}else{
					//insert into the db
					$stmt2 = $conn->prepare("INSERT INTO `match_results`(`ref_id`, `match_fixture_id`, `scores`, `points`, `team_id`, `league_id`) VALUES (?,?,?,?,?,?)");
					$stmt2->bind_param('iiiiii',$ref_id,$match_fixture_id,$team1_scores,$team1_points,$team1_id,$league_id);

					$stmt3 = $conn->prepare("INSERT INTO `match_results`(`ref_id`, `match_fixture_id`, `scores`, `points`, `team_id`, `league_id`) VALUES (?,?,?,?,?,?)");
					$stmt3->bind_param('iiiiii',$ref_id,$match_fixture_id,$team2_scores,$team2_points,$team2_id,$league_id);
				}

				//run all queries
				if($stmt->execute()===false){
					echo 'First query failed'.$conn->error;
					header("location: ../my_match_fixtures_2.php?id=$match_fixture_id?message=server_error");
				}else{
					header("location: ../my_match_fixtures_2.php?id=$match_fixture_id?message=sucess");
				}

				if($stmt2->execute()===false){
					echo 'Second query failed'.$conn->error;
					header("location: ../my_match_fixtures_2.php?id=$match_fixture_id?message=server_error");
				}else{
					header("location: ../my_match_fixtures_2.php?id=$match_fixture_id?message=sucess");
				}

				if($stmt3->execute()===false){
					echo 'Second query failed'.$conn->error;
					header("location: ../my_match_fixtures_2.php?id=$match_fixture_id?message=server_error");
				}else{
					header("location: ../my_match_fixtures_2.php?id=$match_fixture_id?message=sucess");
				}


				if(isset($stmt1)){
					echo "it exist";

					if($stmt1->execute()===false){
						echo 'Middle query failed'.$conn->error;
						header("location: ../my_match_fixtures_2.php?id=$match_fixture_id?message=server_error");
					}else{
						header("location: ../my_match_fixtures_2.php?id=$match_fixture_id?message=sucess");
					}
				}

				

				

		}
}else{
	//the comment section
}


