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

		//first rename it
		//we change the image name to the current time
		$ran =time().$_FILES["myimage"]["name"];

		//send image to the folder 
		//the folder we move it to
		$folder = "../../officials/photos/";

		//move it
		move_uploaded_file($_FILES['myimage']['tmp_name'], "$folder".$ran);
		$db_image = $ran;
	}


echo $db_image;

//validate the inputs
if( empty($fname)|| empty($phone) || empty($mail) ){
	//should not be empty
	header('location: ../index.php?message=empty');
}else{

	//confirm that phone number digits are 10
	if (preg_match('/^\d{10}$/', $phone)) { 
		//its okay

		// Validate e-mail
			if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
				//its valid
				//send data to the db
				$stmt = $conn->prepare("UPDATE officials SET name=?,phone=?,email=?,image=? WHERE official_id=?");
				$stmt->bind_param('ssssi',$fname,$phone,$mail,$db_image,$official_id);

				if($stmt->execute() === TRUE ){
					echo "it worked";
					header('location: ../index.php?message=good');
				}else{
					echo "error <br>".$conn->error;
					//server error
					header('location: ../index.php?message=server_error');
				}

			}else{
				//error
			    header('location: ../index.php?message=mail');
			}
	}else{
		// fail you need 10digits for the phone number
		header('location: ../index.php?message=phone');
	}
}



