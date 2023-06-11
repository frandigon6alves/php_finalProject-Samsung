<?php
    require_once("datos.php");

    function connectDB() {
        $conn = new mysqli(SERVER_ADDRESS, DB_USERNAME, DB_PASSWORD, DB_NAME);

        if ($conn->connect_error) {
            die("Lo siento. No es posible conectarse: " . $conn->connect_error);
        }

        return $conn;
    }
?>