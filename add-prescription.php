<?php
    session_start();
    include "connect-db.php";

    $id = $_GET['id'];

    $sql = "SELECT * FROM medication ORDER BY medication_name ASC";
    $res = mysqli_query($connect, $sql);

    $query = "SELECT * from  medication_in_prescription
    INNER JOIN medication ON medication_in_prescription.medication_id = medication. medication_id 
    INNER JOIN prescription ON medication_in_prescription.prescription_id = prescription.prescription_id 
    ";

    $result = mysqli_query($connect, $query);
    $last_id = -1;

    if (isset($_SESSION['username']) && isset($_SESSION['id'])) 
    {   ?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Prescription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/add-prescription.css">
    <link rel="stylesheet" href="styles/header.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body>
    <header class="header">
        <nav class="navigation">
            <a href="doctor.php" class="profile" style="text-decoration: none;">
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
        <div class="" id="readroot"></div>
            <form action="php/form-prescription.php?id=<?=$id?>" method="POST" class="form-container form-container1" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <button type="submit" name="submit" class="btn btn-primary submit-btn submit">Submit</button>
            </form>
            <div class="prescription" style="display:none;">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="form-label">Medication Name</label>
                        <select name="medication-id[]" class="form-control medication_name" id="medication_id">
                            <option value="0"></option>
                            <?php
                                foreach($res as $row) {
                            ?>
                            <option value="<?=$row["medication_id"]?>"><?=$row["medication_name"]?></option>
                            <?php
                                }
                            ?>
                        </option>
                    </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Dosage</label>
                        <input type="number" name="dosage[]" class="form-control" id="dosage">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Times a Day</label>
                        <input type="number" name="times-day[]" class="form-control" id="times_a_day">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Duration in Days</label>
                        <input type="number" name="duration[]" class="form-control" id="duration">
                    </div>
                    <hr/>
                </div>
            <button class="btn btn-primary add_input_fields_button">Add another medication</button>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            var max_fields=30;
            var wrapper = $(".form-container");
            var add_button = $(".add_input_fields_button");
            var x = 1;
            $(add_button).click(function(e){
                e.preventDefault();
                if(x < max_fields) {
                    var medication_html = $('.prescription').html();
                    var id = 'medication_id' + x;
                    medication_html = medication_html.replace('medication_id0', id);
                    $('.submit').before(medication_html);
                    $('#' + id).select2();
                    x++;
                }
            });
        });

        $(document).ready(function() {
            var medication_html = $('.prescription').html();
            medication_html = medication_html.replace('medication_id', 'medication_id0');
            $('.submit').before(medication_html);
            $('#medication_id0').select2();
        });
    </script>
</body>
</html>
    <?php } ?>


