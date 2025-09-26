<?php
require_once __DIR__ . "/../../includes/config.php";
require_once __DIR__ . "/../../includes/equipos_functions.php";

$error = null;
$usuarioSeleccionado = $_GET['usuario'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (addEquipo($_POST)) {
        header("Location: dashboard.php?page=equipos");
        exit();
    } else {
        $error = "Error al agregar equipo.";
    }
}

$stmt = $pdo->query("SELECT id_usuario, nombre, apellido FROM usuarios ORDER BY nombre");
$usuarios = $stmt->fetchAll();
?>
<h2>Agregar Equipo</h2>
<?php if ($error): ?>
<div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form method="POST">
    <div class="mb-3">
        <label>ID Usuario</label>
        <select name="id_usuario" class="form-control" required>
            <?php foreach ($usuarios as $user): ?>
                <option value="<?= $user['id_usuario'] ?>" <?= ($usuarioSeleccionado == $user['id_usuario']) ? "selected" : "" ?>>
                    <?= htmlspecialchars($user['id_usuario']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label>Código Interno</label>
        <input type="text" name="codigo_interno" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Marca</label>
        <input type="text" name="marca" class="form-control">
    </div>

    <div class="mb-3">
        <label>Modelo</label>
        <input type="text" name="modelo" class="form-control">
    </div>

    <div class="mb-3">
        <label>Fecha Ingreso</label>
        <input type="date" name="fecha_ingreso" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Estado</label>
        <select name="estado" class="form-control">
            <option value="activo">Activo</option>
            <option value="en_mantenimiento">En Mantenimiento</option>
            <option value="inactivo">Inactivo</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Observaciones</label>
        <textarea name="observaciones" class="form-control"></textarea>
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
</form>
