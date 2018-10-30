<?php
//include connection to the database
include 'connection.php';

$fname  = $_POST['fname'];
$phone = $_POST['phone'];
$mail = $_POST['mail'];
$team_id = $_POST['team_id'];
$position = $_POST['position'];
$sub_team = $_POST['team'];
$player_id =$_POST['player'];
$status = $_POST['status'];

echo $fname."<br>";
echo $phone."<br>";
echo $mail."<br>";
echo $team_id."<br>";
echo $sub_team."<br>";
echo $position."<br>";
echo $player_id."<br>";
echo $status."<br>";

//validation
if( empty($fname)|| empty($phone) || empty($mail) ){
	header("location: ../player_profile.php?id=$player_id?message=empty");
}else{
	if (preg_match('/^\d{10}$/', $phone)) { 	
	//check email
			$date_left = date("Y-m-d");
			// Remove all illegal characters from email
			$email = filter_var($mail, FILTER_SANITIZE_EMAIL);

			// Validate e-mail
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				//do an update in the db
				if($status === 'Alumni'){
					$stmt = $conn->prepare("UPDATE players SET date_left=?,name=?,phone=?,email=?,position=?,sub_team=?,player_status=? WHERE player_id=?");
					$stmt->bind_param('sssssssi',$date_left,$fname,$phone,$mail,$position,$sub_team,$status,$player_id);
				}else{
					$stmt = $conn->prepare("UPDATE players SET name=?,phone=?,email=?,position=?,sub_team=?,player_status=? WHERE player_id=?");
					$stmt->bind_param('ssssssi',$fname,$phone,$mail,$position,$sub_team,$status,$player_id);
				}
				

				if($stmt->execute() === TRUE ){
					echo "it worked";
					header("location: ../player_profile.php?id=$player_id?message=good");
				}else{
					echo "error <br>".$conn->error;
					//server error
					header("location: ../player_profile.php?id=$player_id?server=error");
				}


			}else{
				header("location: ../player_profile.php?id=$player_id?message=mail");
			}

	}else{
		header("location: ../player_profile.php?id=$player_id?message=phone");
	}

}
