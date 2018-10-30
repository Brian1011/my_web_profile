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
	<link rel="stylesheet" type="text/css" href="css/common.css">
</head>
<body>

	<div class="content">
		<div class="container">

			<div class="row">
				<div class="page-header">
						<h1 style="margin-left:25%">LEAGUE REGISTRATION</h1>
						<?php
							//check for an error
							$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

							if(strpos($url,'message=good')){
								echo 
								"
									<div class='alert alert-success'>
										<span class='glyphicon glyphicon-ok'></span>
											A new Record has been entered sucessfully
										
									</div>
								";
							} 

							if(strpos($url,'message=empty')){
								echo 
								"
									<div class='alert alert-danger'>
										<span class='glyphicon glyphicon-remove'></span>
											Records cannot be empty
									</div>
								";
							}
						?>
				</div>
			</div>

			<div style="margin-left:25%; margin-right:25%; ">
					<form method="post" action="includes/reg_league.inc.php" enctype="multipart/form-data">
						<label>League Name:</label>
							<input type="text" name="league_name" class="form-control" required><br>
						<label>Starting Date:<br>
							<input type="date" name="starting_date" value="" required class="form-control"></label><br><br>
							<input type="hidden" name="official_id" value=<?php echo $off_id; ?>>
						<center><button type="submit" class="btn btn-primary" id="button1">SUBMIT</button><br></center><br><br>
					</form>
				</div>

				<div class="col-lg-4">
					
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