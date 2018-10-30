<?php
	session_start();
	//check if the sessions exists
	if(isset($_SESSION['uname'])){

?>

	<?php
		include 'header.php';
		//we also need to get the id

		//declare type of user
		//$usertype = 'league';

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

	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>

	<link rel="stylesheet" type="text/css" href="css/common.css">
	<style type="text/css">
		form{

		}
		.card a{
			text-decoration:none;
			color:black;
		}
		.card a:hover{
			text-decoration:none;
			color:black;
		}
		.card{
			display:inline-block;
			margin-left:5px;
			margin-bottom:5px;
			margin-top:5px;
			border:1px solid #ccc;
		}
		.card:hover{
			border: 1px solid black;
		}
		.card img{
			transition: all 1s ease;
		}
		.card img:hover{
			transform:scale(1.25);
		}
	</style>
</head>
<body>
	<div class="content">
		
	
	<div class="container">
		<div class="row">
			<div class="page-header">
				<h1 style="margin-left:25%">TEAM PAGE</h1>		
				<?php
		   				$query1 = "SELECT * FROM team where team_id='$id' ";
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
							$team_id = $row['team_id'];
							$team_name = $row['team_name'];
							$gender = $row['gender'];
							$phone = $row['phone'];
							$mail = $row['email'];
							$coach_name = $row['coach_name'];
							$image = $row['image'];
							$constituency = $row['constituency'];


							//image
							$image_path = "../teams/logo/";

							if(empty($image)){
								$profile_team = $image_path."user.png";
							}else{
								$profile_team = $image_path.$image;
							}
		   			?>
		   			<h3 style="margin-left:25%">TEAM ID: <?php echo $team_id; ?> </h3>
					
			</div>
		</div>


		<ul class="nav nav-tabs">
			  <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
			  <li><a data-toggle="tab" href="#menu1">Players</a></li>
			  <li><a data-toggle="tab" href="#menu2">Team Stats</a></li>
		</ul>

<!--THIS IS THE TAB CONTENT-->
		<div class="tab-content">
		  <div id="home" class="tab-pane fade in active">
		   	<div style="margin-left:15%; margin-right:15%; "><br><br>
		   		<div class="row">
		   			<div class="col-lg-4">
		   				<img src="<?php echo $profile_team; ?>" class="img-thumbnail" height="100%" width="100%"><br>
		   			</div>

		   			<div class="col-lg-8" style="font-size: 25px;">
		   				<B>Team Name: </B><?php echo $team_name; ?><br>
						<B>Gender: </B><?php echo $gender; ?><br>
						<b>Contacts: </b><?php echo $phone; ?><br>
						<b>Email Address: </b><?php echo $mail; ?><br>
						<b>Coach Name: </b><?php echo $coach_name; ?><br>
						<b>Constituency: </b><?php echo $constituency; ?><br>
		   			</div>
		   		</div>
		   			
		   		
				<br><br>

				<?php
					}
				?>

			</div>
		  </div>

		  <div id="menu1" class="tab-pane fade"><br>
		  	
		  	<?php
							$sql = "SELECT player_id,photo,position,name,player_status FROM `players` WHERE current_team_id=? order by player_status asc";
							$stmt = $conn->prepare($sql);
							$stmt->bind_param("i",$team_id);

							//execute statement
							$stmt->execute();

							//bind result variable
							$stmt->bind_result($player_id,$photo,$position,$name,$player_status);

							//fetch the results
							while($stmt->fetch()){

								if(empty($photo)){
									//load default image
									$player_photo = "../teams/players/user.png";
									$player_profile = "../teams/players/".$player_photo;
								}else{
									//load the image from the db
									$player_photo = $photo;
									$player_profile = "../teams/players/".$player_photo;
								}

						?>
						<div class="card" style="width: 20rem; ">
							<a href="player_profile_update.php?id=<?php echo $player_id?>">

						    	<img src=<?php echo $player_profile; ?> alt="player's Image" style="width:100%; height:100%;" class="img-responsive">

						    	<div class="card-block">
						    		<h4>Player Id: <?php echo $player_id; ?></h4>
						    		<h4>Name:<?php echo $name; ?></h4>
						    		<h4>Position: <?php echo $position ?></h4>
						    		<h4>Status: <?php echo $player_status; ?></h4>
						    	</div>
						    </a>
					    </div>
					    <?php
					    	}
					    ?>
				    
		  	
		  </div>

		  <div id="menu2" class="tab-pane fade">

		  	<label for = "myChart">
		  		<?php echo $team_name; ?>	Game statistic<br>
		  	</label>
		  	<div style="width:30%; height:60%;">

		  			<canvas id="myChart" width="400" height="400"></canvas>
		  		
		  		
		  	</div>
		  	

		  	<script type="text/javascript">
			    	//var games = [];
			    	//course_n[course_n.length]="Monday";
			    	//course_n.push['monday'];    	
		  	</script>
		  	<?php
		  		$points_won = 3;
		  		$points_lost = 0;
		  		$points_draw = 1;
		  		//get the data
		  		//SELECT COUNT(points) as won FROM `match_results` WHERE team_id = 4 and points =3
		  		//SELECT COUNT(points) as draw FROM `match_results` WHERE team_id = 4 and points = 1
		  		//SELECT COUNT(points) as lost FROM `match_results` WHERE team_id = 4 and points = 0
		  		//SELECT COUNT(points) as games FROM match_results WHERE team_id = 4

		  		//get the winnings
		  		$sql1 = "SELECT COUNT(points) as won FROM `match_results` WHERE team_id = '$team_id' and points = '3' ";
		  		$result = $conn->query($sql1);
		  		$row = mysqli_fetch_assoc($result);
		  		$won_s = $row['won'];
		  		

		  		//get the draws
		  		$sql2 = "SELECT COUNT(points) as draw FROM `match_results` WHERE team_id ='$team_id' and points = '1' ";
		  		$result1 = $conn->query($sql2);
		  		$row = mysqli_fetch_assoc($result1);
		  		$draw_s = $row['draw'];


		  		//get the losses
		  		$sql3 = "SELECT COUNT(points) as lost FROM `match_results` WHERE team_id = '$team_id' and points = '0'";
		  		$result2 = $conn->query($sql3);
		  		$row = mysqli_fetch_assoc($result2);
		  		$lost_s = $row['lost'];

		  		//$sql = 
		  		//send the data to a js array

		  		
		  	?>	
		  	<?php
		  		$total = $won_s+$draw_s+$lost_s;
		  	?>

		  	<script type="text/javascript">
		  		var games = [];
		  		games[0] = "<?php echo $won_s; ?>";
		  		games[1] = "<?php echo $draw_s; ?>";
		  		games[2] = "<?php echo $lost_s; ?>";
		  		//games[0]=10;
		  		//games[1]=10;
		  		//games[2]=11;
		  	</script>

		  	<script type="text/javascript">
		  		var n = [10,12,14];
		  	</script>

		  	<script type="text/javascript">
			var ctx = document.getElementById("myChart");
			var myChart = new Chart(ctx, {
			    type: 'pie',
			    data: {
			        labels: ["Won", "Draws", "Lost",],
			        datasets: [{
			            label: 'Out of the number of games played',
			            data: games,
			            backgroundColor: [
			                'rgba(255, 99, 132, 0.2)',
			                'rgba(54, 162, 235, 0.2)',
			                'rgba(255, 206, 86, 0.2)'
			            ],
			            borderColor: [
			                'rgba(255,99,132,1)',
			                'rgba(54, 162, 235, 1)',
			                'rgba(255, 206, 86, 1)',
			            ],
			            borderWidth: 1
			        }]
			    },
			   

			});
			</script>

			


		</div>		
		  <?php
			}else{
		?>
			<div style="min-height: 100%;" id='results'>
					<div class="panel panel-primary" >
						 <div class="panel-heading" >
						    	<h4><b>Results Not Found</b></h4>
						  </div>

						   <div class="panel-body">
								    	Click Below to view the list of teams<br><br>
								    	<a href="list_teams.php">
								    		<center><button type="submit" class="btn btn-primary">List of teams</button></center>
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