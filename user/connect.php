<?php
    $mysqli=mysqli_connect("localhost","root","", "publicationweb");

    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

?>