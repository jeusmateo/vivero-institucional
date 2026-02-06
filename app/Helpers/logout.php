<?php

require_once '../Controllers/authController.php';

use app\Controllers\AuthController;

$auth = new AuthController();
$auth->logout();
?>