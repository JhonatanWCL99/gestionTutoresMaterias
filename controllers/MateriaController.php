<?php

require_once 'models/Materia.php';

class MateriaController
{
    public $page_title;
    public $view;
    public $materiaObj;

    public function __construct()
    {
        $this->view = 'listar';
        $this->page_title = 'Listado de Materias';
        $this->materiaObj = new Materia();
    }

    /* List all materias */
    public function listar()
    {
        $this->page_title = 'Listado de Materias';
        return $this->materiaObj->getMaterias();
    }

    /* Load materia for edit */
    public function edit($id = null)
    {
        $this->view = 'crear';
        $this->page_title = 'Editar materia';
        /* Id can from get param or method param */
        if (isset($_GET["id"])) $id = $_GET["id"];
        return $this->materiaObj->getMateriaById($id);
    }

    /* Create or update materia */
    public function save()
    {
        $this->view = 'crear';
        $this->page_title = 'Editar materia';
        $id = $this->materiaObj->save($_POST);
        $result = $this->materiaObj->getMateriaById($id);
        $_GET["response"] = true;
        return $result;
    }

    /* Confirm to delete */
    public function confirmDelete()
    {
        $this->page_title = 'Eliminar materia';
        $this->view = 'confirmar_eliminacion';
        return $this->materiaObj->getMateriaById($_GET["id"]);
    }

    /* Delete */
    public function delete()
    {
        $this->page_title = 'Listado de materias';
        $this->view = 'eliminar';
        return $this->materiaObj->deleteMateriaById($_POST["id"]);
    }
}
