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
	<style type="text/css">
		 #results a{
			text-decoration:none;
			color:white;
		}
		#results a:hover{
			text-decoration:none;
			color:white;
		}
		#results a:active{
			text-decoration:none;
			color:white;
		}
		#results a:visited{
			text-decoration:none;
			color:white;
		}
		p{
			font-size:18px;
		}
		
	</style>
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
			<?php

			if(isset($_GET['id'])){
				$player = $_GET['id'];
			}

			//select from the db
				$sql = "SELECT * FROM `players` WHERE player_id = '$player' ";
				$result = $conn->query($sql);

				//check the number of rows
				if($result ->num_rows>0){
						//display data
						//loop through the data
					$row = mysqli_fetch_array($result);
						$player_name = $row['name'];
						$player_id = $row['player_id'];
						$image = $row['photo'];
						$cert = $row['birth_certificate'];
						$contacts = $row['phone'];
						$mail = $row['email'];
						$Position = $row['position'];

						if(empty($image)){
							$profile = "../teams/players/user.png";
						}else{
							$profile = "../teams/players/".$image;
						}

						//check if there is a certificate
						if(empty($cert)){
							$cert_image = "../teams/cert/user.png";
						}else{
							$cert_image = "../teams/cert/".$cert;
						}
			?>

			<div class="row">
				<div class="page-header">
						<h1 style="margin-left:25%">PLAYER'S PAGE</h1>
						<?php
									//check for an error
									$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
									
									if(strpos($url,'message=success')){
										echo 
										"
											<div class='alert alert-success'>
												<span class='glyphicon glyphicon-ok'></span>
													The changes made have been saved sucessfully
											</div>
										";
									} 

									if(strpos($url,'message=empty')){
										echo 
										"
											<div class='alert alert-danger'>
												<span class='glyphicon glyphicon-remove'></span>
													Records cannot be empty. Make sure you submit an image or a certificate
											</div>
										";
									}

									if(strpos($url,'message=upload')){
										echo 
										"
											<div class='alert alert-danger'>
												<span class='glyphicon glyphicon-remove'></span>
													Image/file could not be uploaded try again later or contact the adminstrator
											</div>
										";
									}

									if(strpos($url,'message=image')){
										echo 
										"
											<div class='alert alert-danger'>
												<span class='glyphicon glyphicon-remove'></span>
													Invalid image file for profile picture. Use a jpeg,jpg or png.
											</div>
										";
									}

									if(strpos($url,'server=error')){
										echo 
										"
											<div class='alert alert-danger'>
												<span class='glyphicon glyphicon-remove'></span>
													Changes cannot be made at the moment
											</div>
										";
									}

						?>
				</div>
			</div>

				<ul class="nav nav-tabs">
			  <li class="active"><a data-toggle="tab" href="#home">Player Profile</a></li>
			  <li><a data-toggle="tab" href="#menu1">Player Game Stats</a></li>
			  
			</ul>

			<div class="tab-content">
			  	<div id="home" class="tab-pane fade in active">
			    		<div class="row">
								<DIV class="col-lg-10">
									<div>
										<div class="panel panel-default">
											<!--INPUT FORM IS HERE-->
										
											<div class="panel-body">
												<div class="row">
													<div class="col-lg-6">
															<form class="form" action="includes/player_update.php" method="post" enctype="multipart/form-data">

																<center><img src=<?php echo $profile;?> class="img-thumbnail img-responsive" height="400px" width="300px" id="output_image" alt='player image'>
																</center><br>

																<center>Player Image</center><br>
																
																<input type="file" name="myimage" accept="image/*" onchange="preview_image(event)" style="color:white; background-color:grey; width:100%;"><hr>
																
																<div style="border-top:5px solid white">
																	<br>
																	<center><img src=<?php echo $cert_image;?> class="img-thumbnail img-responsive" height="400px" width="300px" id="cert_output_image" alt='player certificate'></center>

																	<br><center>Birth Certificate</center><br>
																	
																	<input type="file" name="certificate" accept="image/*" onchange="preview_cert(event)" style="color:white; background-color:grey; width:100%;"><br>

																	<center>
																		<button class="btn btn-primary">Submit Changes</button>
																	</center>
																</div>
																<input type="hidden" name="player_id" value=<?php echo $player_id; ?>>
															</form>
													</div>

													<div class="col-lg-6">
															<p>Player ID:</p> <h1><?php echo $player_id;?><br></h1><br>
															<p>Full Name:</p>  <h1><?php echo $player_name ;?></h1><br>
															<p>Phone Number:</p> <h1><?php echo $contacts ;?></h1><br>
															<p>Email:</p> <h1><?php echo $mail ;?></h1><br>
															<p>Position:</p>  <h1><?php echo $Position ;?></h1><br>
													</div>

													<div class="panel-footer">

													</div>
												</div>
											</div>
										</form>
										</div>
									</div>
								</DIV>
							</div>
			  	</div>

				  <div id="menu1" class="tab-pane fade">
				    
				    <div class="panel panel-primary">
				    		<div class="panel-heading" >
				    			<h4>Player Stats</h4>
				    		</div>

				    		<?php
				    			//get the players info

				    			//total number of goals scored by this player
				    			$query1 = "SELECT COUNT(goals) as total FROM `player_stats` WHERE player_id='$player' ";
				    			$total_goals = $conn->query($query1)->fetch_row()[0];

				    			//total number of red cards recieved
				    			$query2 = "SELECT COUNT(cards) as total FROM player_stats WHERE player_id='$player' and cards ='red'";
				    			$total_red = $conn->query($query2)->fetch_row()[0];

				    			//total number of red cards recieved
				    			$query3 = "SELECT COUNT(cards) as total FROM player_stats WHERE player_id='$player' and cards ='yellow'";
				    			$total_yellow = $conn->query($query3)->fetch_row()[0];

				    			//total number of times injured
				    			$query4 = "SELECT COUNT(injured) as total FROM player_stats WHERE player_id='$player' and injured ='yes'";
				    			$total_injuries = $conn->query($query4)->fetch_row()[0];

				    		?>

				    		<div class="panel-body">
						    	<b>Total Goals scored: </b><?php echo $total_goals; ?><br><br>
						    	<b>Total Red Cards: </b><?php echo $total_red; ?> <br><br>
						    	<b>Total Yellow Cards: </b><?php echo $total_yellow; ?> <br><br>
						    	<b>Number of times injured: </b><?php echo $total_injuries; ?> <br><br>
						    	<!--
						    		<b>Ref Comments:</b> HE IS A GOOD DEFENDER<BR>
						    	-->
				    		</div>
				    </div>

				  </div>

				  <?php
				  	//no data found
					}else{
				?>
						<div style="min-height: 100%;" id='results'>
								<div class="panel panel-primary" >
									 <div class="panel-heading" >
									    	<h4><b>Results Not Found</b></h4>
									  </div>

									   <div class="panel-body">
											    	Check the players in the players table.<br><br>
											    	Click Below to view the list of players<br><br>
											    	<a href="list_players.php">
											    		<center><button type="submit" class="btn btn-primary">List of Players</button></center>
											    	</a>

									    </div>
								 </div>
						</div>
				<?php
					}
				  ?>
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