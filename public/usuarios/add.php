<?php
require_once "../includes/config.php";
require_once "../includes/usuarios_functions.php";

$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (addUsuario($_POST)) {
        // Redirigir directamente a agregar equipo con la cedula del usuario
        header("Location: dashboard.php?page=equipos&action=add&usuario=" .$_POST['id_usuario']);
        exit();
    } else {
        $error = "Error al agregar usuario.";
    }
}
?>
<h2>Agregar Usuario</h2>
<?php if ($error): ?>
<div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form method="POST">
    <div class="mb-3">
        <label>Cédula</label>
        <input type="text" name="id_usuario" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Nombre</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Apellido</label>
        <input type="text" name="apellido" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Correo</label>
        <input type="email" name="correo" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Teléfono</label>
        <input type="text" name="telefono" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Guardar</button>
</form>
