<?php
	session_start();
	//check if the sessions exists
	if(isset($_SESSION['uname'])){

?>

	<?php
		include 'header.php';
	?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript">
		
	//I prefer it being external ...upload an image and see it
			function preview_image(event) 
		{
		 var reader = new FileReader();
		 reader.onload = function()
		 {
		  var output = document.getElementById('output_image');
		  output.src = reader.result;
		 }
		 reader.readAsDataURL(event.target.files[0]);
		}

	</script>
	<link rel="stylesheet" type="text/css" href="css/common.css">
</head>
<body>
	<div class="content">
		<div class="container">

			<div class="row">
				<div class="page-header">
						<h1 style="margin-left:25%">REFEREE REGISTRATION</h1>
						<?php
							//check for an error
							$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
							if(strpos($url,'image_upload')){
							echo 
							"
								<div class='alert alert-danger'>
									<span class='glyphicon glyphicon-remove'></span>
										Image has not been uploaded. Please try again later.
								</div>
							";
							}

							if(strpos($url,'message=image')){
								echo 
								"
									<div class='alert alert-danger'>
										<span class='glyphicon glyphicon-remove'></span>
											Sorry, only  JPEG, PNG & GIF files are allowed as images.
									</div>
								";
							}

							if(strpos($url,'message=good')){
								echo 
								"
									<div class='alert alert-success'>
										<span class='glyphicon glyphicon-ok'></span>
											A new Record has been entered sucessfully
										
									</div>
								";
							} 

							if(strpos($url,'message=empty')){
								echo 
								"
									<div class='alert alert-danger'>
										<span class='glyphicon glyphicon-remove'></span>
											Records cannot be empty
									</div>
								";
							}

							if(strpos($url,'message=uname')){
								echo 
								"
									<div class='alert alert-danger'>
										<span class='glyphicon glyphicon-remove'></span>
											The username is being used. Begin with <b>ref</b>
									</div>
								";
							}

							if(strpos($url,'message=pass')){
								echo 
								"
									<div class='alert alert-danger'>
										<span class='glyphicon glyphicon-remove'></span>
											Username cannot be less than 4 and Password cannot be less than 6
									</div>
								";
							}

							if(strpos($url,'message=mail')){
								echo 
								"
									<div class='alert alert-danger'>
										<span class='glyphicon glyphicon-remove'></span>
											Invalid Email Address
									</div>
								";
							}

							if(strpos($url,'message=phone')){
								echo 
								"
									<div class='alert alert-danger'>
										<span class='glyphicon glyphicon-remove'></span>
											Phone Number cannot be <b>less</b> or <b>more</b> than 10. Enter Numbers Only 
									</div>
								";
							}

						?>
				</div>
			</div>

			<div style="margin-left:25%; margin-right:25%; ">
					<center><img id="output_image" src="user.png" class="image_profile_upload"></center>
					
					<form method="post" action="includes/reg_ref_inc.php" enctype="multipart/form-data">
						<input type="file" name="myimage" accept="image/*" onchange="preview_image(event)" style="color:white; background-color:green; width:400px;"><br>
						Referee Full Name: 
						<input type="text" name="full_name" class="form-control" required><br>
						Phone Number:
						<input type="text" name="phone" class="form-control" required><br>
						Email Address:
						<input type="text" name="mail" class="form-control" required><br>
						Username:
						<input type="text" name="uname" class="form-control" required><br>
						Password:
						<input type="password" name="pass" class="form-control" required><br>

						<center><button type="submit" class="btn btn-primary" id="button1">SUBMIT</button><br></center><br><br>
					</form>

				</div>

				<div class="col-lg-4">
					
				</div>
			</div>
			
		</div>
	</div>

	
		<?php
			include 'footer.php';
		?>
	
</body>
</html>
<?php
	}else{
		header("location: ../login/index.php?message=login");
	}
?>