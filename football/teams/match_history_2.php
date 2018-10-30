<?php
	//check if the sessions exists
	//start a session
	session_start();

	//$_SESSION['uname']; 
	if(isset($_SESSION['coach'])){
?>

	<?php
		include 'header.php';

		//get the match id
		if (isset($_GET['id'])){
			$match_id = $_GET['id'];
		}
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
		
	</style>
	<link rel="stylesheet" type="text/css" href="css/common.css">
</head>
<body>
	<div class="content">
	<div class="container">
		<?php
			//select data based on the fixture id
			$sql = "SELECT scores,match_results.team_id,match_results.league_id,team.team_name,match_fixtures.match_date as matchdate FROM match_results LEFT JOIN team ON match_results.team_id=team.team_id LEFT JOIN match_fixtures on match_results.team_id=match_fixtures.team1_id or match_results.team_id=match_fixtures.team2_id WHERE match_results.match_fixture_id='$match_id' GROUP BY team_id";
			$result = $conn->query($sql);

			//check if ant data is found
			if($result->num_rows>0){

				//select date for the match
				$sql1 = "SELECT match_date,league_id from match_fixtures WHERE match_fixture_id='$match_id'";
				$result1 = $conn->query($sql1);
				$row1 = mysqli_fetch_assoc($result1);
				$match_date = $row1['match_date'];
				$league_id = $row1['league_id'];

			?>
			<div class="row">
			<div class="page-header">
					<h1 style="margin-left:40%">MATCH STASTICS</h1>
					LEAGUE ID: <?php echo $league_id; ?><br>
					
			</div>
			<div style="margin-left:25%; margin-right:25%; ">
				<b>MATCH Fixture ID:</b> <?php echo $match_id;?><br>
				<b>MATCH DATE:</b> <?php echo $match_date;?><br>

			<table>
				<?php
					//loop through the query
					$total_scores= 0 ; 
					while($row = mysqli_fetch_assoc($result)){
						$team_name = $row['team_name'];
						$score = $row['scores'];
						$team_id = $row['team_id'];
						$total_scores = $total_scores +$score;
				?>
				
					<b><?php echo $team_name ?></b>
					 <?php echo " : ".$score; ?><br>
				<?php
					}
				?>
				
			</table>
			<b>Total Number of goals scored</b><?php echo ":".$total_scores; ?><br>
				<div id="matchstats">
				
				<b><center><h3>Goal Scorers:</h3></center></b><br>

					<table class="table" >
						<tr>
							<th>Player Id </th>
							<th>Player Name</th>
							<th>Time</th>
							<th>Team </th>
						</tr>

						<?php
							//get data as a join
							//get who scored when
							$sql = "select player_stats.player_id,player_stats.match_fixture_id,players.name, player_stats.team_id,player_stats.goals,player_stats.match_time,team.team_name from player_stats LEFT JOIN team ON player_stats.team_id=team.team_id LEFT JOIN players ON player_stats.player_id=players.player_id WHERE match_fixture_id='$match_id' and goals=1 ORDER BY match_time asc ";
							$result3 = $conn->query($sql);

							//loop through it
							while($row2 = mysqli_fetch_assoc($result3)){
								$player_id = $row2['player_id'];
								$player_name = $row2['name'];
								$match_time = $row2['match_time'];
								$team_name = $row2['team_name'];
							//display it
						?>

						<tr class="success">
							<td><?php echo $player_id; ?></td>
							<td><?php echo $player_name; ?></td>
							<td><?php echo $match_time; ?></td>
							<td><?php echo $team_name; ?></td>
						</tr>
						<?php
							}
						?>
					</table>

				<b><center><h3><br>Red/yellow Card</h3></center></b><br>
					<table class="table">
						<tr>
							<th>Player Id</th>
							<th>Name</th>
							<th>Team</th>
							<th>Time</th>
							<th>Card</th>
						</tr>
						<?php 
							//select the cards and their type
							//loop through the data
							$sql = "select player_stats.player_id,player_stats.match_fixture_id,players.name,player_stats.match_time,player_stats.cards, team.team_name from player_stats LEFT JOIN team ON player_stats.team_id=team.team_id LEFT JOIN players ON player_stats.player_id=players.player_id WHERE match_fixture_id='$match_id' and (cards<> '') ORDER BY match_time asc";
							$result = $conn->query($sql);

							while($row = mysqli_fetch_assoc($result)){
								$player_id = $row['player_id'];
								$player_name = $row['name'];
								$team_name = $row['team_name'];
								$match_time = $row['match_time'];
								$card_type = $row['cards'];
						?>
						<tr  class="info">
							<td><?php echo $player_id; ?></td>
							<td><?php echo $player_name; ?></td>
							<td><?php echo $team_name; ?></td>
							<td><?php echo $match_time; ?></td>
							<td><?php echo $card_type; ?></td>
						</tr>

						<?php
							}
						?>

						
					</table>
					<br>
					<b><center><h3>Injured Players</h3></center></b><br>
					<table class="table">
						<tr>
							<th>Player Id</th>
							<th>Player Name </th>
							<th>Team</th>
							<th>Time</th>
						</tr>
							<?php
								//select data based on the player id
								//select injured players
								$sql = "select player_stats.player_id,player_stats.match_fixture_id,players.name,player_stats.match_time,team.team_name from player_stats LEFT JOIN team ON player_stats.team_id=team.team_id LEFT JOIN players ON player_stats.player_id=players.player_id WHERE match_fixture_id='$match_id' and injured='yes' ORDER BY match_time asc";
								$result = $conn->query($sql);

								while($row = mysqli_fetch_assoc($result)){
								//loop through data
								
									$player_id = $row['player_id'];
									$player_name = $row['name'];
									$team_name = $row['team_name'];
									$match_time = $row['match_time'];
							?>
								<tr class="danger">
									<td><?php echo $player_id; ?></td>
									<td><?php echo $player_name; ?></td>
									<td><?php echo $team_name; ?></td>
									<td><?php echo $match_time; ?></td>
								</tr>
							<?php
								}
							?>
					</table>
				</div>

		</div>
		<?php
			}else{
				//no data has been found
				//user might have edited the code
		?>
		<div style="min-height: 100%;">
			<div class="panel panel-primary" >
		    		<div class="panel-heading" >
		    			<h4><b>ERROR 101: No such Record Exists</b></h4>
		    			
		    		</div>

		    		<div class="panel-body">
		    			<center>
		    				Use The results under the history/league table to select an existing record.<br>
				    	Click the button below to view history results
		    			</center>
				    	
				    	<a href="match_history.php">
				    		<center><button class="btn btn-primary">Match History</button></center>
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

	<footer class="footer">
		<?php 
			include 'footer.php';
		?>
	</footer>
</body>
<?php
	}else{
		header("location: ../login/index.php?message=login");
	}
?>
