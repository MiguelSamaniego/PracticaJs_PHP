<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Crear Nuevo Usuario</title>
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
    $correo = isset($_POST["correo"]) ? trim($_POST["correo"]) : null;
    $contrasena = isset($_POST["contrasenia"]) ? trim($_POST["contrasenia"]) : null;
    $rol = isset($_POST["rol"]) ? trim($_POST["rol"]) : null;
    $sql = "INSERT INTO usuario VALUES (0, '$correo', MD5('$contrasena'),'$rol')";
    if ($coon->query($sql) === TRUE) {
        if ($rol== 'R') {
            echo "<p>Restaurante</p>";
            
        }elseif($rol== 'C'){
            echo "<p>Cliente</p>";
            header("Location:../../Cliente/vista/registro_cliente.html");
        }
        else{
            echo "<p>No funciono</p>";
        }
    } else {
        if ($coon->errno == 1062) {
            echo "<p class='error'>La persona con la cedula $correo ya esta registrada en el sistema </p>";
        } else {
            echo "<p class='error'>Hola: " . mysqli_error($conn) . "</p>";
        }
    }
    //cerrar la base de datos
    $coon->close();
    echo "<a href='../vista/Principal.php'>Regresar</a>";

    ?>
</body>

</html>