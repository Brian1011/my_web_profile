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
	<link rel="stylesheet" type="text/css" href="css/common.css">
</head>
<body>
	<div class="content">
	
	<div class="container">
		<div class="row">
			<div class="page-header">
					<h2 style="margin-left:25%; margin-right:25%;">Previous Played Games</h2>
			</div>
		</div>
<!--CONTENT IS HERE-->
						<table class="table">
			    		<tr>
							<th>Match Fixture Id</th>
							<th>Date</th>
							<th>Team A</th>
							<th>Results</th>
							<th>Team B</th>
							<th>View Statistics</th>
						</tr>

			  					<?php
									//select from match fixtures where league id is given
									//$query9 = "select * from match_fixtures where league_id='$league_id' ORDER BY match_date desc LIMIT $offset,$limit ";
			    					$query9 = "SELECT * FROM `match_fixtures` where team1_id='$team_id' or team2_id='$team_id' ORDER BY match_date desc";
									$result9 = $conn->query($query9); 
									
									//get the teams involved in the match fixtures with the id
									//match id
									while($row9 = mysqli_fetch_assoc($result9)){
										//get the teams involved in the match
										$match_fixture_id = $row9['match_fixture_id'];
										$match_date = $row9['match_date'];
										$team1 = $row9['team1_id'];
										$team2 = $row9['team2_id'];

										//echo "Match fixture id: ".$match_fixture_id."<br>";
										//echo "Team 1: ".$team1;
										//echo " Team 2: ".$team2;
										//echo " <br>";
										//get the team names
										//team 1 name
										$query10 ="select * from team where team_id='$team1' "; 
										$result10 = $conn->query($query10);
										$row10 = mysqli_fetch_assoc($result10);
										$team1_name = $row10['team_name'];

										//team 2 name
										$query11 ="select * from team where team_id='$team2' "; 
										$result11 = $conn->query($query11);
										$row11 = mysqli_fetch_assoc($result11);
										$team2_name = $row11['team_name'];

										//get the results by use of the match id
										//team 1 scores
										$query12 = "select * from match_results where match_fixture_id='$match_fixture_id' and team_id='$team1' ";
										$result12 = $conn->query($query12);

										//check if the match fixture exists in the match results table
										if($result12 ->num_rows>0){
										$row12 =  mysqli_fetch_assoc($result12);
										$team1_scores = $row12['scores'];
										$match_id = $row12['match_result_id'];
										
										//echo "team 1 score: ".$team1_scores;
										//echo "<br>";
										//team 2 scores
										$query13 = "select * from match_results where match_fixture_id='$match_fixture_id' and team_id='$team2' ";
										$result13 = $conn->query($query13);
										$row13 =  mysqli_fetch_assoc($result13);
										$team2_scores = $row13['scores'];
										//echo "Team 2 score: ".$team2_scores;
										//echo "<br>";
										
										//echo "match id is: ".$match_id."<br>";
										//echo "<br>";
										//echo "<br>";

						?>
						

						<tr>
							<?php
								//start a session
								//store the league id
								//$_SESSION['league_id']=$league_id;
							?>
							<td><?php echo $match_fixture_id; ?></td>
							<td><?php echo $match_date; ?></td>
							<td><?php echo $team1_name; ?></td>
							<td><?php echo $team1_scores; ?>:<?php echo $team2_scores; ?></td>
							<td><?php echo $team2_name; ?></td>
							<td>
								<a href="match_history_2.php?id=<?php echo $match_fixture_id; ?>"><button class="btn btn-primary" color:white;">View</button></a>
								</td>
							</td>
						</tr>
						<?php

									}else{
										//no match fixture found in the results table
						?>			
										
						<?php
									
								}
							}
						?>

					</table>
						
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
