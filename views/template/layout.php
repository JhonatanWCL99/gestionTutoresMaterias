<?php
require_once './views/template/header.php';
if (isset($controller->materiaObj) && !isset($controller->tutorObj)) require_once './views/materia/' . $controller->view . '.php';
if (isset($controller->tutorObj) && isset($controller->materiaObj)) require_once './views/tutor/' . $controller->view . '.php';
require_once './views/template/footer.php';
