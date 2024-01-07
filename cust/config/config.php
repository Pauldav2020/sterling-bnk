<?php
    $host = "localhost";
    $user = "stalaryx_stllinguserskodgy";
    $pass = "Fakepassword@kodgy09";
    $db = "stalaryx_stlingdatabasekodgy";
    //$db = "swiftBankDatabase2";
    $conn = mysqli_connect($host, $user, $pass, $db);
    $conn = mysqli_connect($host, $user, $pass, $db);
    if(!$conn){
        die("Database Could not be reaached".mysqli_connect_error());
    }
?>