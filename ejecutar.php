<?php
function sqlrun( $res ) {
  if ($res === TRUE ) {
    echo "   OK.<br>";
  } else {
    echo "   FAIL!" . $conn->error . "<br>";
  }
}

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['user']) ? $_POST['user'] : '';
    $password = isset($_POST['pass']) ? $_POST['pass'] : '';
    $path     = isset($_POST['link']) ? $_POST['link'] : '';
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
if ( $path === "" ) {
  echo "No se hace nada por no existir script!<br>";
} else {
  echo "<br><h3>Ejecutar script...</h3><br>";
  // Consulta SQL para seleccionar datos de la tabla contactos
  $cmd = "if [ -f " . $path . " ]; then echo -n 1; else echo -n 0; fi";
  //$cmd = "if [ -f '" . $path . "' ]; then echo '1'; else echo '0'; fi";
  $res = shell_exec($cmd);
  if ( $res === '1' ) {
    //echo $cmd . "<br>";
    //echo $res . "<br>";
    $sql = "";
    $fp = fopen($path, 'r');
    while ( !feof($fp)) {
      $aux = fgets($fp);
      //limpia la cadena sin espacios ni saltos
      $aux = trim($aux);
      $tam = mb_strlen($aux);
      // busca que el ultimo caracter sea ';'
      //$sic = rand(0,1);
      $sql = $sql . " " . $aux;
      $sic = strpos($aux, ';');
      //echo "L:" . $tam . " - P:" . $sic;
      if ( $sic !== FALSE && ($tam - $sic) === 1 ) {
        //echo "Hay punto y coma...<br>";
	echo $sql . "....";
        // Ejecutar la consulta y almacenar el resultado
        $result = $conn->query($sql);
        sqlrun($result);
	$sql = "";
        $sihay = FALSE;
      } else {
        $sihay = TRUE;
      }
    }
    fclose($fp);
    $sql = trim($sql);
    if ($sihay && $sql !== "" ) {
      echo $sql . "....";
      // Ejecutar la consulta y almacenar el resultado
      $result = $conn->query($sql);
      sqlrun($result);
    }
  } else {
    //var_dump($res);
    echo "No se halla el fichero: '" . $path . "'";
  }
  echo "Terminado!";
}
  // Cerrar la conexión
  $conn->close();
?>
