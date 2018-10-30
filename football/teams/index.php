<?php
	//check if the sessions exists
	//start a session
	session_start();

	//$_SESSION['uname']; 
	if(isset($_SESSION['coach'])){
?>

<?php 
	include 'header.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css\custom_css.css">
	<script type="text/javascript">
		
	//I prefer it being external ...upload an image and see it
			function preview_image(event) 
		{
		 var reader = new FileReader();
		 reader.onload = function()
		 {
		  var output = document.getElementById('output_image');
		  output.src = reader.result;
		 }
		 reader.readAsDataURL(event.target.files[0]);
		}

	</script>

	<style type="text/css">
		form{

		}
		.card a{
			text-decoration:none;
			color:black;
		}
		.card a:hover{
			text-decoration:none;
			color:black;
		}
		.card{
			display:inline-block;
			margin-left:5px;
			margin-bottom:5px;
			margin-top:5px;
			border:1px solid #ccc;
		}
		.card:hover{
			border: 1px solid black;
		}
		.card img{
			transition: all 1s ease;
		}
		.card img:hover{
			transform:scale(1.25);
		}
	</style>

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
	</style>

</head>
<body>
	<!--THIS IS THE LANDING PAGE -->
	<div class="content">	
		<div class="container">
					<br>
						<?php
							$sql = "SELECT player_id,photo,position,name FROM `players` WHERE current_team_id=?";
							$stmt = $conn->prepare($sql);
							$stmt->bind_param("i",$team_id);

							//execute statement
							$stmt->execute();

							//bind result variable
							$stmt->bind_result($player_id,$photo,$position,$name);

							//fetch the results
							while($stmt->fetch()){

								if(empty($photo)){
									//load default image
									$player_photo = 'user.png';
									$player_profile = "players/".$player_photo;
								}else{
									//load the image from the db
									$player_photo = $photo;
									$player_profile = "players/".$player_photo;
								}

						?>
						<div class="card" style="width: 20rem; ">
							<a href="player_profile.php?id=<?php echo $player_id?>">

						    	<img src=<?php echo $player_profile; ?> alt="player's Image" style="width:100%; height:100%;" class="img-responsive">

						    	<div class="card-block">
						    		<h4>Player Id: <?php echo $player_id; ?></h4>
						    		<h4>Name:<?php echo $name; ?></h4>
						    		<h4>Position: <?php echo $position ?></h4>
						    	</div>
						    </a>
					    </div>
					    <?php
					    	}
					    ?>
				    
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