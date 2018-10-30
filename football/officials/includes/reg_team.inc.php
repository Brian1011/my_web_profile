<?php

//include connection to the database
	include 'connection.php';

//echo out the values from the form
$team_name = $_POST['team_name'];
$constituency = $_POST['constituency'];
$gender = $_POST['category'];
$fname  = $_POST['full_name'];
$phone = $_POST['phone'];
$mail = $_POST['mail'];
$uname = $_POST['uname'];
$pass = $_POST['pass'];
$image = $_FILES['myimage']['name'];
//echo "$image"."<br>";

//by default category is team
$category = 'team';

//we change the image name to the current time
$ran =time().$_FILES["myimage"]["name"];//get current time and rename image

//the folder we move it to
$folder = "../../teams/logo/";

//validate data

//first lets check the inputs with a dropdown to make sure something is selected
$dropdown1 = strcmp($gender, 'empty');
$dropdown2 =  strcmp($constituency, 'empty');

if( ($dropdown1 ==0 ) || ($dropdown2 ==0) ){
	//the dropdowns have not been selected--error
	header('location: ../reg_team.php?message=dropdown');

}else{
	//proceed dropdown has values

	if(empty($gender) || empty($team_name)|| empty($fname)|| empty($phone) || empty($mail) || empty($uname) || empty($pass) ){
	header('location: ../reg_team.php?message=empty');

	}else{

	//confirm that phone number digits are 10
	if (preg_match('/^\d{10}$/', $phone)) { 	
	//check email

			// Remove all illegal characters from email
			$email = filter_var($mail, FILTER_SANITIZE_EMAIL);

			// Validate e-mail
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

				//check username length
				if(strlen($uname)>=4 && strlen($pass)>=5){
					//its valid
				    

						//check username from the database
						$sql = "SELECT uname FROM logins WHERE uname = '$uname' ";
						$result = $conn->query($sql);

						if (mysqli_num_rows($result) != 0)
						  {
						  		//return to the main page with error
						      header('location: ../reg_team.php?message=uname');
						  }

						  else
						  {
						  	//error
						    echo "Username is unique";

						    //insert data into the profile tab;e
						   	if($image=== ''){
						    	$upload_images = '';
						    }else{
						    	$upload_images = $ran;

						    	//check if image is valid
								$check = getimagesize($_FILES["myimage"]["tmp_name"]);
							    if($check !== false) {
							        echo "File is an image - " . $check["mime"] . ".";
							    } else {
							        echo "File is not an image.";
							        header('location: ../reg_team.php?message=image');   
							    }

							    $info = getimagesize($_FILES['myimage']['tmp_name']);
								if (($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG)) {
								   die("Not a gif/jpeg/png");
								   header('location: ../reg_team.php?message=image');
								}

								move_uploaded_file($_FILES['myimage']['tmp_name'], "$folder".$ran);

								//check if it has been uploaded successfully
								if( ($_FILES['myimage']['error'] !== UPLOAD_ERR_OK) ){
								  die("Upload failed with error code " . $_FILES['file']['error']);
								   header('location: ../reg_team.php?message=image_upload');
								}
						    }
						    
							echo $upload_images."<br>";
							echo $ran."<br>";
							echo $fname."<br>";
							echo $phone."<br>";
							echo $mail."<br>";
							echo $uname."<br>";
							echo $pass."<br>";

							

							//INSERT INTO `team`(`team_id`, `team_name`, `gender`, `uname`, `email`, `coach_name`, `constituency`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7])
							//insert into team(team_name,gender,uname,email,coach_name,constituency)values(?,?,?,?,?,?);
							//

		$stmt = $conn->prepare("INSERT INTO team(team_name,gender,uname,phone,email,coach_name,constituency,image) values(?,?,?,?,?,?,?,?)");
							$stmt->bind_param("ssssssss",$team_name,$gender,$uname,$phone,$mail,$fname,$constituency,$upload_images);
							$stmt->execute();

							//insert into the logs table
							//first we encrypt the password 

							$encrypted_password = password_hash($pass,PASSWORD_DEFAULT);
							$stmt1 = $conn->prepare("INSERT INTO logins (uname, password, category) VALUES (?,?,?) ");
							$stmt1->bind_param("sss",$uname,$encrypted_password,$category);
							$stmt1->execute();

							header('location: ../reg_team.php?message=good');
						  }

				}else{
					//error
					header('location: ../reg_team.php?message=pass');
				}

			    	
			} else {
				//error
			    header('location: ../reg_team.php?message=mail');
			}

	} else {
	  // fail you need 10digits for the phone number
		header('location: ../reg_team.php?message=phone');
	}

}
}


	 
		




