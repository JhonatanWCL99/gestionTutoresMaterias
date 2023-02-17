<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <header class="mb-5">
            <div class=" text-center bg-secondary">
                <nav class="navbar navbar-expand-lg navbar-light bg-light ">
                    <a class="navbar-brand" href="#">Prueba Tecnica (Cumbre)</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                            <li class="nav-item active">
                                <a class="nav-link" href="index.php?controller=MateriaController&action=listar">Materias</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="index.php?controller=TutorController&action=listar">Tutores</a>
                            </li>
                        </ul>
                        <form class="form-inline d-flex flex-row my-lg-10" action="index.php?controller=TutorController&action=search" method="POST">
                            <div class="col-12">
                                <input class="form-control " type="search" placeholder="Buscar por Nombre o Apellido" name="buscar" aria-label="Buscar">
                            </div>
                            <br>
                            <button class="btn btn-outline-success mx-4 my-sm-0" type="submit">Buscar</button>
                        </form>
                    </div>
                </nav>
                <br>
                <h1 class="mb-3 text-light"><?php echo $controller->page_title; ?></h1>

                <h4 class="mb-3 text-light">-</h4>
            </div>
        </header>