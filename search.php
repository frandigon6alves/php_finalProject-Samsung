<!DOCTYPE HTML>
<html>

    <head>
        <title>CONSULTA</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <script src="js/index.js" defer></script>
        <script src="https://kit.fontawesome.com/b37653d681.js"></script>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>

<body>

<div id="search">
    <h1>Consulta</h1>
    <?php
    require_once("functions.php");
    $conn = connect_to_db();

    $search_query = "SELECT * FROM usuarios";
    $result = $conn->query($search_query);

    if ($result->num_rows > 0) {
        echo '<table id="usuarios">';
        echo '<tr>';
        echo '<th>Nombre</th>';
        echo '<th>Primer apellido</th>';
        echo '<th>Segundo apellido</th>';
        echo '<th>Email</th>';
        echo '</tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['nombre'] . '</td>';
            echo '<td>' . $row['primer_apellido'] . '</td>';
            echo '<td>' . $row['segundo_apellido'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo "No hay resultados!";
    }
    $conn->close();
    ?>
</div>
</body>

</html>