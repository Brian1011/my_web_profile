
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
						<li><a href="fixtures.php">Fixtures</a></li>
						<li><a href="">Match Results</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</div>
	</header>

		<div class="container" >
			<div >
				<div class="page-header">
						<center><h1>SELECT A LEAGUE TO VIEW RESULTS</h1></center>
				</div><br>
						
						<?php
						//pagination
						// Find out how many items are in the table
				    //$sql = 'SELECT COUNT(*) AS count FROM referee';
				    //$result = mysqli_query($conn, $sql);
				    //$row = mysqli_fetch_assoc($result);
				    //$total = $row['count'];

					$total = $conn->query('
				        SELECT
				            COUNT(*)
				        FROM
				            league
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
			
				?>

						<table class="table table-hover">
							<tr>
								<th>League Id</th>
								<th>League Name</th>
								<th>Date Started</th>
								<th>End Of League Date</th>
								<th>View</th>
							</tr>
						<?php
							//display data query
							$query1 = "SELECT * FROM league ORDER BY league_id desc LIMIT $offset,$limit ";
						    //$stmt = $conn->prepare('SELECT * FROM referee ORDER BY ref_id LIMIT $limit,$offset');

							$result = $conn->query($query1);
							//$retval = mysqli_query($query1, $conn);
							
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

								//get the name of the official
								$query2 = "select name from officials where official_id=?";
								$stmt = $conn->prepare($query2);
								$stmt->bind_param("i",$official_id);

								//execute statement
								$stmt->execute();

								//bind result variable
								$stmt->bind_result($offi_name);

								//fetch the results
								while($stmt->fetch()){

									}
							?>

								<tr>
									<td><?php echo $league_id; ?></td>
									<td><?php echo $league_name; ?></td>
									<td><?php echo $start_date; ?></td>
									<td><?php echo $end_date; ?></td>
									<td class="form">
										<!--pass the league id via the url-->
										<?php
											//$temp = $league_id;
											//$_SESSION['league_id'] = $temp;

										?>
									<a href="match_results_2.php?id=<?php echo $league_id; ?>"><button class="btn btn-primary" color:white;">View</button></a>
									</td>
								</tr>

							<?php
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
					<a href="fixtures.php"><li>Fixtures</li></a>
					<a href=""><li>League Results</li></a>
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