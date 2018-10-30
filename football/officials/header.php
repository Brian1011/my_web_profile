<?php
	//include connection to the database
	include 'includes/connection.php';

	//no need of starting a session

	//use the session username
	$username = $_SESSION['uname'];

	//select data from the database
	$query = "select * from officials where uname=?";

	if($stmt = $conn->prepare($query)){
		$stmt->bind_param('s',$username);

		//execute statement
		$stmt->execute();

		//bind results variables of the officials
		$stmt->bind_result($off_id, $off_name, $off_uname, $off_phone, $off_mail, $off_image, $off_category);

		while($stmt->fetch()){

		}

		//we also need the password
		$query1 = "select password from logins where uname=?";
		$stmt1 = $conn->prepare($query1);
		$stmt1->bind_param('s',$username);
		$stmt1->execute();
		$stmt1->bind_result($off_password);

		while($stmt1->fetch()){

		}

		//logout session time
		$_SESSION['start'] = time();// taking now logged in time

		/*
	    if(!isset($_SESSION['expire'])){
	        $_SESSION['expire'] = $_SESSION['start'] + (1* 300) ; // ending a session in 5 mins
	    }
	    $now = time(); // checking the time now when home page starts

	    if($now > $_SESSION['expire'])
	    {
	        session_destroy();
	        
	        //echo "Your session has expire !  <a href='logout.php'>Click Here to Login</a>";
	    }
	    else
	    {
	    	//you are logged in
	       // echo "This should be expired in 1 min <a href='logout.php'>Click Here to Login</a>";
	    }
	    */

	}
	//close the statements
	$stmt1->close();
	$stmt->close();

	/*
		lets check if image is empty
		if its empty load default image
		if not empty read from the db
	*/

		//declare an image path
		$image_path = "photos/";

		if(empty($off_image)){
			//load default image
			$default_image = 'user.png';
			$profile_image = $image_path.$default_image;

		}else{
			//load the image from the db
			$default_image = $off_image;
			$profile_image = $image_path.$default_image;

		}


?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

		<link rel="stylesheet" type="text/css" href="css/custom_css.css">
</head>
<body>
	<div>
		<div class="row" id="header_row">
			<div class="col-lg-9">
				<h1>FOOTBALL OFFICIAL'S PAGE</h1>
			</div>
			
			<div class="col-lg-3">
				<div id='profile'>
						<div class="dropdown">
							<h3><img
								src= <?php echo $profile_image; ?>
								width='40px' height='40px'

								data-toggle="dropdown"><?php echo " ".$off_name; ?>

							<ul class="dropdown-menu">
						    <li><a href="#"><?php echo " ".$off_name; ?></a></li>
						    <li><a href="index.php">View Profile</a></li>
						    <li class="divider"></li>
						    <li><a href="includes/logout.inc.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
						  </ul>
						</div>
					
				</div>
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

							<li class="dropdown">
				      			<a href="#" class="dropdown-toggle" data-toggle="dropdown">Register <b class="caret"></b></a>
				      				<ul class="dropdown-menu" id="inner_links">
				      					<li><a href="reg_referee.php">Referee</a></li>
				      					<LI><a href="reg_official.php">Officials</a></li>
				      					<li><a href="reg_league.php">League</a></li>
				      					<li><a href="reg_team.php">Team</a></li>
				      				</ul>
				      		</li>


							<li class="dropdown">
				      			<a href="#" class="dropdown-toggle" data-toggle="dropdown">View <b class="caret"></b></a>
				      				<ul class="dropdown-menu" id="inner_links">
				      					<li><a href="list_referee.php">Referee</a></li>
				      					<?php
				      						//check if he is super user
				      						if($off_category === 'super'){
				      							//super user can see other officials
				      					?>
				      					<LI><a href="list_officials.php">Officials</a></li>
				      					<?php
				      						}
				      					?>
				      					<li><a href="list_league.php">Leagues</a></li>
				      					<li><a href="list_teams.php">Teams</a></li>
				      					<li><a href="list_fixtures1.php">Fixtures</a></li>
				      				</ul>
				      		</li>

						<li><a href="set_fixtures_p1.php">Set Fixtures</a></li>
						<li><a href="match_results.php">Match Results</a></li>
						<li><a href="list_players.php">Players</a></li>
					</ul>

					<ul class="nav navbar-nav navbar-right" id="nav_links">
				      <li><a href="includes/logout.inc.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li> 
	    			</ul>
				</div>
			</div>
		</nav>
	</div>
</body>
</html>
