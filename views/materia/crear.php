<?php
$id = $nombre = "";

if (isset($dataToView["data"]["id"])) $id = $dataToView["data"]["id"];
if (isset($dataToView["data"]["nombre"])) $nombre = $dataToView["data"]["nombre"];

?>
<div class="row">
    <?php
    if (isset($_GET["response"]) and $_GET["response"] === true) {
    ?>
        <div class="alert alert-success">
            Operación realizada correctamente. <a href="index.php?controller=MateriaController&action=listar">Volver al listado</a>
        </div>
    <?php
    }
    ?>
    <form class="form" action="index.php?controller=MateriaController&action=save" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <div class="form-group">
            <label>Materia</label>
            <input class="form-control" type="text" name="nombre" value="<?php echo $nombre; ?>" />
        </div>

        <br>
        <input type="submit" value="Guardar" class="btn btn-primary" />
        <a class="btn btn-outline-danger" href="index.php?controller=MateriaController&action=listar">Cancelar</a>
    </form>
</div>