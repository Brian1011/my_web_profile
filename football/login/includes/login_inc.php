<?php
//include the databaseb file
include 'connection.php';

//get the inputs and sanitize the inputs
$uname = filter_var($_POST['uname'], FILTER_SANITIZE_STRING);
$pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);

echo $uname;
echo $pass;

//lets first make sure its not empty
if(empty($uname) || empty($pass)){
	//error
	header('location: ../login.php?message=empty');

}else{
	//proceed
	
	//we need to go into the database get the encrypted password
	$query = " SELECT * FROM logins WHERE uname=?";
	
	if($stmt = $conn->prepare($query)){
		$stmt->bind_param("s",$uname);

		//execute statement
		$stmt->execute();

		//bind result variable
		$stmt->bind_result($user_name,$encrpted_pass,$user_category);

		//fetch the results
		while($stmt->fetch()){
			echo "<br>";
			echo $user_name;
			echo $encrpted_pass."<br>";
			echo $user_category;
		}
		
		//we compare from the password from db and what is typed in
		$hash = password_verify($pass,$encrpted_pass);

		if($hash == 0){
			//they do not match...error
			header("location: ../index.php?message=error");
		}else{
			//valid take the user to page based on the user category

			//start a session
			session_start();

			//create a session based on the username
			//$_SESSION['uname'] = $user_name;

			if($user_category === 'referee'){
				//go to the ref page
				$_SESSION['ref'] = $user_name;
				header("location: ../../referee/");
				
			}else if($user_category === 'official'){
				//go to the official page
				$_SESSION['uname'] = $user_name;
				header("location: ../../officials/");
				
			}else{
				//its a team/coach user
				//go to the team's page
				$_SESSION['coach'] = $user_name;
				header("location: ../../teams/");
			}

		}

		//close statement
		$stmt->close();
	}
	

	//close connection
	$conn->close();
}

