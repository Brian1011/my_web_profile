<?php
	session_start();
	//check if the sessions exists
	if(isset($_SESSION['uname'])){

?>


	<?php
		include 'header.php';

		//declare type of user
		$usertype = 'fixture';
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
						<center><h1>LIST OF TEAM FIXTURES </h1></center>
				</div><br>
					<?php
							//check for an error
							$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

							if(strpos($url,'message=server_error')){
								echo 
								"
									<div class='alert alert-danger'>
										<span class='glyphicon glyphicon-remove'></span>
											Error Cannot Change Make Changes at the momement...Contact Admin
									</div>
								";
							}

							if(strpos($url,'message=success')){
								echo 
								"
									<div class='alert alert-success'>
										<span class='glyphicon glyphicon-ok'></span>
											Changes Made Successfully
									</div>
								";
							}

							if(strpos($url,'message=dels')){
								echo 
								"
									<div class='alert alert-success'>
										<span class='glyphicon glyphicon-ok'></span>
											Record Has Been Erased Successfully
									</div>
								";
							}

							if(strpos($url,'error=erase')){
								echo 
								"
									<div class='alert alert-danger'>
										<span class='glyphicon glyphicon-remove'></span>
											The referee has a fixture to supervise / Has supervised a match before
									</div>
								";
							}


					?>
				<?php

						//pagination
						// Find out how many items are in the table
				    //$sql = 'SELECT COUNT(*) AS count FROM referee';
				    //$result = mysqli_query($conn, $sql);
				    //$row = mysqli_fetch_assoc($result);
				    //$total = $row['count'];

				/*

					$total = $conn->query('
				        SELECT
				            COUNT(*)
				        FROM
				            match_fixtures
				    ')->fetch_row()[0];

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
					
			<div>

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
								<th>Save Changes</th>
								<th>Delete</th>
							</tr>

							<?php
								//$query2 = "SELECT * FROM match_fixtures ORDER BY match_fixture_id desc LIMIT $offset,$limit ";
								$query2 = "SELECT * FROM match_fixtures ORDER BY match_fixture_id desc ";

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
									<form action="includes/list_users.update.inc.php" method="POST">
										<!--BEGIN OF FORM-->
										<input type="date" name="match_date" value=<?php echo $match_date; ?> required class="form-control">	
									</td>
								<td>
									
										<select name='referee' class="form-control">
											<option value=<?php echo $referee_id; ?> ><?php echo $ref_name; ?></option>
											<?php 
							    			//get the ref from the database
							    			$query5 = "select * from referee";

											$result5 = $conn->query($query5);
											
											if(! $result5){
												echo "Error".mysqli_error($conn);
											}

											//get the data
											while($row5 = mysqli_fetch_array($result5)) {
											//get the referee id and referee name
											$ref_id = $row5['ref_id'];
											$ref_name = $row5['ref_name'];	

											if($ref_id == $referee_id){
												//so that the names do not appear twice
											}else{
										?>

										<option value=<?php echo $ref_id; ?>><?php echo $ref_name; ?></option>
										<?php
														}
													}
												
										?>
										</select>	
								</td>
								<td>
									<input type="text" name="venue" class="form-control" value=<?php echo $venue;?> required>
										
									</td>
								<td>
										<input type="hidden" name="usertype" value=<?php echo $usertype; ?>>
										<input type="hidden" name="match_fixture_id" value=<?php echo $match_fixture_id; ?>>
										<button type="submit" class="btn btn-primary">Save</button>
										<!--Where the form ends-->
									</form>
								</td>

								<td>
									<form action="includes/list_users.del.php" method="POST">
										<input type="hidden" name="usertype" value=<?php echo $usertype; ?>>
										<input type="hidden" name="match_fixture_id" value=<?php echo $match_fixture_id; ?>>
										<button type="submit" class="btn btn-danger"><span class='glyphicon glyphicon-trash'></span></button>
									</form>
								</td>
							</tr>

							<?php
							//close loop
									}
								}
							?>
						</table>
				</div>
			</div>

			<table>
				
			</table>
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