<?php
    session_start();
    include "connect-db.php";

    $prescription_id = (int) $_GET['id'];
    $u_id = $_SESSION['id'];

    $sql = "SELECT * from medication_in_prescription 
    INNER JOIN prescription ON medication_in_prescription.prescription_id  = prescription.prescription_id 
    INNER JOIN medication ON medication_in_prescription.medication_id = medication.medication_id
    WHERE prescription.prescription_id = '$prescription_id'
    ";

    $res = mysqli_query($connect, $sql);

    $query = "SELECT * from user 
    INNER JOIN prescription ON user.id = prescription.doctor_id
    WHERE prescription.prescription_id='$prescription_id'
    ";

    $result = mysqli_query($connect, $query);

    $row = mysqli_fetch_assoc($result);

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
    <link rel="stylesheet" href="styles/view-prescription.css">

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
        <div class="page-title">Prescription Overview</div>
        <div class="doctor-name">Doctor: <?=$row['name']?> <?=$row['fname']?></div>
            <table class="table table-hover prescr-table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Medication Name</th>
                    <th scope="col">Dosage</th>
                    <th scope="col">Times a Day</th>
                    <th scope="col">Duration in Days</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
				  	$i =1;
				  	while ($rows = mysqli_fetch_assoc($res)) {?>
				    <tr>
				      <th scope="row"><?=$i?></th>
				      <td><?=$rows['medication_name']?></td>
                      <td><?=$rows['dosage']?></td>
				      <td><?=$rows['times_a_day']?></td>
                      <td><?=$rows['duration']?></td>
				    </tr>
				    <?php $i++; }?>
                    </tbody>
            </table>
            <div class="button-container">
                <button class="btn btn-primary" id="download-button">Download Prescription</button>
            </div>
        </div>
    </div>
</body>
<script>
    function htmlToCSV(html, filename) {
        var data = [];
        var rows = document.querySelectorAll("table tr");
                
        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll("td, th");   
            for (var j = 0; j < cols.length; j++) {
                row.push(cols[j].innerText);
            }    
            data.push(row.join(",")); 		
        }
        downloadCSVFile(data.join("\n"), filename);
    }
</script>

<script>
    function downloadCSVFile(csv, filename) {
        var csv_file, download_link;
        csv_file = new Blob([csv], {type: "text/csv"});
        download_link = document.createElement("a");
        download_link.download = filename;
        download_link.href = window.URL.createObjectURL(csv_file);
        download_link.style.display = "none";
        document.body.appendChild(download_link);
        download_link.click();
    }
</script>

<script>
    document.getElementById("download-button").addEventListener("click", function () {
        var html = document.querySelector("table").outerHTML;
        htmlToCSV(html, "prescription.csv");
    });
</script>

</html>
    <?php } ?>