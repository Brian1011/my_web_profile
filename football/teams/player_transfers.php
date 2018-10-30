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
					<h1 style="margin-left:25%">PLAYER TRANSFERS</h1>
			</div>
		</div>


		<ul class="nav nav-tabs">
			  <li class="active"><a data-toggle="tab" href="#home">Transfer Player</a></li>
			  <li><a data-toggle="tab" href="#menu1">Transfer History</a></li>
		</ul>

<!--THIS IS THE TAB CONTENT-->
		<div class="tab-content">
		  <div id="home" class="tab-pane fade in active">
		   	<div style="margin-left:30%; margin-right:30%; "><br><br>
		   		<?php
						//check for an error
						$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
						
						if(strpos($url,'message=sucess')){
							echo 
							"
								<div class='alert alert-success'>
									<span class='glyphicon glyphicon-ok'></span>
										Player Has been transfered sucessfully
								</div>
							";
						} 

						if(strpos($url,'message=empty')){
							echo 
							"
								<div class='alert alert-danger'>
									<span class='glyphicon glyphicon-remove'></span>
										Records cannot be empty. Make sure you select a team and a player
								</div>
							";
						}

						if(strpos($url,'server=error')){
							echo 
							"
								<div class='alert alert-danger'>
									<span class='glyphicon glyphicon-remove'></span>
										We cannot make an update at the moment
								</div>
							";
						}

				?>
				<form method="post" action="includes/transfers.inc.php" method="POST"><BR>	

					Player Name:
					<select class="form-control" name="player_id">
						<option value="">Select Player</option>
					<?php
							$status = "active";
							$sql = "SELECT player_id,name,date_joined FROM `players` WHERE current_team_id=? and player_status=?";
							$stmt = $conn->prepare($sql);
							$stmt->bind_param("is",$team_id,$status);

							//execute statement
							$stmt->execute();

							//bind result variable
							$stmt->bind_result($player_id,$name,$start_date);

							//fetch the results
							while($stmt->fetch()){		
					?>
					 
						<option value=<?php echo $player_id; ?> ><?php echo $name; ?></option>
					<?php
						}
					?>
					</select><br>

					Team transfered to:
					<select class="form-control" name="to_team">
						<option value="">Select team </option>
						<?php
							$status = "active";
							$sql = "SELECT team_id,team_name FROM `team`";
							$stmt = $conn->prepare($sql);
							//$stmt->bind_param("is",$team_id,$status);

							//execute statement
							$stmt->execute();

							//bind result variable
							$stmt->bind_result($t_id,$t_name);

							//fetch the results
							while($stmt->fetch()){

								if($team_id == $t_id){

								}else{
						?>

							
								<option value=<?php echo $t_id; ?> ><?php echo $t_name; ?></option>
							<?php
									}
								}
							?>
					</select><br>

					Recommendations / Coach Comments<br>
					<textarea cols="60" rows="6" name="comments" class="form-control"></textarea><br>

					<input type="hidden" name="start_date" value=<?php echo $start_date; ?>>
					<input type="hidden" name="from_team" value=<?php echo $team_id; ?>>
					<center><button type="submit" class="btn btn-primary" id="button1">SAVE CHANGES</button><br></center><br><br>
				</form>

			</div>
		  </div>

		  <div id="menu1" class="tab-pane fade">
		    <form class="form" style="margin-left:25%; margin-right:25%;"><br><Br>
		    	<h3>Transfered to this team</h3>
		    	<?php
		    		$sql = "SELECT transfers.player_id,transfers.start_date,transfers.end_date,players.position,players.name,team.team_name,transfers.additional_info FROM `transfers` LEFT JOIN players ON transfers.player_id = players.player_id LEFT JOIN team ON transfers.to_team_id = team.team_id where to_team_id = ?";
		    		$stmt = $conn->prepare($sql);
		    		$stmt->bind_param('i',$team_id);

		    		//execute statement
					$stmt->execute();

					//bind result variable
					$stmt->bind_result($player_id,$start_date,$end_date,$position,$player_name,$team_name,$comments);

					//fetch the results
					while($stmt->fetch()){
						
						
		    	?>
		    	<div class="panel panel-primary">
		    		<div class="panel-heading" >
		    			<h4><b>Player Id:</b> <?php echo $player_id; ?></h4>
		    			<h4><b>Player Name:</b> <?php echo $player_name; ?></h4>
		    		</div>

		    		<div class="panel-body">
		    			<b>Start Date:</b><?php echo $start_date; ?><br>
		    			<b>End date:</b><?php echo $end_date; ?><br>
		    			<b>Position:</b><?php echo $position; ?><br>
		    			<b>Coach Comments: </b><?php echo $comments; ?><BR>
		    		</div>
	    		</div>
	    		<?php
	    			}
	    		?>

	    		<br><h3>Transfered from this team</h3>
		    	<?php
		    		$sql = "SELECT transfers.player_id,transfers.start_date,transfers.end_date,players.position,players.name,team.team_name,transfers.additional_info FROM `transfers` LEFT JOIN players ON transfers.player_id = players.player_id LEFT JOIN team ON transfers.from_team_id = team.team_id where from_team_id = ?";
		    		$stmt = $conn->prepare($sql);
		    		$stmt->bind_param('i',$team_id);

		    		//execute statement
					$stmt->execute();

					//bind result variable
					$stmt->bind_result($player_id,$start_date,$end_date,$position,$player_name,$team_name,$comments);

					//$count
					
					//fetch the results
					while($stmt->fetch()){
						
		    	?>
		    	<div class="panel panel-primary">
		    		<div class="panel-heading" >
		    			<h4><b>Player Id:</b> <?php echo $player_id; ?></h4>
		    			<h4><b>Player Name:</b> <?php echo $player_name; ?></h4>
		    		</div>

		    		<div class="panel-body">
		    			<b>Start Date:</b><?php echo $start_date; ?><br>
		    			<b>End date:</b><?php echo $end_date; ?><br>
		    			<b>Position:</b><?php echo $position; ?><br>
		    			<b>Coach Comments: </b><?php echo $comments; ?><BR>
		    		</div>
	    		</div>
	    		<?php
	    			}
	    		?>

		    </form>
		  </div>

		</div>
		
	</div>
</BR>
</div>
	<footer>
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