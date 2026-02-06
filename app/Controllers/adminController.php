<?php
namespace app\Controllers;

class AdminController {

    public function __construct() {
      
        if (session_status() === PHP_SESSION_NONE) session_start();
        
        if (empty($_SESSION["valido"])) {
            header("location: /login?estado=4");
            exit();
        }
    }

    public function index() {
        
        require_once dirname(__DIR__) . '../../Views/admin/administrarCatalogo.html';
    }
}