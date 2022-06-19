<?php
include('db.php');
date_default_timezone_set("America/El_Salvador");
setlocale(LC_ALL, 'es_ES');

$metodoAction  = (int) filter_var($_REQUEST['metodo'], FILTER_SANITIZE_NUMBER_INT);

//Eliminar Producto
if($metodoAction == 3){
    $idProducto  = (int) filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
    $namePhoto = filter_var($_REQUEST['namePhoto'], FILTER_SANITIZE_STRING);

    $SqlDeleteProducto = ("DELETE FROM tabla_productos WHERE  id='$idProducto'");
    $resultDeleteProducto = mysqli_query($con, $SqlDeleteProducto);
    
    if($resultDeleteProducto !=0){
        $fotoProducto = "fotosProductos/".$namePhoto;
        unlink($fotoProducto);
    }
    
    $msj ="Producto Borrado correctamente.";
    header("Location:index.php?deletProducto=1&mensaje=".$msj);
}