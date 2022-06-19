<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="css/estilos.css" rel="stylesheet">
</head>

<body>
    <header>
        <div class="navbar navbar-expand-lg   navbar-dark bg-dark">
            <div class="container">
                <a href="products.php" class="navbar-brand">
                    <strong>Menu System</strong>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader"
                    aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarHeader">

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a href="index.php" class="nav-link ">Productos</a></li>
                        <li class="nav-item"><a href="menu.php" class="nav-link active">Menu</a></li>

                    </ul>
<!--                      <h2>Bienvenida, <?php echo $user; ?>!</h2>
 -->                    <a href="logout.php" class="btn btn-primary">Cerrar Sesion</a> 
                </div>
            </div>
        </div>
    </header>

