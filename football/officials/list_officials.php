<?php
	session_start();
	//check if the sessions exists
	if(isset($_SESSION['uname'])){

?>

	<?php
		include 'header.php';
		//connection file is here

		//declare type of user
		$usertype = 'official';

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
						<center><h1>LIST OF OFFICIALS </h1></center>
				</div>
					<?php
							//check for an error
							$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

							//get any message that has been passed through url...
							//such as a new password
							if(strpos($url,'newpass')){

								//get the password and referee id

							//if ($_GET['newpass']){
								//get the new password 
								//$newpass = $_GET['newpass'];

								//check if the session is set
								if(isset($_SESSION['official_id'])){
									//create a varible to hold the referee identification
									$temp_name = $_SESSION['official_id'];
									$newpass = $_SESSION['official_new_pass'];
								
								echo 
								"
									<div class='alert alert-success'>
										<span class='glyphicon glyphicon-ok'></span>
											Referee with username: <b>$temp_name</b> ,Password has been changed to <b>$newpass</b>
									</div>
								";
								}
							//}

					}
							
							if(strpos($url,'message=server_error')){
								echo 
								"
									<div class='alert alert-danger'>
										<span class='glyphicon glyphicon-remove'></span>
											Error Cannot Change Make Changes at the momement...Contact Admin
									</div>
								";
							}

							if(strpos($url,'message=success')){
								echo 
								"
									<div class='alert alert-success'>
										<span class='glyphicon glyphicon-ok'></span>
											Changes Made Successfully
									</div>
								";
							}

							if(strpos($url,'message=dels')){
								echo 
								"
									<div class='alert alert-success'>
										<span class='glyphicon glyphicon-ok'></span>
											Record Has Been Erased Successfully
									</div>
								";
							}

							if(strpos($url,'error=erase')){
								echo 
								"
									<div class='alert alert-danger'>
										<span class='glyphicon glyphicon-remove'></span>
											The Official has registered a league under his name
									</div>
								";
							}

					?>
			<?php
						//pagination
						// Find out how many items are in the table
				    //$sql = 'SELECT COUNT(*) AS count FROM referee';
				    //$result = mysqli_query($conn, $sql);
				    //$row = mysqli_fetch_assoc($result);
				    //$total = $row['count'];

					$total = $conn->query('
				        SELECT
				            COUNT(*)
				        FROM
				            officials
				    ')->fetch_row()[0];

				    // How many items to list per page
				    $limit = 5;

				    // How many pages will there be
				    $pages = ceil($total / $limit);

				    // What page are we currently on?
				    $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
				        'options' => array(
				            'default'   => 1,
				            'min_range' => 1,
				        ),
				    )));


				    // Calculate the offset for the query
				    $offset = ($page - 1)  * $limit;

				    // Some information to display to the user
				    $start = $offset + 1;
				    $end = min(($offset + $limit), $total);

				    // The "back" link
				    $prevlink = ($page > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

				    // The "forward" link
				    $nextlink = ($page < $pages) ? '<a href="?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

				    // Display the paging information
				    echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $total, ' results ', $nextlink, ' </p></div>';
			
				?>
						<table class="table">
							<tr>
								<th>Profile Image</th>
								<th>Official Id</th>
								<th>Username</th>
								<th>Name</th>
								<th>Contact</th>
								<center><th>Reset Password</th></center>
								<center><th>Erase Record</th></center>
								<th></th>

						</tr>
									<?php
							//display data query
							$query1 = "SELECT * FROM officials ORDER BY official_id LIMIT $offset,$limit ";
						    //$stmt = $conn->prepare('SELECT * FROM referee ORDER BY ref_id LIMIT $limit,$offset');

							$result = $conn->query($query1);
							//$retval = mysqli_query($query1, $conn);
							
							if(! $result){
								echo "Error".mysqli_error($conn);
							}
							while($row = mysqli_fetch_array($result)) {
								$official_id = $row['official_id'];
								$official_name = $row['name'];
								$official_uname = $row['uname'];
								$phone = $row['phone'];
								$email = $row['email'];
								$official_image = $row['image'];
							?>


							<?php
							//check if profile image is empty

							if(empty($official_image)){
								//its empty load default
								$ref_profile_image = 'user.png';
							}else{
								//image exists
								$ref_profile_image = 'photos/'.$official_image;
							}		
					?>		

							<tr>
								<td>
									<img
									src= <?php echo $ref_profile_image;?>
									width='40px' height='40px' alt='profile pic'>
								</td>
								<td><?php echo $official_id; ?></td>
								<td><?php echo $official_uname; ?></td>
								<td><?php echo $official_name; ?></td>
								<td><?php echo $phone; ?></td>

								<td>
									<!--Reset Password Form-->
									<form method="POST" action="includes/list_users.update.password.php">
										<input type="hidden" name="official_id" value=<?php echo $official_uname; ?>>
										<input type="hidden" name="usertype" value=<?php echo $usertype; ?> >
										<input type="hidden" name="fname" value=<?php echo $official_id;?>>
										<button type="submit" class="btn btn-info">Reset</button>
									</form>
								</td>

								<td>
									<!--Delete Form-->
									<?php
										//check if this is the currently logged in user
										if($official_uname === $off_uname){
											//cannot erase your own record
									?>
										<p>You Cannot Erase Your own Record</p>

									<?php

										}else{
											//erase
									?>
									<form method="POST" action="includes/list_users.del.php">
										<input type="hidden" name="official_id" value=<?php echo $official_id; ?>>
										<input type="hidden" name="uname" value=<?php echo $official_uname; ?>>
										<input type="hidden" name="usertype" value=<?php echo $usertype; ?> >
										<button type="submit" class="btn btn-danger"><span class='glyphicon glyphicon-trash'></span></button>
									</form>

									<?php
										}
									?>

								</td>

								
							</tr>
						<?php
						//close the while loop
						}
					
						?>
						</table>
				</div>
			</div>

			<table>
				
			</table>
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