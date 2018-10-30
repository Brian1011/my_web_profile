
<?php
	//include connection to the database
	include '../login/includes/connection.php';

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
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

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
						<li><a href="">Fixtures</a></li>
						<li><a href="match_results_1.php">Match Results</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</div>
	</header>

	<div class="container" >
		<table class="table table-hover" >
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
										<p><?php echo $match_date; ?></p>	
								</td>

								<td>
										<p><?php echo $ref_name; ?></p>
								</td>

								<td>
									<p><?php echo $venue;?></p>		
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
	</div>
	</div>
	<footer>
		<div class="container-fluid" style="color:white;">
			<div class="row">
				<div class="col-lg-2">
					
				</div>

				<div class="col-lg-6">
					<a href=""><li>Fixtures</li></a>
					<a href="match_results_1.php"><li>League Results</li></a>
					<a href="../login/"><li>Portal</li></a>
				</div>

				<div class="col-lg-4">
					<a href="../#section2"><li>About Us</li></a>
					<a href="../#contacts"><li>Contact us</li></a>
					<a href="../#home"><li>Home</li></a>
				</div>
			</div>

			<div class="row">
				<center><h3>Copyright 2017</h3></center>
			</div>
			
		</div>
	</footer>
</body>
</html>