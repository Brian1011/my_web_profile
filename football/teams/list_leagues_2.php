<?php
	session_start();
	//check if the sessions exists
	if(isset($_SESSION['coach'])){

?>

	<?php
		include 'header.php';

		//get id from url
		if (isset($_GET['id'])){
			$id = $_GET['id'];
		}

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
			<?php
		   		$query1 = "SELECT * FROM league where league_id='$id' ";
				//$stmt = $conn->prepare('SELECT * FROM referee ORDER BY ref_id LIMIT $limit,$offset');

				$result = $conn->query($query1);
				//$retval = mysqli_query($query1, $conn);

				//incase the user changes the url avoid errors
				//do this by running an sql statement 

				if($result ->num_rows>0){
					//display data
						
						if(! $result){
							echo "Error".mysqli_error($conn);
						}

						//get the data
						while($row = mysqli_fetch_array($result)) {
							$league_id = $row['league_id'];
							$official_id = $row['official_id'];
							$league_name = $row['league_name'];
							$start_date = $row['start_date'];
							$end_date = $row['end_date'];
						}
		   			?>
					<h2 style="margin-left:0%">League Id: <?php echo $league_id; ?> </h2>
					<h2 style="margin-left:0%">League Name: <?php echo $league_name; ?></h2>
			</div>
		</div>
<!--CONTENT TABS-->
			<ul class="nav nav-tabs">
			  <li class="active"><a data-toggle="tab" href="#home">League Ranking Results</a></li>
			  <li><a data-toggle="tab" href="#menu1">Team vs Team Results</a></li>
			  <li><a data-toggle="tab" href="#menu2">League Fixtures</a></li>
			</ul>

<!--CONTENT IS HERE-->
			<div class="tab-content">
			  <div id="home" class="tab-pane fade in active"><br>
			  	<?php	
				$total = $conn->query("
			        SELECT
			            COUNT(*)
			        FROM
			            league_team where league_id='$league_id'
			    ")->fetch_row()[0];

			    // How many items to list per page
			    $limit = 5;

			    // How many pages will there be
			    $pages = ceil($total / $limit);

			    // What page are we currently on?
			    $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
			        'options' => array(
			            'default'   => 1,
			            'min_range' => 1,
			        ),
			    )));


			    // Calculate the offset for the query
			    $offset = ($page - 1)  * $limit;

			    // Some information to display to the user
			    $start = $offset + 1;
			    $end = min(($offset + $limit), $total);

			    // The "back" link
			    $prevlink = ($page > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

			    // The "forward" link
			    $nextlink = ($page < $pages) ? '<a href="?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

			    // Display the paging information
			    echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $total, ' results ', $nextlink, ' </p></div>';
		
			
			?>
			   		<table class="table">
			   			<tr>
							<th>Team Id</th>
							<th>Team Name</th>
							<th>Points</th>
							<th>Number of Games played</th>
							<th>Number of goals scored</th>	
						</tr>

			   	
			   			<?php

			   			//use joins to retrieve data
			   			//really amazing
			   			$query2 = "SELECT match_results.team_id,SUM(points) as POINTS,COUNT(points) as total_games,SUM(scores) as SCORES,team.team_name as name FROM match_results LEFT JOIN team ON match_results.team_id=team.team_id WHERE league_id='$league_id' GROUP BY team_id ORDER BY team_id LIMIT $offset,$limit ";


			   			$query3 = "SELECT match_results.team_id,SUM(points) as POINTS,COUNT(points) as total_games,SUM(scores) as SCORES,team.team_name as name FROM match_results LEFT JOIN team ON match_results.team_id=team.team_id WHERE league_id='$league_id' GROUP BY team_id ORDER BY points desc";

						$result1 = $conn->query($query3);
						
						if(! $result1){
							echo "Error".mysqli_error($conn);
						}else{

						//get the data
						while($row = mysqli_fetch_assoc($result1)){

							//get the teams that are not enrolled
							//5 lines of code summarised to one line

							//its a join between two tables
							$games_played = $row['total_games'];
							$team_name =$row['name'];
							$team_id = $row['team_id'];
							$points = $row['POINTS'];
							$total_scores = $row['SCORES'];
						?>
						<tr>
							<td><?php echo $team_id; ?></td>
							<td><?php echo $team_name; ?></td>
							<td><?php echo $points; ?></td>
							<td><?php echo $games_played; ?></td>
							<td><?php echo $total_scores; ?></td>
						</tr>

						<?php
							
							}
						}
						?>
					</table>
			  </div>
			  	<div id="menu2" class="tab-pane fade"><br>
 						<table class="table">
						<tr>
							<th>Match Fixture Id</th>
							<th>League Id</th>
							<th>Team A</th>
							<th></th>
							<th>Team B </th>
							<th>Date of Match</th>
							<th>Referee</th>
							<th>Venue</th>
						</tr>

						<?php
							$query2 = "SELECT * FROM match_fixtures where league_id='$league_id' ORDER BY match_fixture_id  desc LIMIT $offset,$limit ";

							$result = $conn->query($query2);
							
							if(! $result){
								echo "Error".mysqli_error($conn);
							}
							

							//get the data
							while($row = mysqli_fetch_array($result)) {

								//get the teams that are not enrolled
								$match_fixture_id = $row['match_fixture_id'];
								$match_date = $row['match_date'];
								$league_id = $row['league_id'];
								$referee_id =$row['referee_id'];
								$venue =$row['venue'];
								$team1_id = $row['team1_id'];
								$team2_id = $row['team2_id'];
								
								//check if the match has already taken place
								$query6 = "select * from match_results where match_fixture_id='$match_fixture_id' ";
								$result6 = $conn->query($query6);
								if($result6->num_rows > 0){
									
								}else{

								//select the names of the teams from the team table
								$sql2 = "select team_name from team where team_id = '$team1_id' ";
								$result2 = $conn->query($sql2);
								$row2 = mysqli_fetch_assoc($result2);
								$team1_name = $row2['team_name'];

								//select the second team name from the teams table
								$sql3 = "select team_name from team where team_id = '$team2_id' ";
								$result3 = $conn->query($sql3);
								$row3 = mysqli_fetch_assoc($result3);
								$team2_name = $row3['team_name'];

								//select the referee name
								$sql4 = "select ref_name from referee where ref_id = '$referee_id' ";
								$result4 = $conn->query($sql4);
								$row4 = mysqli_fetch_assoc($result4);
								$ref_name = $row4['ref_name'];
						?>		
						
						<tr>
							<td><?php echo $match_fixture_id; ?></td>
							<td><?php echo $league_id; ?></td>
							<td><?php echo $team1_name; ?></td>
							<td>vs</td>
							<td><?php echo $team2_name; ?></td>
							<td>
									<?php echo $match_date; ?>	
								</td>
							<td>
									<?php echo $ref_name; ?>
							</td>
							<td>
								<?php echo $venue;?>
							</td>
							

							
						</tr>

						<?php
						//close loop
								}
							}
						?>
					</table>
			
				</div>

		<div id="menu1" class="tab-pane fade"><br>
			  <?php	
			  /*
				$total = $conn->query("
			        SELECT
			            COUNT(*)
			        FROM
			            match_fixtures where league_id='$league_id'
			    ")->fetch_row()[0];

			    // How many items to list per page
			    $limit = 5;

			    // How many pages will there be
			    $pages = ceil($total / $limit);

			    // What page are we currently on?
			    $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
			        'options' => array(
			            'default'   => 1,
			            'min_range' => 1,
			        ),
			    )));


			    // Calculate the offset for the query
			    $offset = ($page - 1)  * $limit;

			    // Some information to display to the user
			    $start = $offset + 1;
			    $end = min(($offset + $limit), $total);

			    // The "back" link
			    $prevlink = ($page > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

			    // The "forward" link
			    $nextlink = ($page < $pages) ? '<a href="?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

			    // Display the paging information
			    echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $total, ' results ', $nextlink, ' </p></div>';
			    */
				?>
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
	$query9 = "select * from match_fixtures where league_id='$league_id' ORDER BY match_date desc ";
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
								$_SESSION['league_id']=$league_id;
							?>
							<td><?php echo $match_fixture_id; ?></td>
							<td><?php echo $match_date; ?></td>
							<td><?php echo $team1_name; ?></td>
							<td><?php echo $team1_scores; ?>:<?php echo $team2_scores; ?></td>
							<td><?php echo $team2_name; ?></td>
							<td>
								<a href="match_results_teams212.php?id=<?php echo $match_fixture_id; ?>"><button class="btn btn-primary" color:white;">View</button></a>
								</td>
							</td>
						</tr>
						<?php
									}else{
										//no match fixture found in the results table
									}
								}
						?>

					</table>
				</div>
			</div>
		
	
		
	<?php
	}else{
		//no such league exists
	?>
		<div style="min-height: 100%;">
			<div class="panel panel-primary" >
		    		<div class="panel-heading" >
		    			<h4><b>ERROR 101: No such League Exists</b></h4>
		    			
		    		</div>

		    		<div class="panel-body">
				    	Use The results under the league table to select an existing league.
				    	You can also contact the admin incase of any issue.
		    		</div>
		    </div>
		 </div>
	<?php
	}
	?>
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