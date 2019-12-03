<?php
//Server connection info.
$host = 'den1.mysql3.gear.host';
$username = 'cs370';
$password = 'Zu9E~B31v_IK';
$database = 'cs370';

//Connect to server
$mysqli = new mysqli($host, $username, $password, $database);

function query($query)
{
	global $mysqli;
	$result =  $mysqli->query($query);
	return $result;
}


?>
