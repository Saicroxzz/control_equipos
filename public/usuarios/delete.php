<?php
require_once "../includes/usuarios_functions.php";

$id = $_GET['id'] ?? null;
if ($id) {
    deleteUsuario($id);
}

header("Location: dashboard.php?page=usuarios");
exit();
