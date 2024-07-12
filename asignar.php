<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['user']) ? $_POST['user'] : '';
    $password = isset($_POST['pass']) ? $_POST['pass'] : '';
    $dbname   = isset($_POST['dbnm']) ? $_POST['dbnm'] : '';
    $newuser  = isset($_POST['newu']) ? $_POST['newu'] : '';
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
if ( $newuser === "root" ) {
  echo " No es necesario esta accion a Root!";
} else {
  echo "<br><h3>Grant all privileges...</h3><br>";
  $sql = "GRANT ALL PRIVILEGES ON " . $dbname . ".* TO '" . $newuser . "'@'" . $servername . "'";
  $result = $conn->query($sql);
  //print_r($result);

  if ($result === TRUE ) {
    echo "Usuario '" . $newuser . "' con Grant all Privileges en: " . $dbname;
  } else {
    echo "Error al otorgar Grant P. " . $conn->error;
  }

  echo "<br><h3>full privileges...</h3><br>";
  $result = $conn->query("FLUSH PRIVILEGES");
  //print_r($result);

  if ($result === TRUE ) {
    echo "Se actualiza Full Privileges!.<br>";
  } else {
    echo "Error al actualizar Full Pri." . $conn->error;
  }
}
    
  // Cerrar la conexión
  $conn->close();
?>
