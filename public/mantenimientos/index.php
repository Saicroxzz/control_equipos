<?php
require_once __DIR__ . "/../../includes/config.php";
require_once __DIR__ . "/../../includes/mantenimientos_functions.php";

$mantenimientos = getAllMantenimientos();
?>

<h2>Mantenimientos</h2>
<a href="dashboard.php?page=mantenimientos&action=add" class="btn btn-success mb-3">Agregar Mantenimiento</a>

<div class="row">
    <?php if (empty($mantenimientos)): ?>
        <div class="alert alert-info">No hay mantenimientos registrados.</div>
    <?php endif; ?>

    <?php foreach ($mantenimientos as $mantenimiento): ?>
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header 
                <?= $mantenimiento['estado'] == 'pendiente' ? 'bg-warning text-dark' : '' ?>
                <?= $mantenimiento['estado'] == 'en_proceso' ? 'bg-info text-white' : '' ?>
                <?= $mantenimiento['estado'] == 'finalizado' ? 'bg-success text-white' : '' ?>
            ">
                <strong><?= ucfirst($mantenimiento['estado']) ?></strong>
            </div>
            <div class="card-body">
                <h5 class="card-title">
                    <?= htmlspecialchars($mantenimiento['codigo_interno'] . " - " . $mantenimiento['marca'] . " " . $mantenimiento['modelo']) ?>
                </h5>
                <p><strong>Usuario:</strong> <?= htmlspecialchars($mantenimiento['nombre_usuario'] . " " . $mantenimiento['apellido_usuario']) ?></p>
                <p><strong>Técnico:</strong> <?= htmlspecialchars($mantenimiento['nombre_tecnico'] . " " . $mantenimiento['apellido_tecnico']) ?></p>
                <p><strong>Fecha:</strong> <?= $mantenimiento['fecha_mantenimiento'] ?></p>
                <p><strong>Descripción:</strong> <?= htmlspecialchars($mantenimiento['descripcion']) ?></p>
                <p><strong>Costo:</strong> $<?= number_format($mantenimiento['costo'], 2) ?></p>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="dashboard.php?page=mantenimientos&action=edit&id=<?= $mantenimiento['id_mantenimiento'] ?>" class="btn btn-primary btn-sm">Editar</a>
                <a href="dashboard.php?page=mantenimientos&action=delete&id=<?= $mantenimiento['id_mantenimiento'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que desea eliminar este mantenimiento?')">Eliminar</a>
                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#facturaModal<?= $mantenimiento['id_mantenimiento'] ?>">Generar Factura</button>
            </div>
        </div>

        <!-- Modal de factura -->
        <div class="modal fade" id="facturaModal<?= $mantenimiento['id_mantenimiento'] ?>" tabindex="-1" aria-labelledby="facturaModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="facturaModalLabel">Factura del Mantenimiento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
              </div>
              <div class="modal-body">
                <h4 class="mb-3">Factura #FAC-<?= date("YmdHis") . "-" . rand(1000,9999) ?></h4>
                <p><strong>Fecha de emisión:</strong> <?= date("d/m/Y") ?></p>
                <p><strong>Mantenimiento ID:</strong> <?= $mantenimiento['id_mantenimiento'] ?></p>
                <hr>
                <h5>Detalles del mantenimiento</h5>
                <p><strong>Equipo:</strong> <?= htmlspecialchars($mantenimiento['codigo_interno'] . " - " . $mantenimiento['marca'] . " " . $mantenimiento['modelo']) ?></p>
                <p><strong>Usuario:</strong> <?= htmlspecialchars($mantenimiento['nombre_usuario'] . " " . $mantenimiento['apellido_usuario']) ?></p>
                <p><strong>Técnico:</strong> <?= htmlspecialchars($mantenimiento['nombre_tecnico'] . " " . $mantenimiento['apellido_tecnico']) ?></p>
                <p><strong>Fecha mantenimiento:</strong> <?= $mantenimiento['fecha_mantenimiento'] ?></p>
                <p><strong>Descripción:</strong> <?= htmlspecialchars($mantenimiento['descripcion']) ?></p>
                <p><strong>Costo:</strong> $<?= number_format($mantenimiento['costo'], 2) ?></p>
                <hr>
                <p><strong>Método de pago:</strong> Efectivo</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>

    </div>
    <?php endforeach; ?>
</div>
