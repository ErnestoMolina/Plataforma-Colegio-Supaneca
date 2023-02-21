<?php
session_start();

class Login
{
    private $user;
    private $password;
    function Ingreso(){
        include '../../controller/admin/seguridad.php';

        $passLimpia = new Seguridad();
        $password = $passLimpia->encriptarP($_POST['contraseña']);
        
        $userLimpiar = new Seguridad();
        $user = $userLimpiar->limpiar($_POST['usuario']);
        // echo $user.'<br>'.$password;
        include 'conexion.php';
        
        $conexion = new conexion();
        $con = $conexion->conectarDB();
    
        $sql = "SELECT * FROM administradores
        WHERE CorreoelectronicoAdministrador='".$user."' AND Contraseña='".$password."';";

        $sql2 = "SELECT * FROM docentes
        WHERE CorreoelectronicoDocente='".$user."' AND ContraseñaDocente='".$password."';";

        $sql3 = "SELECT * FROM acudientes
        WHERE CorreoElectronicoAcudiente='".$user."' AND ContraseñaAcudiente='".$password."';";
    
        $resultset = $con->query($sql);
        $resultset2 = $con->query($sql2);
        $resultset3 = $con->query($sql3);
        if ($resultset->num_rows > 0) {
            while ($fila = $resultset->fetch_assoc()) {
                $_SESSION["Usuario"] = $fila["NombresAdministrador"];
                header('Location: ../../views/administrador/index.php');
            }
        } elseif($resultset2->num_rows > 0){
            while ($fila = $resultset2->fetch_assoc()) {
                echo $_SESSION["Usuario"] = $fila["NombresDocente"];
                echo $_SESSION["Id"] = $fila["IdDocente"];
                header('Location: ../../views/docente/index.php');
            }
        }elseif($resultset3->num_rows > 0){
            while ($fila = $resultset3->fetch_assoc()) {
                $_SESSION["Usuario"] = $fila["NombresAcudiente"];
                header('Location: ../../views/acudiente/indexAcudiente.php');
            }
        }else{
                $_SESSION["Error"] = "Por favor verifique sus credenciales de acceso";
                header('Location: ../../index.php');
        }
        $con->close();
    }
}

$init = new Login();
$init->Ingreso(); 
?>