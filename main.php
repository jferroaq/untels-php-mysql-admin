<html>
<head>
</head>
<body>
<h3>Menus de Opciones Para Nuevo Usuario</h3>
<h4>1. Listar Base de Datos de un Usuario</h4>
  <form action="listar.php" method="post">
    <input type="text" name="user" placeholder="Usuario">
    <input type="password" name="pass" placeholder="Clave">
    <input type="submit" value="Listar!">
  </form>
<h4>2. Listar tablas de una Base de Datos</h4>
  <form action="analizar.php" method="post">
    <input type="text" name="user" placeholder="Usuario">
    <input type="password" name="pass" placeholder="Clave">
    <input type="text" name="dbnm" placeholder="Database">
    <input type="submit" value="Listar!">
  </form>
<h4>3. Mostrar estructura de una tabla de una Base de Datos</h4>
  <form action="tabular.php" method="post">
    <input type="text" name="user" placeholder="Usuario">
    <input type="password" name="pass" placeholder="Clave">
    <input type="text" name="dbnm" placeholder="Database"><br>
    <input type="text" name="dbtb" placeholder="Table">
    <input type="text" name="info" placeholder="full" value=" ">
    <input type="submit" value="Mostrar!">
  </form>
<h4>4. Mostrar elementos de una tabla de una Base de Datos</h4>
  <form action="mostrar.php" method="post">
    <input type="text" name="user" placeholder="Usuario">
    <input type="password" name="pass" placeholder="Clave">
    <input type="text" name="dbnm" placeholder="Database"><br>
    <input type="text" name="dbtb" placeholder="Tabla">
    <input type="text" name="info" placeholder="Columnas">
    <input type="submit" value="Mostrar!">
  </form>
<h4>5. Crear Base de Datos en Root</h4>
  <form action="dbCrear.php" method="post">
    <input type="text" name="user" placeholder="Usuario">
    <input type="password" name="pass" placeholder="Clave">
    <input type="text" name="dbnm" placeholder="Database">
    <input type="submit" value="Crear!">
  </form>
<h4>6. Eliminar Base de Datos en Root</h4>
  <form action="dbEliminar.php" method="post">
    <input type="text" name="user" placeholder="Usuario">
    <input type="password" name="pass" placeholder="Clave">
    <input type="text" name="dbnm" placeholder="Database">
    <input type="submit" value="Eliminar!">
  </form>
<h4>7. Crear nuevo usuario de Mysql</h4>
  <form action="crear.php" method="post">
    <input type="text" name="user" placeholder="Usuario">
    <input type="password" name="pass" placeholder="Clave"><br><br>
    <input type="text" name="newu" placeholder="Nuevo Usuario">
    <input type="password" name="newp" placeholder="Nueva Clave">
    <input type="submit" value="Crear!">
  </form>
<h4>8. Asignar Base de Datos a nuevo usuario de Mysql</h4>
  <form action="asignar.php" method="post">
    <input type="text" name="user" placeholder="Usuario">
    <input type="password" name="pass" placeholder="Clave"><br>
    <input type="text" name="dbnm" placeholder="Database"><br>
    <input type="text" name="newu" placeholder="Nuevo Usuario">
    <input type="submit" value="Asignar!">
  </form>
<h4>9. Eliminar usuario de Mysql</h4>
  <form action="eliminar.php" method="post">
    <input type="text" name="user" placeholder="Usuario">
    <input type="password" name="pass" placeholder="Clave"><br><br>
    <input type="text" name="newu" placeholder="Cual Usuario">
    <input type="submit" value="Eliminar!">
  </form>
<h4>0. Ejecutar script de Mysql</h4>
  <form action="ejecutar.php" method="post" enctype="multipart/form-data">
    <input type="text" name="user" placeholder="Usuario">
    <input type="password" name="pass" placeholder="Clave"><br>
    Selecciona un script: <input type="file" name="link"><br><br>
    <input type="submit" value="Ejecutar!">
  </form>
</body>
</html>
