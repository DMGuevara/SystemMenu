<?php
include('db.php');
date_default_timezone_set("America/El_Salvador");
setlocale(LC_ALL, 'es_ES');

$metodoAction  = (int) filter_var($_REQUEST['metodo'], FILTER_SANITIZE_NUMBER_INT);

//$metodoAction ==1, es crear un registro nuevo
if($metodoAction == 1){

    $fechaRegistro  = date('d-m-Y H:i:s A', time()); 
    $nombre       = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
    //$precio         = (int) filter_var($_POST['precio'], FILTER_SANITIZE_STRING);
    $precio         = filter_var($_POST['precio'], FILTER_SANITIZE_STRING);
    $stock           = filter_var($_POST['stock'], FILTER_SANITIZE_STRING);

    //Informacion de la foto
    $filename       = $_FILES["foto"]["name"]; //nombre de la foto
    $tipo_foto      = $_FILES['foto']['type']; //tipo de archivo
    $sourceFoto     = $_FILES["foto"]["tmp_name"]; //url temporal de la foto
    $tamano_foto    = $_FILES['foto']['size']; //tamaño del archivo (foto)

//Se comprueba si la foto a cargar es correcto observando su extensión y tamaño, 100000 = 1 Mega 
if (!((strpos($tipo_foto, "PNG") || strpos($tipo_foto, "jpg") && ($tamano_foto < 100000)))) {
    //código para renombrar la foto 
    $logitudPass 	        = 8;
    $newNameFoto            = substr( md5(microtime()), 1, $logitudPass);
    $explode                = explode('.', $filename);
    $extension_foto         = array_pop($explode);
    $nuevoNameFoto          = $newNameFoto.'.'.$extension_foto;

    //Verificando si existe el directorio, de lo contrario lo creo
    $dirLocal       = "fotosProductos";
    if (!file_exists($dirLocal)) {
        mkdir($dirLocal, 0777, true);
    }

    $miDir 		      = opendir($dirLocal); //Habro mi  directorio
    $urlFotoProducto    = $dirLocal.'/'.$nuevoNameFoto; //Ruta donde se almacena la foto.

    //Muevo la foto a mi directorio.
    if(move_uploaded_file($sourceFoto, $urlFotoProducto)){
        $SqlInsertProducto = ("INSERT INTO tabla_productos(
            nombre,
            precio,
            stock,
            foto,
            fechaRegistro
        )
        VALUES(
            '".$nombre."',
            '".$precio."',
            '".$stock."',
            '".$nuevoNameFoto."',
            '".$fechaRegistro."'
        )");
        $resulInsert = mysqli_query($con, $SqlInsertProducto);
        ///print_r( $SqlInsertProducto);
    }
    closedir($miDir);
    header("Location:index.php?a=1");

  }else{
    header("Location:index.php?errorimg=1");
  }
}

//Actualizar registro del Producto
if($metodoAction == 2){
    $idProducto      = (int) filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);

    $nombre       = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
    //$precio         = (int) filter_var($_POST['precio'], FILTER_SANITIZE_STRING);
    $precio         = filter_var($_POST['precio'], FILTER_SANITIZE_STRING);
    $stock           = filter_var($_POST['stock'], FILTER_SANITIZE_STRING);

    $UpdateProducto    = ("UPDATE tabla_productos
        SET nombre='$nombre',
        precio='$precio', 
        stock='$stock'
        WHERE id='$idProducto' ");
    $resultadoUpdate = mysqli_query($con, $UpdateProducto);

    //Verificando si existe foto del Producto para actualizar
    if (!empty($_FILES["foto"]["name"])){
            $filename       = $_FILES["foto"]["name"]; //nombre de la foto
            $tipo_foto      = $_FILES['foto']['type']; //tipo de archivo
            $sourceFoto     = $_FILES["foto"]["tmp_name"]; //url temporal de la foto
            $tamano_foto    = $_FILES['foto']['size']; //tamaño del archivo (foto)

            //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
        if (!((strpos($tipo_foto, "PNG") || strpos($tipo_foto, "jpg") && ($tamano_foto < 100000)))) {
            $logitudPass 	        = 8;
            $newNameFoto            = substr( md5(microtime()), 1, $logitudPass);
            $explode                = explode('.', $filename);
            $extension_foto         = array_pop($explode);
            $nuevoNameFoto          = $newNameFoto.'.'.$extension_foto;

            //Verificando si existe el directorio, de lo contrario lo creo
            $dirLocal       = "fotosProductos";
            $miDir 		      = opendir($dirLocal); //Habro mi  directorio
            $urlFotoProducto    = $dirLocal.'/'.$nuevoNameFoto; //Ruta donde se almacena la factura.

            //Muevo la foto a mi directorio.
        if(move_uploaded_file($sourceFoto, $urlFotoProducto)){
            $updateFoto = ("UPDATE tabla_productos SET foto='$nuevoNameFoto' WHERE id='$idProducto' ");
            $resultFoto = mysqli_query($con, $updateFoto);
        }
    }else{
        header("Location:index.php?errorimg=1");
    }
  }

  header("Location:viewEdit.php?update=1&id=$idProducto");
 }

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

?>