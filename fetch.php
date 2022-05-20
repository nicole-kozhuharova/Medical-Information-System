<?php

include("appointments.php");
if(isset($_POST['request'])){
    $request = $_POST['request'];

    $query = "SELECT * FROM appointment WHERE date > DATE_SUB(NOW(), INTERVAL 1 DAY);";
    $result = mysqli_query($connect, $sql);
}
?>