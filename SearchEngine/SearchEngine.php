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
    <title>Flight Search</title>
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
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <a class="navbar-brand" href="SearchEngine.php">Flight Search</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="SearchEngine.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../directory.php">Directory</a>
                    </li>

                    <?php
					//change nav if signed in
                    if(isset($_SESSION['searchEngineAdmin'])){
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
				if(isset($_SESSION['searchEngineAdmin'])){
                    print " Logged In: ";
					print '<a id="myprofile" class="account" S href="myprofile.php">   ' . $_SESSION['searchAdmin'] . '  </a>';
					print " | ";
					print '<a id="signOut" class="account" S href="signout.php">Log Out</a>';
                }

				else if (!isset($_SESSION["customerLoggedIn"])) {
					print '
							<a id="userAccount" class="account" href="login.php">Sign in</a>
							<a id="registerAccount" class="account" S href="register.php">Register</a>
							';
				}else {
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



            <div class="container bg-light">
                <form action="SearchEngine.php" method="post" id="flightForm">
                    <label for="airline">Airline</label>
                    <select name="airline">
                        <option value="default">All Airlines</option>
                        <option value="JetBlue">JetBlue</option>
                        <option value="JetRed">JetRed</option>
                        <option value="JetGreen">JetGreen</option>
                    </select>
                    <label for="from"></label>
                    <select name="fromAirport" id="from" onchange="changeOptions()">
                        <option value="QueensAirport">QueensAirport</option>
                        <option value="BrooklynAirport">BrooklynAirport</option>
                        <option value="ManhattanAirport">ManhattanAirport</option>
                    </select>
                    <label for="toAirport">To</label>
                    <select name="toAirport" id="to">
                        <option value="BrooklynAirport">BrooklynAirport</option>
                        <option value="ManhattanAirport">ManhattanAirport</option>
                    </select>
                    <label for="fromTime">Between</label>
                    <input type="date" name="fromTime" min="2019-12-03" max="2019-12-31" value="2019-12-03" id="leftRange" onchange="changeMinDate()">
                    <label for="toTime"> And </label>
                    <input type="date" name="toTime" min="2019-12-03" max="2019-12-31" value="2019-12-03" id="rightRange">

                    <input type="submit" name="Submit" value="Search Flights">
                </form>

                <script>
                    function changeMinDate() {
                        var max = document.getElementById("leftRange");
                        var min = document.getElementById("rightRange");
                        min.min = max.value;
                        min.value = max.value;
                    }




                    function changeOptions() {
                        var airportOptions = document.getElementById("to");
                        var airportValue = document.getElementById("from").value;
                        switch (airportValue) {
                            case "QueensAirport":
                                airportOptions.options.length = 0;
                                var option_1 = document.createElement("option");
                                option_1.text = "BrooklynAirport";
                                option_1.value = "BrooklynAirport";
                                airportOptions.add(option_1);
                                var option_2 = document.createElement("option");
                                option_2.text = "ManhattanAirport";
                                option_2.value = "ManhattanAirport";
                                airportOptions.add(option_2);
                                break;
                            case "BrooklynAirport":
                                airportOptions.options.length = 0;
                                var option_1 = document.createElement("option");
                                option_1.text = "QueensAirport";
                                option_1.value = "QueensAirport";
                                airportOptions.add(option_1);
                                var option_2 = document.createElement("option");
                                option_2.text = "ManhattanAirport";
                                option_2.value = "ManhattanAirport";
                                airportOptions.add(option_2);
                                break;
                            case "ManhattanAirport":
                                airportOptions.options.length = 0;
                                var option_1 = document.createElement("option");
                                option_1.text = "QueensAirport";
                                option_1.value = "QueensAirport";
                                airportOptions.add(option_1);
                                var option_2 = document.createElement("option");
                                option_2.text = "BrooklynAirport";
                                option_2.value = "BrooklynAirport";
                                airportOptions.add(option_2);
                                break;
                                break;
                        }
                    }

                </script>
            </div>





        </div>

        <?php
        if(array_key_exists('Submit',$_POST)){
           if(!isset($_SESSION['customerLoggedIn'])){
               print'
                   <div align="center">
                       <button type="button" onclick="sortByAirline()">Sort by airline</button>
                       <button type="button" onclick="sortByFare()">Sort by fare</button>
                   </div>
                   <script>
                   function sortByFare() {
                        var table, i, x, y; 
                        table = document.getElementById("seTable"); 
                        console.log(table);
                        var switching = true; 

                        // Run loop until no switching is needed 
                        while (switching) { 
                            switching = false; 
                            var rows = table.rows; 
                            console.log(rows);

                            // Loop to go through all rows 
                            for (i = 1; i < (rows.length - 1); i++) { 
                                var Switch = false; 

                                // Fetch 2 elements that need to be compared 
                                x = rows[i].getElementsByTagName("TD")[7]; 
                                console.log(x);
                                y = rows[i + 1].getElementsByTagName("TD")[7]; 

                                // Check if 2 rows need to be switched 
                                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) 
                                    { 

                                    // If yes, mark Switch as needed and break loop 
                                    Switch = true; 
                                    break; 
                                } 
                            } 
                            if (Switch) { 
                                // Function to switch rows and mark switch as completed 
                                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]); 
                                switching = true; 
                            } 
                        } 
                    }
                    
                    
                    
                    function sortByAirline() {
                        var table, i, x, y; 
                        table = document.getElementById("seTable"); 
                        console.log(table);
                        var switching = true; 

                        // Run loop until no switching is needed 
                        while (switching) { 
                            switching = false; 
                            var rows = table.rows; 
                            console.log(rows);

                            // Loop to go through all rows 
                            for (i = 1; i < (rows.length - 1); i++) { 
                                var Switch = false; 

                                // Fetch 2 elements that need to be compared 
                                x = rows[i].getElementsByTagName("TD")[0]; 
                                console.log(x);
                                y = rows[i + 1].getElementsByTagName("TD")[0]; 

                                // Check if 2 rows need to be switched 
                                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) 
                                    { 

                                    // If yes, mark Switch as needed and break loop 
                                    Switch = true; 
                                    break; 
                                } 
                            } 
                            if (Switch) { 
                                // Function to switch rows and mark switch as completed 
                                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]); 
                                switching = true; 
                            } 
                        } 
                    }
                    
                    
                   </script>'

                   
               ;
               $airline = $_POST['airline'];
               $fromAirport = $_POST['fromAirport'];
               $toAirport = $_POST['toAirport'];
               $fromTime = $_POST['fromTime'];
               $toTime = $_POST['toTime'];
               if($airline == 'default'){
                   $stmt = $mysqli->prepare("select * from flights where startAirport = (?) and endAirport = (?) and departureTime and arrivalTime between (?) and (?) and airline = airline;");
                   $stmt->bind_param('ssss',$fromAirport,$toAirport, $fromTime,$toTime);
               }else{
                   $stmt = $mysqli->prepare("select * from flights where departureTime and arrivalTime between (?) and (?) and airline =(?);");
                   $stmt->bind_param('sss',$fromTime,$toTime, $airline);
               }
               
               
               $stmt->execute();
               $result = $stmt->get_result();
                    print "<div class='table-responsive'>
                        <table class='table' id='seTable'>

                    <tr>
                        <th>" . "Airline" . "</th>
                        <th>" . "Flight #" . "</th>
                        <th>" . "Departing" . "</th>
                        <th>" . "Destination" . "</th>
                        <th>" . "Departure" . "</th>
                        <th>" . "Arrival" . "</th>
                        <th>" . "Capacity" . "</th>
                        <th>" . "Fare" . "</th>
                        <th>" . "Status" . "</th>
                            </tr>";


                    while ($row = $result->fetch_assoc()) {
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


                        $display = 0;

                        if($status == "Canceled"){
                            $display = "Canceled";
                        }
                        else if($isFull === 1){
                            $display = "Full";
                        }
                        else{
                           $display = "Log in to Book";
                        }

                print
                "<tr>
                    <td>" . $airline . "</td>
                    <td>" . $flightNum . "</td>
                    <td>" . $startAirport . "</td>
                    <td>" . $endAirport . "</td>
                    <td>" . $departureTime . "</td>
                    <td>" . $arrivalTime . "</td>
                    <td>" . $capacity . "</td>
                    <td>" . $fare . "</td>
                    <td>" . $status . "</td>
                    <td>" . $display . "</td>
                </tr>";
                    }
                    print "</table>";

                    }
                else{
                    print'
                   <div align="center">
                       <button type="button" onclick="sortByAirline()">Sort by airline</button>
                       <button type="button" onclick="sortByFare()">Sort by fare</button>
                   </div>
                   <script>
                   function sortByFare() {
                        var table, i, x, y; 
                        table = document.getElementById("seTable"); 
                        console.log(table);
                        var switching = true; 

                        // Run loop until no switching is needed 
                        while (switching) { 
                            switching = false; 
                            var rows = table.rows; 
                            console.log(rows);

                            // Loop to go through all rows 
                            for (i = 1; i < (rows.length - 1); i++) { 
                                var Switch = false; 

                                // Fetch 2 elements that need to be compared 
                                x = rows[i].getElementsByTagName("TD")[7]; 
                                console.log(x);
                                y = rows[i + 1].getElementsByTagName("TD")[7]; 

                                // Check if 2 rows need to be switched 
                                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) 
                                    { 

                                    // If yes, mark Switch as needed and break loop 
                                    Switch = true; 
                                    break; 
                                } 
                            } 
                            if (Switch) { 
                                // Function to switch rows and mark switch as completed 
                                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]); 
                                switching = true; 
                            } 
                        } 
                    }
                    
                    
                    
                    function sortByAirline() {
                        var table, i, x, y; 
                        table = document.getElementById("seTable"); 
                        console.log(table);
                        var switching = true; 

                        // Run loop until no switching is needed 
                        while (switching) { 
                            switching = false; 
                            var rows = table.rows; 
                            console.log(rows);

                            // Loop to go through all rows 
                            for (i = 1; i < (rows.length - 1); i++) { 
                                var Switch = false; 

                                // Fetch 2 elements that need to be compared 
                                x = rows[i].getElementsByTagName("TD")[0]; 
                                console.log(x);
                                y = rows[i + 1].getElementsByTagName("TD")[0]; 

                                // Check if 2 rows need to be switched 
                                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) 
                                    { 

                                    // If yes, mark Switch as needed and break loop 
                                    Switch = true; 
                                    break; 
                                } 
                            } 
                            if (Switch) { 
                                // Function to switch rows and mark switch as completed 
                                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]); 
                                switching = true; 
                            } 
                        } 
                    }
                    
                    
                   </script>'

                   
               ;
                       $airline = $_POST['airline'];
                       $fromAirport = $_POST['fromAirport'];
                       $toAirport = $_POST['toAirport'];
                       $fromTime = $_POST['fromTime'];
                       $toTime = $_POST['toTime'];
                       if($airline == 'default'){
                       $stmt = $mysqli->prepare("select * from flights where startAirport = (?) and endAirport = (?) and departureTime and arrivalTime between (?) and (?) and airline = airline;");
                       $stmt->bind_param('ssss',$fromAirport,$toAirport, $fromTime,$toTime);
                       }else{
                       $stmt = $mysqli->prepare("select * from flights where departureTime and arrivalTime between (?) and (?) and airline =(?);");
                       $stmt->bind_param('sss',$fromTime,$toTime, $airline);
                       }
                   $stmt->execute();
                   $result = $stmt->get_result();
                    print "<div class='table-responsive'>
                        <table class='table' id='seTable'>

                    <tr>
                        <th>" . "Airline" . "</th>
                        <th>" . "Flight #" . "</th>
                        <th>" . "Departing" . "</th>
                        <th>" . "Destination" . "</th>
                        <th>" . "Departure" . "</th>
                        <th>" . "Arrival" . "</th>
                        <th>" . "Capacity" . "</th>
                        <th>" . "Fare" . "</th>
                        <th>" . "Status" . "</th>
                            </tr>";


                    while ($row = $result->fetch_assoc()) {
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
                <td>" . $airline . "</td>
                <td>" . $flightNum . "</td>
                <td>" . $startAirport . "</td>
                <td>" . $endAirport . "</td>
                <td>" . $departureTime . "</td>
                <td>" . $arrivalTime . "</td>
                <td>" . $capacity . "</td>
                <td>" . $fare . "</td>
                <td>" . $status . "</td>
                <td>" . $display . "</td>
            </tr>";
                }
                print "</table>";


                }
       }

        
        
        
        ?>



        <!-- Footer -->
        <footer class="page-footer font-small indigo">
            <div class="footer text-center py-3">JetRed
            </div>
        </footer>
        <!-- Footer -->



    </div>
</body>

</html>
