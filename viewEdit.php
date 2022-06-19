<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Editar - MenuSystem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/home.css">
    <!-- https://icons.getbootstrap.com/ -->
</head>
<body>
    <div class="container mt-3">
        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <h1 class="text-center mt-3">
                    <a href="./">
                        <i class="bi bi-arrow-left-circle"></i>
                    </a>
                    Actualizar Datos del Producto
                </h1>
                <hr class="mb-3">
            </div>

            

            <?php
    include('db.php');
    $idProducto     = (int) filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
    $sqlProductos   = ("SELECT * FROM tabla_productos WHERE id='$idProducto' LIMIT 1");
    $queryProductos = mysqli_query($con, $sqlProductos);
    $dataProducto   = mysqli_fetch_array($queryProductos);
    ?>
            <div class="col-md-5 mb-3">
                <h3 class="text-center">Datos del Producto</h3>
                <form method="POST" action="action.php?metodo=2" enctype="multipart/form-data">
                    <input type="text" name="id" value="<?php echo $dataProducto['id']; ?>" hidden>
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre"
                            value="<?php echo $dataProducto['nombre']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Precio</label>
                        <input type="text" name="precio" class="form-control"
                            value="<?php echo $dataProducto['precio']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="Stock">Estado</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="stock" value="Habilitado"
                                <?php echo $dataProducto['stock']==='Habilitado' ?  'checked' : '' ?> checked>
                            <label class="form-check-label" for="stockH">
                                Habilitado
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="stock" value="Deshabilitado"
                                <?php echo $dataProducto['stock']==='Deshabilitado' ?  'checked' : '' ?>>
                            <label class="form-check-label" for="stockD">
                                Deshabilitado
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="formFile" class="form-label">Foto del Producto</label>
                        <input class="form-control" type="file" name="foto" accept="image/png,image/jpeg">
                    </div>

                    <div class="d-grid gap-2 col-12 mx-auto">
                        <button type="submit" class="btn  btn btn-primary mt-3 mb-2">
                            Actualizar datos del Producto
                            <i class="bi bi-arrow-right-circle"></i>
                        </button>
                    </div>

                </form>
            </div>

            <div class="col-md-5 mb-3">
                <label class="form-label">Foto actual del Producto</label>
                <br>
                <img src="fotosProductos/<?php echo $dataProducto['foto']; ?>" alt="foto perfil"
                    class="card-img-top fotoPerfil">
            </div>
        </div>
    </div>

<?php include('messages.php'); ?>


<script 
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" 
    crossorigin="anonymous">
</script>

<script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
    crossorigin="anonymous">
</script>

<script>
    $(function() {
        $('.toast').toast('show');
    });
</script>


</body>
</html>