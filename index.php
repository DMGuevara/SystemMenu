<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projecto # 1- Menu :: Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/home.css">
    <!-- https://icons.getbootstrap.com/ -->
  </head>
<body>

<div class="container mt-3">
  <div class="row justify-content-md-center">
    <div class="col-md-12">
      <h1 class="text-center mt-3">Projecto # 1 - Menu </h1>
      <p class="text-center"><span>Productos</span> </p>
        <a href="./"><i class="bi bi-house"></i></a>
        <hr class="mb-3">
    </div>


    <div class="col-md-4 mb-3">
      <h3 class="text-center">Datos del Producto</h3>
      <form method="POST" action="action.php" enctype="multipart/form-data">
        <input type="text" name="metodo" value="1" hidden>
      <div class="mb-3">
          <label class="form-label">Nombre</label>
          <input type="text" class="form-control" name="nombre" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Precio</label>
          <input type="text" name="precio" class="form-control" required>
        </div>

        <div class="mb-3">
        <label for="Stock">Stock</label>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="stock" value="Habilitado" checked>
            <label class="form-check-label" for="stockH">
              Habilitado
            </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="stock" value="Deshabilitado">
          <label class="form-check-label" for="stockD">
            Deshabilitado
          </label>
        </div>
        </div>
        <div class="mb-3">
          <label for="formFile" class="form-label">Foto del Producto</label>
          <input class="form-control" type="file" name="foto" accept="image/png,image/jpeg" required>
        </div>

        <div class="d-grid gap-2 col-12 mx-auto">
          <button type="submit" class="btn  btn btn-primary mt-3 mb-2">
            Registrar nuevo Producto
            <i class="bi bi-arrow-right-circle"></i>
          </button>
        </div>
        
      </form>
    </div>


    
    <?php
    include('config.php');
    $sqlProductos   = ("SELECT * FROM tabla_productos ORDER BY id DESC");
    $queryProductos  = mysqli_query($con, $sqlProductos );
    $totalProductos  = mysqli_num_rows($queryProductos );

    ?>
    <div class="col-md-8">
    <h3 class="text-center">Lista de Productos <?php echo '(' . $totalProductos . ')'; ?></h3>
      <div class="row">
        <div class="col-md-12 p-2">
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Precio</th>
                  <th scope="col">Stock</th>
                  <th scope="col">Acción</th>
                </tr>
              </thead>
              <tbody>
              <?php
              $conteo =1;
              while ($dataProducto = mysqli_fetch_array($queryProductos)) { ?>
                <tr>
                  <td><?php echo  $conteo++ .')'; ?></td>
                  <td><?php echo $dataProducto['nombre']; ?></td>
                  <td><?php echo $dataProducto['precio']; ?></td>
                  <td><?php echo $dataProducto['stock']==='Habilitado' ?  'Habilitado' : 'Deshabilitado' ?></td>
                  <td>
                  <a href="detalles.php?id=<?php echo $dataProducto['id']; ?>" class="btn btn-warning mb-2"   title="Ver datos del producto <?php echo $dataProducto['nombre']; ?>">
                  <i class="bi bi-tv"></i> Ver</a>
                    <a href="formEditar.php?id=<?php echo $dataProducto['id']; ?>" class="btn btn-info mb-2"   title="Actualizar datos del producto <?php echo $dataProducto['nombre']; ?>">
                    <i class="bi bi-arrow-clockwise"></i> Actualizar</a>
                    <a href="action.php?id=<?php echo $dataProducto['id']; ?>&metodo=3&namePhoto=<?php echo $dataProducto['foto']; ?>" class="btn btn-danger mb-2" title="Borrar el producto <?php echo $dataProducto['nombre']; ?>">
                    <i class="bi bi-trash"></i> Borrar</a>
                  </td>
                </tr>
              <?php } ?>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<?php
  include('mensajes.php'); 
?>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script>
$(function(){
  $('.toast').toast('show');
});
</script>

</body>
</html>