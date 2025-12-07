<?php

include '../includes/connect_db.php'; 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// --- DELETE ---

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id_ruta = $_GET['id'];
    try {
        $stmt = $pdo->prepare("DELETE FROM rutas WHERE id = ?");
        $stmt->execute([$id_ruta]);
        $_SESSION['mensaje'] = 'Ruta eliminada con éxito.';
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Error al eliminar la ruta: ' . $e->getMessage();
    }
    header('Location: crud_rutas.php'); 
    exit;
}

// --- CREATE - UPDATE ---

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $origen = $_POST['origen'];
    $destino = $_POST['destino'];
    $precio = $_POST['precio_por_persona'];
    $id_ruta = $_POST['id'] ?? null;

    try {
        if ($id_ruta) {
            // UPDATE
            $sql = "UPDATE rutas SET origen=?, destino=?, precio_por_persona=? WHERE id=?";
            $pdo->prepare($sql)->execute([$origen, $destino, $precio, $id_ruta]);
            $_SESSION['mensaje'] = 'Ruta actualizada con éxito.';
        } else {
            // CREATE
            $sql = "INSERT INTO rutas (origen, destino, precio_por_persona) VALUES (?, ?, ?)";
            $pdo->prepare($sql)->execute([$origen, $destino, $precio]);
            $_SESSION['mensaje'] = 'Nueva ruta agregada con éxito.';
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Error al guardar la ruta: ' . $e->getMessage();
    }
    
    header('Location: crud_rutas.php');
    exit;
}

// --- READ ---
$rutas = $pdo->query("SELECT * FROM rutas ORDER BY origen")->fetchAll();


$ruta_a_editar = null;
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM rutas WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $ruta_a_editar = $stmt->fetch();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Rutas</title>
    <link rel="stylesheet" href="../../css/admin_styles.css"> 
</head>
<body>

    <div class="admin-container">
        
        <?php include '../includes/admin_sidebar.php'; ?>
        
        <div class="admin-content">

    <h1>Gestión de Rutas</h1>

    <?php if (isset($_SESSION['mensaje'])): ?>
        <p class="success"><?= $_SESSION['mensaje']; unset($_SESSION['mensaje']); ?></p>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
        <p class="error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>

    <h3><?= $ruta_a_editar ? 'Editar Ruta' : 'Agregar Nueva Ruta'; ?></h3>
    <form method="POST" action="crud_rutas.php">
        <input type="hidden" name="id" value="<?= $ruta_a_editar ? $ruta_a_editar['id'] : ''; ?>">
        
        <label for="origen">Origen:</label><br>
        <input type="text" name="origen" value="<?= $ruta_a_editar ? htmlspecialchars($ruta_a_editar['origen']) : ''; ?>" placeholder="Ej: Bogotá" required><br>
        
        <label for="destino">Destino:</label><br>
        <input type="text" name="destino" value="<?= $ruta_a_editar ? htmlspecialchars($ruta_a_editar['destino']) : ''; ?>" placeholder="Ej: Girardot" required><br>

        <label for="precio_por_persona">Precio por Persona:</label><br>
        <input type="number" name="precio_por_persona" value="<?= $ruta_a_editar ? $ruta_a_editar['precio_por_persona'] : ''; ?>" placeholder="Ej: 35000" step="0.01" required><br>
        
        <button type="submit"><?= $ruta_a_editar ? 'Actualizar Ruta' : 'Guardar Ruta'; ?></button>
        <?php if ($ruta_a_editar): ?>
            <a href="crud_rutas.php">Cancelar Edición</a>
        <?php endif; ?>
    </form>

    <h3>Rutas Registradas</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Origen</th>
                <th>Destino</th>
                <th>Precio por Persona</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rutas as $ruta): ?>
            <tr>
                <td><?= $ruta['id']; ?></td>
                <td><?= htmlspecialchars($ruta['origen']); ?></td>
                <td><?= htmlspecialchars($ruta['destino']); ?></td>
                <td>$<?= number_format($ruta['precio_por_persona'], 2, ',', '.'); ?></td>
                <td>
                    <a href="?action=edit&id=<?= $ruta['id']; ?>">Editar</a> | 
                    <a href="?action=delete&id=<?= $ruta['id']; ?>" onclick="return confirm('¿Seguro de eliminar esta ruta?')">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
        </div>
    </div>
</body>
</html>