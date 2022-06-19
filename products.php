<?php include('session.php'); ?>
<?php include('./includes/cabecera.php'); ?>

<div class="container mt-3">
    <div class="row justify-content-md-center">
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
                    <label for="Stock">Estado</label>
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
    include('db.php');
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
                                    <th scope="col">Estado</th>
                                    <th scope="col">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
    $conteo =1;
    while ($dataProducto = mysqli_fetch_array($queryProductos)) { 
    ?>
                                <tr>
                                    <td><?php echo  $conteo++ .')'; ?></td>
                                    <td><?php echo $dataProducto['nombre']; ?></td>
                                    <td><?php echo $dataProducto['precio']; ?></td>
                                    <td><?php echo $dataProducto['stock']==='Habilitado' ?  'Habilitado' : 'Deshabilitado' ?>
                                    </td>
                                    <td>
                                        <a href="viewdetails.php?id=<?php echo $dataProducto['id']; ?>"
                                            class="btn btn-warning mb-2"
                                            title="Ver datos del producto <?php echo $dataProducto['nombre']; ?>">
                                            <i class="bi bi-tv"></i> Ver</a>
                                        <a href="viewEdit.php?id=<?php echo $dataProducto['id']; ?>"
                                            class="btn btn-info mb-2"
                                            title="Actualizar datos del producto <?php echo $dataProducto['nombre']; ?>">
                                            <i class="bi bi-arrow-clockwise"></i> Actualizar</a>
                                        <a href="action.php?id=<?php echo $dataProducto['id']; ?>&metodo=3&namePhoto=<?php echo $dataProducto['foto']; ?>"
                                            class="btn btn-danger mb-2"
                                            title="Borrar el producto <?php echo $dataProducto['nombre']; ?>">
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

<?php include('./includes/pie.php'); ?>



