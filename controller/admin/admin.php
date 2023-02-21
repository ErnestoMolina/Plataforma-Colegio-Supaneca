<?php
    class Administrador{
        private $AdministradoresModel;

        public function __construct(){
            include_once '../../../modules/admin/admin.php';
            $this->AdministradoresModel = new Administradores();
        }

        public function ConsultarAdministrador($nombreAdmin){
            return $this->AdministradoresModel->ConsultarAdministrador($nombreAdmin);
        } 

        public function EditarDatos($DataRow){
            return $this->AdministradoresModel->EditarDatos($DataRow);
        }
    }
?>