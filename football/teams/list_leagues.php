<?php
	session_start();
	//check if the sessions exists
	if(isset($_SESSION['coach'])){

?>
	<?php
		include 'header.php';

	?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.form{

		}
		.form a{
			text-decoration:none;
			color:white;
		}
		.form a:hover{
			text-decoration:none;
			color:white;
		
	</style>
	<link rel="stylesheet" type="text/css" href="css/common.css">
</head>
<body>

<div class="content">
	<div class="container">
		<div class="row">
			<div class="page-header">
					<center><h1>SELECT A LEAGUE TO VIEW RESULTS</h1></center>
			</div><br>
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
						}

						if(strpos($url,'message=success')){
							echo 
							"
								<div class='alert alert-success'>
									<span class='glyphicon glyphicon-ok'></span>
										Changes Made Successfully
								</div>
							";
						}

						if(strpos($url,'message=dels')){
							echo 
							"
								<div class='alert alert-success'>
									<span class='glyphicon glyphicon-ok'></span>
										Record Has Been Erased Successfully
								</div>
							";
						}

						if(strpos($url,'error=erase')){
							echo 
							"
								<div class='alert alert-danger'>
									<span class='glyphicon glyphicon-remove'></span>
										The League has matches or Teams Assigned to it
								</div>
							";
						}

				?>
					
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

					<table class="table">
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
								<a href="list_leagues_2.php?id=<?php echo $league_id; ?>"><button class="btn btn-primary" color:white;">View</button></a>
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