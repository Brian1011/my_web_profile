<!DOCTYPE html>
<html>
<head>
	<title>Jimbo Football System</title>
	<!-- Latest compiled and minified CSS -->
		<meta charset="utf-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

		<link rel="stylesheet" type="text/css" href="css/custom_css.css">

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

		<style type="text/css">
			.title{
				letter-spacing: 2px;
			}
			.title h1{
				font-size:50px;
				padding-top:20px;
				padding-bottom:10px;
				margin-bottom:10px; 
				margin-top:0px;
			}
			.title .inner{
				
			}
			.navbar{
				margin-bottom: 0;
				background-color: #52647A;
				z-index:9999;
				border: 0;
				font-size: 12px;
				line-height: 1.42857143 !important;
    			letter-spacing: 4px;
    			border-radius: 0;
			}
			.navbar li a, .navbar .navbar-brand {
			    color: #fff !important;
			}

			.navbar-nav li a:hover, .navbar-nav li.active a {
			    color: #f4511e !important;
			    background-color: #fff !important;
			}

			.navbar-default .navbar-toggle {
			    border-color: transparent;
			    color: #fff !important;
			}
			.container{
				margin-top:20px;
				margin-bottom:20px;
				border-radius:5px;
				background-color:#E3E5E6; 
				padding:0px;
			}
			#home{
				letter-spacing:2px;
			}
			#home img{
				width:100%; 
				max-height:600px;
				min-height:500px;
			}
			.image_container{
				position: relative;
				max-width: 100%;
				min-width: 500px;
				margin: 0 auto;
			}
			

			.container_content{
				position: absolute;
				bottom: 0;
				background: rgba(0, 0, 0, 0.5);
				color: #f1f1f1;
				width: 100%;
				padding: 30px;
			}
			#about{
				letter-spacing:2px;
			}
			#about img{
				height:300px;
				width:300px; 
			}
			#about p{
				margin-left:10px
			}
			#about h2{
				text-align: center;
			}
			#contacts{
				letter-spacing: 2px;
			}
			footer{
				background-color: #52647A;
			}

			footer li{
				list-style: none;
			}

			footer a{
				text-decoration: none;
				color:white;
				font-size:20px;
			}

			footer a:hover{
				text-decoration: none;
				color:yellow;
			}

			footer a:active{
				text-decoration: none;
			}

			footer a:link{
				text-decoration: none;
			}
		</style>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50" style="position:relative;">
	<header>
		<div>
			<div class="title" >
				<div class="inner">
					<h1>JIMBO FOOTBALL SYSTEM</h1>
				</div>	
			</div>
		</div>

	<div>
		<nav class="navbar navbar-default">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span> 
	      	</button>

			<div class="container-fluid">
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav" id="nav_links">
						<li><a href="#home">Home</a></li>
						<li><a href="#section2">About Us</a></li>
						<li><a href="#contacts">Contact us</a></li>
						<li><a href="home/fixtures.php">Fixtures</a></li>
						<li><a href="home/match_results_1.php">Match Results</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</div>
	</header>

	<div class="container" >
		<div style=" margin-top:10px;margin-bottom:10px;">
			<div class="image_container" id='home' style="border-radius:5px;">
				<img src="home/one.jpeg" alt="field image">	

				<div class="container_content">
					<h1>Welcome To Jimbo Football System</h1><br>
					<p>
						View match fixtures and results based on various leagues.<br>
						Promoting youth talent.
					</p>
				</div>
			</div>

		<div style="background-color: #433F40;" id="section2">
				<div style="color:white;" id='about' >
					<center><h1 style="padding-top:30px; ">About us</h1></center>
					<div class="row" style="padding-bottom:40px; padding-top:40px;">
						<div class="col-lg-4" >
							<h2>Fixtures</h2>
							<img src="home/back.jpg"  alt="image" style="width: 95%; margin-left:15px;">
							<br>
								<P>
									<center>We set up matches between high schools within each county and after each and every match we evaluate teams that have proceeded and we give them new matches to participate in
									</center>
								</P>
						</div>

						<div class="col-lg-4">
							<h2>Tournaments</h2>
							<img src="home/13.jpg"  alt="image 2 Football" style="width: 100%;">
							<br>
							<center>
								<br>
								<p>
									We have leagues where we enrol schools that will partcipate.
									We record each goal scored by each team and the player who scored.
								</p> 
							</center>
						</div>

						<div class="col-lg-4">
							<h2>Stats</h2>
							<img src="home/harambee.jpg" alt="about" style="width: 90%;">
							<br>
							<center>
								<Br>
								<P style="width: 90%;">Finally we update the player records, that is who scored a goal and when and we store this data for future use</P>
							</center>
						</div>
				</div>	
			</div>
				
		</div>

		<div style="background-color:#E3E5E6;" id="contacts" >
			<center><h1>Contact Us</h1></center><br>
				<center>
					<P>
						Have any questions? We would love to hear from you.
						Here's how to get in touch with us.
					</P>
				</center>
			<div class="row">
				<div class="col-lg-6">
					<h2 style="margin-left:10px; ">Where we are located</h2>
					 <div id="map" style="width:600px; height:400px; "></div>
						    <script>
						      function initMap() {
						        var uluru = {lat: -1.310102, lng: 36.813875};
						        var map = new google.maps.Map(document.getElementById('map'), {
						          zoom: 12,
						          center: uluru
						        });
						        var marker = new google.maps.Marker({
						          position: uluru,
						          map: map
						        });
						      }
						    </script>
						    <script async defer
							  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCyV2K-IzCHhobcyBjS5rXXwWdrRZab_Lw&callback=initMap">
							</script>
					</div>

				<div class="col-lg-6">
					<div style="margin-left:20px;">
						<h2>Social Media</h2>
						<a href="#"><i class="fa fa-facebook" style="font-size: 30px; color:#3B5998; hover:red;"> Jimbo Kenya</i></a><br>
					    <a href="#"><i class="fa fa-twitter" style="font-size: 30px; color:#0084b4.;"> Jimbo_Ke </i></a><br>
					    <a href="#"><i class="fa fa-linkedin" style="font-size: 30px; color:#0077B5;  "> Jimboken </i></a><br>
					    <a href="#"><i class="fa fa-google-plus" style="font-size: 30px; color:#0084b4; "> Jimbo_kenya</i></a><br>
					    <a href=""><i class="fa fa-instagram" aria-hidden="true" style="font-size: 30px";> kenya Jimbo</i></a><br><br>

					    <h2>Phone Number</h2>
					    <i class="fa fa-phone-square" aria-hidden="true" style="font-size: 30px; color:#34af23;" ></i>
					    <span style="font-size:30px;"> +25478901223</span><br>
					      <i class="fa fa-phone-square" aria-hidden="true" style="font-size: 30px; color:#34af23;" ></i> 
					       <span style="font-size:30px;"> +25478901223</span><br>
					</div>
				</div>
			</div>

		</div>

		</div>
		
	</div>

	<footer>
		<div class="container-fluid" style="color:white;">
			<div class="row">
				<div class="col-lg-2">
					
				</div>

				<div class="col-lg-6">
					<a href="home/fixtures.php"><li>Fixtures</li></a>
					<a href="home/match_results_1.php"><li>Match Results</li></a>
					<a href="login/"><li>Portal</li></a>
				</div>

				<div class="col-lg-4">
					<a href="#section2"><li>About Us</li></a>
					<a href="#contacts"><li>Contact us</li></a>
					<a href="#home"><li>Home</li></a>
				</div>
			</div>

			<div class="row">
				<center><h3>Copyright 2017</h3></center>
			</div>
			
		</div>
	</footer>
	
</body>
</html>