	<?php
		include 'header.php';
	?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		body{
			margin:0;
   			padding:0;
   			height:100%;
		}
		footer{
			position:absolute;
   			bottom:0;
   			width:100%;
   			height:60px;   /* Height of the footer */
		}
		
		.container{
			min-height:100%;
  			 position:relative;
		}
	</style>

</head>
<body>
	<div class="container">

		<div class="row">
			<div class="page-header">
					<h1 style="margin-left:25%">PLAYER'S PAGE</h1>
			</div>
		</div>

			<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">Player Profile</a></li>
  <li><a data-toggle="tab" href="#menu1">Player Match Stats</a></li>
  
</ul>

<div class="tab-content">
  	<div id="home" class="tab-pane fade in active">
    		<div style="margin-left:10%; margin-right:10%; ">
				<div class="row">
					<DIV class="col-lg-8">
						
						<div>

							<div class="panel panel-default">
								<div class="panel-body">
									<center> <img src="user.png" height="300px" width="200px" class="img-thumbnail img-responsive"></center>
									Player_id: 12345<br>
										Current_team_id: 137<br>
								</div>

								<div class="panel-footer">
									<div style="margin-right:0%; margin-left:0%;">
										Full Name: Daniel Oliech<br>
										Phone Number: 0703748544<br>
										Email Address: bm@gmail.com<br>
										Position: striker<br>
										Transfered To: 
									</div>
								</div>
							</div>
						</div>
					</DIV>
					
					<div class="col-lg-4">
						<div class="panel panel-default">
							<div class="panel-body">
								<center><img src="user.png" class="img-thumbnail img-responsive" height="400px" width="300px"></center>
							</div>

							<div class="panel-footer">
								Birth Certificate
							</div>
						</div>
						
					</div>
				</div>
					
			</div>
		
  	</div>

	  <div id="menu1" class="tab-pane fade">
	    <h3>Players Stats Page</h3>
	    
	    	

	    	<div class="panel panel-primary">
	    		<div class="panel-heading" >
	    			<h4><b>Match Id:</b> 101</h4>
	    			<h4>TEAM A VS TEAM B</h4>
	    		</div>

	    		<div class="panel-body">
	    			
			    	<b>Goals scored</b>:10<br><br>
			    	<b>Red Card:</b> No<br><br>
			    	<b>Yellow Card:</b> No<br><br>
			    	<b>Injured:</b> No <br><br>
			    	<b>Ref Comments:</b> HE IS A GOOD DEFENDER<BR>
	    		</div>
	    	</div>
	  </div>
</div>

			
		
	</div>
	<div class="container-fluid">
		<footer>
			<?php
				include 'footer.php';
			?>
		</footer>
	</div>
</body>
</html>