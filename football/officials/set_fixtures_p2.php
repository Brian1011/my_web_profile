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
		//pass multiple values using ?
		if (isset($_GET['id'])){
			$id = $_GET['id'];
		}
		
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
	</style>
	<link rel="stylesheet" type="text/css" href="css/common.css">
</head>
<body>
	<div class="content">
		<div class="container">

			<div class="row">
				<div class="page-header">
						<h1 style="margin-left:40%">SET A MATCH</h1>
						<?php
			   				$query1 = "SELECT * FROM league where league_id='$id' ";
						    //$stmt = $conn->prepare('SELECT * FROM referee ORDER BY ref_id LIMIT $limit,$offset');

							$result = $conn->query($query1);
							//$retval = mysqli_query($query1, $conn);
							
							if(! $result){
								echo "Error".mysqli_error($conn);
							}

							//get the data
							while($row = mysqli_fetch_array($result)) {
								$league_id = $row['league_id'];
							}
						?>
						LEAGUE ID: <?php echo $league_id; ?>
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
							}else

							if(strpos($url,'message=success')){
								echo 
								"
									<div class='alert alert-success'>
										<span class='glyphicon glyphicon-ok'></span>
											A new match fixture has been set
									</div>
								";
							}else
							if(strpos($url,'message=empty')){
								echo 
								"
									<div class='alert alert-danger'>
										<span class='glyphicon glyphicon-remove'></span>
											Choose teams from the dropdown
									</div>
								";
							}else

							if(strpos($url,'message=same')){
								echo 
								"
									<div class='alert alert-danger'>
										<span class='glyphicon glyphicon-remove'></span>
											You have chosen the same team twice
									</div>
								";
							}else

							if(strpos($url,'message=dates')){
								echo 
								"
									<div class='alert alert-danger'>
										<span class='glyphicon glyphicon-remove'></span>
											You cannot choose an earlier date than today
									</div>
								";
							}



					?>
				</div>
			</div>

			<div style="margin-left:25%; margin-right:25%; ">
				<form method="post" action="includes/set.fixtures.php" >
					Select First Team
					<select class="form-control" name="first_team">
						<option value="empty">Select the first team</option>

						<!--We select teams form the database-->
						<?php 
			    			//collect data from the db based on the league id
			    			$query2 = "select * from league_team where league_id='$id' ";

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

							<option value=<?php echo $team_id; ?>><?php echo $team_name; ?></option>
							<?php
									}
							?>
						
					</select><br>
							<center>VS</center>

						Select Second Team:
					<select class="form-control" name="second_team">
							<option value="empty">Select The second Team</option>
							<?php 
				    			//collect data from the db based on the league id
				    			$query2 = "select * from league_team where league_id='$id' ";

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

								<option value=<?php echo $team_id; ?>><?php echo $team_name; ?></option>
								<?php
										}
								?>
					</select><br>

						Select a referee
					<select class="form-control" name="referee">
							<option value="empty">Select a Ref</option>
							<?php 
				    			//get the ref from the database
				    			$query2 = "select * from referee";

								$result = $conn->query($query2);
								
								if(! $result){
									echo "Error".mysqli_error($conn);
								}

								//get the data
								while($row = mysqli_fetch_array($result)) {
								//get the referee id and referee name
								$ref_id = $row['ref_id'];
								$ref_name = $row['ref_name'];	
							?>

							<option value=<?php echo $ref_id; ?>><?php echo $ref_name; ?></option>
							<?php
									}
							?>
					</select><br>

						Date Of Match
					<input type="date" name="match_date" required class="form-control">
					<input type="hidden" name="league_id" value=<?php echo $league_id; ?>>
						<br>Venue:
					<input type="text" name="venue" class="form-control" required><br>
					<center><button type="submit" class="btn btn-primary" id="button1">SUBMIT</button><br></center><br><br>
				</form>
			</div>

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