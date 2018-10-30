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
	<link rel="stylesheet" type="text/css" href="css/common.css">
</head>
<body>
		<div class="content">
			
		<div class="container">

			<div class="row">
				<div class="page-header">
						<h1 style="margin-left:40%">SET A MATCH</h1>
						MATCH ID: 101
				</div>
			</div>

			<div style="margin-left:25%; margin-right:25%; ">
					<form method="post" action="#" enctype="multipart/form-data">
						Select First Team
						<select class="form-control" name="ward">
							<option value="empty">Select a constituency</option>
							<option value="kamkunji">Kamkunji</option>
						</select><br>
							<center>VS</center>
						Select Second Team:
						<select class="form-control" name="ward">
							<option value="empty">Select a constituency</option>
							<option value="kamkunji">Kamkunji</option>
							<option value="westlands">Westlands</option>
						</select><br>

						Select a referee
						<select class="form-control" name="ward">
							<option value="empty">Select a Ref</option>
							<option value="kamkunji">Kamkunji</option>
							<option value="westlands">Westlands</option>
							<option value="langata">Langata</option>
						</select><br>

						Date Of Match
						<input type="text" name="" class="form-control"><br>


						<center><button type="submit" class="btn btn-primary" id="button1">SUBMIT CHANGES</button><br></center><br><br>
					</form>
			</div>

		</div>
		</div>	

	<div class="container-fluid">
		<?php 
			include 'footer.php';
		?>
	</div>
</body>

<?php
	}else{
		header("location: ../login/index.php?message=login");
	}
?>
