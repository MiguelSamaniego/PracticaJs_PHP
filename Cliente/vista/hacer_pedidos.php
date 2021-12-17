<?php 
   include '../../conf/conexionBD.php';
  // echo "El codigo es :".$_GET["codig"];
   $var=$_GET["codig"];
  // echo $var;
   $coP=(int)($var);
   //echo $coP;
   $c=intval($_GET["codig"]);
   //echo $c;
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

</head>
<body>
<nav class="navbar navbar-expand navbar-light bg-light">
    <ul class="nav navbar-nav">
    
        <li class="nav-item">
            <a class="nav-link" href="../../index.html">Salir</a>
        </li>
    </ul>
</nav>
  <!-- inicia la tabla de pedidos  -->
  <?php

//inicio de productos 
$txtCodigo = (isset($_POST['txtCodigo'])) ? $_POST['txtCodigo'] : "";
$txtCantidad = (isset($_POST['txtCantidad'])) ? $_POST['txtCantidad'] : "";
$txtPresio = (isset($_POST['txtPresio'])) ? $_POST['txtPresio'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";
$precio = doubleval($txtPresio);
$arreglo= array();
$total3s= array();
//echo $txtCodigo;
include '../../conf/conexionBD.php';
switch ($accion) {
    case 'Agregar':
        $subtotal= (int)($txtCantidad)*$precio;
        $arreglo= [$txtCodigo,$txtCantidad,$txtPresio,$subtotal];
        $total3s[]=$arreglo;
        foreach($total3s as $t){
           // echo "<li>$t[0]</li>";
        }
        break;
    case 'Comprar':
        $fecha = date('Y-m-d');
        $cabSubtotal=0.0;
        $Iva=0.0;
        $total=0.0;
        $sentenciaSQL = "INSERT INTO pedido_cabecera VALUES (0,$fecha,$cabSubtotal,$Iva,$total,1,1)";
        $Seleccionado = $coon->query($sentenciaSQL);
        if ($coon->query($sentenciaSQL) === TRUE) {
                foreach($total3s as $t){
                    $sentenciaSQL = "INSERT INTO pedido_detalle VALUES (0,1,$cabSubtotal,$total,1,1)";
                    $Seleccionado = $coon->query($sentenciaSQL);
                }
                
        }else{
           // echo 'NO cargo';
        }
        break;
    case 'Cancelar':
        break;
    case 'Selecionar':
        $sentenciaSQL = "SELECT * FROM productos WHERE pro_codigo=$txtCodigo ";
        $Seleccionado = $coon->query($sentenciaSQL);
        foreach ($Seleccionado as $productoss) {
            $txtCodigo =$txtCodigo ;
            $txtPresio = $productoss['pro_precio'];
            
        }
       
        break;
    case 'Borrar':
        $sentenciaSQL = "DELETE FROM productos WHERE pro_codigo=$txtCodigo ";
        $Seleccionado = $coon->query($sentenciaSQL);
        break;
}

$sentenciaSQL = "SELECT * FROM productos WHERE res_codigo_fk=$c";
$listado = $coon->query($sentenciaSQL);
?>
<section class="producto">
<div class="col-md-5">

    <div class="card">
        <div class="card-body">
            <h1>Ingrese el Producto</h1>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                </div>
                <div class="form-group">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="txtCodigo" value="<?php echo $txtCodigo; ?>" placeholder="Codigo Producto">
                        <label for="floatingInput">Codigo Producto</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="txtCantidad" value="" placeholder="cantidad">
                        <label for="floatingInput">Cantidad</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="txtPresio" value="<?php echo $txtPresio; ?>" placeholder="Precio">
                        <label for="floatingInput">Precio</label>
                    </div>
                    
                </div>
                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" <?php echo ($accion=='Selecionar')?'disabled':'';?> value="Comprar" class="btn btn-success">Comprar</button>
                    <button type="submit" name="accion" <?php echo ($accion!='Selecionar')?'disabled':'';?> value="Agregar" class="btn btn-success">Agregar</button>
                    <button type="submit" name="accion" <?php echo ($accion!='Selecionar')?'disabled':'';?> value="Cancelar" class="btn btn-info">Limpiar</button>
                </div>
            </form>
        </div>
    </div>
</div>
</section>

</div>

<!-- TERMINA LA TABLA DE PEDIDOS-->


 <div class="col-md-7">
    <table class="table">
    <thead>
            <tr>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>DescripcionS</th>
                <th>Precio</th>
                <th>foranea</th>
                <th>Elegir</th>
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
                    <td>
                        <form method="POST">
                            <input type="hidden" name="txtCodigo" id="txtCodigo" value="<?php echo $res['pro_codigo']; ?>" />
                            <input type="hidden" name="txtprecio" id="txtPresio" value="<?php echo $res['pro_precio']; ?>" />
                            <input type="submit" name="accion" value="Selecionar" class="btn btn-success">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>
</html>