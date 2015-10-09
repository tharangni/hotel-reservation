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
			<div class="col-md-4">
			</div>
			<div class="col-md-4">
				<a href="book.php" role="button" class="btn btn-success btn-block">
					<h3><span class="glyphicon glyphicon-lamp"></span> Book a room</h3>
				</a><br>
				<a href="checkout.php" role="button" class="btn btn-info btn-block">
					<h3><span class="glyphicon glyphicon-floppy-remove"></span>&nbsp;&nbsp;Checkout</h3>
				</a><br>
				<a href="admin.php" role="button" class="btn btn-warning btn-block">
					<h3><span class="glyphicon glyphicon-exclamation-sign"></span> Admin Access</h3>
				</a>
			</div>			
			<div class="col-md-4">
			</div>
		</div>
	</div>
	<?php
	$con = mysql_connect("localhost","hotelths","password");
	if(!$con)
	{
		die("Error: " . mysql_error());
	}

	mysql_select_db("hotelres",$con);
	$sql = "CREATE TABLE hotelmain (
		Name varchar(20),
		Room_no int,
		Arr_date date,
		Chk_date date,
		Ph_no bigint,
		Room_type varchar(20),
		No_of_People int
		)";
	mysql_query($sql,$con);
	mysql_close($con);
	?>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
</body>
</html>
