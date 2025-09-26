<?php
require_once __DIR__ . "/../../includes/config.php";
require_once __DIR__ . "/../../includes/equipos_functions.php";


$id = $_GET['id'] ?? null;
if ($id) {
    deleteEquipo($id);
}

header("Location: dashboard.php?page=equipos");
exit();
