<?php
    session_start();

    if (isset($_SESSION['username']) && isset($_SESSION['id'])) 
    {   
        include "connect-db.php";

        if (!isset($_GET['id'])) {
            header("Location: patients-list.php");
            exit;
        }

        $id = $_GET['id']; 

        if($id == 0) {
            header("Location: patients-list.php");
            exit;
        }

        $sql = "SELECT * FROM user WHERE id=$id";
        $res = mysqli_query($connect, $sql);
  
?>
<!DOCTYPE html>
<html>
<head>
	<title>Doctor</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/patient-info.css">
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
            <div class="personal-info">
                <div class="info-title">Personal Information</div>
                <div class="info-container">
                    <?php $info = mysqli_fetch_assoc($res);?>
                    <?=$info['name']?>
                    <?=$info['fname']?>
                    <br>
                    <?=date('d/m/Y', strtotime($info['date_of_birth']))?>
                    <br>
                    <?=$info['phone_number']?>
                    <br>
                </div>
                <!-- <a href="#">More Information</a> -->
            </div>

            <div class="btns-container">
                <div class="btn-holder">
                    <a class="btn btn-primary active" href="add-prescription.php?id=<?=$id?>" role="button">Add Prescription</a>
                </div>
                <div class="btn-holder">
                    <a class="btn btn-primary active" href="history-of-visits.php?id=<?=$id?>" role="button">History of Visits</a>
                </div>
                <div class="btn-holder">
                    <a class="btn btn-primary inactive" href="#" role="button">Request Laboratory Test</a>
                </div>
                <div class="btn-holder">
                    <a class="btn btn-primary inactive" href="#" role="button">Laboratory Results</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php } ?> 