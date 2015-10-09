<html>
<head>
	<title>Hotel Reservation</title>
</head>
<body>
	<link rel="stylesheet" href="css/bootstrap.css">
	<div class="container">
		<div class="jumbotron">
			<h1><span class="glyphicon glyphicon-map-marker"></span> Hotel name</h1>
		</div>
		<div class="row">
			<div class="col-md-12">
			<a href="index.php" class="btn btn-default btn-sm">
          	<span class="glyphicon glyphicon-home"></span> Home
            </a>
			</div>
			<div class="col-md-4">
			</div>
			<div class="col-md-4">
				<?php
				if(isset($_POST['password'])){
				if($_POST['password'] == 'password' && $_POST['username'] == 'admin')
				{
					echo "<h3>Successfully Logged in!</h3>";
					echo "<br><a href='done.php'> Click here to view database</a>";
				}
				else {
					echo "Incorrect details - Retry";
				}
				}
				?>
				<h2>Login Details</h2>
				<form action="admin.php" method="post">
				Username: <input type="text" name="username"><br>
				Password: <input type="password" name="password"><br>
				<input type="submit" name="submit" value="Enter" class="btn btn-info">
				<br>
			</div>			
			<div class="col-md-4">
			</div>
		</div>
	</div>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
</body>
</html>
