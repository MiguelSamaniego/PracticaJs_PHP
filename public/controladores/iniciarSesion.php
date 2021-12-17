<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>IniciarSesion</title>
    <style type="text/css" rel="stylesheet">
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <?php
    //incluir conexión a la base de datos
    include '../../conf/conexionBD.php';
    $correo = isset($_POST["correo"]) ? trim($_POST["correo"]) : null;
    $contrasena = isset($_POST["contrasenia"]) ? trim($_POST["contrasenia"]) : null;
    $sql="SELECT * FROM usuario";
    $usuarios=$coon->query($sql);
    foreach($usuarios as $usu){
        echo $usu["usu_correo"]."<br>";
        echo $usu["usu_contrasenia"]."<br>";
        if($usu["usu_correo"] ==$correo && $usu["usu_contrasenia"]==Md5($contrasena) && $usu["usu_rol"]=='R'){
            $cod=$usu['usu_codigo'];
            $newSql= "SELECT * FROM restaurante WHERE usu_codigo_fk_res=$cod";
            $datosRestaurante=$coon->query($newSql); 
            foreach($datosRestaurante as $res){
                $codigoRestaurante=$res["res_codigo"];
                $nombreRestaurante=$res["res_nombre"];
                $direccionRestaurante=$res["res_direccion"];
                $telefonoRestaurante=$res["res_telefono"];
            }

            header("Location:../../Restaurante/vista/principal_restaurante.php?codigo=$cod&nombre=$nombreRestaurante&direccion=$direccionRestaurante&telefono=$telefonoRestaurante&codRes=$codigoRestaurante");
            echo "<p>restautante</p>";


        }else if($usu["usu_correo"] ==$correo && $usu["usu_contrasenia"]==Md5($contrasena) && $usu["usu_rol"]=='C'){
            $cod=$usu['usu_codigo'];
            $newSql= "SELECT * FROM cliente WHERE usu_codigo-fk=$cod";
            $datosCliente=$coon->query($newSql); 
            foreach($datosCliente as $res){
                $nombreRestaurante=$res["res_nombre"];
                $direccionRestaurante=$res["res_direccion"];
                $telefonoRestaurante=$res["res_telefono"];
            }
            header("Location:../../Cliente/vista/principal_cliente.php?codigo=$cod");
            echo "<p>cliente</p>";
        }

    }
    
    //cerrar la base de datos
    $coon->close();

    ?>
</body>

</html>