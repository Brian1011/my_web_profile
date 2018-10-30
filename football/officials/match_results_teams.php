<?php
	session_start();
	//check if the sessions exists
	if(isset($_SESSION['uname'])){

?>

	<?php
		include 'header.php';
	?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		form{

		}
		form a{
			text-decoration:none;
			color:white;
		}
		form a:hover{
			text-decoration:none;
			color:white;
		
	</style>
</head>
<body>
	<div class="content">
		
		<div class="container">
			<div class="row">
				<div class="page-header">
						<h1 style="margin-left:25%">LEAGUE 101 MATCH RESULTS</h1>
				</div>
			</div>

			<table class="table">
							<tr>
								<th>Match Id</th>
								<th>Date</th>
								<th>Team A</th>
								<th>Results</th>
								<th>Team B</th>
								<th>View Statistics</th>
								
							</tr>

							<tr>
								<td>1000</td>
								<td>2nd Dec 2017</td>
								<td>Kamkunji</td>
								<td>3 : 0</td>
								<td>Westlands</td>
								<td>
									<form action="" method="POST">
										<input type="hidden" name="league_id">
										<button type="submit" class="btn btn-success"><a href="match_results_teams212.php">View</a></button>
									</form>
								</td>
							</tr>
						</table>

						<ul class="pagination">
						  <li><a href="#">1</a></li>
						  <li><a href="#">2</a></li>
						  <li><a href="#">3</a></li>
						  <li><a href="#">4</a></li>
						  <li><a href="#">5</a></li>
						</ul>
				</div>
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