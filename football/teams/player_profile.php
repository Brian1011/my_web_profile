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

	<?php


	?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/common.css">
</head>
<body>
	<div class="content">
		
		<div class="container">

					<div class="row">
						<div class="page-header">
								<h1 style="margin-left:25%">PLAYER'S PAGE</h1>

						</div>
					</div>

						<ul class="nav nav-tabs">
			  <li class="active"><a data-toggle="tab" href="#home">Player Profile</a></li>
			  <li><a data-toggle="tab" href="#menu1">Player Match Stats</a></li>
			  
			</ul>

			<div class="tab-content">
			  	<div id="home" class="tab-pane fade in active">
			    		<div style="margin-left:10%; margin-right:10%; ">
							<div class="row">
								<DIV class="col-lg-8">
									<br>
									<?php
									//check for an error
									$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
									
									if(strpos($url,'message=good')){
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
													Records cannot be empty. Make sure you submit an image and the certificate
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
												$player_status = $row['player_status'];
												$Position = $row['position'];
												$team = $row['sub_team'];

												if(empty($image)){
													$player_profile = "players/user.png";
												}else{
													$player_profile = "players/".$image;
												}

												//check if there is a certificate
												if(empty($cert)){
													$cert_image = "cert/user.png";
												}else{
													$cert_image = "cert/".$cert;
												}
									?>

									
									<div>

										<div class="panel panel-default">
											<div class="panel-body">
												<center><img src=<?php echo $player_profile;?> class="img-thumbnail img-responsive" height="400px" width="300px" id="output_image" alt='player image'></center>
												Player_id: <?php echo $player_id;?><br>
												Current_team_id: <?php echo $team_id; ?><br>
											</div>

											<div class="panel-footer">
													
												<form class="form" style="margin-right:20%; margin-left:20%;" action="includes/player_update.php" method="post">
													Full Name: <input type="text" name="fname" class="form-control" value=<?php echo $player_name ;?>><br>
													Phone Number:<input type="text" name="phone" class="form-control" value=<?php echo $contacts ;?>><br>
													Email Address:<input type="text" name="mail" class="form-control" value=<?php echo $mail ;?>><br>
													Position:
														<select class="form-control" name="position">
															<option value=<?php echo $Position;?>><?php echo $Position ;?></option>
															<option value="Striker">Striker</option>
															<option value="Defender">Defender</option>
															<option value="GoalKeeper">GoalKeeper</option>
															<option value="Midfield">Midfield</option>
														</select><br>
													<?php

													if($player_status === 'Alumni'){

													}else{
													?>
														Status:
															<select class="form-control" name="status">
																<option value=<?php echo $player_status; ?> ><?php echo $player_status; ?></option>
																<option value='Alumni'>Alumni</option>
															</select><br>

															Team:
															<select class="form-control" name="team">
																<OPTION value=<?php echo $team; ?>><?php echo $team; ?></OPTION>
																<option value="A"> A</option>
																<option value="B"> B</option>
															</select><br>
															<input type="hidden" name="team_id" value=<?php echo $team_id; ?>><br>
															<input type="hidden" name="player" value=<?php echo $player_id; ?>>
													<?php
														}
													?>
													<center><button type="submit" class="btn btn-primary">Submit Changes</button></center>	
												</form>
											</div>
										</div>
									</div>
								</DIV>
								
								<div class="col-lg-4">
									<div class="panel panel-default">
										<div class="panel-body">
											<center><img src=<?php echo $cert_image;?> class="img-thumbnail img-responsive" height="400px" width="300px" id="cert_output_image" alt='player certificate'></center>
										</div>

										<div class="panel-footer">
											Birth Certificate
										</div>
									</div>
									
								</div>
							</div>
								
						</div>
					
			  	</div>

				  <div id="menu1" class="tab-pane fade">
				    <h3>Players Stats Page</h3> 
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
								    	<a href="index.php">
								    		<center><button type="submit" class="btn btn-primary">List of Players</button></center>
								    	</a>

						    </div>
					 </div>
			</div>
	<?php
		}
	  ?>
	
	</BR>
	</div>
	</div>
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