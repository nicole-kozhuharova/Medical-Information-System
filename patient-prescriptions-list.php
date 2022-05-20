<?php
    session_start();
    include "connect-db.php";

    $u_id = $_SESSION['id'];

    $sql = "SELECT * from medication_in_prescription 
    INNER JOIN prescription ON medication_in_prescription.prescription_id  = prescription.prescription_id 
    INNER JOIN medication ON medication_in_prescription.medication_id = medication.medication_id
    WHERE prescription.patient_id = '$u_id'
    GROUP BY prescription.prescription_id
    ";

    $res = mysqli_query($connect, $sql);

    if (isset($_SESSION['username']) && isset($_SESSION['id'])) 
    {   
?>

<!DOCTYPE html>
<html>
<head>
	<title>Prescription</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/appointments.css">
    <link rel="stylesheet" href="styles/patients-list.css">
    <link rel="stylesheet" href="styles/header.css">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
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

            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Information</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
				  	$i =1;
				  	while ($rows = mysqli_fetch_assoc($res)) {?>
				    <tr>
				      <th scope="row"><?=$i?></th>
				      <td><?=date('d/m/Y', strtotime($rows['date_prescription']))?></td>
                      <td>        
                        <div class="btn-holder">
                            <a class="btn btn-primary" href="view-prescription.php?id=<?=$rows['prescription_id']?>" role="button">View Prescription</a>
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