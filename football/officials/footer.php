<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">

		#cf{
			background-color:#f4511e;
			width:100%;
		}
		.foot_footer{
			width:100%;
			padding:20px;
			color:white;
		}
		.foot_footer li{
			list-style:none;
			margin-bottom:5px;
		}
		.foot_footer li a{
			text-decoration:none;
			color:white;
		}
		.foot_footer li a:hover{
			text-decoration:underline;
			color:yellow;
		}
		footer{
			width:100%;
			top:400px;
		}
	</style>
</head>
<body>
	<footer class="container-fluid">
		<div class="container" id="cf">
			<div class="foot_footer">
				<div class="row">
					<div class="col-lg-3">
						<ul>
							<h3>QUICK LINKS</h3>
							<li><a href="../">Home Page</a></li>
							<li><a href="includes/logout.inc.php">Logout</a></li>
					</div>

					<div class="col-lg-3">
						<ul>
							<h3>LIST OF:</h3>
							<li><a href="list_players.php">Players</a></li>
							<li><a href="list_teams.php">Teams</a></li>
							<li><a href="list_referee.php">Referees</a></li>
						</ul>
					</div>

					<div class="col-lg-3">
						<ul>
							<h3>LEAGUES</h3>
							<li><a href="reg_league.php">Create New League</a></li>
							<li><a href="list_league.php">Leagues Available</a></li>
							
						</ul>
					</div>

					<div class="col-lg-3">
						<ul>
							<h3>MATCH</h3>
							<li><a href="match_results.php">Results</a></li>
							<li><a href="list_fixtures1.php">View Fixtures</a></li>
							<li><a href="set_fixtures_p1.php">Set Fixtures</a></li>
					</div>
				</div>



				<div class="row">
					<br>
					<center><h4>Copyright 2017</h4></center>
				</div>
			</div>
			
			
		</div>
	</footer>
</body>
</html>

<!--

	.footer {
  position: absolute;
  right: 0;
  bottom: 0;
  left: 0;
  padding: 1rem;
  background-color: #efefef;
  text-align: center;
}

-->