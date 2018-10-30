<?php
	//include connection to the database
	include 'includes/connection.php';

	//no need of starting a session
	//session_start();
	//use the session username
	$username = $_SESSION['ref'];

	if(empty($username)){
		header("location: ../login/index.php?message=login");
	}else{

	//select data from the database
	$query = "select * from referee where uname=?";

	if($stmt = $conn->prepare($query)){
		$stmt->bind_param('s',$username);

		//execute statement
		$stmt->execute();

		//bind results variables of the officials
		$stmt->bind_result($ref_id, $ref_name, $ref_uname, $ref_phone, $ref_mail, $ref_image, $ref_status);

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

		if(empty($ref_image)){
			//load default image
			$default_image = 'user.png';
			$profile_image = $image_path.$default_image;

		}else{
			//load the image from the db
			$default_image = $ref_image;
			$profile_image = $image_path.$default_image;
		}
		if($ref_status === 'inactive'){
			header("location: ../login/index.php?message=inactive");
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

		<link rel="stylesheet" type="text/css" href="css\custom_css.css">
</head>
<body>
	<div>
		<div class="row" id="header_row">
			<div class="col-lg-9">
				<h1>REFEREE'S PAGE</h1>
			</div>
			
			<div class="col-lg-3">
				<div id='profile'>
						<div class="dropdown">
							<h3><img src=<?php echo $profile_image; ?> data-toggle="dropdown"> <?php echo $ref_name; ?>
							<ul class="dropdown-menu">
						    <li><a href="#"><?php echo $ref_name; ?></a></li>
						    <li><a href="index.php">View Profile</a></li>
						    <li class="divider"></li>
						    <li><a href="includes/logout.inc.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
						  </ul>
						</div>
					
				</div>
			</div>
		</div>
	</div>

	<div >
		<nav class="navbar navbar-default">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span> 
	      	</button>

			<div class="container-fluid">
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav" id="nav_links">

							<li><a href="index.php">Profile</a></li>
							<li class="dropdown">
				      			<a href="#" class="dropdown-toggle" data-toggle="dropdown">View <b class="caret"></b></a>
				      				<ul class="dropdown-menu" id="inner_links">
				      					<li><a href="list_leagues.php">Leagues</a></li>
				      				</ul>
				      		</li>

						<li><a href="my_match_fixtures.php">My Match Fixtures</a></li>
						<li><a href="players.php">Players</a></li>

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
<?php } ?>