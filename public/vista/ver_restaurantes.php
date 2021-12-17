<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../css/base.css" />
    <link rel="stylesheet" href="../../css/formulario.css" />
</head>
<body>
    <nav class="navbar navbar-expand navbar-light bg-light">
        <ul class="nav navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="../../index.html">Inicio </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="registro.html">Registrate</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="ver_restaurantes.php">Ver Restaurantes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="IniciarSesion.html">Iniciar Sesion</a>
            </li>
        </ul>
    </nav>
   <?php 
   include '../../conf/conexionBD.php';
   $sql="SELECT * FROM restaurante";
   $restaurantes=$coon->query($sql);
   $txtCodigo = (isset($_POST['txtCodigo'])) ? $_POST['txtCodigo'] : "";
   $accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";
   switch ($accion) {
    case "Selecionar":
        header("Location:ver_productos.php?codig=$txtCodigo");
        break;
    }   
        
   ?>

 <div class="col-md-7">
    <table class="table">
    <thead>
            <tr>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Direccion</th>
                <th>Telefono</th>
                <th>Seleccionar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($restaurantes as $res) { ?>
                <tr>
                    <td><?php echo $res['res_codigo']; ?></td>
                    <td><?php echo $res['res_nombre']; ?></td>
                    <td><?php echo $res['res_direccion']; ?></td>
                    <td><?php echo $res['res_telefono']; ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="txtCodigo" id="txtCodigo" value="<?php echo $res['res_codigo']; ?>" />
                            <input type="submit" name="accion" value="Selecionar" class="btn btn-success">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>
</html>