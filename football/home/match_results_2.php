
<?php
	//include connection to the database
	include '../login/includes/connection.php';

	//get id from url
		if (isset($_GET['id'])){
			$id = $_GET['id'];
		}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Jimbo Football System</title>
	<!-- Latest compiled and minified CSS -->
		<meta charset="utf-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

		<link rel="stylesheet" type="text/css" href="css/custom_css.css">

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

		<style type="text/css">
			html, body {
  height: 100%;
}
body {
  display: flex;
  flex-direction: column;
}
.content {
  flex: 1 0 auto;
}

			.title{
				letter-spacing: 2px;
			}
			.title h1{
				font-size:50px;
				padding-top:20px;
				padding-bottom:10px;
				margin-bottom:10px; 
				margin-top:0px;
			}
			.title .inner{
				
			}
			.navbar{
				margin-bottom: 0;
				background-color: #52647A;
				z-index:9999;
				border: 0;
				font-size: 12px;
				line-height: 1.42857143 !important;
    			letter-spacing: 4px;
    			border-radius: 0;
			}
			.navbar li a, .navbar .navbar-brand {
			    color: #fff !important;
			}

			.navbar-nav li a:hover, .navbar-nav li.active a {
			    color: #f4511e !important;
			    background-color: #fff !important;
			}

			.navbar-default .navbar-toggle {
			    border-color: transparent;
			    color: #fff !important;
			}
			.container{
				margin-top:20px;
				margin-bottom:20px;
				border-radius:5px;
				background-color:#E3E5E6; 
				padding:0px;
			}
			#home{
				letter-spacing:2px;
			}
			#home img{
				width:100%; 
				max-height:600px;
				min-height:500px;
			}
			.image_container{
				position: relative;
				max-width: 100%;
				min-width: 500px;
				margin: 0 auto;
			}
			

			.container_content{
				position: absolute;
				bottom: 0;
				background: rgba(0, 0, 0, 0.5);
				color: #f1f1f1;
				width: 100%;
				padding: 30px;
			}
			#about{
				letter-spacing:2px;
			}
			#about img{
				height:300px;
				width:300px; 
			}
			#about p{
				margin-left:10px
			}
			#about h2{
				text-align: center;
			}
			#contacts{
				letter-spacing: 2px;
			}
			footer{
				background-color: #52647A;
				letter-spacing:2px;
			}

			footer li{
				list-style: none;
			}

			footer a{
				text-decoration: none;
				color:white;
				font-size:20px;
				letter-spacing:2px;
			}

			footer a:hover{
				text-decoration: none;
				color:yellow;
			}

			footer a:active{
				text-decoration: none;
			}

			footer a:link{
				text-decoration: none;
			}

			footer a:visited{
				text-decoration: none;
			}
		</style>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50" style="position:relative;">
	<div class="content">

	<header>
		<div>
			<div class="title" >
				<div class="inner">
					<h1>JIMBO FOOTBALL SYSTEM</h1>
				</div>	
			</div>
		</div>
	<div>
		<nav class="navbar navbar-default">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span> 
	      	</button>

			<div class="container-fluid">
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav" id="nav_links">
						<li><a href="../#home">Home</a></li>
						<li><a href="../#section2">About Us</a></li>
						<li><a href="../#contacts">Contact us</a></li>
						<li><a href="fixtures.php">Fixtures</a></li>
						<li><a href="match_results_1.php">Match Results</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</div>
	</header>

		<div class="container" >
			<div class="content">
		
	
	<div class="container">
		<div class>
			<div class="page-header">
			<?php
		   		$query1 = "SELECT * FROM league where league_id='$id' ";
				//$stmt = $conn->prepare('SELECT * FROM referee ORDER BY ref_id LIMIT $limit,$offset');

				$result = $conn->query($query1);
				//$retval = mysqli_query($query1, $conn);

				//incase the user changes the url avoid errors
				//do this by running an sql statement 

				if($result ->num_rows>0){
					//display data
						
						if(! $result){
							echo "Error".mysqli_error($conn);
						}

						//get the data
						while($row = mysqli_fetch_array($result)) {
							$league_id = $row['league_id'];
							$official_id = $row['official_id'];
							$league_name = $row['league_name'];
							$start_date = $row['start_date'];
							$end_date = $row['end_date'];
						}
		   			?>
					<h2 style="margin-left:0%">League Id: <?php echo $league_id; ?> </h2>
					<h2 style="margin-left:0%">League Name: <?php echo $league_name; ?></h2>
			</div>
		</div>
			<!--CONTENT TABS-->
			<ul class="nav nav-tabs">
			  <li class="active"><a data-toggle="tab" href="#home">League Ranking Results</a></li>
			  <li><a data-toggle="tab" href="#menu1">Team vs Team Results</a></li>
			</ul>

				<!--CONTENT IS HERE-->
			<div class="tab-content">
			  <div id="home" class="tab-pane fade in active"><br>
			  	<?php
			  	
			?>
			   		<table class="table table-hover">
			   			<tr>
							<th>Team Id</th>
							<th>Team Name</th>
							<th>Points</th>
							<th>Number of Games played</th>
							<th>Number of goals scored</th>	
						</tr>

			   	
			   			<?php

			   			//use joins to retrieve data
			   			//really amazing
			   			//$query2 = "SELECT match_results.team_id,SUM(points) as POINTS,COUNT(points) as total_games,SUM(scores) as SCORES,team.team_name as name FROM match_results LEFT JOIN team ON match_results.team_id=team.team_id WHERE league_id='$league_id' GROUP BY team_id ORDER BY team_id LIMIT $offset,$limit ";

			   			$query2 = "SELECT match_results.team_id,SUM(points) as POINTS,COUNT(points) as total_games,SUM(scores) as SCORES,team.team_name as name FROM match_results LEFT JOIN team ON match_results.team_id=team.team_id WHERE league_id='$league_id' GROUP BY team_id ORDER BY team_id ";


			   			$query3 = "SELECT match_results.team_id,SUM(points) as POINTS,COUNT(points) as total_games,SUM(scores) as SCORES,team.team_name as name FROM match_results LEFT JOIN team ON match_results.team_id=team.team_id WHERE league_id='$league_id' GROUP BY team_id ORDER BY points desc";

						$result1 = $conn->query($query3);
						
						if(! $result1){
							echo "Error".mysqli_error($conn);
						}else{

						//get the data
						while($row = mysqli_fetch_assoc($result1)){

							//get the teams that are not enrolled
							//5 lines of code summarised to one line

							//its a join between two tables
							$games_played = $row['total_games'];
							$team_name =$row['name'];
							$team_id = $row['team_id'];
							$points = $row['POINTS'];
							$total_scores = $row['SCORES'];
						?>
						<tr>
							<td><?php echo $team_id; ?></td>
							<td><?php echo $team_name; ?></td>
							<td><?php echo $points; ?></td>
							<td><?php echo $games_played; ?></td>
							<td><?php echo $total_scores; ?></td>
						</tr>

						<?php
							
							}
						}
						?>
					</table>
			  </div>

			  <div id="menu1" class="tab-pane fade"><br>
			  		<?php	
			  		
					?>
			    	<table class="table table-hover">
			    		<tr>
							<th>Match Fixture Id</th>
							<th>Date</th>
							<th>Team A</th>
							<th>Results</th>
							<th>Team B</th>
						</tr>

			    			<?php

									//select from match fixtures where league id is given
									//$query9 = "select * from match_fixtures where league_id='$league_id' ORDER BY match_date desc LIMIT $offset,$limit ";
			    					$query9 = "select * from match_fixtures where league_id='$league_id' ORDER BY match_date desc";
									$result9 = $conn->query($query9); 
									
									//get the teams involved in the match fixtures with the id
									//match id
									while($row9 = mysqli_fetch_assoc($result9)){
										//get the teams involved in the match
										$match_fixture_id = $row9['match_fixture_id'];
										$match_date = $row9['match_date'];
										$team1 = $row9['team1_id'];
										$team2 = $row9['team2_id'];

										//echo "Match fixture id: ".$match_fixture_id."<br>";
										//echo "Team 1: ".$team1;
										//echo " Team 2: ".$team2;
										//echo " <br>";
										//get the team names
										//team 1 name
										$query10 ="select * from team where team_id='$team1' "; 
										$result10 = $conn->query($query10);
										$row10 = mysqli_fetch_assoc($result10);
										$team1_name = $row10['team_name'];

										//team 2 name
										$query11 ="select * from team where team_id='$team2' "; 
										$result11 = $conn->query($query11);
										$row11 = mysqli_fetch_assoc($result11);
										$team2_name = $row11['team_name'];

										//get the results by use of the match id
										//team 1 scores
										$query12 = "select * from match_results where match_fixture_id='$match_fixture_id' and team_id='$team1' ";
										$result12 = $conn->query($query12);

										//check if the match fixture exists in the match results table
										if($result12 ->num_rows>0){
										$row12 =  mysqli_fetch_assoc($result12);
										$team1_scores = $row12['scores'];
										$match_id = $row12['match_result_id'];
										
										//echo "team 1 score: ".$team1_scores;
										//echo "<br>";
										//team 2 scores
										$query13 = "select * from match_results where match_fixture_id='$match_fixture_id' and team_id='$team2' ";
										$result13 = $conn->query($query13);
										$row13 =  mysqli_fetch_assoc($result13);
										$team2_scores = $row13['scores'];
										//echo "Team 2 score: ".$team2_scores;
										//echo "<br>";
										
										//echo "match id is: ".$match_id."<br>";
										//echo "<br>";
										//echo "<br>";

						?>
						

						<tr>
							<?php
								//start a session
								//store the league id
								$_SESSION['league_id']=$league_id;
							?>
							<td><?php echo $match_fixture_id; ?></td>
							<td><?php echo $match_date; ?></td>
							<td><?php echo $team1_name; ?></td>
							<td><?php echo $team1_scores; ?>:<?php echo $team2_scores; ?></td>
							<td><?php echo $team2_name; ?></td>
						</tr>
						<?php
									}else{
										//no match fixture found in the results table
									}
								}
						?>

					</table>
	<?php
	}else{
		//no such league exists
	?>
		<div style="min-height: 100%;">
			<div class="panel panel-primary" >
		    		<div class="panel-heading" >
		    			<h4><b>ERROR 101: No such League Exists</b></h4>
		    			
		    		</div>

		    		<div class="panel-body">
				    	Use The results under the league table to select an existing league.
				    	You can also contact the admin incase of any issue.
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
	</div>
		</div>
	</div>

	<footer>
		<div class="container-fluid" style="color:white;">
			<div class="row">
				<div class="col-lg-2">
					
				</div>

				<div class="col-lg-6">
					<a href="fixtures.php"><li>Fixtures</li></a>
					<a href="match_results_1.php"><li>League Results</li></a>
					<a href="../login/"><li>Portal</li></a>
				</div>

				<div class="col-lg-4">
					<a href="../#section2"><li>About Us</li></a>
					<a href="../contacts"><li>Contact us</li></a>
					<a href="../home"><li>Home</li></a>
				</div>
			</div>

			<div class="row">
				<center><h3>Copyright 2017</h3></center>
			</div>
			
		</div>
	</footer>
</body>
</html>