<?php
require_once __DIR__ . "/../../includes/config.php";
require_once __DIR__ . "/../../includes/mantenimientos_functions.php";

if (!isset($_GET['id'])) {
    header("Location: dashboard.php?page=mantenimientos");
    exit();
}

$id = intval($_GET['id']);
deleteMantenimiento($id);

header("Location: dashboard.php?page=mantenimientos");
exit();
