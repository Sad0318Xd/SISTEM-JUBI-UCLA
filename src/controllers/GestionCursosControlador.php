<?php
class GestionCursosControlador {

    public function GestionCursos(): void {
        include_once  __DIR__ . '/../views/admin/gestionCursosAdmin.php';
    }

    public function AgregarCursosVistaAdmin(): void {
        include_once  __DIR__ . '/../views/admin/agregarCursos.php';
    }

    public function EditarCursosVistaAdmin(): void {
        include_once  __DIR__ . '/../views/admin/editarCursos.php';
    } 

    public function CursosVistaAdmin(): void {
        include_once  __DIR__ . '/../views/admin/cursosAdmin.php';
    }

    public function CursosVistaEmpleado(): void {
        include_once  __DIR__ . '/../views/empleado/cursosEmpleado.php';
    }

}
?>