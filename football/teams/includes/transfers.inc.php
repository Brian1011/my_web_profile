<?php
//include connection to the database
include 'connection.php';

$player_id = $_POST['player_id'];
$to_team = $_POST['to_team'];
$comments = $_POST['comments'];
$from_team = $_POST['from_team'];
$start_date = $_POST['start_date'];

echo $player_id."<br>";
echo $to_team."<br>";
echo $comments."<br>";
echo $from_team."<br>";

//todays date
//it will be the end date
$today = date("Y-m-d");

if( empty($to_team)|| empty($from_team) ){
	header("location: ../player_transfers.php?message=empty");
}else{
	//insert data into the tranfers
	$stmt = $conn->prepare("INSERT INTO `transfers`(`from_team_id`,player_id, `start_date`, `end_date`, `to_team_id`, `additional_info`) VALUES (?,?,?,?,?,?)");
	$stmt->bind_param("iissis",$from_team,$player_id,$start_date,$today,$to_team,$comments);


	$stmt1 = $conn->prepare("UPDATE `players` SET `current_team_id`=?,`date_joined`=? WHERE player_id = ?");
	$stmt1->bind_param("isi",$to_team,$today,$player_id);
	

	if($stmt->execute() === TRUE ){
		echo "it worked";
		//EXECUTE THE UPDATE
		$stmt1->execute();

			if($stmt1->execute() === TRUE ){
					echo "it worked";
					header("location: ../player_transfers.php?message=sucess");
				}else{
					echo "error <br>".$conn->error;
					//server error
					header("location: ../player_transfers.php?server=error");
				}
	}else{
		echo "error <br>".$conn->error;
		//server error
		header("location: ../player_transfers.php?server=error");
	}

	//update player profile
}