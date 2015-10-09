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

			<div class="col-md-3">
				<h2>Enter details</h2>
				<form action="details.php" method="post">
					Name: <input type="text" name="cname"><br>
					Ph No: <input type="text" name="phno"><br>
					<input type="submit" class="btn btn-info btn-block" name="submit"><br>
			</div>
			<div class="col-md-9">
					<?php
					if(isset($_POST['submit'])) {
					$con = mysql_connect("localhost","hotelths","password");
					if(!$con)
					{
					die("Error: " . mysql_error());
					}
					mysql_select_db("hotelres",$con);
					$sql = "SELECT * FROM hotelmain WHERE Name = '$_POST[cname]' AND Ph_no ='$_POST[phno]'";
					$mydata = mysql_query($sql,$con);
					echo "	
					<h2> Results found </h2>	
					<table class=table table-bordered>
					<tr>	
					<th>Name</th>
					<th>Room no</th>
					<th>Ph no</th>
					<th>Arrival date</th>
					<th>Checkout Date</th>
					<th>Room Type</th>
					<th>No of People</th>
					</tr>";
					while($record = mysql_fetch_array($mydata)) {
					echo "<tr>";
					echo "<td>" .  $record['Name'] . " </td>";
					echo "<td>" .  $record['Room_no'] . " </td>";
					echo "<td>" .  $record['Ph_no'] . " </td>";
					echo "<td>" .  $record['Arr_date'] . " </td>";
					echo "<td>" .  $record['Chk_date'] . " </td>";
					echo "<td>" .  $record['Room_type'] . " </td>";
					echo "<td>" .  $record['No_of_People'] . " </td>";
					echo "</tr>";
					}
					echo "</table>";
					mysql_query($sql,$con);
					mysql_close($con); }
					else {
						echo "No results to display";
					}
					?>
				</form>
			</div>			
		</div>
	</div>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
</body>
</html>
