<?php
	//check if the sessions exists
	//start a session
	session_start();

	//$_SESSION['uname']; 
	if(isset($_SESSION['ref'])){
?>
<?php
		include 'header.php';

		if (isset($_GET['id'])){
			$match_fixture_id = $_GET['id'];
		
	?>
<!DOCTYPE html>
<html>
<head>	<title></title>
	<style type="text/css">
		form{

		}
		form a{
			text-decoration:none;
			color:white;
		}
		form a:hover{
			text-decoration:none;
			color:white;
		}
		.card{
			display:inline-block;
			margin-left:5px;
			margin-bottom:5px;
			margin-top:5px;
			border:1px solid #ccc;
		}
		.card:hover{
			border: 1px solid black;
		}
		.card img{
			transition: all 1s ease;
		}
		.card img:hover{
			transform:scale(1.25);
		}
	</style>
	<link rel="stylesheet" type="text/css" href="css/common.css">
</head>
<body>
	<div class="content">
	<div class="container">
		<?php
			//get the match fixture id
			//get data from the database
			$sql = "SELECT * FROM `match_fixtures` WHERE match_fixture_id= '$match_fixture_id'";
			$result = $conn->query($sql);

			if(!$result){
					echo "Error".mysqli_error($conn);
				}
					
			if($result ->num_rows>0){
				//get the data
				$row = mysqli_fetch_assoc($result);
				$match_fixture_id = $row['match_fixture_id'];
				$match_date = $row['match_date'];
				$team1_id = $row['team1_id'];
				$team2_id = $row['team2_id'];
				$league_id = $row['league_id'];
				$comments = $row['comments'];

				//get the team names

				//team 1 name
				//$sql2 = "SELECT 'match_results.scores','team.team_name' FROM match_results left JOIN team ON 'match_results.team_id' = 'team.team_id' WHERE 'match_results.team_id'=3 and match_fixture_id=1";
				$sql = "SELECT team_name FROM `team` WHERE team_id='$team1_id'";
				$result2 = $conn->query($sql);
				$row1 = mysqli_fetch_assoc($result2);
				$team1_name = $row1['team_name'];
				//get the team scores

				//team1 one scores
				$sql = "SELECT points,scores from match_results where team_id='$team1_id' and match_fixture_id=$match_fixture_id";
				$result = $conn->query($sql);
				$row2 = mysqli_fetch_assoc($result);
				$team1_scores= $row2['scores'];
				$team1_points = $row2['points'];

				//team 2 name
				$sql = "SELECT team_name FROM `team` WHERE team_id='$team2_id'";
				$result = $conn->query($sql);
				$row2 = mysqli_fetch_assoc($result);
				$team2_name = $row2['team_name'];

				//team2 score
				$sql = "SELECT points,scores from match_results where team_id='$team2_id' and match_fixture_id=$match_fixture_id";
				$result = $conn->query($sql);
				$row2 = mysqli_fetch_assoc($result);
				$team2_scores= $row2['scores'];
				$team2_points = $row2['points'];
		?>

		<div class="row">
			<div class="page-header">
					<h1 style="margin-left:40%">SET MATCH RESULTS</h1>
					LEAGUE ID: <?php echo $league_id; ?>
			</div>
		</div>

		<div style="margin-left:5%; margin-right:5%; ">

			<ul class="nav nav-tabs">
			  <li class="active"><a data-toggle="tab" href="#home">Match Fixture</a></li>
			  <li><a data-toggle="tab" href="#menu1"><?php echo $team1_name ?> Players</a></li>
			  <li><a data-toggle="tab" href="#menu2"><?php echo $team2_name ?> Players</a></li>
			</ul>

			<div class="tab-content" >
				<!--LANDING PAGE-->
			  <div id="home" class="tab-pane fade in active">
			  	<br><br>
			  		<?php
						//check for an error
						$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

						if(strpos($url,'message=server_error')){
							echo 
							"
								<div class='alert alert-danger'>
									<span class='glyphicon glyphicon-remove'></span>
										Cannot make changes at the moment
								</div>
							";
						}

						if(strpos($url,'message=red')){
							echo 
							"
								<div class='alert alert-danger'>
									<span class='glyphicon glyphicon-remove'></span>
										<b>Error</b> The player has been issued a red card in this game
								</div>
							";
						}

						if(strpos($url,'message=injury')){
							echo 
							"
								<div class='alert alert-danger'>
									<span class='glyphicon glyphicon-remove'></span>
										<b>Error</b> The player got an injury within this game therefore this changes cannot persist
								</div>
							";
						}


						if(strpos($url,'message=sucess')){
							echo 
							"
								<div class='alert alert-success'>
									<span class='glyphicon glyphicon-ok'></span>
										Changes have been made sucessfully
								</div>
							";
						} 

					?>
			  		<div style="margin-left:20%; margin-right:20%; ">
							<b>MATCH FIXTURE ID:</b> <?php echo $match_fixture_id; ?><br>
							<b>REF ID:</b> <?php echo $ref_id; ?><br>
							<b>Date Of Match:</b> <?php echo $match_date; ?><br>
							<b><?php echo $team1_name; ?><?php echo " : ".$team1_scores."  "; ?>Points: <?php echo $team1_points; ?></b>
							<br> vs <br>
							<b><?php echo $team2_name ?><?php echo " : ".$team2_scores."  "; ?>Points: <?php echo $team2_points; ?></b><br><br>
						<?php
								//check if there are players within both teams
								//and if both are active
							//team 1 count
						$sql = "SELECT COUNT(players.player_id) as total_players FROM `players` WHERE players.current_team_id = '$team1_id' and player_status = 'active'";
							$result = $conn->query($sql);
							list($team1_count) = $result->fetch_row();

							//team 2 count
						$sql = "SELECT COUNT(players.player_id) as total_players FROM `players` WHERE players.current_team_id = '$team2_id' and player_status = 'active'";
							$result = $conn->query($sql);
							list($team2_count) = $result->fetch_row();


						if( ($team1_count == 0) || ($team2_count == 0) ){
									//then do not display anything
							//check which team specifically

						?>


						<div class="panel panel-primary" >
					    		<div class="panel-heading" >
					    			<h4><b>ERROR 101: One team has no or few players</b></h4>
					    		</div>

					    		<div class="panel-body">
					    			View the list of players of each team from the above tabs.<br>
					    			
					    			Contact the coach responsible for that team.

					    		</div>
					    </div>
							

						<?php

						}else{



						?>
							<!--Team 1 id-->
							<h1>Team: <?php echo $team1_name ?></h1><hr>
							<form class="form" style="margin-left:20%; margin-right:20%;" action="includes/match_results.inc.php" method="post">
								Select Player<br>
								<select class="form-control" name="team1_player">
									<?php
										//select all players
										$sql = "SELECT player_id,name,current_team_id FROM `players` WHERE current_team_id='$team1_id' and player_status='active'";
										$result = $conn->query($sql);

										//loop through the records
										while($row = mysqli_fetch_assoc($result)){
											$player_id = $row['player_id'];
											$player_name = $row['name'];
											$current_team_id = $row['current_team_id'];
									?>
										<option value="<?php echo $player_id; ?>"><?php echo $player_name; ?></option>
									<?php
										}
									?>
									
								</select><br>

								Select Activity
								<select class="form-control" name="activity">
									<option value='yellow'>Yellow Card</option>
									<option value='red'>Red Card</option>
									<option value='injury'>Injured</option>
									<option value='goal'>Scored Goal</option>
								</select>

								<center><br>
									<button class="btn btn-primary" type="submit">Submit</button><br><br>
								</center>

									<input type="hidden" name="location" value='one'>
									<input type="hidden" name="current_team_id" value=<?php echo $current_team_id;  ?> >
									<input type="hidden" name="team1_id" value=<?php echo $team1_id;  ?> >
									<input type="hidden" name="team2_id" value=<?php echo $team2_id;  ?> >
									<input type="hidden" name="league_id" value=<?php echo $league_id;  ?> >
									<input type="hidden" name="team1_scores" value=<?php echo $team1_scores;?> >
									<input type="hidden" name="team2_scores" value=<?php echo $team2_scores; ?> >
									<input type="hidden" name="team1_points" value=<?php echo $team1_points;  ?> >
									<input type="hidden" name="team2_points" value=<?php echo $team2_points;  ?> >
									<input type="hidden" name="match_fixture_id" value=<?php echo $match_fixture_id; ?>>
									<input type="hidden" name="ref_id" value=<?php echo $ref_id; ?> >
							</form>

							<!--Team 2 id-->
							<h1>Team: <?php echo $team2_name; ?></h1><hr>
							<form class="form" style="margin-left:20%; margin-right:20%;" action="includes/match_results.inc.php" method="post">
								Select Player<br>
								<select class="form-control" name="team1_player">
									<?php
										//select all players
										$sql = "SELECT player_id,name,current_team_id FROM `players` WHERE current_team_id='$team2_id' and player_status='active'";
										$result = $conn->query($sql);

										//loop through the records
										while($row = mysqli_fetch_assoc($result)){
											$player_id = $row['player_id'];
											$player_name = $row['name'];
											$current_team_id = $row['current_team_id'];
									?>
										<option value="<?php echo $player_id; ?>"><?php echo $player_name; ?></option>
									<?php
										}
									?>
								</select><br>

								Select Activity
								<select class="form-control" name="activity">
									<option value='yellow'>Yellow Card</option>
									<option value='red'>Red Card</option>
									<option value='injury'>Injured</option>
									<option value='goal'>Scored Goal</option>
								</select>

								<center><br>
									<button class="btn btn-primary">Submit</button>
								</center>

									<input type="hidden" name="location" value='one'>
									<input type="hidden" name="current_team_id" value=<?php echo $current_team_id;  ?> >
									<input type="hidden" name="team1_id" value=<?php echo $team1_id;  ?> >
									<input type="hidden" name="team2_id" value=<?php echo $team2_id;  ?> >
									<input type="hidden" name="league_id" value=<?php echo $league_id;  ?> >
									<input type="hidden" name="team1_scores" value=<?php echo $team1_scores;?> >
									<input type="hidden" name="team2_scores" value=<?php echo $team2_scores; ?> >
									<input type="hidden" name="team1_points" value=<?php echo $team1_points;  ?> >
									<input type="hidden" name="team2_points" value=<?php echo $team2_points;  ?> >
									<input type="hidden" name="match_fixture_id" value=<?php echo $match_fixture_id; ?>>
									<input type="hidden" name="ref_id" value=<?php echo $ref_id; ?> >
							</form>
							<br>
							<?php
								//if no activity is recorded we need to send a nil to the database
								if($team1_points == ''){
							?>
								<form action="includes/nil_match_results.inc.php" method="post">
									<h3>Incase no activity has been recorded i.e no red or yellow cards given, no injuries and no goals have been scored press the button below to submit the results as 0-0</h3>
									
									<input type="hidden" name="league_id" value=<?php echo $league_id;  ?> >
									<input type="hidden" name="ref_id" value=<?php echo $ref_id; ?> >
									<input type="hidden" name="match_fixture_id" value=<?php echo $match_fixture_id; ?>>
									<input type="hidden" name="team1_id" value=<?php echo $team1_id;  ?> >
									<input type="hidden" name="team2_id" value=<?php echo $team2_id;  ?> >
									<center><button class="btn btn-danger" type="submit">No activity recorded</button></center>
									<br><br>
								</form>
							<?php

								}

							}//close the if for checking students
							?>
							
							<!--
								<h1>Game comments</h1><hr>
								<form class="form" style="margin-left:20%; margin-right:20%;">
									Overall Game Comments
									<textarea cols="50" rows="5" name='comments'>
										<?php echo $comments; ?>
									</textarea><br>
									<center><button type="submit" class="btn btn-primary">Submit Changes</button></center><br>
								</form>
							-->
					</div>
			  </div>
			  	<!--TEAM 1 PLAYERS-->
				<div id="menu1" class="tab-pane fade">
					<!--Cards with images-->
					<?php
					//select all players
					$sql = "SELECT player_id,photo,position,name,current_team_id FROM `players` WHERE current_team_id='$team1_id' and player_status='active'";
					$result = $conn->query($sql);

					//loop through the records
					while($row = mysqli_fetch_assoc($result)){
						$player_id = $row['player_id'];
						$player_name = $row['name'];
						$player_position = $row['position'];
						$image = $row['photo'];

									//check if image is empty
									if(empty($image)){
										//default image should load
										$profile = "../teams/players/user.png";
									}else{
										//load image from the db
										$profile = "../teams/players/".$image;
									}
					?>
						<div class="card" style="width: 20rem; ">
					    	<img src="<?php echo $profile;?>" alt="player's Image" style="width:100%; height:100%;" class="img-responsive">

					    	<div class="card-block">
					    		<h4>Player Id: <?php echo $player_id; ?></h4>
					    		<h4>Name: <?php echo $player_name; ?></h4>
					    		<h4>Position: <?php echo $player_position; ?></h4>
					    	</div>
					    </div>
					<?php
						}
					?>
				</div>

				<!--TEAM 2 PLAYERS-->
				<div id="menu2" class="tab-pane fade">
				    <?php
					//select all players
					$sql = "SELECT player_id,photo,position,name,current_team_id FROM `players` WHERE current_team_id='$team2_id' and player_status='active'";
					$result = $conn->query($sql);

					//loop through the records
					while($row = mysqli_fetch_assoc($result)){
						$player_id = $row['player_id'];
						$player_name = $row['name'];
						$player_position = $row['position'];
						$image = $row['photo'];

									//check if image is empty
									if(empty($image)){
										//default image should load
										$profile = "../teams/players/user.png";
									}else{
										//load image from the db
										$profile = "../teams/players/".$image;
									}
					?>
						<div class="card" style="width: 20rem; ">
					    	<img src="<?php echo $profile;?>" alt="player's Image" style="width:100%; height:100%;" class="img-responsive">

					    	<div class="card-block">
					    		<h4>Player Id: <?php echo $player_id; ?></h4>
					    		<h4>Name: <?php echo $player_name; ?></h4>
					    		<h4>Position: <?php echo $player_position; ?></h4>
					    	</div>
					    </div>
					<?php
						}
					?>
				</div>
			</div>

				
		</div>

	<?php
			}else{
	?>
		<div style="min-height: 100%;">
			<div class="panel panel-primary" >
		    		<div class="panel-heading" >
		    			<h4><b>ERROR 101: No such Record Exists</b></h4>
		    		</div>

		    		<div class="panel-body">
		    			The record you are looking for does not exists.<br>
				    	You can contact the admin incase of any issue.<br>
				    	Click the button below to view your fixtures <br>
				    	<a href="my_match_fixtures.php"><button class="btn btn-primary">My fixtures</button></a>
		    		</div>
		    </div>
		 </div>

	<?php
			}
			}else{
	?>
		<div style="min-height: 100%;">
			<div class="panel panel-primary" >
		    		<div class="panel-heading" >
		    			<h4><b>ERROR 101: No such Record Exists</b></h4>
		    		</div>

		    		<div class="panel-body">
		    			The record you are looking for does not exists.<br>
				    	You can contact the admin incase of any issue.<br>
				    	Click the button below to view your fixtures <br>
				    	<a href="my_match_fixtures.php"><button class="btn btn-primary">My fixtures</button></a>
		    		</div>
		    </div>
		 </div>
	<?php
		}
	?>

	</div>

		</div>

	
		<?php 
			include 'footer.php';
		?>
	
</body>
<?php
	}else{
		header("location: ../login/index.php?message=login");
	}
?>