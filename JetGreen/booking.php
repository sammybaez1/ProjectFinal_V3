<?php
session_start();
require '../database-connection.php';

if(array_key_exists('Book',$_POST)){
    $flightID = $_POST['Book'];
   book($flightID);
}

function book($flightID){
        query("UPDATE flights SET capacity =(capacity-1) WHERE flightID ="."'". $flightID."';");
        query("Insert into customerFlights values("."'".$_SESSION['user']."'".","."'".$flightID."');");
        header("Location: myprofile.php");
}
?>
<!doctype html>


<html>

<head>
    <meta charset="utf-8">
    <title>JetGreen</title>
    <style>
        #account {
            color: white;

        }

        .account {
            color: white;
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
        <nav class="navbar navbar-expand-lg navbar-dark bg-success">
            <a class="navbar-brand" href="JetGreen.php">JetGreen</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="JetGreen.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="booking.php">Booking</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../directory.php">Directory</a>
                    </li>
                    <?php
					//change nav if signed in
                    if(isset($_SESSION['JetGreenAdmin'])){
                        	print '

					<li class="nav-item">
						<a class="nav-link" href="admin.php">Admin Settings</a>
					</ li>
					';
                    }
					else if (isset($_SESSION["customerLoggedIn"])) {
						print '

					<li class="nav-item">
						<a class="nav-link" href="myprofile.php">My Flights</a>
					</ li>
					';
                      
                        
					}
					?>
                </ul>
            </div>

            <div id="account">
                <?php
				print ' <a> Today is  ' . $_SESSION['currentDate'] . '  </a><br>';
				?>

                <?php
				//change nav if signed in
				if(isset($_SESSION['JetGreenAdmin'])){
                    print " Logged In: ";
					print '<a id="myprofile" class="account" S href="myprofile.php">   ' . $_SESSION['greenAdmin'] . '  </a>';
					print " | ";
					print '<a id="signOut" class="account" S href="signout.php">Log Out</a>';
                }

				else if (!isset($_SESSION["customerLoggedIn"])) {
					print '
							<a id="userAccount" class="account" href="login.php">Sign in</a>
							<a id="registerAccount" class="account" S href="register.php">Register</a>
							';
				} else {
					print " Logged In: ";
					print '<a id="myprofile" class="account" S href="myprofile.php">   ' . $_SESSION['user'] . '  </a>';
					print " | ";
					print '<a id="signOut" class="account" S href="signout.php">Log Out</a>';
				}
				?>
            </div>

        </nav>
        <!-- nav -->

        <div class="container bg-light">

        </div>

    </div>
    <div id="SignInPrompt">
        <?php
          if(isset($_SESSION['JetGreenAdmin'])){
                print '<p align="center"> Log in as customer to book<p>';
            }
        else if (!isset($_SESSION["customerLoggedIn"])) {
            print '<p align="center"> Must be logged in to book </p>';        
        }else{
            

			$result = query("SELECT * FROM flights WHERE airline='JetGreen'");

			print "<div class='table-responsive'>
				<table class='table'>

			<tr>
				<td>" . "Flight #" . "</td>
				<td>" . "Departing" . "</td>
				<td>" . "Destination" . "</td>
				<td>" . "Departure" . "</td>
				<td>" . "Arrival" . "</td>
				<td>" . "Capacity" . "</td>
				<td>" . "Fare" . "</td>
				<td>" . "Status" . "</td>
					<tr>";


			while ($row = mysqli_fetch_assoc($result)) {
                $flightID = $row['flightID'];
				$flightNum = $row['flightNumber'];
				$bookingPage = $row['bookingPage'];
				$airline = $row['airline'];
				$startAirport = $row['startAirport'];
				$endAirport = $row['endAirport'];
				$departureTime = $row['departureTime'];
				$arrivalTime = $row['arrivalTime'];
				$capacity = $row['capacity'];
				$fare = $row['fare'];
				$status = $row['status'];
                $alreadyBooked = 0;
                $isFull = 0;
                if($capacity < 1){
                    $isFull = 1;
                }
                else{
                    $isFull = 0;
                }
                $checkBooking = query("select * from customerFlights where user_id ="."'".$_SESSION['user']."'"." and flightID = ". "'".$flightID."'");
                if($checkBooking->num_rows > 0){
                    $alreadyBooked = 1;
                }
                
                
                $display = 0;
                if($alreadyBooked === 1){
                    $display = "Already Booked";
                }
                else if($status == "Canceled"){
                    $display = "Canceled";
                }
                else if($isFull === 1){
                    $display = "Full";
                }
                else{
                    
                   $display = " <form method='post'>
        <button name='Book' type='submit' value='$flightID'>Book</button>
        </form>";

        }




        print
        "<tr>
            <td>" . $flightNum . "</td>
            <td>" . $startAirport . "</td>
            <td>" . $endAirport . "</td>
            <td>" . $departureTime . "</td>
            <td>" . $arrivalTime . "</td>
            <td>" . $capacity . "</td>
            <td>" . $fare . "</td>
            <td>" . $status . "</td>
            <td>" . $display . "</td>
        <tr>";
            }
            print "</table>";

            }
            ?>
    </div>

    <!-- Footer -->
    <footer class="page-footer font-small indigo">
        <div class="footer text-center py-3">JetGreen
        </div>
    </footer>
    <!-- Footer -->




</body>

</html>
