<!DOCTYPE HTML>
<html>

    <head>
        <title>SUBMIT</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <script src="js/index.js" defer></script>
        <script src="https://kit.fontawesome.com/b37653d681.js"></script>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    
<body>

<?php

if ($_POST) {
    // Sanitize and validate data
    $name = trim($_POST["username"]);
    $first_surname = trim($_POST["firstSurname"]);
    $second_surname = trim($_POST["secondSurname"]);
    $email = trim($_POST["email"]);

    // Connect to DB
    require_once("functions.php");
    $conn = connect_to_db();

    // Check if user has already registered
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE nombre = ? AND primer_apellido = ? AND segundo_apellido = ?");
    $stmt->bind_param("sss", $name, $first_surname, $second_surname);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        displayRegistrationError("Este nombre completo ya se encuentra registrado en nuestra base de datos. Será redirigido al formulario en 5 segundos.");
        exit;
    }

    // Check if user email already exists
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        displayRegistrationError("Este e-mail ya se encuentra registrado en nuestra base de datos. Será redirigido al formulario en 5 segundos.");
        exit;
    }

    // Insert data into DB
    try {
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, primer_apellido, segundo_apellido, email) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $first_surname, $second_surname, $email);
        $stmt->execute();

        // Successful insert
        displayRegistrationSuccess("Registro completado con éxito.");
    } catch (mysqli_sql_exception $e) {
        // Show generic error message
        displayRegistrationError("No se han podido registrar los datos. Por favor, inténtelo nuevamente.");
        error_log("Error during registration: " . $e->getMessage());
        exit;
    }

    $stmt->close();
    $conn->close();
}

function displayRegistrationError($message) {
    echo "<div class='registration-error'>";
    echo "ERROR: $message";
    echo "</div>";
    header("refresh:5;url=registration.html");
}

function displayRegistrationSuccess($message) {
    echo "<div class='registration-success'>";
    echo "$message";
    echo '<div><input class="search-button" type="button" value="CONSULTA" onclick="location.href=\'search.php\'"></div>';
    echo "</div>";
}

?>

 </body>
</html>