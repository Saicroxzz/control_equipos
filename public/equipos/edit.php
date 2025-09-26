<?php
require_once __DIR__ . "/../../includes/config.php";
require_once __DIR__ . "/../../includes/equipos_functions.php";

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: dashboard.php?page=equipos");
    exit;
}

$equipo = getEquipoById($id);
if (!$equipo) {
    echo "<div class='alert alert-danger'>Equipo no encontrado</div>";
    exit;
}

$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (updateEquipo($id, $_POST)) {
        header("Location: dashboard.php?page=equipos");
        exit;
    } else {
        $error = "Error al actualizar equipo.";
    }
}

$stmt = $pdo->query("SELECT id_usuario, nombre, apellido FROM usuarios ORDER BY nombre");
$usuarios = $stmt->fetchAll();
?>
<h2>Editar Equipo</h2>
<?php if ($error): ?>
<div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form method="POST">
    <div class="mb-3">
        <label>ID Usuario</label>
        <select name="id_usuario" class="form-control" required>
            <?php foreach ($usuarios as $user): ?>
                <option value="<?= $user['id_usuario'] ?>" <?= ($equipo['id_usuario'] == $user['id_usuario']) ? "selected" : "" ?>>
                    <?= htmlspecialchars($user['id_usuario']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label>Código Interno</label>
        <input type="text" name="codigo_interno" class="form-control" value="<?= $equipo['codigo_interno'] ?>" required>
    </div>

    <div class="mb-3">
        <label>Marca</label>
        <input type="text" name="marca" class="form-control" value="<?= $equipo['marca'] ?>">
    </div>

    <div class="mb-3">
        <label>Modelo</label>
        <input type="text" name="modelo" class="form-control" value="<?= $equipo['modelo'] ?>">
    </div>

    <div class="mb-3">
        <label>Fecha Ingreso</label>
        <input type="date" name="fecha_ingreso" class="form-control" value="<?= $equipo['fecha_ingreso'] ?>" required>
    </div>

    <div class="mb-3">
        <label>Estado</label>
        <select name="estado" class="form-control">
            <option value="activo" <?= $equipo['estado'] == 'activo' ? 'selected' : '' ?>>Activo</option>
            <option value="en_mantenimiento" <?= $equipo['estado'] == 'en_mantenimiento' ? 'selected' : '' ?>>En Mantenimiento</option>
            <option value="inactivo" <?= $equipo['estado'] == 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Observaciones</label>
        <textarea name="observaciones" class="form-control"><?= $equipo['observaciones'] ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
</form>
