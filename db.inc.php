<?php
    $servername="localhost";
    $serverusername="root";
    $serverpassword="temitope";
    $dbname="image";
    $connection=mysqli_connect($servername, $serverusername, $serverpassword, $dbname);
    if (!$connection) {
        die("Error in connection!".mysqli_connect_error());
    }

?>