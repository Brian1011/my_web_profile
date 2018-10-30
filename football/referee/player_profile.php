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
							<DIV class="col-lg-6">
								
								<div>

									<div class="panel panel-default">
										<div class="panel-body">
											<center> <img src="user.png" height="300px" width="200px" class="img-thumbnail img-responsive"></center>
										</div>

										<div class="panel-footer">
											Player_id: 12345<br>
											Current_team_id: 137<br>
											Full Name: <br>
											Phone Number:<br>
											Email Address:<br>
											Position:<br>	
										</div>
									</div>
								</div>
							</DIV>
							
							<div class="col-lg-6">
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
</div>

	
		<?php

		include 'footer.php';
		?>
	
</body>
</html>