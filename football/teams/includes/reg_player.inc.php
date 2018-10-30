<?php
//include connection to the database
include 'connection.php';

$fname  = $_POST['fname'];
$phone = $_POST['phone'];
$mail = $_POST['mail'];
$team_id = $_POST['team_id'];
$image = $_FILES['myimage']['name'];
$cert = $_FILES['certificate']['name'];
$date_joined = $_POST['date_joined'];
$position = $_POST['position'];
$sub_team = $_POST['team'];

echo $date_joined."<br>";
echo $fname."<br>";
echo $phone."<br>";
echo $mail."<br>";
echo $team_id."<br>";
echo $image."<br>";
echo $cert;
echo $sub_team."<br>";

//status is used in the account by default its active
$status_default = 'active';

//we change the image name to the current time
$ran =time().$_FILES["myimage"]["name"];//get current time and rename image

//we change the image name of the cert to the current time
$ran_cert =time().$_FILES["certificate"]["name"];//get current time and rename image


//the folder we move it to
$folder_image = "../../teams/players/";
$folder_cert =  "../../teams/cert/";


//validation is the next step
if( empty($fname)|| empty($phone) || empty($mail) || empty($image) || empty($cert) || empty($date_joined)){
	header('location: ../reg_player.php?message=empty');
}else{
	if (preg_match('/^\d{10}$/', $phone)) { 	
	//check email

			// Remove all illegal characters from email
			$email = filter_var($mail, FILTER_SANITIZE_EMAIL);

			// Validate e-mail
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

				//check if its an image
				$check = getimagesize($_FILES["myimage"]["tmp_name"]);
			    if($check !== false) {
			        echo "File is an image - " . $check["mime"] . ".";
			    } else {
			        echo "File is not an image.";
			        header('location: ../reg_player.php?message=image');   
			    }

			    $info = getimagesize($_FILES['myimage']['tmp_name']);
				if (($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG)) {
				   die("Not a gif/jpeg/png");
				   header('location: ../reg_player.php?message=image');
				}
				//everything is okay we move on
				move_uploaded_file($_FILES['myimage']['tmp_name'], "$folder_image".$ran);
				move_uploaded_file($_FILES['certificate']['tmp_name'], "$folder_cert".$ran_cert);


				if ( ($_FILES['myimage']['error'] !== UPLOAD_ERR_OK) || ($_FILES['certificate']['error'] !== UPLOAD_ERR_OK) ){
				   die("Upload failed with error code " . $_FILES['file']['error']);
				   header('location: ../reg_player.php?message=image_upload');
				}

				//initialize the variables
				$cert_image = $ran_cert;
				$profile_image = $ran;

				//send it to the db
				$stmt = $conn->prepare("INSERT INTO `players`(`photo`, `birth_certificate`, `current_team_id`, `date_joined`, `player_status`, `name`, `phone`, `email`, `position`,sub_team) VALUES (?,?,?,?,?,?,?,?,?,?)");
				$stmt->bind_param("ssisssssss",$profile_image,$cert_image,$team_id,$date_joined,$status_default,$fname,$phone,$mail,$position,$sub_team);
				$stmt->execute();
				header('location: ../reg_player.php?message=good');

			}else{
				//invalid email address
				 header('location: ../reg_player.php?message=mail');
			}
	}else{
		//phone error
		header('location: ../reg_player.php?message=phone');
	}
}