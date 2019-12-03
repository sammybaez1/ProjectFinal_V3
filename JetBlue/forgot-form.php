<?php
    session_start();
    require '../database-connection.php';
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>JetBlue</title>
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
    <?php
			?>

    <div class="container-fluid">
        <!-- nav -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="JetBlue.php">JetBlue</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="JetBlue.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="booking.php">Booking</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../directory.php">Directory</a>
                    </li>
                    <?php
					//change nav if signed in
					if (isset($_SESSION["customerLoggedIn"])) {
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
				 if(isset($_SESSION['JetBlueAdmin'])){
                    print " Logged In: ";
					print '<a id="myprofile" class="account" S href="myprofile.php">   ' . $_SESSION['redAdmin'] . '  </a>';
					print " | ";
					print '<a id="signOut" class="account" S href="signout.php">Log Out</a>';
                }

				else if (!isset($_SESSION["customerLoggedIn"])) {
					print '
							<a id="userAccount" class="account" href="login.php">Sign in</a>
							<a id="registerAccount" class="account" S href="register.php">Register</a>
							';
				} 
                
                else {
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

            
            <form id="forgot-form" action="forgot-form.php" method="post">
			<fieldset>
				<legend>Forgot Password</legend>
				<label for="username">Username</label><br>
				<input name="username" id="username" type="username"><br />
				<label for="email">Email Address</label><br />
				<input name="email" id="email" type="email"><br />
				<label for="secretquestion">Secret Question</label><br />
				<select name="secretquestion" id="secretquestion" type="secretquestions">
				<option value="sq1">What is your mother's maiden name?</option>
				<option value="sq2">What was your first pet?</option>
				<option value="sq3">What was the model of your first car?</option>
				<option value="sq4">In what city were you born?</option>
				</select>
				<br> <label for="secretanswer">Secret Answer</label><br />
				<input name="secretanswer" id="secretanswer" type="secretanswer"><br />
				<input type="submit" name="Submit" id="Submit">
			</fieldset>
		</form>
            
            <?php
            
             if(array_key_exists('Submit',$_POST)){
                 $username = $_POST['username'];
                 $email = $_POST['email'];
                 $sa = $_POST['secretanswer'];
                 
                 $stmt = $mysqli->prepare('Select password from customers where user_id=(?) and email =(?) and secretAnswer=(?);');
                 $stmt->bind_param('sss',$username,$email, $sa);
                 $stmt->execute();
                 $result = $stmt->get_result();
                 $row = $result->fetch_assoc();
                 $pass = $row['password'];
                 print "<p>Your password is: $pass</p>";
             }
            
            
            ?>

        </div>
        <!-- Footer -->
        <footer class="page-footer font-small indigo">
            <div class="footer text-center py-3">JetBlue
            </div>
        </footer>
        <!-- Footer -->
    </div>
</body>
<html>
		
</html>