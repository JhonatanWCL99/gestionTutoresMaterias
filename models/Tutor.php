<?php
class Tutor
{
    private $table = "tutores";
    private $conection;

    /* Set conection */
    public function getConection()
    {
        $dbObj = new Db();
        $this->conection = $dbObj->conection;
    }

    public function filterTutores()
    {
        $this->getConection();
        $filter = $_POST["filter"];
        $sql = "SELECT t.* 
                FROM tutores as t
                INNER JOIN materias_tutores as mt on mt.tutor_id=t.id 
                INNER JOIN materias as m on m.id=mt.materia_id
                WHERE m.id = ? ";

        $stmt = $this->conection->prepare($sql);
        $stmt->execute([$filter]);
        /* echo json_encode($stmt->fetchAll()); */
        return $stmt->fetchAll();
    }

    public function searchTutores()
    {
        $this->getConection();

        $buscar = "%" . $_POST["buscar"] . "%";
        $sql = "SELECT * 
         FROM tutores 
         WHERE 
            CONCAT_WS(' ', nombre,    apellido) LIKE  ? OR
            CONCAT_WS(' ', apellido, nombre   ) LIKE  ? 
            ";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute([$buscar, $buscar]);
        return $stmt->fetchAll();
    }

    /* Get all Tutores */
    public function getTutores()
    {
        $this->getConection();
        $sql = "SELECT * FROM " . $this->table;
        $stmt = $this->conection->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /* Get note by id */
    public function getTutorById($id)
    {
        if (is_null($id)) return false;
        $this->getConection();
        $sql = "SELECT * FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch();
    }

    /* Save Tutor */
    public function save($param)
    {
        $this->getConection();
        /* Check if exists */
        $exists = false;
        if (isset($param["id"]) and $param["id"] != '') {
            $actualTutor = $this->getTutorById($param["id"]);
            $actualTutorMaterias = $this->getMateriasxTutor($param["id"]);
            if (isset($actualTutor["id"])) {
                $exists = true;
                /* Actual values */
                $id = $param["id"];
                $nombre = $actualTutor["nombre"];
                $apellido = $actualTutor["apellido"];
                $celular = $actualTutor["celular"];
                $materias = $actualTutorMaterias;
            }
        }

        /* Received values */
        if (isset($param["nombre"])) $nombre = $param["nombre"];
        if (isset($param["apellido"])) $apellido = $param["apellido"];
        if (isset($param["celular"])) $celular = $param["celular"];
        if (isset($param["materias"])) $materias = $param["materias"];

        /* Database operations */
        if ($exists) {
            $sql = "UPDATE " . $this->table . " SET nombre=?,apellido=?,celular=? WHERE id=?";
            $stmt = $this->conection->prepare($sql);
            $res = $stmt->execute([$nombre, $apellido, $celular, $id]);
        } else {
            $sql = "INSERT INTO " . $this->table . " (nombre, apellido, celular) values(?,?,?)";
            $stmt = $this->conection->prepare($sql);
            $stmt->execute([$nombre, $apellido, $celular]);
            $id = $this->conection->lastInsertId();
        }
        $this->deleteMateriasxTutor($id);
        if (isset($param["materias"])) {
            $this->updateMateriasxTutor($id, $materias);
        }
        return $id;
    }

    /* Delete tutor by id */
    public function deleteTutorById($id)
    {
        $this->getConection();
        $sql = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conection->prepare($sql);
        return $stmt->execute([$id]);
    }

    /* Get  Materias x Tutor*/
    public function getMateriasxTutor($tutor_id)
    {
        $this->getConection();
        $sql = "SELECT tutores.nombre as tutor,tutores.id as tutor_id, materias.nombre as materia, materias.id as materia_id
            FROM tutores
            INNER JOIN materias_tutores on tutores.id = materias_tutores.tutor_id 
            INNER JOIN materias on materias.id = materias_tutores.materia_id
            WHERE  materias_tutores.tutor_id = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute([$tutor_id]);

        return $stmt->fetchAll();
    }
    public function deleteMateriasxTutor($id)
    {
        $sql = "DELETE FROM materias_tutores WHERE tutor_id = ?";
        $query = $this->conection->prepare($sql);
        $query->execute([$id]);
    }

    //Insert new category for musing
    public function updateMateriasxTutor($tutor_id, array $materias)
    {

        $stmt = $this->conection->prepare("
                     INSERT INTO materias_tutores (materia_id,tutor_id) 
                     VALUES (:materia_id, :tutor_id);
                                      ");

        for ($i = 0; $i < count($materias); $i++) {
            $stmt->bindValue(':materia_id', $materias[$i], \PDO::PARAM_INT);
            $stmt->bindValue(':tutor_id', $tutor_id, \PDO::PARAM_INT);
            $stmt->execute();
        }
    }
}
