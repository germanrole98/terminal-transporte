<?php

include '../includes/connect_db.php'; 


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// DELETE
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id_vehiculo = $_GET['id'];
    try {
        $stmt = $pdo->prepare("DELETE FROM vehiculos WHERE id = ?");
        $stmt->execute([$id_vehiculo]);
        $_SESSION['mensaje'] = 'Vehículo eliminado con éxito.';
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Error al eliminar el vehículo: ' . $e->getMessage();
    }
    header('Location: crud_vehiculos.php'); 
    exit;
}

// --- UPDATE CREATE ---
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tipo = $_POST['tipo'];
    $capacidad = $_POST['capacidad'];
    $descripcion = $_POST['descripcion'];
    $costo_base = $_POST['costo_base'];
    $id_vehiculo = $_POST['id'] ?? null; // ID solo existe en caso de edición

    try {
        if ($id_vehiculo) {
            // UPDATE
            $sql = "UPDATE vehiculos SET tipo=?, capacidad=?, descripcion=?, costo_base=? WHERE id=?";
            $pdo->prepare($sql)->execute([$tipo, $capacidad, $descripcion, $costo_base, $id_vehiculo]);
            $_SESSION['mensaje'] = 'Vehículo actualizado con éxito.';
        } else {
            // CREATE
            $sql = "INSERT INTO vehiculos (tipo, capacidad, descripcion, costo_base) VALUES (?, ?, ?, ?)";
            $pdo->prepare($sql)->execute([$tipo, $capacidad, $descripcion, $costo_base]);
            $_SESSION['mensaje'] = 'Nuevo vehículo agregado con éxito.';
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Error al guardar el vehículo: ' . $e->getMessage();
    }
    
    header('Location: crud_vehiculos.php');
    exit;
}

// --- READ ---
$vehiculos = $pdo->query("SELECT * FROM vehiculos ORDER BY tipo")->fetchAll();


$vehiculo_a_editar = null;
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM vehiculos WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $vehiculo_a_editar = $stmt->fetch();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Vehículos</title>
    <link rel="stylesheet" href="../../css/admin_styles.css"> 
</head>
<body>

    <d class="admin-container"></div>
        
        <?php include '../includes/admin_sidebar.php'; ?>
        
        <div class="admin-content">

    <h1>Gestión de Vehículos</h1>

    <?php if (isset($_SESSION['mensaje'])): ?>
        <p class="success"><?= $_SESSION['mensaje']; unset($_SESSION['mensaje']); ?></p>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
        <p class="error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>

    <h3><?= $vehiculo_a_editar ? 'Editar Vehículo' : 'Agregar Nuevo Vehículo'; ?></h3>
    <form method="POST" action="crud_vehiculos.php">
        <input type="hidden" name="id" value="<?= $vehiculo_a_editar ? $vehiculo_a_editar['id'] : ''; ?>">
        
        <label for="tipo">Tipo:</label><br>
        <input type="text" name="tipo" value="<?= $vehiculo_a_editar ? htmlspecialchars($vehiculo_a_editar['tipo']) : ''; ?>" placeholder="Ej: Microbús" required><br>
        
        <label for="capacidad">Capacidad (Pasajeros):</label><br>
        <input type="number" name="capacidad" value="<?= $vehiculo_a_editar ? $vehiculo_a_editar['capacidad'] : ''; ?>" placeholder="Ej: 12" required><br>

        <label for="costo_base">Costo Base:</label><br>
        <input type="number" name="costo_base" value="<?= $vehiculo_a_editar ? $vehiculo_a_editar['costo_base'] : ''; ?>" placeholder="Ej: 50000" step="0.01" required><br>

        <label for="descripcion">Descripción:</label><br>
        <textarea name="descripcion" placeholder="Detalles del servicio"><?= $vehiculo_a_editar ? htmlspecialchars($vehiculo_a_editar['descripcion']) : ''; ?></textarea><br>
        
        <button type="submit"><?= $vehiculo_a_editar ? 'Actualizar Vehículo' : 'Guardar Vehículo'; ?></button>
        <?php if ($vehiculo_a_editar): ?>
            <a href="crud_vehiculos.php">Cancelar Edición</a>
        <?php endif; ?>
    </form>

    <h3>Vehículos Registrados</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Capacidad</th>
                <th>Costo Base</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vehiculos as $vehiculo): ?>
            <tr>
                <td><?= $vehiculo['id']; ?></td>
                <td><?= htmlspecialchars($vehiculo['tipo']); ?></td>
                <td><?= $vehiculo['capacidad']; ?></td>
                <td>$<?= number_format($vehiculo['costo_base'], 2, ',', '.'); ?></td>
                <td><?= htmlspecialchars(substr($vehiculo['descripcion'], 0, 50)) . '...'; ?></td>
                <td>
                    <a href="?action=edit&id=<?= $vehiculo['id']; ?>">Editar</a> | 
                    <a href="?action=delete&id=<?= $vehiculo['id']; ?>" onclick="return confirm('¿Seguro de eliminar este vehículo?')">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
        </div>
    </div>
</body>
</html>