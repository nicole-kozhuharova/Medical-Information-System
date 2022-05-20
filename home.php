<?php
    session_start();
    include "connect-db.php";
    if (isset($_SESSION['username']) && isset($_SESSION['id'])) 
    {   ?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
    <header class="header" style="padding: .75rem 0; background-color: #0077B6;">
    <nav class="navigation" style="display: flex; align-items: center; justify-content: space-between; width: 95%; margin: 0 auto;">
    <img src="images/avatarimg.png" alt="Avatar" class="avatar" style="vertical-align: middle;
  width: 50px;
  height: 50px;
  border-radius: 50%;"> 
    <a href="log-out.php" class="btn btn-primary" style="color: #fff; background-color: transparent; border-color: #fff;">Log Out</a>
    </nav>

    </header>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh">
        <?php if ($_SESSION['role'] == 'patient') { 
          header("Location: patient-home.php");  
        }else { 
          header("Location: doctor.php");
        }?>    
    </div>
</body>
</html>

<?php }else {
    header("Location: index.php");
}   ?>