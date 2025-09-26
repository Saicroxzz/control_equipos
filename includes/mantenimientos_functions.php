<?php
require_once __DIR__ . "/config.php";

function getAllMantenimientos() {
    global $pdo;
    try {
        $stmt = $pdo->query("
            SELECT m.*, 
                   e.codigo_interno, e.marca, e.modelo, 
                   u.nombre AS nombre_usuario, u.apellido AS apellido_usuario, 
                   t.nombre AS nombre_tecnico, t.apellido AS apellido_tecnico 
            FROM mantenimientos m
            JOIN equipos e ON m.id_equipo = e.id_equipo
            JOIN usuarios u ON e.id_usuario = u.id_usuario
            JOIN tecnicos t ON m.id_tecnico = t.id_tecnico
            ORDER BY m.fecha_mantenimiento DESC
        ");
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Error en getAllMantenimientos: " . $e->getMessage());
        return false;
    }
}

function getMantenimientoById($id_mantenimiento) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("
            SELECT m.*, 
                   e.codigo_interno, e.marca, e.modelo, 
                   u.nombre AS nombre_usuario, u.apellido AS apellido_usuario, 
                   t.nombre AS nombre_tecnico, t.apellido AS apellido_tecnico 
            FROM mantenimientos m
            JOIN equipos e ON m.id_equipo = e.id_equipo
            JOIN usuarios u ON e.id_usuario = u.id_usuario
            JOIN tecnicos t ON m.id_tecnico = t.id_tecnico
            WHERE m.id_mantenimiento = ?
        ");
        $stmt->execute([$id_mantenimiento]);
        return $stmt->fetch();
    } catch (PDOException $e) {
        error_log("Error en getMantenimientoById: " . $e->getMessage());
        return false;
    }
}

function addMantenimiento($data) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("
            INSERT INTO mantenimientos (id_equipo, id_tecnico, fecha_mantenimiento, descripcion, costo, estado) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['id_equipo'],
            $data['id_tecnico'],
            $data['fecha_mantenimiento'],
            $data['descripcion'],
            $data['costo'],
            $data['estado']
        ]);
    } catch (PDOException $e) {
        error_log("Error en addMantenimiento: " . $e->getMessage());
        return false;
    }
}

function updateMantenimiento($id_mantenimiento, $data) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("
            UPDATE mantenimientos 
            SET id_equipo = ?, id_tecnico = ?, fecha_mantenimiento = ?, descripcion = ?, costo = ?, estado = ?
            WHERE id_mantenimiento = ?
        ");
        return $stmt->execute([
            $data['id_equipo'],
            $data['id_tecnico'],
            $data['fecha_mantenimiento'],
            $data['descripcion'],
            $data['costo'],
            $data['estado'],
            $id_mantenimiento
        ]);
    } catch (PDOException $e) {
        error_log("Error en updateMantenimiento: " . $e->getMessage());
        return false;
    }
}


function deleteMantenimiento($id) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("DELETE FROM mantenimientos WHERE id_mantenimiento = ?");
        return $stmt->execute([$id]);
    } catch (PDOException $e) {
        error_log("Error en deleteMantenimiento: " . $e->getMessage());
        return false;
    }
}
