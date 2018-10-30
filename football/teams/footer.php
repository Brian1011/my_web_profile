<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		#cf{
			/*
			height: 200px;
		  position: absolute;
		  right: 0;
		  bottom: 0;
		  left: 0;
		  padding: 1rem;
		  */
		  background-color:#A8C257;
		}

		#cf{
			color:white;
		}
		#cf li{
			list-style:none;
			margin-bottom:5px;
		}
		#cf li a{
			text-decoration:none;
			color:white;
		}
		#cf li a:hover{
			text-decoration:underline;
			color:yellow;
		}
	</style>
</head>
<body>
		<div id="cf">
				<div class="row">
					<div class="col-lg-4">
						<ul>
							<h3>QUICK LINKS</h3>
							<li><a href="../">Home Page</a></li>
							<li><a href="current_players.php">Current Players</a></li>
							<li><a href="alumni.php">Alumni Players</a></li>
					</div>

					<div class="col-lg-4">
						<ul>
							<h3>Profile</h3>
							<li><a href="coach_profile.php">Change Password</a></li>
							<li><a href="coach_profile.php">View Profile</a></li>
							<li><a href="includes/logout.inc.php">Logout</a>
							
						</ul>
					</div>

					<div class="col-lg-3">
						<ul>
							<h3>MATCH</h3>
							<li><a href="match_history.php">Team Results</a></li>
							<li><a href="upcoming_matches.php">Team Fixtures</a></li>
							<li><a href="team_stats.php">Team Stats</a></li>
					</div>
				</div>

				<div class="row">
					<br>
					<center><h4>Copyright 2017</h4></center>
				</div>
		</div>
</body>
</html>