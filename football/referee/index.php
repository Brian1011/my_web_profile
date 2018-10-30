<?php
	//check if the sessions exists
	//start a session
	session_start();

	//$_SESSION['uname']; 
	if(isset($_SESSION['ref'])){
?>


<?php 
	include 'header.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/custom_css.css">
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
	<!--THIS IS THE LANDING PAGE -->
	<div class="content">
	<div class="container">
		<div class="row" id="profile_page">
			<?php
						//check for an error
						$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

						if(strpos($url,'message=server_error')){
							echo 
							"
								<div class='alert alert-danger'>
									<span class='glyphicon glyphicon-remove'></span>
										Error Cannot Change Profile...Contact Admin
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
										Phone Number digits have to be 10
								</div>
							";
						}

						if(strpos($url,'message=good')){
							echo 
							"
								<div class='alert alert-success'>
									<span class='glyphicon glyphicon-ok'></span>
										Your Profile Has been Changed
								</div>
							";
						}

						if(strpos($url,'message=success')){
							echo 
							"
								<div class='alert alert-success'>
									<span class='glyphicon glyphicon-ok'></span>
										Your Password has been changed
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

						if(strpos($url,'message=length')){
							echo 
							"
								<div class='alert alert-danger'>
									<span class='glyphicon glyphicon-remove'></span>
										Passwords cannot be less than 5 characters
								</div>
							";
						}

						if(strpos($url,'message=unmatch')){
							echo 
							"
								<div class='alert alert-danger'>
									<span class='glyphicon glyphicon-remove'></span>
										Your new Passwords do not much
								</div>
							";
						}

						if(strpos($url,'message=incorrect')){
							echo 
							"
								<div class='alert alert-danger'>
									<span class='glyphicon glyphicon-remove'></span>
										Enter the correct current password
								</div>
							";
						}

						if(strpos($url,'message=server')){
							echo 
							"
								<div class='alert alert-danger'>
									<span class='glyphicon glyphicon-remove'></span>
										Server error update function...Contact Admin immeadiately
								</div>
							";
						}

			?>
			<div class="col-lg-2">
				
			</div>

			<div class="col-lg-4">
				<div class="panel panel-default">
					<div class="panel-body">
						 <img
						 	src= <?php echo $profile_image; ?>
						  height="100%" width="100%">
					</div>

					<div class="panel-footer">
						 NAME: <?php echo $ref_name; ?> <br>
						 USERNAME: <?php echo $ref_uname; ?> <br>
					</div>
				</div>

			</div>

			<div class="col-lg-1">
				
			</div>

			<div class="col-lg-4">
				<div class="panel panel-default">
					<div class="panel-body">
						REFEREE Id: <?php echo $ref_id; ?><br>
						PHONE: <?php echo $ref_phone; ?> <br>
						EMAIL: <?php echo $ref_mail; ?> <br>
					</div>
				</div>

				<DIV class="panel panel-default">
					<div class="panel-body">
						Click The Button Below to edit your profile<br><br>
						 <button class="btn btn-primary" data-toggle="modal" data-target="#mymodal">Edit Your Profile</button>
					</div>
				</DIV>	

				<DIV class="panel panel-default">
					<div class="panel-body">
							Click The Button Below to change your password<br><br>
						 <button class="btn btn-primary" data-toggle="modal" data-target="#password_module">Change password</button>
					</div>
				</DIV>	
			</div>

			<!--Password Modal-->
				<div id="password_module" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Change your password</h4>
				      </div>

				      <div class="modal-body">

				        <form action="includes/changepassword.inc.php" method="POST" class="form">

				        	Current/Old Password<input type="password" name="old" class="form-control" required><br>
				        	New Password<input type="password" name="pass1" class="form-control" required><br>
				        	Re-Type New Password<input type="password" name="pass2" class="form-control" required><br>
				        	<input type="hidden" name="uname" value=<?php echo$ref_uname; ?> >
				        	<center><button type="submit" class="btn btn-primary">Save Changes</button></center>

				        </form>

				      </div>
				    </div>

				  </div>
				</div>
			<!--End of Password Modal-->

<!--MODAL-->
		<div id="mymodal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				
<!--MODAL CONTENT-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
        			<center><h4 class="modal-title">EDIT YOUR PROFILE</h4></center>
        			UNAME: <?php echo $ref_uname; ?><br>
				</div>

					<div class="modal-body">
<!--UPDATE FORM HERE-->
						<center><img id="output_image" src=<?php echo $profile_image; ?> class="image_profile_update"></center>
						<form method="post" action="includes\changeprofile.inc.php" enctype="multipart/form-data">
							<input type="file" name="myimage" accept="image/*" onchange="preview_image(event)" style="color:white; background-color:green; width:400px;">
							NAME: 
							<input type="text" name="full_name" class="form-control" value='<?php echo $ref_name; ?>' ><br>
							PHONE:
							<input type="text" name="phone" class="form-control" value=<?php echo $ref_phone; ?>><br>
							EMAIL:
							<input type="text" name="mail" class="form-control" value=<?php echo $ref_mail; ?>><br>
							<input type="hidden" name="username" value=<?php echo $ref_uname; ?> >
							<input type="hidden" name="official_id" value=<?php echo $ref_id; ?>>
							<input type="hidden" name="profile_image" value=<?php echo $default_image; ?>>

							<center><button type="submit" class="btn btn-primary" id="button1">SUBMIT CHANGES</button><br></center>
						</form>
					</div>
			</div>	

			</div>
		</div>
	</div>
</BR>
</BR>
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