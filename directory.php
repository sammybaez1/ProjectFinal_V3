<?php
session_start();
if(!isset($_SESSION['currentDate'])){
    $_SESSION['currentDate'] = $_POST['currentDate'];
}

//IF YOU WANT TO LOG OUT WHEN GOING BACK TO DIRECTORY
// UNCOMMENT THIS CODE 

/*
if(isset($_SESSION['customerLoggedIn'])){
    $_SESSION['customerLoggedIn'] = null;
}

if(isset($_SESSION['admin'])){
    $_SESSION['admin'] = null;
    $_SESSION['customerLoggedIn'] = null;
}






*/

?>

<!DOCTYPE html>
<html>
<title>Directory</title>

<head>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <style>

    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<body>
    <div class="container-fluid">
        <!-- nav -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-info">
            <a class="navbar-brand" href="#">Project 2 Directory</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">


                </ul>
            </div>

        </nav>
        <div class="container bg-light">
            <?php
			print ' <a> Today is  ' . $_SESSION['currentDate'] . '  </a><br>';
			?>
            <label for="Airports">Airports</label>
            <ul id="Airports">
                <li><a href="./QueensAirport/QueensAirport.php">Queens Airport</a></li>
                <li><a href="./ManhattanAirport/ManhattanAirport.php">Manhattan Airport</a></li>
                <li><a href="./BrooklynAirport/BrooklynAirport.php">Brooklyn Airport</a></li>
            </ul>

            <label for="Airlines">Airlines</label>
            <ul id="Airlines">
                <li><a href="./JetRed/JetRed.php">JetRed</a></li>
                <li><a href="./JetGreen/JetGreen.php">JetGreen</a></li>
                <li><a href="./JetBlue/JetBlue.php">JetBlue</a></li>
            </ul>
            <a href="./SearchEngine/SearchEngine.php">SearchEngine</a>
        </div>
    </div>

</body>

</html>
