<?php
	session_start();
	//check if the sessions exists
	if(isset($_SESSION['uname'])){

?>

	<?php
		include 'header.php';
		//we also need to get the id

		//declare type of user
		$usertype = 'league';

		//get id from any page linked to this n
		//no need of a session
		//pass multiple values using ? or using &
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
				<h1 style="margin-left:25%">LEAGUE PAGE</h1>		
				<?php
		   				$query1 = "SELECT * FROM league where league_id='$id' ";
					    //$stmt = $conn->prepare('SELECT * FROM referee ORDER BY ref_id LIMIT $limit,$offset');

						$result = $conn->query($query1);
						//$retval = mysqli_query($query1, $conn);
						
						if(! $result){
							echo "Error".mysqli_error($conn);
						}

						//check if record eists
						if($result ->num_rows>0){

						//get the data
						while($row = mysqli_fetch_array($result)) {
							$league_id = $row['league_id'];
							$official_id = $row['official_id'];
							$league_name = $row['league_name'];
							$start_date = $row['start_date'];
							$end_date = $row['end_date'];
		   			?>
		   			<h3 style="margin-left:25%">LEAGUE ID: <?php echo $league_id; ?> </h3>
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

						if(strpos($url,'mesage=success')){
							echo 
							"
								<div class='alert alert-success'>
									<span class='glyphicon glyphicon-ok'></span>
										Changes Made Successfully
								</div>
							";
						}

						if(strpos($url,'mesage=empty')){
							echo 
							"
								<div class='alert alert-danger'>
									<span class='glyphicon glyphicon-remove'></span>
										Records Cannot be empty
								</div>
							";
						}

						if(strpos($url,'mesage=dates')){
							echo 
							"
								<div class='alert alert-danger'>
									<span class='glyphicon glyphicon-remove'></span>
										End Date cannot Be Earlier Than Start Date
								</div>
							";
						}

						if(strpos($url,'mesage=enrolled')){
							echo 
							"
								<div class='alert alert-success'>
									<span class='glyphicon glyphicon-ok'></span>
										A team Has been enrolled
								</div>
								
							";
						}
						if(strpos($url,'mesage=unenrol')){
							echo 
							"
								<div class='alert alert-danger'>
									<span class='glyphicon glyphicon-remove'></span>
										You can't remove this team because it has been assigned matches within this league
								</div>
								
							";
						}
						if(strpos($url,'message=dels')){
							echo 
							"
								<div class='alert alert-success'>
									<span class='glyphicon glyphicon-ok'></span>
										The record has been erased sucessfully
								</div>
								
							";
						}


				?>
			</div>
		</div>


		<ul class="nav nav-tabs">
			  <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
			  <li><a data-toggle="tab" href="#menu1">Enroll Team</a></li>
			  <li><a data-toggle="tab" href="#menu2">Registered Teams</a></li>
		</ul>

<!--THIS IS THE TAB CONTENT-->
		<div class="tab-content">
		  <div id="home" class="tab-pane fade in active">
		   	<div style="margin-left:25%; margin-right:25%; "><br><br>

		   			

				<form method="post" action="includes/list_users.update.inc.php"><BR>	
					League Name: 
					<input type="text" name="league_name" class="form-control" value=<?php echo $league_name; ?> required><br>
					Start Date:
					<input type="date" name="start_date" class="form-control"  value=<?php echo $start_date; ?> requiredd><br>
					End Date:
					<input type="date" name="end_date" class="form-control"  value=<?php echo $end_date; ?> ><br>
					<input type="hidden" name="league_id" value=<?php echo $league_id; ?> >
					<input type="hidden" name="usertype" value=<?php echo $usertype; ?>>
					<center><button type="submit" class="btn btn-primary" id="button1">SAVE CHANGES</button><br></center><br><br>
				</form>

				<?php
					}
				?>

			</div>
		  </div>

		  <div id="menu1" class="tab-pane fade"><br>
		  	<!--PAGINATION-->
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
			    $prevlink = ($page > 1) ? '<a href="?id='.($id).'$id?page=1" title="First page">&laquo;</a> <a href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

			    // The "forward" link
			    $nextlink = ($page < $pages) ? '<a href="?id='.($id).'?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

			    // Display the paging information
			    echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $total, ' results ', $nextlink, ' </p></div>';
					*/
				?>
		  	<!--PAGINATION-->
		  	<table class="table">
		  		<tr>
			  		<th>Team Id</th>
			  		<th>Team Name</th>
			  		<th>Constituency</th>
			  		<th>Category</th>
			  		<th>Enrol</th>
			  	</tr>

		    		<?php 
		    			//collect data from the db
		    			//$query2 = "SELECT * FROM team  ORDER BY team_id LIMIT $offset,$limit ";
		    			$query2 = "SELECT * FROM team  ORDER BY team_id";
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

							//select check to see if this team is registered under this league
							$query3 = "select * from league_team where team_id='$team_id' and league_id='$id'";
							$result1 = $conn->query($query3);

							if($result1->num_rows > 0){
								//it means this team is already enrolled under this league
								//display nothing
								//continue with the loop 
							}else{
								//its not enrolled then display it here
						?>
						<tr>
							<td><?php echo $team_id; ?></td>
							<td><?php echo $team_name; ?></td>
							<td><?php echo $constituency; ?></td>
							<td><?php echo $gender; ?></td>
							<td>
								<form action="includes/league.enrol.team.php?" method="post">
									<input type="hidden" name="team_id" value=<?php echo $team_id; ?>>
									<input type="hidden" name="league_id" value=<?php echo $league_id; ?>>
									<button type="submit" class="btn btn-primary">Enrol</button>
								</form>
							</td>
						</tr>

					<?php
							}
						}
		    		?>	
		</table>
		  </div>

		  <div id="menu2" class="tab-pane fade">
		  	<br><br>
		    		<table class="table">
						<tr>
							<th>Enrollment Id</th>
							<th>Team Id</th>
							<th>Team Name</th>
							<th>Coach Name</th>
							<th>Constituency</th>
							<th>Category</th>
							<th>Erase From League</th>
						</tr>
			<!--WRITTE A QUERY TO READ THE ALREADY REGISTERED TEAMS-->
			<!--do a pagination-->
			<?php	
				/*
				$total = $conn->query('
			        SELECT
			            COUNT(*)
			        FROM
			            league_team
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

			<?php 
		    			//collect data from the db based on the league id
		    			//$query2 = "select * from league_team where league_id='$id' ORDER BY team_id LIMIT $offset,$limit ";
						$query2 = "select * from league_team where league_id='$id' ORDER BY team_id";

						$result = $conn->query($query2);
						
						if(! $result){
							echo "Error".mysqli_error($conn);
						}

						$team_name;
						$gender;
						$constituency;

						//get the data
						while($row = mysqli_fetch_array($result)) {

							//get the teams that are not enrolled
							$enrol_id = $row['enrol_id'];
							$team_id = $row['team_id'];

							//get the names and any relevant data based on the team id
							$query4 = "select * from team where team_id='$team_id' ";
							$result7 = $conn->query($query4);

							$row1 = mysqli_fetch_array($result7);
								$team_name = $row1['team_name'];
								$gender = $row1['gender'];
								$constituency =$row1['constituency'];
								$coach = $row1['coach_name'];

							//select check to see if this team is registered under this league
							

			?>

						<tr>
							<td><?php echo $enrol_id; ?></td>
							<td><?php echo $team_id; ?></td>
							<td><?php echo $team_name; ?></td>
							<td><?php echo $coach; ?></td>
							<td><?php echo $constituency; ?></td>
							<td><?php echo $gender; ?></td>
							<td>
								<form action="includes/league.unenrol.php" method="POST">
										<input type="hidden" name="official_id" value=<?php echo $official_id; ?> >
										<input type="hidden" name="enrol_id" value=<?php echo $enrol_id; ?> >
										<input type="hidden" name="league_id" value=<?php echo $league_id; ?>>
										<input type="hidden" name="team_id" value=<?php echo $team_id; ?>>
										<button type="submit" class="btn btn-danger"><span class='glyphicon glyphicon-trash'></span></button>
								</form>
							</td>
						</tr>

					<?php
							}
					?>
					</table>
					
		  <?php
			}else{
		?>
			<div style="min-height: 100%;" id='results'>
					<div class="panel panel-primary" >
						 <div class="panel-heading" >
						    	<h4><b>Results Not Found</b></h4>
						  </div>

						   <div class="panel-body">
								    	Click Below to view the list of Leagues<br><br>
								    	<a href="list_league.php">
								    		<center><button type="submit" class="btn btn-primary">List of Leagues</button></center>
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