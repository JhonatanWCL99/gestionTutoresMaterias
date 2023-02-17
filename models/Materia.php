<?php
class Materia
{
    private $table = "materias";
    private $conection;

    /* Set conection */
    public function getConection()
    {
        $dbObj = new Db();
        $this->conection = $dbObj->conection;
    }

    
    /* Get all Materias */
    public function getMaterias()
    {
        $this->getConection();
        $sql = "SELECT * FROM " . $this->table;
        $stmt = $this->conection->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /* Get note by id */
    public function getMateriaById($id)
    {
        if (is_null($id)) return false;
        $this->getConection();
        $sql = "SELECT * FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch();
    }

    /* Save Materia */
    public function save($param)
    {
        $this->getConection();

        /* Set default values */
        $title = $content = "";

        /* Check if exists */
        $exists = false;
        if (isset($param["id"]) and $param["id"] != '') {
            $actualMateria = $this->getMateriaById($param["id"]);
            if (isset($actualMateria["id"])) {
                $exists = true;
                /* Actual values */
                $id = $param["id"];
                $nombre = $actualMateria["nombre"];
            }
        }

        /* Received values */
        if (isset($param["nombre"])) $nombre = $param["nombre"];

        /* Database operations */
        if ($exists) {
            $sql = "UPDATE " . $this->table . " SET nombre=? WHERE id=?";
            $stmt = $this->conection->prepare($sql);
            $res = $stmt->execute([$nombre, $id]);
        } else {
            $sql = "INSERT INTO " . $this->table . " (nombre) values(?)";
            $stmt = $this->conection->prepare($sql);
            $stmt->execute([$nombre]);
            $id = $this->conection->lastInsertId();
        }

        return $id;
    }

    /* Delete materia by id */
    public function deleteMateriaById($id)
    {
        $this->getConection();
        $sql = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conection->prepare($sql);
        return $stmt->execute([$id]);
    }
}
