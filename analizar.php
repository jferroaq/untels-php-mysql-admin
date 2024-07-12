<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['user']) ? $_POST['user'] : '';
    $password = isset($_POST['pass']) ? $_POST['pass'] : '';
    $dbname   = isset($_POST['dbnm']) ? $_POST['dbnm'] : '';
  } else {
    // Si el método no es POST, redirigimos al formulario
    header('Location: main.php');
    exit;
  }
  $servername = "localhost";

  // Crear la conexión
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Verificar la conexión
  if ($conn->connect_error) {
    die("Conexion fallida: " . $conn->connect_error);
  }

  // Consulta SQL para seleccionar datos de la tabla contactos
  $sql = "show tables";

  // Ejecutar la consulta y almacenar el resultado
  $result = $conn->query($sql);

  // Iterar sobre los resultados
  if ($result->num_rows > 0) {
    // Imprimir cada fila como un array asociativo
    $i = 0;
    while($row = $result->fetch_assoc()) {
      //print_r($row);
      //echo "<br>";
      $i = $i + 1;
      $key = "Tables_in_" . $dbname;
      echo "Tabla [" . $i . "] :" . $row[$key] . "<br>";
    }
  } else {
    echo "0 resultados encontrados";
  }

  // Cerrar la conexión
  $conn->close();
?>
