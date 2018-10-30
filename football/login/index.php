<!DOCTYPE html>
<html>
<head>
	<title></title>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

		<style type="text/css">
			.row{
				margin-top:80px;
			}

			form{
				border:1px solid white;
			}

			#login_content{
				background: rgba(255, 255, 255, 0.2);
				padding:20px;
			}
			#login_content:hover{
				background: rgba(255, 255, 255, 0.8);
				transition: background 0.40s ease-in-out;
			}
			#button1{
				height:50px;
				font-size:30px;
				width:80%;
				
			}
			#button2{
				height:50px;
				font-size:30px;
				width:80%;
				background-color:#2F4F4F;
				color:white;
			}
			#button2:hover{
				background-color:red;
			}

			*{
				font-style:Tahoma;
			}
			body{
				height:662px;
				background-image: url("football.jpeg");
				background-repeat: no-repeat;
    			background-size:100% 100%;
			}
			.container{
				height:100%;
			}
			
			a:hover {
			    text-decoration: none;
			    color:white;
			}
			a:link{
				text-decoration: none;
				color:white;
			}

			a:visited {
			    text-decoration: none;
			    color:white;
			}


			a:active {
			    text-decoration: none;
			    color:white;
			}

		</style>

</head>
<body>
	<div class="container" >
		<div class="row">
			<div class="col-lg-4">
				
			</div>


			<div class="col-lg-4">
				<form action="includes/login_inc.php" method="POST">

					<div id="login_content">
						<?php
						//check for an error
							$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

							if(strpos($url,'message=error')){
								echo 
								"
									<div class='alert alert-danger'>
										<span class='glyphicon glyphicon-remove'></span>
											Invalid <b>Username</b> or <b>Password</b>
									</div>
								";
							} 

							if(strpos($url,'message=empty')){
								echo 
								"
									<div class='alert alert-danger'>
										<span class='glyphicon glyphicon-remove'></span>
											The fields cannot be empty
									</div>
								";
							}
							if(strpos($url,'message=logout')){
								echo 
								"
									<div class='alert alert-success'>
									<span class='glyphicon glyphicon-ok'></span>
										Your Have succesfully loged out
								</div>
								";
							} 
							if(strpos($url,'message=login')){
								echo 
								"
									<div class='alert alert-danger'>
									<span class='glyphicon glyphicon-remove'></span>
										Your Have to login to continue
								</div>
								";
							}
							if(strpos($url,'message=inactive')){
								echo 
								"
									<div class='alert alert-danger'>
										<span class='glyphicon glyphicon-remove'></span>
											Your Account has been frozen. Contact the admin
									</div>
								";
							}  
						?>
						<div class="form-group">
							<label>USERNAME:<br></label>
							<input type="text" name="uname" class="form-control" placeholder="Enter username" required>
						</div>

						<div class="form-group">
							<label>PASSWORD:<br></label>
							<input type="password" name="pass" class="form-control" placeholder="Enter password" required><br>
						</div>
								<center><button type="submit" class="btn btn-success btn-block" id="button1">LOGIN</button><br></center>
								<center>
									<a href="../">
										<button class="btn btn-block" id="button2"><a href="../"> CANCEL</a></button><br></center>	
									</a>
						</div>
					</div>
				</form>
			</div>


			<div class="col-lg-4">
				
			</div>
			
		</div>
	</div>
</body>
</html>