<?php

require_once 'models/Tutor.php';
require_once 'models/Materia.php';

class TutorController
{
    public $page_title;
    public $view;
    public $tutorObj;
    public $materiaObj;

    public function __construct()
    {
        $this->view = 'listar';
        $this->page_title = 'Listado de Tutores';
        $this->tutorObj = new Tutor();
        $this->materiaObj = new Materia();
    }

    public function filter()
    {
        $this->page_title = 'Listado de Tutores';
        $tutores = $this->tutorObj->filterTutores();
        $materias = $this->obtenerMateriaxTutor($tutores);
        $allMaterias = $this->materiaObj->getMaterias();
        $datos = [
            "tutores" =>  $tutores,
            "materias" => $materias,
            "allMaterias" => $allMaterias,
        ];
        return $datos;
    }

    public function search()
    {
        $this->page_title = 'Listado de Tutores';
        $tutores = $this->tutorObj->searchTutores();
        $materias = $this->obtenerMateriaxTutor($tutores);
        $allMaterias = $this->materiaObj->getMaterias();
        $datos = [
            "tutores" =>  $tutores,
            "materias" => $materias,
            "allMaterias" => $allMaterias,

        ];
        return $datos;
    }

    /* List all tutores */
    public function listar()
    {
        $this->page_title = 'Listado de Tutores';
        $tutores = $this->tutorObj->getTutores();
        $materiasxTutor = $this->obtenerMateriaxTutor($tutores);
        $allMaterias = $this->materiaObj->getMaterias();
        $datos = [
            "tutores" =>  $tutores,
            "materias" => $materiasxTutor,
            "allMaterias" => $allMaterias,
        ];
        return $datos;
    }

    public function obtenerMateriaxTutor($tutores)
    {
        $datos = [];
        foreach ($tutores as $tutor) {
            $materias = $this->tutorObj->getMateriasxTutor($tutor["id"]);
            $datos += [$tutor["id"] => $materias];
        }
        return $datos;
    }

    /* Load tutor for edit */
    public function edit($id = null)
    {
        $this->view = 'crear';
        $this->page_title = 'Editar tutor';
        /* Id can from get param or method param */
        if (isset($_GET["id"])) $id = $_GET["id"];
        return [

            'MateriasxTutor' => $this->tutorObj->getMateriasxTutor($id),
            'Materias' => $this->materiaObj->getMaterias(),
            'Tutor' => $this->tutorObj->getTutorById($id)
        ];
    }

    /* Create or update tutor */
    public function save()
    {
        $this->view = 'crear';
        $this->page_title = 'Editar Tutor';
        $id = $this->tutorObj->save($_POST);
        $result = $this->tutorObj->getTutorById($id);
        $_GET["response"] = true;
        return [
            'MateriasxTutor' => $this->tutorObj->getMateriasxTutor($id),
            'Materias' => $this->materiaObj->getMaterias(),
            'Tutor' => $this->tutorObj->getTutorById($id)
        ];
    }

    /* Confirm to delete */
    public function confirmDelete()
    {
        $this->page_title = 'Eliminar Tutor';
        $this->view = 'confirmar_eliminacion';
        return $this->tutorObj->getTutorById($_GET["id"]);
    }

    /* Delete */
    public function delete()
    {
        $this->page_title = 'Listado de Tutores';
        $this->view = 'eliminar';
        return $this->tutorObj->deleteTutorById($_POST["id"]);
    }
}
