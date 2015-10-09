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
				<h2>Details</h2>
				<form action="book.php" method="post">
					Name: <input type="text" name="cname"><br>
					Room No: <input type="text" name="rno"><br>
					Arrival Date: <input type="date" name="adate"><br>
					Checkout Date: <input type="date" name="cdate"><br>
					Ph No: <input type="text" name="phno"><br>
					Room Type: <select class="form-control" name="rtype">
					<option>Stark House</option>
					<option>Ryne House</option>
					<option>Lannister House</option>
					</select><br>
					No. of People: <input type="text" name="nop"><br>
					<input type="submit" class="btn btn-info btn-block" name="submit"><br>
					Already Booked? <a href="details.php">Click here for details</a>
				</form>
			</div>			
			<div class="col-md-4">
			</div>
		</div>
	</div>
	<?php
	if(isset($_POST['submit'])) {
	$con = mysql_connect("localhost","hotelths","password");
	if(!$con)
	{
		die("Error: " . mysql_error());
	}

	mysql_select_db("hotelres",$con);
	$sql = "INSERT INTO hotelmain (
		Name, Room_no, Arr_date, Chk_date, Ph_no, Room_type, No_of_People)
		VALUES ('$_POST[cname]','$_POST[rno]','$_POST[adate]',
			'$_POST[cdate]','$_POST[phno]','$_POST[rtype]',
			'$_POST[nop]')";
	mysql_query($sql,$con);
	mysql_close($con); }
	?>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
</body>
</html>
