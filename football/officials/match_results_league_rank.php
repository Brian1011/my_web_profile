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
		}
	</style>
	<link rel="stylesheet" type="text/css" href="css/common.css">
</head>
<body>
	<div class="content">
		
		<div class="container">

			<div class="row">
				<div class="page-header">
						<h1 style="margin-left:25%">LEAGUE RANK RESULTS</h1>
				</div>
			</div>

			<table class="table">
							<tr>
								<th>Rank</th>
								<th>Team Id</th>
								<th>Team Name</th>
								<th>Points</th>
								<th>Number of Games played</th>
								<th>Number of goals scored</th>
								
							</tr>

							<tr>
								<td>1</td>
								<td>102</td>
								<td>ACTIVE FC</td>
								<TD>30</TD>
								<td>10</td>
								<td>12</td>
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