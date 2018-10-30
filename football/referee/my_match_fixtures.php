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
		
	</style>
	<link rel="stylesheet" type="text/css" href="css/common.css">
</head>
<body>
	<div class="content">
		
	
	<div class="container">
		<div class="row">
			<div class="page-header">
					<center><h1>LIST OF MY MATCH FIXTURES </h1></center>
			</div><br>
			
					<table class="table">
						<tr>
							<th>Fixture Id</th>
							<th>League ID</th>
							<th>Team A</th>
							<th></th>
							<th>Team B</th>
							<th>Match Date</th>
							<th>Referee Name</th>
							<th>Venue</th>
							<th>View</th>
						</tr>
						<?php	
				$total = $conn->query("
			        SELECT
			            COUNT(*)
			        FROM
			            match_fixtures where referee_id='$ref_id'
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

			   if($total == 0){
				//display an error
				?>
				<div style="min-height: 100%;">
					<div class="panel panel-primary" >
						<div class="panel-heading" >
							<h4><b>No Games at the moment</b></h4>
							    			
						</div>

						<div class="panel-body">
							You have not been assigned any game at the moment.
							You can also contact the admin incase of any issue.
						</div>
					</div>
				</div>

				<?php

				}else{

					/*

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



						<?php
							//get todays date
							$today = date("Y-m-d");
							//$query2 = "SELECT * FROM match_fixtures where referee_id='$ref_id' and match_date>'$today' or match_date='$today'  ORDER BY match_fixture_id LIMIT $offset,$limit";
							//$query2 = "SELECT * FROM match_fixtures where referee_id=$ref_id and (match_date>'$today' or match_date='$today')  ORDER BY match_fixture_id";
							$query2 = "SELECT * FROM match_fixtures where referee_id=$ref_id and (match_date>'$today' or match_date='$today')  ORDER BY match_date asc";

							$result = $conn->query($query2);
							
							//very important line
							if(! $result){
								echo "Error".mysqli_error($conn);
							}
							
							if($result ->num_rows>0){
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
								$query6 = "select * from match_results where match_fixture_id='$match_fixture_id'";
								$result6 = $conn->query($query6);
								//if($result6->num_rows > 0){
									
								//}else{

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
							<td><?php echo $match_fixture_id; ?>
								<?php //echo //$today; ?>
							</td>
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
							<td>
								<?php
									//if date is not today then you cant view
									if($match_date === $today){
										//you cannot view
								?>
									<a href="my_match_fixtures_2.php?id=<?php echo $match_fixture_id; ?>">
										<button class="btn btn-primary">View</button>
									</a>
								<?php
									}else{
										//calculate days left
										$finish = strtotime($match_date);
										$todays = strtotime($today);

										$diff = $finish - $todays;
										$days_left = floor($diff/(60*60*24));
								?>
									You cannot view.<br><?php echo $days_left;?> days left
								<?php
									}
								?>
							</td>
						</tr>

						<?php
						//close loop
									//}
							}
						?>
						<?php 
			}else{
		?>

			You do not have any set match at the moment

		<?php
			}

		}
		?>
					</table>

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