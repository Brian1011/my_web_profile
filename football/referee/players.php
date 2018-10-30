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
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<style type="text/css">
		form{

		}
		 a{
			text-decoration:none;
			color:white;
		}
		 a:hover{
			text-decoration:none;
			color:white;
		}
		a:active{
			text-decoration:none;
			color:white;
		}
		a:visited{
			text-decoration:none;
			color:white;
		}
		
	</style>
</head>
<body>
	<div class="content">
	<div class="container">
		<div class="row">
			<div class="page-header">
					<center><h1>LIST OF REGISTERED PLAYERS </h1></center>
			</div><br>
					
						<form action="players.php" method="GET"> 
							  <div class="row">
							  	<div class="col-xs-6 col-md-4">
							  		
							  	</div>
							    <div class="col-xs-6 col-md-4">
							      <div class="input-group">
									   <input type="text" class="form-control" placeholder="Search" id="txtSearch" name="search" />
									   <div class="input-group-btn">
									        <button class="btn btn-primary" type="submit">
									        	<span class="glyphicon glyphicon-search"></span>
								        	</button>
							   			</div>
							   		</div>
							    </div>
							  </div>
						</form><br>

						<?php
							//if get is empty run this
							//select the player details from the db

							//check if the user has searched for any item

							if(isset($_GET['search'])){
								$searched_player = $_GET['search'];

								//change the query also
								$query ="SELECT players.player_id,players.name,players.photo,players.current_team_id,team.team_name FROM players LEFT JOIN team ON players.current_team_id = team.team_id where players.name LIKE'%$searched_player%' ORDER by player_id asc";

								//pagination query changes
								$query_pagination = "SELECT COUNT(players.name) as total, players.player_id,players.name FROM players LEFT JOIN team ON players.current_team_id = team.team_id where players.name LIKE'%$searched_player%' ORDER by player_id asc";
							}else{
								//else select all players
								$query ="SELECT players.player_id,players.name,players.photo,players.current_team_id,team.team_name FROM players LEFT JOIN team ON players.current_team_id = team.team_id ORDER by player_id asc";

								//pagination will be
								$query_pagination = "SELECT COUNT(*) FROM players";
							}
							
							$result = $conn->query($query);

							if($result ->num_rows>0){
								//display data
								//loop through the data
							?>
				<?php			
				$total = $conn->query($query_pagination)->fetch_row()[0];

			    // How many items to list per page
			    $limit = 10;

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
										<th>Profile Image</th>
										<th>Player Id</th>
										<th>Player Name</th>
										<th>Current Team Name</th>
										<th>View</th>
									</tr>
							<?php

								//display the data
								while($row = mysqli_fetch_array($result)){
									$player_name = $row['name'];
									$player_id = $row['player_id'];
									$image = $row['photo'];
									$team = $row['team_name'];

									//check if image is empty
									if(empty($image)){
										//default image should load
										$profile = "../teams/players/user.png";
									}else{
										//load image from the db
										$profile = "../teams/players/".$image;
									}

							?>
								
									<tr>
										<td>
												<img
												src= <?php echo $profile;?>
												width='40px' height='40px' alt='profile pic'>
											</td>
											<td><?php echo $player_id; ?></td>
											<td><?php echo $player_name; ?></td>
											<td><?php echo $team; ?></td>
											<td>
									<a href="player_profile_update.php?id=<?php echo $player_id ?>"><button type="submit" class="btn btn-primary">View</button></a>		
								</td>
									</tr>
							<?php
								}
								//close the loop
							?>

						</table>

						<?php
							}else{
						?>
							<div style="min-height: 100%;">
							<div class="panel panel-primary" >
						    		<div class="panel-heading" >
						    			<h4><b>Results Not Found</b></h4>
						    		</div>

						    		<div class="panel-body">
								    	Make sure you type in the correct Player name.
						    		</div>
						    </div>
						 </div>
						<?php
								//close the if statement
							}
						?>
			</div>
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