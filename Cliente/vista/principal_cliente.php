
<?php echo $_GET["codigo"] ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../css/base.css" />
</head>
<body>
<nav class="navbar navbar-expand navbar-light bg-light">
    <ul class="nav navbar-nav">
    <li class="nav-item active"> 
            <a class="nav-link" <?php header("Location:principal_restaurante.php"); ?>><?php echo $_GET["nombre"] ?></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="Productos.php">Administrar Productos </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="../../index.html">Salir</a>
        </li>
    </ul>
</nav>
</nav>
</body>
</html>