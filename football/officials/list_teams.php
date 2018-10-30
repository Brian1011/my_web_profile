<?php
	session_start();
	//check if the sessions exists
	if(isset($_SESSION['uname'])){

?>

	<?php
		include 'header.php';
		//connection file is here

		//declare type of user
		$usertype = 'team';

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
		}

		.form{
			text-decoration:none;
		}
		.form a:hover{
			text-decoration:none;
		}

	</style>
	<link rel="stylesheet" type="text/css" href="css/common.css">

</head>
<body>
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="page-header">
						<center><h1>LIST OF TEAMS </h1></center>
				</div>
					<?php
							//check for an error
							$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

							//get any message that has been passed through url...
							//such as a new password
							if(strpos($url,'newpass')){

								//get the password and referee id

							//if ($_GET['newpass']){
								//get the new password 
								//$newpass = $_GET['newpass'];

								//check if the session is set
								if(isset($_SESSION['team_id'])){
									//create a varible to hold the referee identification
									$temp_name = $_SESSION['team_id'];
									$newpass = $_SESSION['team_new_pass'];
								
								echo 
								"
									<div class='alert alert-success'>
										<span class='glyphicon glyphicon-ok'></span>
											The Team with the username: <b>$temp_name</b> ,Password has been changed to <b>$newpass</b>
									</div>
								";
								}
							//}

								}
							
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
											The Team has been registered under a league
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

					$total = $conn->query('
				        SELECT
				            COUNT(*)
				        FROM
				            team
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
			
				?>
						<table class="table">
							<tr>
								<th>Profile Image</th>
								<th>Team Id</th>
								<th>Username</th>
								<th>Name</th>
								<th>Contact</th>
								<th>Players/Stats</th>
								<center><th>Reset Password</th></center>
								<center><th>Erase Record</th></center>
						</tr>
							<?php
									$query2 = "SELECT * FROM team  ORDER BY team_id desc LIMIT $offset,$limit ";

							$result = $conn->query($query2);
							
							if(! $result){
								echo "Error".mysqli_error($conn);
							}

							//get the data
							while($row = mysqli_fetch_array($result)) {

								//get the teams that are not enrolled
								$team_id = $row['team_id'];
								$team_name = $row['team_name'];
								$gender = $row['gender'];
								$constituency =$row['constituency'];
								$team_uname =$row['uname'];
								$team_image = $row['image'];
								$team_phone = $row['phone'];

							//check if profile image is empty

							if(empty($team_image)){
								//its empty load default
								$team_profile_image = 'user.png';
							}else{
								//image exists
								$team_profile_image = "../teams/logo/".$team_image;
							}		
					?>		

							<tr>
								<td>
									<img
									src= <?php echo $team_profile_image;?>
									width='40px' height='40px' alt='profile pic'>
								</td>
								<td><?php echo $team_id; ?></td>
								<td><?php echo $team_uname; ?></td>
								<td><?php echo $team_name; ?></td>
								<td><?php echo $team_phone; ?></td>
								<td>
									<a href="list_teams_2.php?id=<?php echo $team_id; ?>" class="form"><button class="btn btn-default">View Players</button></a>
								</td>

								<td>
									<!--Reset Password Form-->
									<form method="POST" action="includes/list_users.update.password.php">
										<input type="hidden" name="team_id" value=<?php echo $team_id; ?>>
										<input type="hidden" name="usertype" value=<?php echo $usertype; ?> >
										<input type="hidden" name="team_uname" value=<?php echo $team_uname; ?>>
										<button type="submit" class="btn btn-info">Reset</button>
									</form>
								</td>

								<td>
									<!--Delete Form-->
									<form method="POST" action="includes/list_users.del.php">
										<input type="hidden" name="team_id" value=<?php echo $team_id; ?>>
										<input type="hidden" name="usertype" value=<?php echo $usertype; ?> >
										<input type="hidden" name="team_uname" value=<?php echo $team_uname; ?>>
										<button type="submit" class="btn btn-danger"><span class='glyphicon glyphicon-trash'></span></button>
									</form>

								</td>

								
							</tr>
						<?php
						//close the while loop
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
