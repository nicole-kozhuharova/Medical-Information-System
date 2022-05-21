<?php

//If port 3306 is not available, set to a new port and change the value
$servername = "localhost:3306"; //$servername = "localhost:your_port"; 
$db_user = "root";
$db_password = "";

$db_name = "medical_db";

//Create connection
$connect = mysqli_connect($servername, $db_user, $db_password, $db_name);

//Check if connected successfully
if (mysqli_connect_error()) {
    die("Unable to connect: " . mysqli_connect_error());
}

?>