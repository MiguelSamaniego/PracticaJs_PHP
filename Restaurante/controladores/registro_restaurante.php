<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Crear Nuevo Restaurante</title>
    <style type="text/css" rel="stylesheet">
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <a href></a>
    <?php
    //incluir conexión a la base de datos

    include '../../conf/conexionBD.php';
    $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : null;
    $direccion = isset($_POST["direccion"]) ? trim($_POST["direccion"]) : null;
    $telefono = isset($_POST["telefono"]) ? trim($_POST["telefono"]) : null;
    //$busqueda_cod_usu= "SELECT MAX(usu_codigo) FROM usuario ";
    $busqueda_cod_usu= "SELECT * FROM usuario ";
    $variableUno=$coon->query($busqueda_cod_usu);
    //$foranea=(int)($variableUno);
    $max=0;
    foreach ($variableUno as $u){
       if((int)($u['usu_codigo']) >$max){
           $max =(int)($u['usu_codigo']);
       }
    }
    echo $max;
    $sql = "INSERT INTO restaurante VALUES (0, '$nombre','$direccion','$telefono', $max)";
   
    if ($coon->query($sql) === TRUE) {
        echo "<h1>Restaurante Creado</h1>";
    } else {
        if ($coon->errno == 1062) {
            echo "<p class='error'>La persona con la cedula $correo ya esta registrada en el sistema </p>";
        } else {
            echo "<p class='error'>Hola: " . mysqli_error($conn) . "</p>";
        }
    }
    
    //cerrar la base de datos
    $coon->close();

    ?>
</body>

</html>