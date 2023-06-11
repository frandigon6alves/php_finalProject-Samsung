<!DOCTYPE HTML>
<html>

    <head>
        <title>SUBMIT</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <script src="index.js" defer></script>
        <script src="https://kit.fontawesome.com/b37653d681.js"></script>
    </head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    body {
      background: linear-gradient(90deg, #00dbde 0%, #b6c2c1 100%);
      display: flex;
      flex-direction: column;
      padding: 25px;
    }

     </style>
    
<body>

<?php

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // Connect to DB
    require_once("functions.php");
    $conn = connectDB();

// Get data from form
    $name = trim($_POST["username"]);
    $first_surname = trim($_POST["firstSurname"]);
    $second_surname = trim($_POST["secondSurname"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

// Check if user has already registered
    $sql_complete_name_query = "SELECT * FROM USUARIOS 
                                WHERE nombre='$name' 
                                AND primer_apellido='$first_surname'
                                AND segundo_apellido='$second_surname'";
    $complete_name_duplicates = $conn->query($sql_complete_name_query);

    $is_error = false;
    if ($complete_name_duplicates->num_rows > 0) {
        echo "<div class='registration-error'>";
        echo "ERROR:  Este nombre ya tines registro. ";
        echo "Espere por favor. Estás siendo redirigido al formulario.";
        echo "</div>";
        $is_error = true;
    }

     // Check if user e-mail already exists
    $sql_email_query = "SELECT * FROM USUARIOS 
                        WHERE email='$email'";
    $email_duplicates = $conn->query($sql_email_query);
    if ($email_duplicates->num_rows > 0) {
        echo "<div class='registration-error'>";
        echo "ERROR: Este e-mail ya se encuentra registrado. ";
        echo "Espere por favor. Estás siendo redirigido al formulario.";
        echo "</div>";
        $is_error = true;
    }
    $password_length = strlen($password);
    if ($password_length < 4 || $password_length > 8) {
        echo "<div class='registration-error'>ERROR: La contraseña debe tener entre 4 y 8 caracteres. Espere por favor. Estás siendo redirigido al formulario.</div>";
        $is_error = true;        
    }

    if($is_error) {
        header("refresh:10;url=registration.html");
        exit;
    }
    
    // Insert data into DB
    try {
        $sql_insert = "INSERT INTO USUARIOS (nombre, primer_apellido, segundo_apellido, email, password) 
                       VALUES ('$name', '$first_surname', '$second_surname', '$email', '$password')";

        // Successful insert
        if ($conn->query($sql_insert) === TRUE) {
            echo "<div class='registration-success'>";
            echo "Registro completado con éxito.";
            echo '<div><input class="btn btn-primary search-button" type="button" value="CONSULTA" onclick="location.href=\'search.php\'" style="background-color: #078082; border: 2px solid #abb2b3;"></div>';
            echo "</div>";
        } 
    } catch (mysqli_sql_exception $e) {
        // Show error in Spanish if variable exceeds the maximum number of characters (30)
        if ($e instanceof mysqli_sql_exception && str_contains($e->getMessage(), "Data too long for column")) {
            $error_message = $e->getMessage();
            $start_position = strpos($error_message, "column") + strlen("column");
            $end_position = strpos($error_message, "at row") - 1;
            $column_name = substr($error_message, $start_position, $end_position - $start_position);
            echo "<div class='registration-error'>";
            echo "ERROR: Se ha sobrepasado el número máximo de caracteres (50) en el campo $column_name. ";
            echo "Espere por favor. Estás siendo redirigido al formulario.";
            echo "</div>";
            header("refresh:10;url=registration.html" );
        
        // Show other errors
        } else {
            echo "<div class='registration-error'>";
            echo "Lo siento, no se han podido registrar los datos. ";
            echo "ERROR: " . $e;
            echo "</div>";
        }
        exit;
    }

    $conn->close();
}

?>

 </body>
</html>