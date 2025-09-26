<?php
require_once "../includes/config.php";
require_once "../includes/usuarios_functions.php";

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: dashboard.php?page=usuarios");
    exit();
}

$usuario = getUsuarioById($id);
if (!$usuario) {
    header("Location: dashboard.php?page=usuarios");
    exit();
}

$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (updateUsuario($id, $_POST)) {
        header("Location: dashboard.php?page=usuarios");
        exit();
    } else {
        $error = "Error al actualizar usuario.";
    }
}
?>
<h2>Editar Usuario</h2>
<?php if ($error): ?>
<div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form method="POST">
    <div class="mb-3">
        <label>Cédula</label>
        <input type="text" name="id_usuario" class="form-control" value="<?= htmlspecialchars($usuario['id_usuario']) ?>" readonly>
    </div>
    <div class="mb-3">
        <label>Nombre</label>
        <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
    </div>
    <div class="mb-3">
        <label>Apellido</label>
        <input type="text" name="apellido" class="form-control" value="<?= htmlspecialchars($usuario['apellido']) ?>" required>
    </div>
    <div class="mb-3">
        <label>Correo</label>
        <input type="email" name="correo" class="form-control" value="<?= htmlspecialchars($usuario['correo']) ?>" required>
    </div>
    <div class="mb-3">
        <label>Teléfono</label>
        <input type="text" name="telefono" class="form-control" value="<?= htmlspecialchars($usuario['telefono']) ?>">
    </div>
    <button type="submit" class="btn btn-success">Actualizar</button>
</form>
