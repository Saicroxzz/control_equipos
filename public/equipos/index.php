<?php
require_once __DIR__ . "/../../includes/config.php";
require_once __DIR__ . "/../../includes/equipos_functions.php";

$equipos = getAllEquipos();
?>
<h2>Lista de Equipos</h2>
<a href="dashboard.php?page=equipos&action=add" class="btn btn-success mb-3">Agregar Equipo</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>ID Usuario</th>
            <th>Código Interno</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Fecha Ingreso</th>
            <th>Estado</th>
            <th>Observaciones</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($equipos as $equipo): ?>
        <tr>
            <td><?= $equipo['id_equipo'] ?></td>
            <td><?= $equipo['id_usuario'] ?></td>
            <td><?= $equipo['codigo_interno'] ?></td>
            <td><?= $equipo['marca'] ?></td>
            <td><?= $equipo['modelo'] ?></td>
            <td><?= $equipo['fecha_ingreso'] ?></td>
            <td><?= ucfirst($equipo['estado']) ?></td>
            <td><?= $equipo['observaciones'] ?></td>
            <td>
                <a href="dashboard.php?page=equipos&action=edit&id=<?= $equipo['id_equipo'] ?>" class="btn btn-primary btn-sm">Editar</a>
                <a href="dashboard.php?page=equipos&action=delete&id=<?= $equipo['id_equipo'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
