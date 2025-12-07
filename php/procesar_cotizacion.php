<?php
include 'includes/connect_db.php'; 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: cotizacion.php');
    exit;
}

$id_vehiculo = filter_input(INPUT_POST, 'tipo', FILTER_VALIDATE_INT);
$id_ruta = filter_input(INPUT_POST, 'ruta', FILTER_VALIDATE_INT);
$personas = filter_input(INPUT_POST, 'personas', FILTER_VALIDATE_INT);

if (!$id_vehiculo || !$id_ruta || !$personas || $personas <= 0) {
    $_SESSION['error'] = "Datos de cotización inválidos. Asegúrate de seleccionar una ruta, un vehículo y una cantidad válida de personas.";
    header('Location: cotizacion.php');
    exit;
}

try {
    $stmt_vehiculo = $pdo->prepare("SELECT costo_base FROM vehiculos WHERE id = ?");
    $stmt_vehiculo->execute([$id_vehiculo]);
    $vehiculo = $stmt_vehiculo->fetch();

    if (!$vehiculo) {
        throw new Exception("Error: El vehículo seleccionado no existe.");
    }
    $costo_base_vehiculo = $vehiculo['costo_base'];

    $stmt_ruta = $pdo->prepare("SELECT origen, destino, precio_por_persona FROM rutas WHERE id = ?");
    $stmt_ruta->execute([$id_ruta]);
    $ruta = $stmt_ruta->fetch();

    if (!$ruta) {
        throw new Exception("Error: La ruta seleccionada no existe.");
    }
    $precio_por_persona = $ruta['precio_por_persona'];

    $costo_ruta_por_persona = $precio_por_persona * $personas;
    $costo_total = $costo_base_vehiculo + $costo_ruta_por_persona;
    
    $_SESSION['cotizacion_resultado'] = [
        'total' => number_format($costo_total, 2, ',', '.'),
        'ruta_nombre' => $ruta['origen'] . ' - ' . $ruta['destino'],
        'personas' => $personas
    ];
    
} catch (Exception $e) {
    $_SESSION['error'] = "No se pudo realizar la cotización. " . $e->getMessage();
}

header('Location: cotizacion.php');
exit;
?>