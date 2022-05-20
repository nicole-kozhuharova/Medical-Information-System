<?php
    session_start();
    include "connect-db.php";
    if (isset($_SESSION['username']) && isset($_SESSION['id'])) 
    {   ?>

<!DOCTYPE html>
<html>
<head>
	<title>Patient</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/home.css">
    <link rel="stylesheet" href="styles/header.css">
</head>
<body>
    <header class="header">
        <nav class="navigation">
            <div class="profile">
                <img src="images/PhotoAvatar.jpg" alt="Avatar" class="avatar"> 
                <span class="names">
                    <?=$_SESSION['name']?>
                    <?=$_SESSION['fname']?>
                </span>
            </div>

            <a href="log-out.php" class="btn btn-primary logout-btn">Log Out</a>
        </nav>
    </header>
    
    <div class="main-container">
        <div class="btns-container">
            <div class="btn-holder">
                <a class="btn btn-primary" href="patient-prescriptions-list.php" role="button">Prescriptions</a>
            </div>
            <div class="btn-holder">
                <a class="btn btn-primary" href="patient-appointments-list.php" role="button">Appointments</a>
            </div>
        </div>
    </div>
</body>
</html>
    <?php } ?>