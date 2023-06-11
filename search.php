<!DOCTYPE HTML>
<html>

<head>
        <title>CONSULTA</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <script src="js/index.js" defer></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
    body {
      background: linear-gradient(90deg, #00dbde 0%, #b6c2c1 100%);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 15px;
    }
    .container {
      border-radius: 10px;
      padding: 5px;
      max-width: 100%; 
    }
</style>
</head>

<body>
  <!-- MENU -->
  <div class="row justify-content-center align-items-center">
    <div class="col-12">
      <div class="selection text-center">
        <input class="btn btn-primary" id="registration-button" type="button" value="REGISTRO" onclick="location.href='registration.html'" style="color:#fff; background-color: #078082; border: 2px solid #abb2b3;">
      </div>
    </div>
  </div>

  <!-- SEARCH FORM -->
  <div class="container">
    <div class="header">
      <h2 class="text-center">Consulta de Registros</h2>
    </div>
    <?php
    // Connect to DB
    require_once("./datos.php");
    require_once("./functions.php");
    $conn = connectDB();

    $search_query = "SELECT * FROM USUARIOS";
    $result = $conn->query($search_query);

    if ($result->num_rows > 0) {
    ?>
      <table class="table" id="usuarios">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Primer apellido</th>
            <th>Segundo apellido</th>
            <th>Email</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row[USUARIOS_COLUMN_NAME] . "</td>";
            echo "<td>" . $row[USUARIOS_COLUMN_FIRST_SURNAME] . "</td>";
            echo "<td>" . $row[USUARIOS_COLUMN_SECOND_SURNAME] . "</td>";
            echo "<td>" . $row[USUARIOS_COLUMN_EMAIL] . "</td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    <?php
    } else {
      echo "Todavía no hay registros en nuestra base de datos.";
    }
    $conn->close();
    ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>