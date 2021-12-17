<?php 
   include '../../conf/conexionBD.php';
   echo "El codigo es :".$_GET["codig"];
   $var=$_GET["codig"];
   echo $var;
   $coP=(int)($var);
   echo $coP;
   $c=intval($_GET["codig"]);
   echo $c;
   $sql="SELECT * FROM productos WHERE res_codigo_fk=$c";
   $restaurantes=$coon->query($sql);
   //echo $sql;
   $accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";
   
        
   ?>
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
  

 <div class="col-md-7">
    <table class="table">
    <thead>
            <tr>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>DescripcionS</th>
                <th>Precio</th>
                <th>foranea</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($restaurantes as $res) { ?>
                <tr>
                    <td><?php echo $res['pro_codigo']; ?></td>
                    <td><?php echo $res['pro_nombre']; ?></td>
                    <td><?php echo $res['pro_descripcion']; ?></td>
                    <td><?php echo $res['pro_precio']; ?></td>
                    <td><?php echo $res['res_codigo_fk']; ?></td>
                    
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>
</html>