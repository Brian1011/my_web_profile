<?php
//include connection to the database
include 'connection.php';

$player_id =$_POST['player_id'];
$image = $_FILES['myimage']['name'];
$cert = $_FILES['certificate']['name'];

echo $player_id;
echo $image;
echo $cert;

//validation
if(empty($image) && empty($cert)){
	header("location: ../player_profile_update.php?id=$player_id?message=empty");
}else{
	//something has been submitted
	//confirm if the first one is an image

	//we change the image name to the current time
	$ran =time().$_FILES["myimage"]["name"];//get current time and rename image

	//we change the image name of the cert to the current time
	$ran_cert =time().$_FILES["certificate"]["name"];//get current time and rename image


	//the folder we move it to
	$folder_image = "../../teams/players/";
	$folder_cert =  "../../teams/cert/";

	//check if its an image

				//check if its empty
				if(empty($image)){
					//certificate is not empty

					//move certficate to a folder
					move_uploaded_file($_FILES['certificate']['tmp_name'], "$folder_cert".$ran_cert);

					//prepare sql statement
					$stmt = $conn->prepare("UPDATE players SET birth_certificate=? WHERE player_id=?");
					$stmt->bind_param('si',$ran_cert,$player_id);

					//check if upload is succesful
					if($_FILES['certificate']['error'] !== UPLOAD_ERR_OK){
						die("Upload failed with error code " . $_FILES['file']['error']);
						header("location: ../player_profile_update.php?id=$player_id?message=upload");
					}
					header("location: ../player_profile_update.php?id=$player_id?message=success");

				}else{
					//certificate is empty or not
					$check = getimagesize($_FILES["myimage"]["tmp_name"]);
				    if($check !== false) {
				        echo "File is an image - " . $check["mime"] . ".";
				    } else {
				        echo "File is not an image.";
				       header("location: ../player_profile_update.php?id=$player_id?message=image");  
				    }

				    $info = getimagesize($_FILES['myimage']['tmp_name']);
					if (($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG)) {
					   die("Not a gif/jpeg/png");
					   header("location: ../player_profile_update.php?id=$player_id?message=image");
					}

					//check if certificate is empty
					if(empty($cert)){
						//upload the image only
						move_uploaded_file($_FILES['myimage']['tmp_name'], "$folder_image".$ran);
						//prepare sql statement
						$stmt = $conn->prepare("UPDATE players SET photo=? WHERE player_id=?");
						$stmt->bind_param('si',$ran,$player_id);

						//check if upload is succesful
						if($_FILES['myimage']['error'] !== UPLOAD_ERR_OK){
							die("Upload failed with error code " . $_FILES['file']['error']);
							header("location: ../player_profile_update.php?id=$player_id?message=upload");
						}
						header("location: ../player_profile_update.php?id=$player_id?message=success");

					}else{
						//upload both the image and cert
						move_uploaded_file($_FILES['myimage']['tmp_name'], "$folder_image".$ran);
						move_uploaded_file($_FILES['certificate']['tmp_name'], "$folder_cert".$ran_cert);

						$stmt = $conn->prepare("UPDATE players SET photo=?,birth_certificate=? WHERE player_id=?");
						$stmt->bind_param('ssi',$ran,$ran_cert,$player_id);

						if(($_FILES['myimage']['error'] !== UPLOAD_ERR_OK) || ($_FILES['certificate']['error'] !== UPLOAD_ERR_OK) ){
						   die("Upload failed with error code " . $_FILES['file']['error']);
						   header("location: ../player_profile_update.php?id=$player_id?message=upload");
						}
					}

				}

				if($stmt->execute() === TRUE ){
					echo "it worked";
					header("location: ../player_profile_update.php?id=$player_id?message=success");
				}else{
					echo "error <br>".$conn->error;
					//server error
					header("location: ../player_profile_update.php?id=$player_id?server=error");
				}	
				

				

}