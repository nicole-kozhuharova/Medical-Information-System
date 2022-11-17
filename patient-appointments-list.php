<?php
    session_start();
    include "connect-db.php";

    $u_id = $_SESSION['id'];

    $sql = "SELECT * from user 
    INNER JOIN doctor ON user.id = doctor.doctor_id 
    INNER JOIN appointment ON doctor.doctor_id = appointment.doctor_id 
    INNER JOIN patient ON patient.patient_id = appointment.patient_id
    WHERE  patient.patient_id = '$u_id'
    ORDER BY date DESC;
    ";

    $res = mysqli_query($connect, $sql);


    if (isset($_SESSION['username']) && isset($_SESSION['id'])) 
    {   
?>

<!DOCTYPE html>
<html>
<head>
	<title>Appointments</title>
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
                    <th scope="col">Doctor Name</th>
                    <th scope="col">Date and Time</th>
                    <th scope="col">Description</th>
                    <th scope="col">Room</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
				  	$i =1;
				  	while ($rows = mysqli_fetch_assoc($res)) {
                        $class_value = ''; 
                        if(date('d/m/Y H:i', strtotime($rows['date'])) >= date('d/m/Y H:i')) { 
                          $class_value = "past";
                        } else {
                            $class_value = "upcoming";
                        }
                    ?>
				    <tr class="<?php echo $class_value; ?>">
				      <th scope="row"><?=$i?></th>
				      <td><?=$rows['name']?> <?=$rows['fname']?></td>
				      <td><?=date('d/m/Y H:i', strtotime($rows['date']))?></td>
                      <td><?=$rows['description']?></td>
                      <td><?=$rows['room']?></td>
				    </tr>
				    <?php $i++; }?>
                    </tbody>
            </table>
        </div>
    </div>
</body>
</html>
    <?php } ?>