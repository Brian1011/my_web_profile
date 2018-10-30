<?php
	//check if the sessions exists
	//start a session
	session_start();

	//$_SESSION['uname']; 
	if(isset($_SESSION['coach'])){
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

	<script type="text/javascript">
		
	//I prefer it being external ...upload an image and see it
			function preview_cert(event) 
		{
		 var reader = new FileReader();
		 reader.onload = function()
		 {
		  var output = document.getElementById('cert_output_image');
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
					<h1 style="margin-left:30%">REGISTER NEW PLAYER</h1>
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
										Records cannot be empty. Make sure you submit an image and the certificate
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
										Username cannot be less than 4 and Password cannot be less than 5
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

    		<div style="margin-left:10%; margin-right:10%; ">
				<div class="row">
					<DIV class="col-lg-10">
						<div>
							<div class="panel panel-default">
								<!--INPUT FORM IS HERE-->
							<form class="form" action="includes/reg_player.inc.php" method="post" enctype="multipart/form-data">
								<div class="panel-body">
									<div class="row">
										<div class="col-lg-6">
											<div class="panel panel-default">
												<div class="panel-body">
													<center><img src="user.png" class="img-thumbnail img-responsive" height="400px" width="300px" id="output_image" alt="profile image"></center>
												</div>

												<div class="panel-footer">
													Player Image<br><br>
													<input type="file" name="myimage" accept="image/*" onchange="preview_image(event)" style="color:white; background-color:green; width:100%;">
												</div>
											</div>
										</div>

										<div class="col-lg-6">
											<div class="panel panel-default">
												<div class="panel-body">
													<center><img src="user.png" class="img-thumbnail img-responsive" height="400px" width="300px" id="cert_output_image" alt="certificate"></center>
												</div>

												<div class="panel-footer">
													Birth Certificate<br><br>
													<input type="file" name="certificate" accept="image/*" onchange="preview_cert(event)" style="color:white; background-color:green; width:100%;">
												</div>
											</div>
										</div>
									</div>
									
								</div>

								<div class="panel-footer">
										<div style="margin-right:20%; margin-left:20%;">
											Full Name: <input type="text" name="fname" class="form-control" required><br>
											Phone Number:<input type="text" name="phone" class="form-control" required><br>
											Email Address:<input type="text" name="mail" class="form-control" required><br>
											Position:
												<select class="form-control" name="position">
													<option value="Striker">Striker</option>
													<option value="Defender">Defender</option>
													<option value="GoalKeeper">GoalKeeper</option>
													<option value="Midfield">Midfield</option>
												</select><br>
											Team:
												<select class="form-control" name="team">
													<option value="A">Team A</option>
													<option value="B">Team B</option>
												</select><br>
											 Date Player Joined:<br><input type="date" name="date_joined" value="" required class="form-control">
											<input type="hidden" name="team_id" value=<?php echo $team_id; ?>><br>
											<center><button type="submit" class="btn btn-primary">Submit Details</button></center>
										</div>	

								</form>
							</div>
						</div>
					
					</DIV>
				</div>
					
			</div>
		
  		</div>
	</div>
</div>
	
		<footer class="footer">
			<?php
				include 'footer.php';
			?>
		</footer>
	
</body>
</html>
<?php
	}else{
		header("location: ../login/index.php?message=login");
	}
?>