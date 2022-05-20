<?php
session_start();
include "../connect-db.php";
if (isset($_SESSION['username']) && isset($_SESSION['id'])) { 
    
    $doctor_id = $_SESSION['id'];
    $patient_id = (int) $_GET['id'];

    // Insert new perscription
    $insert_prescription = "INSERT INTO prescription (doctor_id, patient_id) VALUES ($doctor_id, $patient_id)";
    mysqli_query($connect, $insert_prescription);
    $prescription_id = mysqli_insert_id($connect);

    foreach($_POST["medication-id"] as $key => $value) {
        $medication_id = $_POST["medication-id"][$key];
        $dosage = (int) $_POST['dosage'][$key];
        $times_day = (int) $_POST['times-day'][$key];
        $duration = (int) $_POST['duration'][$key];

        $insert_prescription_for_med = "INSERT INTO medication_in_prescription (prescription_id, medication_id, dosage, times_a_day, duration) 
                                        VALUES ($prescription_id, $medication_id, $dosage, $times_day, $duration)";

        mysqli_query($connect, $insert_prescription_for_med);

    }

    header("Location: ../view-prescription.php?id=$prescription_id");

}

?>
