<div class="row">
    <div class="col-md-12 text-right">
        <a href="index.php?controller=MateriaController&action=edit" class="btn btn-outline-primary">Crear Materia</a>
        <hr />
    </div>
    <?php
    if (count($dataToView["data"]) > 0) {
        foreach ($dataToView["data"] as $materia) {
    ?>
            <div class="col-md-3 pb-4">
                <div class="card-body border border-secondary rounded">
                    <h5 class="card-title"><?php echo $materia['nombre']; ?></h5>
                    <div class="card-text"><?php echo nl2br($materia['nombre']); ?></div>
                    <hr class="mt-1" />
                    <a href="index.php?controller=MateriaController&action=edit&id=<?php echo $materia['id']; ?>" class="btn btn-primary">Editar</a>
                    <a href="index.php?controller=MateriaController&action=confirmDelete&id=<?php echo $materia['id']; ?>" class="btn btn-danger">Eliminar</a>
                </div>
            </div>
        <?php
        }
    } else {
        ?>
        <div class="alert alert-info">
            Actualmente no existen materias.
        </div>
    <?php
    }
    ?>
    
</div>