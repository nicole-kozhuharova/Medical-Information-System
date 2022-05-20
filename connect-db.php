<?php
$servername = "localhost:4306";
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