<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['user']) ? $_POST['user'] : '';
    $password = isset($_POST['pass']) ? $_POST['pass'] : '';
    $olduser = isset($_POST['newu']) ? $_POST['newu'] : '';
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
if ( $olduser === "root" ) {
  echo "Se restringe la eliminacion de este usuario!<br>";
} else {
  echo "<br><h3>Eliminando usuario...</h3><br>";
  // Consulta SQL para seleccionar datos de la tabla contactos
  $sql = "DROP USER '" . $olduser . "'@'" . $servername . "'";
  echo $sql;
  
  // Ejecutar la consulta y almacenar el resultado
  $result = $conn->query($sql);

  if ($result === TRUE ) {
    echo "Usuario '" . $olduser . "' eliminado correctamente.<br>";
  } else {
    echo "Error al eliminar el usuario " . $conn->error;
  }

  echo "<br><h3>Actualiza full privileges...</h3><br>";
  $result = $conn->query("FLUSH PRIVILEGES");
  //print_r($result);

  if ($result === TRUE ) {
    echo "Se actualiza Full Privileges!.<br>";
  } else {
    echo "No se pudo actualizar Full." . $conn->error;
  }
}
  // Cerrar la conexión
  $conn->close();
?>
