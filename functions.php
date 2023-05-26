<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "registro";

    function connect_to_db() {
        
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("No es posible conectarse: " . $conn->connect_error);
        }

        return $conn;
    }
?>