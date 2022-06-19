<?php
    include('db.php');
    $sqlProductos   = ("SELECT * FROM tabla_productos where stock= 'Habilitado' ");
    $queryProductos  = mysqli_query($con, $sqlProductos );
    $totalProductos  = mysqli_num_rows($queryProductos );
    ?>
   <?php include('session.php'); ?>
   <?php include('./includes/cabecera.php'); ?> 

    <main>
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php
     $conteo =1;
    while ($dataProducto = mysqli_fetch_array($queryProductos)) { 
    ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <?php 
                        $imagen ="./fotosProductos/" . $dataProducto['foto'];
                        if(!file_exists($imagen)){
                            $imagen = "./fotosProductos/imagen-no-disponible.jpg";
                        }
                        ?>
                        <img src="<?php echo $imagen?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $dataProducto['nombre']; ?></h5>
                            <p class="card-text">$<?php echo number_format($dataProducto['precio'], 2, '.', ',');?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="viewDetails.php" class="btn btn-primary">Detalles</a>
                                </div>
                                <a href="" class="btn btn-success">Agregar</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </main>

    <?php include('./includes/pie.php'); ?> 
