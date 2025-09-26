<?php
require_once __DIR__ . "/../../includes/config.php";
require_once __DIR__ . "/../../includes/mantenimientos_functions.php";

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (addMantenimiento($_POST)) {
        header("Location: dashboard.php?page=mantenimientos");
        exit();
    } else {
        $error = "Error al agregar mantenimiento.";
    }
}

$equipos = $pdo->query("SELECT e.id_equipo, e.codigo_interno, e.marca, e.modelo FROM equipos e")->fetchAll();
$tecnicos = $pdo->query("SELECT id_tecnico, nombre, apellido FROM tecnicos")->fetchAll();
?>

<h2>Agregar Mantenimiento</h2>
<?php if ($error): ?>
<div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form method="POST">
    <div class="mb-3">
        <label>Equipo</label>
        <select name="id_equipo" class="form-control" required>
            <?php foreach ($equipos as $equipo): ?>
                <option value="<?= $equipo['id_equipo'] ?>">
                    <?= htmlspecialchars($equipo['codigo_interno'] . " - " . $equipo['marca'] . " " . $equipo['modelo']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label>Técnico</label>
        <select name="id_tecnico" class="form-control" required>
            <?php foreach ($tecnicos as $tecnico): ?>
                <option value="<?= $tecnico['id_tecnico'] ?>">
                    <?= htmlspecialchars($tecnico['nombre'] . " " . $tecnico['apellido']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label>Fecha de Mantenimiento</label>
        <input type="date" name="fecha_mantenimiento" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Descripción</label>
        <textarea name="descripcion" class="form-control" required></textarea>
    </div>

    <div class="mb-3">
        <label>Costo</label>
        <input type="number" step="0.01" name="costo" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Estado</label>
        <select name="estado" class="form-control">
            <option value="pendiente">Pendiente</option>
            <option value="en_proceso">En Proceso</option>
            <option value="finalizado">Finalizado</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
</form>
