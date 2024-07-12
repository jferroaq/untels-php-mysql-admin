<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['user']) ? $_POST['user'] : '';
    $password = isset($_POST['pass']) ? $_POST['pass'] : '';
  } else {
    // Si el método no es POST, redirigimos al formulario
    header('Location: main.php');
    exit;
  }
  $servername = "localhost";

  // Crear la conexión
  $conn = new mysqli($servername, $username, $password, null);

  // Verificar la conexión
  if ($conn->connect_error) {
    die("Conexion fallida: " . $conn->connect_error);
  }

  // Consulta SQL para seleccionar datos de la tabla contactos
  $sql = "show databases";

  // Ejecutar la consulta y almacenar el resultado
  $result = $conn->query($sql);

  //print_r($result);
  // Iterar sobre los resultados
  if ($result->num_rows > 0) {
    // Imprimir cada fila como un array asociativo
    while($row = $result->fetch_assoc()) {
      echo "Base de datos: " . $row["Database"] . "<br>";
    }
  } else {
    echo "0 resultados encontrados";
  }

  // Cerrar la conexión
  $conn->close();
?>
