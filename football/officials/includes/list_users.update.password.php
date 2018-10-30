<?php
//include the database conection
include 'connection.php';

//start a session
session_start();

//lets check the type of user
$usertype = $_POST['usertype'];
echo $usertype."<br>";

//initialize global variable
$new_pass ='';

//this the referee
if($usertype === 'ref'){
	$ref_username = $_POST['ref_id'];

		//generate random password
	function randomPassword() {
		    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		    $pass = array(); //remember to declare $pass as an array
		    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache

		    for ($i = 0; $i < 8; $i++) {
		        $n = rand(0, $alphaLength);
		        $pass[] = $alphabet[$n];
		    }

		return implode($pass); //turn the array into a string
	}

		echo randomPassword();

		//the new password will be random
		$new_pass = randomPassword();

		//create a session to hold the password and the ref_id
		$_SESSION['ref_id'] = $ref_username;
		$_SESSION['ref_new_pass'] = $new_pass;

		//
		//echo $ref_username;

		//encrypt password then send it to the db
		$encrypted_password = password_hash($new_pass,PASSWORD_DEFAULT);

		//update the logins table
		$stmt = $conn->prepare("update logins set password=? where uname=?");
		$stmt->bind_param('ss',$encrypted_password,$ref_username);

		//check for nay errors
		if($stmt->execute()===TRUE){
			echo "it worked";
			header("Location: ../list_referee.php?newpass");
		}else{
			echo "error".$conn->error;
			header("Location: ../list_referee.php?message=server_error");
		}

//official
}else if($usertype === 'official'){
		//get the variables
		$off_uname = $_POST['official_id'];
		echo $off_uname;

			function randomPassword() {
			    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
			    $pass = array(); //remember to declare $pass as an array
			    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache

			    for ($i = 0; $i < 8; $i++) {
			        $n = rand(0, $alphaLength);
			        $pass[] = $alphabet[$n];
			    }

				return implode($pass); //turn the array into a string
			}

		echo randomPassword();

		//the new password will be random
		$new_pass = randomPassword();

		$_SESSION['official_id'] = $off_uname;
		$_SESSION['official_new_pass'] = $new_pass;

		//
		//echo $ref_username;

		//encrypt password then send it to the db
		$encrypted_password = password_hash($new_pass,PASSWORD_DEFAULT);

		//update the logins table
		$stmt = $conn->prepare("update logins set password=? where uname=?");
		$stmt->bind_param('ss',$encrypted_password,$off_uname);

		//check for nay errors
		if($stmt->execute()===TRUE){
			echo "it worked";
			header("Location: ../list_officials.php?newpass");
		}else{
			echo "error".$conn->error;
			header("Location: ../list_officials.php?message=server_error");
		}


}else if($usertype === 'team'){
	$team_id = $_POST['team_uname'];

		//generate random password
	function randomPassword() {
		    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		    $pass = array(); //remember to declare $pass as an array
		    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache

		    for ($i = 0; $i < 8; $i++) {
		        $n = rand(0, $alphaLength);
		        $pass[] = $alphabet[$n];
		    }

		return implode($pass); //turn the array into a string
	}

		echo randomPassword();

		//the new password will be random
		$new_pass = randomPassword();

		//create a session to hold the password and the ref_id
		$_SESSION['team_id'] = $team_id;
		$_SESSION['team_new_pass'] = $new_pass;
		//echo $team_id;

		//encrypt password then send it to the db
		$encrypted_password = password_hash($new_pass,PASSWORD_DEFAULT);

		//update the logins table
		$stmt = $conn->prepare("update logins set password=? where uname=?");
		$stmt->bind_param('ss',$encrypted_password,$team_id);

		//check for nay errors
		if($stmt->execute()===TRUE){
			echo "it worked";
			header("Location: ../list_teams.php?newpass");
		}else{
			echo "error".$conn->error;
			header("Location: ../list_teams.php?message=server_error");
		}

}

		

