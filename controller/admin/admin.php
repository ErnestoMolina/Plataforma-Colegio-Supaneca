<?php
    class Administrador{
        private $AdministradoresModel;

        public function __construct(){
            include_once '../../../modules/admin/admin.php';
            $this->AdministradoresModel = new Administradores();
        }

        public function ConsultarAdministrador($IdAdmin){
            return $this->AdministradoresModel->ConsultarAdministrador($IdAdmin);
        } 

        public function EditarDatos($DataRow){
            return $this->AdministradoresModel->EditarDatos($DataRow);
        }
    }
?>