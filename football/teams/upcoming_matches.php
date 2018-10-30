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
					<h2 style="margin-left:25%; margin-right:25%;">Upcoming Team Matches</h2>
			</div>
		</div>
		<!--CONTENT IS HERE-->
			  	<table class="table">
						<tr>
							<th>Fixture Id</th>
							<th>League Id</th>
							<th>Team A</th>
							<th></th>
							<th>Team B </th>
							<th>Date of Match</th>
							<th>Referee</th>
							<th>Venue</th>
						</tr>

						<?php
							//$query2 = "SELECT * FROM match_fixtures ORDER BY match_fixture_id desc LIMIT $offset,$limit ";
							$query2 = "SELECT * FROM match_fixtures  WHERE team1_id='$team_id' or team2_id='$team_id' ORDER BY match_fixture_id desc ";

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
							<td><?php echo $match_date; ?></td>
							<td><?php echo $ref_name; ?></td>
							<td><?php echo $venue;?></td>
							
							
						</tr>

						<?php
						//close loop
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