<?php

include "../connect-db.php";

function get_patient_id($connect, $id) {
            $sql = "SELECT * FROM user WHERE id=?";
            $statement = $connect->prepare($sql);
            $statement->execute([$id]);

            $patient_id = $statement->fetch();

            return $id;
        }
?>