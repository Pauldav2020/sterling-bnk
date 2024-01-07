<?php
    $host = "localhost";
    $user = "root";
    $pass = "root";
    //$db = "stalaryx_stlingdatabasekodgy";
    $db = "swiftBankDatabase2";
    $conn = mysqli_connect($host, $user, $pass, $db);
    if(!$conn){
        die("Database Could not be reaached".mysqli_connect_error());
    }
?>