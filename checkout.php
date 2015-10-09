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
				<h2>Proceed to checkout</h2>
				<form action="checkout.php" method="post">
					Name: <input type="text" name="cname"><br>
					Ph No: <input type="text" name="phno"><br>
					Room No: <input type="text" name="rno"><br>
					<input type="submit" class="btn btn-info btn-block" name="submit"><br>
			</div>
			<div class="col-md-9">
					<?php
					function datediff($interval, $datefrom, $dateto, $using_timestamps = false) {
					    /*
					    $interval can be:
					    yyyy - Number of full years
					    q - Number of full quarters
					    m - Number of full months
					    y - Difference between day numbers
					        (eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".)
					    d - Number of full days
					    w - Number of full weekdays
					    ww - Number of full weeks
					    h - Number of full hours
					    n - Number of full minutes
					    s - Number of full seconds (default)
					    */
					    
					    if (!$using_timestamps) {
					        $datefrom = strtotime($datefrom, 0);
					        $dateto = strtotime($dateto, 0);
					    }
					    $difference = $dateto - $datefrom; // Difference in seconds
					     
					    switch($interval) {
					     
					    case 'yyyy': // Number of full years
					        $years_difference = floor($difference / 31536000);
					        if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom)+$years_difference) > $dateto) {
					            $years_difference--;
					        }
					        if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto)-($years_difference+1)) > $datefrom) {
					            $years_difference++;
					        }
					        $datediff = $years_difference;
					        break;
					    case "q": // Number of full quarters
					        $quarters_difference = floor($difference / 8035200);
					        while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($quarters_difference*3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
					            $months_difference++;
					        }
					        $quarters_difference--;
					        $datediff = $quarters_difference;
					        break;
					    case "m": // Number of full months
					        $months_difference = floor($difference / 2678400);
					        while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
					            $months_difference++;
					        }
					        $months_difference--;
					        $datediff = $months_difference;
					        break;
					    case 'y': // Difference between day numbers
					        $datediff = date("z", $dateto) - date("z", $datefrom);
					        break;
					    case "d": // Number of full days
					        $datediff = floor($difference / 86400);
					        break;
					    case "w": // Number of full weekdays
					        $days_difference = floor($difference / 86400);
					        $weeks_difference = floor($days_difference / 7); // Complete weeks
					        $first_day = date("w", $datefrom);
					        $days_remainder = floor($days_difference % 7);
					        $odd_days = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?
					        if ($odd_days > 7) { // Sunday
					            $days_remainder--;
					        }
					        if ($odd_days > 6) { // Saturday
					            $days_remainder--;
					        }
					        $datediff = ($weeks_difference * 5) + $days_remainder;
					        break;
					    case "ww": // Number of full weeks
					        $datediff = floor($difference / 604800);
					        break;
					    case "h": // Number of full hours
					        $datediff = floor($difference / 3600);
					        break;
					    case "n": // Number of full minutes
					        $datediff = floor($difference / 60);
					        break;
					    default: // Number of full seconds (default)
					        $datediff = $difference;
					        break;
					    }    
					    return $datediff;
					}

					if(isset($_POST['submit'])) {
					$con = mysql_connect("localhost","hotelths","password");
					if(!$con)
					{
					die("Error: " . mysql_error());
					}
					mysql_select_db("hotelres",$con);
					$sql = "SELECT * FROM hotelmain WHERE Name = '$_POST[cname]' AND Room_no ='$_POST[rno]'";
					$mydata = mysql_query($sql,$con);
					echo "	
					<h2> Summary of your stay </h2>	
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
					echo "</table>";
					echo "<h4>";
					if(strcmp($record['Room_type'],"Ryne House")==0)
					{
						$date1 = datediff('d',$record['Arr_date'],$record['Chk_date']);
						$x = 100;
						echo "Days of stay is: " . $date1;
						echo "<br><br>Cost per day is: $" . $x;
						echo "<br><br>Amount to pay is: $" . $date1 * $x; 
					}
					elseif(strcmp($record['Room_type'],"Stark House")==0)
					{
						$date2 = datediff('d',$record['Arr_date'],$record['Chk_date']);
						$x = 150;
						echo "Days of stay is: " . $date2;
						echo "<br><br>Cost per day is: $" . $x;
						echo "<br><br>Amount to pay is: $" . $date2 * $x; 
					}
					else
					{
						$date3 = datediff('d',$record['Arr_date'],$record['Chk_date']);
						$x = 200;
						echo "Days of stay is: " . $date3;
						echo "<br><br>Cost per day is: $" . $x;
						echo "<br><br>Amount to pay is: $" . $date3 * $x; 
					}
					echo "</h4>";
					}
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
