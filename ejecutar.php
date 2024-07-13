<?php
function subirSQL( $imagen ) {
  // Directorio donde se guardarán los script subidos
  $target_dir = "fav/";
  $target_file = $target_dir . basename($imagen["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  // Verificar si el archivo ya existe
  if (file_exists($target_file)) {
    echo "Lo siento, el archivo ya existe.";
    $uploadOk = 0;
  }

  // Verificar el tamaño del archivo
  if ($imagen["size"] > 500000) {
    echo "Lo siento, tu archivo es demasiado grande.";
    $uploadOk = 0;
  }

  // Permitir ciertos formatos de archivo
  if ($imageFileType != "txt" && $imageFileType != "sql") {
    echo "Lo siento, solo se permiten archivos TXT y SQL.";
    $uploadOk = 0;
  }

  // Verificar si $uploadOk es 0 por un error
  if ($uploadOk == 0) {
    echo "Lo siento, tu script no fue subido.";
  // Si todo está bien, intenta subir el archivo
  } else {
    if (move_uploaded_file($imagen["tmp_name"], $target_file)) {
      echo "El archivo ". htmlspecialchars(basename($imagen["name"])) . " ha sido subido.";
    } else {
      echo "Lo siento, hubo un error al subir tu script.";
    }
  }
  return $target_file;
}

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
	$diccionario = isset($_FILES['link']) ? $_FILES['link'] : '';
	
	// Aqui se guardan los script subidos a la carpeta: fav/
    $path = subirSQL($diccionario);
	echo "<br>Se ejecuta las instrucciones de: '" . $path . "'";
    
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
  // $cmd = "if [ -f " . $path . " ]; then echo -n 1; else echo -n 0; fi";
  // $cmd = "if [ -f '" . $path . "' ]; then echo '1'; else echo '0'; fi";
  // $res = shell_exec($cmd);
  $res = file_exists($path);
  // $rus = is_dir("house/fav");
  if ( $res === TRUE ) {
    // echo $cmd . "<br>";
    // echo "RES: '" . $res . "' y RUS: '" . $rus . "'<br>";
    $sql = "";
    $fp = fopen($path, 'r');
    while ( !feof($fp)) {
      $aux = fgets($fp);
      //limpia la cadena sin espacios ni saltos
      $aux = trim($aux);
	if (0 === strpos($aux, "--")) {
      $sql = "";
	  $sihay = TRUE;
      continue;
	  // si halla un comentario que inicia con '--', entonces se ignora el tal.
    } else {
      $tam = mb_strlen($aux);
      // busca que el ultimo caracter sea ';'
      //$sic = rand(0,1);
      $sql = $sql . " " . $aux;
      $sic = strpos($aux, ';');
      //echo "L:" . $tam . " - P:" . $sic;
      if ( $sic !== FALSE && ($tam - $sic) === 1 ) {
        //echo "Hay punto y coma...<br>";
        echo $sql . "<br>";
        // Ejecutar la consulta y almacenar el resultado
        //$result = $conn->query($sql);
        // sqlrun($result);
        $sql = "";
        $sihay = FALSE;
      } else {
        $sihay = TRUE;
      }
	}
    }
    fclose($fp);
    $sql = trim($sql);
    if ($sihay && $sql !== "" ) {
      echo $sql . "<br>";
      // Ejecutar la consulta y almacenar el resultado
      $result = $conn->query($sql);
      // sqlrun($result);
    }
  } else {
    // var_dump($res);
	// var_dump($res);
    // echo "RES: '" . $res . "' y RUS: '" . $rus . "'<br>";
    echo "No se halla el fichero: '" . $path . "'";
  }
  echo "<br><h3>Terminado!</h3><br>";
}
  // Cerrar la conexión
  $conn->close();
?>
