<div class="card-body bg-light">
    <div class="table-responsive" style="overflow-x: hidden">
        <form action="index.php?controller=TutorController&action=filter" method="POST">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <span class="input-group-addon "><strong>Seleccione la materia:</strong> </span>
                        <select name="filter" id="filter" class="form-control ">
                            <?php foreach ($dataToView['data']['allMaterias'] as $materia) { ?>
                                <option value="<?php echo $materia['id'] ?>"><?php echo $materia['nombre'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <br>
                        <input class="form-control btn btn-primary" type="submit" value="Filtrar" id="filtrar" name="filtrar">
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12 text-right">
        <a href="index.php?controller=TutorController&action=edit" class="btn btn-outline-primary">Crear tutor</a>
        <hr />
    </div>
    <?php
    if (count($dataToView["data"]) > 0) {
        foreach ($dataToView["data"]["tutores"] as $tutor) {

    ?>
            <div class="col-md-3 pb-4">
                <div class="card-body border border-secondary rounded">
                    <h5 class="card-title"><?php echo $tutor['nombre'] . " ";
                                            echo $tutor["apellido"]; ?></h5>
                    <div class="card-text">

                        <?php foreach ($dataToView["data"]["materias"][$tutor["id"]] as $materia) {
                            echo nl2br($materia['materia']) . "<BR>";
                        }
                        ?>
                    </div>
                    <hr class="mt-1" />
                    <a href="index.php?controller=TutorController&action=edit&id=<?php echo $tutor['id']; ?>" class="btn btn-primary">Editar</a>
                    <a href="index.php?controller=TutorController&action=confirmDelete&id=<?php echo $tutor['id']; ?>" class="btn btn-danger">Eliminar</a>
                </div>
            </div>
        <?php
        }
    } else {
        ?>
        <div class="alert alert-info">
            Actualmente no existen tutores.
        </div>
    <?php
    }
    ?>
</div>