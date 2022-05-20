<?php
    session_start();
    include "connect-db.php";
    $u_id = $_SESSION['id'];

    $sql = "SELECT * from user 
    INNER JOIN patient ON user.id = patient.patient_id 
    INNER JOIN appointment ON patient.patient_id = appointment.patient_id 
    INNER JOIN doctor ON doctor.doctor_id = appointment.doctor_id
    WHERE doctor.doctor_id = '$u_id'
    GROUP BY patient.patient_id
    ORDER BY user.name ASC;
    ";

    $res = mysqli_query($connect, $sql);


    if (isset($_SESSION['username']) && isset($_SESSION['id'])) 
    {   ?>

<!DOCTYPE html>
<html>
<head>
	<title>Patients List</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/patients-list.css">
    <link rel="stylesheet" href="styles/header.css">
</head>
<body>
    <header class="header">
        <nav class="navigation">
            <a href="home.php" class="profile" style="text-decoration: none;">
                <img src="images/PhotoAvatar.jpg" alt="Avatar" class="avatar"> 
                <span class="names">
                    <?=$_SESSION['name']?>
                    <?=$_SESSION['fname']?>
                </span>
            </a>

            <a href="log-out.php" class="btn btn-primary logout-btn">Log Out</a>
        </nav>
    </header>

    <div class="main-container">
        <div class="main-content">
            <div class="page-title">My Patients</div>
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">More Info</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
				  	$i =1;
				  	while ($rows = mysqli_fetch_assoc($res)) {?>
				    <tr>
				      <th scope="row"><?=$i?></th>
				      <td><?=$rows['name']?> <?=$rows['fname']?></td> 
				      <td>
                        <div class="btn-holder">
                            <a class="btn btn-primary" href="patient-info.php?id=<?=$rows['patient_id']?>" role="button">Info</a>
                        </div>
                       
                    </td>
				    </tr>
				    <?php $i++; }?>
                    </tbody>
            </table>
        </div>
    </div>
</body>
</html>
    <?php } ?>