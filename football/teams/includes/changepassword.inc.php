<?php
//include connection to the database
include 'connection.php';

//get the typed in data ,sanitize them
$oldpass = filter_var($_POST['old'], FILTER_SANITIZE_STRING);
$newpass1 = filter_var($_POST['pass1'], FILTER_SANITIZE_STRING);
$newpass2 = filter_var($_POST['pass2'], FILTER_SANITIZE_STRING);
$username = $_POST['uname'];

//echo them out
echo $oldpass."<br>";
echo $newpass1."<br>";
echo $newpass2."<br>";
echo $username."<br>";

//validation is the next step

//check if evrything is not empty
if(($newpass1 === '')||($newpass2 == '') ||($oldpass == '')){
	//error fields are empty
	echo "fields are empty";
	header('location: ../coach_profile.php?message=empty');

}else{

	//check length of the password has tob 5 or >5
	if( (strlen($newpass1)<5) || (strlen($newpass1)<5) ){
		//error its less than 5 characters
		echo "password cannot be less than 5";
		header('location: ../coach_profile.php?message=length');

	}else{
		//compare the two new passwords if they are the same
		if($newpass1 !== $newpass2){
			//error they are not the same
			//echo "they are not the same nigga";
			header('location: ../coach_profile.php?message=unmatch');

		}else{
			//check if the old pass is the same password in the database
			$query = 'select password from logins where uname=? ';
			$stmt = $conn->prepare($query);
			$stmt->bind_param("s",$username);//bind variable
			$stmt->execute();//run query
			$stmt->bind_result($encrpted_pass);//take that password column from the db
			$stmt->fetch();//fetch very important line
			$stmt->close();

			//variable $encrpted_pass is the encrypted password from the db
		
			//compare the old pass with the one from the db
			$hash = password_verify($oldpass, $encrpted_pass);

				if($hash == 0){
					//error they do not match
					echo "the old password is not this";
					header('location: ../coach_profile.php?message=incorrect');
				}else{
					//they match 
					//now we update the record in the db but first we encrypt

					//encrypt the one of the new passwords
					$encrypted_password = password_hash($newpass1, PASSWORD_DEFAULT);
					echo $encrypted_password;

					//update the record in the database

					//i prefer using prepared statements even though it denied
					$sql = "UPDATE logins SET password='$encrypted_password' WHERE uname = '$username' ";

					if ($conn->query($sql) === TRUE) {
					    echo "Record updated successfully";
					    header('location: ../coach_profile.php?message=success');

					} else {
					    echo "Error updating record: " . "<BR>".$conn->error;
					     header('location: ../coach_profile.php?message=server');

					}
					//update 

					//UPDATE units SET unit_cost = $u_cost,sem=$sem,year=$year,contact_hours=$chours,course_id=$courses WHERE unit_id = $unit_id"
					
				}
			
		}

	}
}



