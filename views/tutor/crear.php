<?php
$id = $nombre = $apellido = $celular =  "";
$materias = [];
if (isset($dataToView["data"]["Tutor"]["id"])) $id = $dataToView["data"]["Tutor"]["id"];
if (isset($dataToView["data"]["Tutor"]["nombre"])) $nombre = $dataToView["data"]["Tutor"]["nombre"];
if (isset($dataToView["data"]["Tutor"]["apellido"])) $apellido = $dataToView["data"]["Tutor"]["apellido"];
if (isset($dataToView["data"]["Tutor"]["celular"])) $celular = $dataToView["data"]["Tutor"]["celular"];
if (isset($dataToView["data"]["MateriasxTutor"])) $materias = $dataToView["data"]["MateriasxTutor"];

?>
<div class="row">
    <?php
    if (isset($_GET["response"]) and $_GET["response"] === true) {
    ?>
        <div class="alert alert-success">
            Operación realizada correctamente. <a href="index.php?controller=TutorController&action=listar">Volver al listado</a>

        </div>
    <?php
    }
    ?>
    <form class="form" action="index.php?controller=TutorController&action=save" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <div class="form-group">
            <label>Nombre</label>
            <input class="form-control" type="text" name="nombre" value="<?php echo $nombre; ?>" />
        </div>
        <div class="form-group">
            <label>Apellido</label>
            <input class="form-control" type="text" name="apellido" value="<?php echo $apellido; ?>" />
        </div>
        <div class="form-group">
            <label>Celular</label>
            <input class="form-control" type="number" name="celular" value="<?php echo $celular; ?>" />
        </div>
        <br>
        <div class="form-group">
            <label>Seleccione las Materias</label>
            <br><br>
            <?php
            foreach ($dataToView["data"]["Materias"] as $materia) {

            ?>
                <div class="form-check">
                    <?php
                    $sw = false;
                    foreach ($materias as $mat) {
                        if ($materia["id"] == $mat["materia_id"]) {
                    ?>
                            <input class="form-check-input" name="materias[]" type="checkbox" value="<?php echo $materia['id']; ?>" id="flexCheckDefault" checked>
                    <?php
                            $sw = true;
                        }
                    }
                    ?>

                    <?php
                    if (!$sw) {
                    ?>
                            <input class="form-check-input" name="materias[]" type="checkbox" value="<?php echo $materia['id']; ?>" id="flexCheckDefault" >

                    <?php
                    }
                    $sw = false;
                    ?>

                    <label class="form-check-label" for="flexCheckDefault">
                        <?php echo $materia['nombre']; ?>
                    </label>
                </div>
            <?php
            }
            ?>
        </div>

        <br>
        <input type="submit" value="Guardar" class="btn btn-primary" />
        <a class="btn btn-outline-danger" href="index.php?controller=TutorController&action=listar">Cancelar</a>

    </form>
</div>