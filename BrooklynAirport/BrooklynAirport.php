<?php
session_start();
header("refresh: 10;");
?>


<!doctype html>


<html>

<head>
    <meta charset="utf-8">
    <title>BrooklynAirport</title>
    <style>
        #account {
            color: white;

        }

        .account {
            color: white;
        }

        .dTable td {
            border: 1px solid black;
            border-collapse: collapse;

        }

        .test {
            padding-right: 50px;
        }

        .aTable td {
            border: 1px solid black;
            border-collapse: collapse;
        }

    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-fluid">
        <!-- nav -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="BrooklynAirport.php">Brooklyn Airport</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../directory.php">Directory</a>
                    </li>
                </ul>
            </div>

        </nav>
        <!-- nav -->

        <div class="currentDate">
            <?php print"<h1 align='center'>".$_SESSION['currentDate'].'</h1>' ?>

        </div>


        <div class="container bg-light">

            <?php
			require '../database-connection.php';

			$departures = query("Select 
airline as 'Airline',
flightnumber as 'Flight #',
endairport as 'Destination', 
TIME_FORMAT(TIME(departuretime), '%h:%i:%s %p') as 'Departure Time', 
status as 'Status' 
from flights 
WHERE startAirport = 'BrooklynAirport' and date(departureTime) ="."'".$_SESSION['currentDate']."';");
            
         $arrivals = query("Select 
airline as 'Airline',
flightnumber as 'Flight #',
startairport as 'Origin', 
TIME_FORMAT(TIME(arrivaltime), '%h:%i:%s %p') as 'Arrival Time', 
status as 'Status' 
from flights 
WHERE endAirport = 'BrooklynAirport' and date(arrivalTime) =". "'".$_SESSION['currentDate']."';"); 
            
            

			print "
				<table class='mainTable' align='center'><tr><td>
                <div class='test'>
                <table class='dTable'>
                <tr><th>Departures<th><tr>
			<tr>
				<td>" . "Airline" . "</td>
				<td>" . "Flight #" . "</td>
				<td>" . "Destination" . "</td>
				<td>" . "Departure Time" . "</td>
				<td>" . "Status" . "</td>
                <tr>";


			while ($row = mysqli_fetch_assoc($departures)) {
				$airline = $row['Airline'];
				$flightNum = $row['Flight #'];
				$destination = $row['Destination'];
				$time = $row['Departure Time'];
				$status = $row['Status'];

				print
					"<tr>
					<td>" . $airline . "</td>
					<td>" . $flightNum . "</td>
					<td>" . $destination . "</td>
					<td>" . $time . "</td>
					<td>" . $status . "</td>
						<tr>";
			}
			print "</table></td><td></div>";

			print "
				<table class='aTable'>
                <tr><th>Arrivals<th><tr>
			<tr>
				<td>" . "Airline" . "</td>
				<td>" . "Flight #" . "</td>
				<td>" . "Origin" . "</td>
				<td>" . "Arrival Time" . "</td>
				<td>" . "Status" . "</td>
                <tr>";


			while ($row = mysqli_fetch_assoc($arrivals)) {
				$airline = $row['Airline'];
				$flightNum = $row['Flight #'];
				$origin = $row['Origin'];
				$time = $row['Arrival Time'];
				$status = $row['Status'];

				print
					"<tr>
					<td>" . $airline . "</td>
					<td>" . $flightNum . "</td>
					<td>" . $origin . "</td>
					<td>" . $time . "</td>
					<td>" . $status . "</td>
						<tr>";
			}
			print "</table></td></tr></table> ";
            
            
            
            
			?>








        </div>


        <!-- Footer -->
        <footer class="page-footer font-small indigo">
            <div class="footer text-center py-3">BrooklynAirport
            </div>
        </footer>
        <!-- Footer -->



    </div>
</body>

</html>
