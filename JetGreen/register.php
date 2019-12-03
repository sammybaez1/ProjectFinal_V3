<?php
session_start();
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
            <a class="navbar-brand" href="#">JetGreen</a>
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
                </ul>
            </div>
            <div id="account">
                <?php
				print ' <a> Today is  ' . $_SESSION['currentDate'] . '  </a><br>';
				?>
                <a class="account" href="login.php">Sign in</a>
                <a class="account" S href="register.php">Register</a>
            </div>

        </nav>
        <!-- nav -->

        <div class="container bg-light">


            <?php
			require '../database-connection.php';

			?>

            <?php



			if (isset($_GET['registration'])) {
				echo '<p>Registration was Successful</p>';
			}

			?>
            <form id="registration" action="register-user.php" method="post">
                <fieldset>
                    <legend>Registration</legend>
                    <label for="user">Username</label><br>
                    <input name="user" id="user" type="text"><br>
                    <label for="pass">Password</label><br>
                    <input name="pass" id="pass" type="password"><br>
                    <label for="email">Email Address</label><br>
                    <input name="email" id="email" type="email"><br>
                    <label for="firstname">First Name</label><br>
                    <input name="firstname" id="firstname" type="firstname"><br>
                    <label for="lastname">Last Name</label><br>
                    <input name="lastname" id="lastname" type="lastname"><br>
                    <select name="secretquestion" id="secretquestion" type="secretquestions">
                        <option name="a">Secret Question</option>
                        <option value="sq1">What is your mother's maiden name?</option>
                        <option value="sq2">What was your first pet?</option>
                        <option value="sq3">What was the model of your first car?</option>
                        <option value="sq4">In what city were you born?</option>
                    </select><br>
                    <label for="secretanswer">Secret Answer</label><br>
                    <input name="secretanswer" id="secretanswer" type="secretanswer"><br>
                    <input type="submit">
                </fieldset>
            </form>




        </div>
    </div>
</body>

</html>
