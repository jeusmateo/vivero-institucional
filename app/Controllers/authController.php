<?php
namespace app\Controllers;

use app\Models\Usuario;

class AuthController {

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) session_start();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirigirLogin(4);
            return;
        }

        $usuario = trim($_POST['usuario'] ?? '');
        $contrasena = trim($_POST['contrasena'] ?? '');
        $recordarUsuario = isset($_POST['recordarUsuario']); 

        if (empty($usuario)) {
            $this->redirigirLogin(1);
            return;
        }
        if (empty($contrasena)) {
            $this->redirigirLogin(2);
            return;
        }

    

        $usuarioModel = new Usuario();
        $datosUsuario = $usuarioModel->autenticar($usuario, $contrasena);

        if ($datosUsuario) {
            $_SESSION["valido"] = true;
            $_SESSION["usuario"] = $datosUsuario['usuario'];
            $_SESSION["id_usuario"] = $datosUsuario['id_usuario']; // Ojo: tu SQL viejo usaba 'nombre', ajusta según tu tabla
            
            if ($recordarUsuario) {
                setcookie("usuarioRecordado", $usuario, time() + (86400 * 30), "/");
            } else {
                if (isset($_COOKIE["usuarioRecordado"])) {
                    setcookie("usuarioRecordado", "", time() - 3600, "/");
                }
            }
            header("location: ../Views/admin/administrarCatalogo.html");
            exit();

        } else {
            $this->redirigirLogin(3);
            return;
        }
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        
        // Destruir todas las variables de sesión
        $_SESSION = [];
        
        // Destruir la sesión completamente
        session_destroy();
        
        // Borrar cookie de "Recordar usuario" si existe
        if (isset($_COOKIE["usuarioRecordado"])) {
            setcookie("usuarioRecordado", "", time() - 3600, "/");
        }

        header("location: ../Views/admin/login.html?estado=5");
        exit();
    }

    private function redirigirLogin($codigo) {
        header("location: ../Views/admin/login.html?estado=" . $codigo);
        exit();
    }
}