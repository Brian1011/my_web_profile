	<?php
		include '..\header.php';
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
	<div class="container">
		<div class="row">
			<div class="page-header">
					<center><h1>LIST OF REGISTERED PLAYERS </h1></center>
			</div><br>
					<center><form class="form-inline" action="">
						<input type="text" name="players" size="50" placeholder="Search player's name" class="form-control">
						<button type="submit" class="btn btn-danger">Search</button>
					</form><br><br></center>

					<table class="table">
						<tr>
							<th>Player Id</th>
							<th>Player Name</th>
							<th>Current Team Name</th>
							<th>View</th>
							<th>Delete</th>
						</tr>

						<tr>
							<td>1000</td>
							<td>NAMELSS</td>
							<td>WESTLANDS HI</td>
							<td>
								<form action="" method="POST">
									<input type="hidden" name="league_id">
									<button type="submit" class="btn btn-success"><a href="list_teams_2.php">Edit</a></button>
								</form>
							</td>

							<td>
								<form action="" method="POST">
									<input type="hidden" name="league_id">
									<button type="submit" class="btn btn-warning"><a href="#">Delete</a></button>
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

		<table>
			
		</table>
	</div>



	<div class="container-fluid">
			<?php
				include '../footer.php';
			?>
	</div>
</body>
</html>