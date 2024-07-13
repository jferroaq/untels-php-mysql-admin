<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['user']) ? $_POST['user'] : '';
    $password = isset($_POST['pass']) ? $_POST['pass'] : '';
    $dbname = isset($_POST['dbnm']) ? $_POST['dbnm'] : '';
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
  //print_r($olduser);
if ( $username !== "root" || $dbname === "mysql" || $dbname === "phpmyadmin" || $dbname === "performance_schema" || $dbname === "information_schema") {
  echo "Se restringe la eliminacion de BBDD por: '" . $username . "'<br>";
} else {
  echo "<br><h3>Eliminando BBDD...</h3><br>";
  // Consulta SQL para seleccionar datos de la tabla contactos
  // $sql = "DROP DATABASE '" . $dbname . "'@'" . $servername . "'";
  $sql = "DROP DATABASE " . $dbname . "";
  echo $sql;
  
  // Ejecutar la consulta y almacenar el resultado
  $result = $conn->query($sql);

  if ($result === TRUE ) {
    echo "Base de datos '" . $dbname . "' eliminada correctamente por: '" . $username . "'<br>";
  } else {
    echo "Error al eliminar BBDD " . $conn->error;
  }

}
  // Cerrar la conexión
  $conn->close();
?>
