<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['user']) ? $_POST['user'] : '';
    $password = isset($_POST['pass']) ? $_POST['pass'] : '';
    $dbname  = isset($_POST['dbnm']) ? $_POST['dbnm'] : '';
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
  $sql = "CREATE DATABASE " . $dbname;
  // Ejecutar la consulta y almacenar el resultado
  $result = $conn->query($sql);

  if ($result === TRUE ) {
    echo "Base de datos creada correctamente";
  } else {
    echo "Error al crear la base de datos: " . $conn->error;
  }
    
  // Cerrar la conexión
  $conn->close();
?>

