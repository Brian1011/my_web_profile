<?php
include('connection.php');

$team1_id = $_POST['team1_id'];
$team2_id = $_POST['team2_id'];
$match_fixture_id = $_POST['match_fixture_id'];
$league_id = $_POST['league_id'];
$ref_id = $_POST['ref_id'];


echo "Team 1 id: ".$team1_id;
echo "<br> Team 2 id".$team2_id;
echo "<br> Match Fixture Id".$match_fixture_id;
echo "<br> League Id: ".$league_id."<br>";
echo "<br> Ref Id: ".$ref_id."<br>";

$score = 0;
$points = 1;

//send to the db two records with 0-0 as the score
$stmt2 = $conn->prepare("INSERT INTO `match_results`(`ref_id`, `match_fixture_id`, `scores`, `points`, `team_id`, `league_id`) VALUES (?,?,?,?,?,?)");
$stmt2->bind_param('iiiiii',$ref_id,$match_fixture_id,$score,$points,$team1_id,$league_id);

$stmt3 = $conn->prepare("INSERT INTO `match_results`(`ref_id`, `match_fixture_id`, `scores`, `points`, `team_id`, `league_id`) VALUES (?,?,?,?,?,?)");
$stmt3->bind_param('iiiiii',$ref_id,$match_fixture_id,$score,$points,$team2_id,$league_id);


if($stmt2->execute()===false){
	echo 'Second query failed'.$conn->error;
	//header("location: ../my_match_fixtures_2.php?id=$match_fixture_id?message=sucess");
}else{
	echo "it works";
	header("location: ../my_match_fixtures_2.php?id=$match_fixture_id?message=sucess");
}

if($stmt3->execute()===false){
	echo 'Third query failed'.$conn->error;
	//header("location: ../my_match_fixtures_2.php?id=$match_fixture_id?message=server_error");
}else{
	echo "it works";
	header("location: ../my_match_fixtures_2.php?id=$match_fixture_id?message=sucess");
}