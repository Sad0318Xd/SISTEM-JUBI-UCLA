<?php
class GestionCursosControlador {

    public function GestionCursos(): void {
        include_once  __DIR__ . '/../views/admin/gestionCursosAdmin.php';
    }

    public function EditSuccess(): void {
        include_once  __DIR__ . '/../views/admin/editSuccess.php';
    }
}
?>