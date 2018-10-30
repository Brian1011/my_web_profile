<?php
//include connection to the database
include 'connection.php';

//get the variables and sanitize them
$fname = filter_var($_POST['full_name'], FILTER_SANITIZE_STRING);
$phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
$mail = filter_var($_POST['mail'], FILTER_SANITIZE_STRING);
$form_image = $_FILES['myimage']['name'];//new image

//get the hidden variables
$official_id = filter_var($_POST['official_id'], FILTER_SANITIZE_STRING);//unique key-->primary key
$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);//unique key
$current_pic = filter_var($_POST['profile_image'], FILTER_SANITIZE_STRING);//the profile pic image

echo $fname."<br>";
echo $phone."<br>";
echo $mail."<br>";
echo $form_image."<br>";
echo $username."<br>";
echo $current_pic."<br>";
echo $official_id."<br>";

//validaton
//we check the image if its default image then image variable has to be empty
//declare a global image variable that we will be taken to the db
$db_image;

	//check if some thing has been submitted or not 
	if($form_image === ''){

		//check if its default or not

		if($current_pic === 'user.png'){
			//default image
			echo "its the default";
			$db_image = '';
		}else{

		//same image
		echo "its the same image <br>";

		//send current image to db
		$db_image = $current_pic;
		}


	}else{
		//new image
		echo "its a new image <br>";

		//send new pic to db
		//$db_image = $form_image;

		//we check if its a real image
		$check = getimagesize($_FILES["myimage"]["tmp_name"]);
	    if($check !== false) {
	        echo "File is an image - " . $check["mime"] . ".";
	    } else {
	        echo "File is not an image.";
	        header('location: ../coach_profile.php?message=image');   
	    }

	    $info = getimagesize($_FILES['myimage']['tmp_name']);
		if (($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG)) {
		   die("Not a gif/jpeg/png");
		   header('location: ../coach_profile.php?message=image');
		}

		//first rename it
		//we change the image name to the current time
		$ran =time().$_FILES["myimage"]["name"];

		//send image to the folder 
		//the folder we move it to
		$folder = "../../teams/logo/";

		//move it
		move_uploaded_file($_FILES['myimage']['tmp_name'], "$folder".$ran);
		$db_image = $ran;


		if ($_FILES['myimage']['error'] !== UPLOAD_ERR_OK) {
		   die("Upload failed with error code " . $_FILES['file']['error']);
		   header('location: ../coach_profile.php?message=image_upload');
		}

	}


echo $db_image;

//validate the inputs
if( empty($fname)|| empty($phone) || empty($mail) ){
	//should not be empty
	header('location: ../coach_profile.php?message=empty');
}else{

	//confirm that phone number digits are 10
	if (preg_match('/^\d{10}$/', $phone)) { 
		//its okay

		// Validate e-mail
			if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
				//its valid
				//send data to the db
				$stmt = $conn->prepare("UPDATE team SET coach_name=?,phone=?,email=?,image=? WHERE team_id=?");
				$stmt->bind_param('ssssi',$fname,$phone,$mail,$db_image,$official_id);

				if($stmt->execute() === TRUE ){
					echo "it worked";
					header('location: ../coach_profile.php?message=good');
				}else{
					echo "error <br>".$conn->error;
					//server error
					header('location: ../coach_profile.php?server=error');
				}

			}else{
				//error
			    header('location: ../coach_profile.php?message=mail');
			}
	}else{
		// fail you need 10digits for the phone number
		header('location: ../coach_profile.php?message=phone');
	}
}



