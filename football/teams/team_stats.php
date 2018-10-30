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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
</head>
<body>

<div class="content">
	<div class="container">
		<label for = "myChart">
		  		<?php echo $team_name; ?>	Game statistic<br>
		  	</label>
		  	<div style="width:30%; height:60%;">

		  			<canvas id="myChart" width="400" height="400"></canvas>
		  		
		  		
		  	</div>
		  	

		  	<script type="text/javascript">
			    	//var games = [];
			    	//course_n[course_n.length]="Monday";
			    	//course_n.push['monday'];    	
		  	</script>
		  	<?php
		  		$points_won = 3;
		  		$points_lost = 0;
		  		$points_draw = 1;
		  		//get the data
		  		//SELECT COUNT(points) as won FROM `match_results` WHERE team_id = 4 and points =3
		  		//SELECT COUNT(points) as draw FROM `match_results` WHERE team_id = 4 and points = 1
		  		//SELECT COUNT(points) as lost FROM `match_results` WHERE team_id = 4 and points = 0
		  		//SELECT COUNT(points) as games FROM match_results WHERE team_id = 4

		  		//get the winnings
		  		$sql1 = "SELECT COUNT(points) as won FROM `match_results` WHERE team_id = '$team_id' and points = '3' ";
		  		$result = $conn->query($sql1);
		  		$row = mysqli_fetch_assoc($result);
		  		$won_s = $row['won'];
		  		

		  		//get the draws
		  		$sql2 = "SELECT COUNT(points) as draw FROM `match_results` WHERE team_id ='$team_id' and points = '1' ";
		  		$result1 = $conn->query($sql2);
		  		$row = mysqli_fetch_assoc($result1);
		  		$draw_s = $row['draw'];


		  		//get the losses
		  		$sql3 = "SELECT COUNT(points) as lost FROM `match_results` WHERE team_id = '$team_id' and points = '0'";
		  		$result2 = $conn->query($sql3);
		  		$row = mysqli_fetch_assoc($result2);
		  		$lost_s = $row['lost'];

		  		//$sql = 
		  		//send the data to a js array

		  		
		  	?>	
		  	<?php
		  		$total = $won_s+$draw_s+$lost_s;
		  	?>

		  	<script type="text/javascript">
		  		var games = [];
		  		games[0] = "<?php echo $won_s; ?>";
		  		games[1] = "<?php echo $draw_s; ?>";
		  		games[2] = "<?php echo $lost_s; ?>";
		  		//games[0]=10;
		  		//games[1]=10;
		  		//games[2]=11;
		  	</script>

		  	<script type="text/javascript">
		  		var n = [10,12,14];
		  	</script>

		  	<script type="text/javascript">
			var ctx = document.getElementById("myChart");
			var myChart = new Chart(ctx, {
			    type: 'pie',
			    data: {
			        labels: ["Won", "Draws", "Lost",],
			        datasets: [{
			            label: 'Out of the number of games played',
			            data: games,
			            backgroundColor: [
			                'rgba(255, 99, 132, 0.2)',
			                'rgba(54, 162, 235, 0.2)',
			                'rgba(255, 206, 86, 0.2)'
			            ],
			            borderColor: [
			                'rgba(255,99,132,1)',
			                'rgba(54, 162, 235, 1)',
			                'rgba(255, 206, 86, 1)',
			            ],
			            borderWidth: 1
			        }]
			    },
			   

			});
			</script>

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