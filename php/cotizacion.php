<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'includes/connect_db.php'; 

try {
    $stmt_vehiculos = $pdo->query("SELECT id, tipo, capacidad FROM vehiculos ORDER BY capacidad ASC");
    $vehiculos = $stmt_vehiculos->fetchAll();
} catch (PDOException $e) {
    $vehiculos = [];
}

try {
    $stmt_rutas = $pdo->query("SELECT id, origen, destino FROM rutas ORDER BY origen ASC");
    $rutas = $stmt_rutas->fetchAll();
} catch (PDOException $e) {
    $rutas = [];
}
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/styles.css" />
    <title>Cotización de Transporte</title>
    
    <meta name="description" content="Calcula el costo estimado de tu viaje en bus según el tipo de vehículo, ruta y número de personas. 
    Obtén tu cotización rápida y fácilmente.">

    <script src="js/cotizacion.js"></script> 
  </head>

  <body>

    <?php include 'includes/nav.php'; ?>

    <main class="main-cotizacion">
      <div class="cotizacion">
        <h2>Calcula tu cotización</h2>
        
        <?php if (isset($_SESSION['error'])): ?>
            <p style="color: red; font-weight: bold; padding: 10px; border: 1px solid red; border-radius: 4px;"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
        <?php endif; ?>

        <form id="formulario-cotizacion" action="procesar_cotizacion.php" method="POST">
          
          <label for="tipo">Tipo de vehículo</label>
          <select name="tipo" id="tipo" required>
            <option value="">-- Seleccione un vehículo --</option>
            <?php 
            if (count($vehiculos) > 0) {
                foreach ($vehiculos as $vehiculo) {
            ?>
                <option value="<?php echo $vehiculo['id']; ?>">
                  <?php echo htmlspecialchars($vehiculo['tipo']) . ' (' . $vehiculo['capacidad'] . ' pasajeros)'; ?>
                </option>
            <?php 
                }
            } else {
                 echo "<option value=''>Error: No hay vehículos en la DB</option>";
            }
            ?>
          </select>
          <label for="ruta">Ruta</label>
          <select id="ruta" name="ruta" required>
            <option value="">-- Seleccione una ruta --</option>
            <?php 
            if (count($rutas) > 0) {
                foreach ($rutas as $ruta) {

            ?>
                <option value="<?php echo $ruta['id']; ?>">
                  <?php echo htmlspecialchars($ruta['origen']) . ' – ' . htmlspecialchars($ruta['destino']); ?>
                </option>
            <?php 
                }
            } else {
                 echo "<option value=''>Error: No hay rutas en la DB</option>";
            }
            ?>
          </select>
          <label for="personas">Cantidad de personas</label>
          <input type="number" id="personas" name="personas" min="1" required />

          <button type="submit">Calcular costo</button>
        </form>
        
        <div id="resultado">
          <div>
            <?php if (isset($_SESSION['cotizacion_resultado'])): 
                $res = $_SESSION['cotizacion_resultado'];
            ?>
                <h3 id="resultado-cotizacion">Costo estimado: **$<?= $res['total']; ?> COP**</h3>
                <p>Ruta: **<?= $res['ruta_nombre']; ?>** | Personas: **<?= $res['personas']; ?>**</p>
                
            <?php unset($_SESSION['cotizacion_resultado']); ?>
            <?php else: ?>
                <h3 id="resultado-cotizacion">Costo estimado: $0</h3>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </main>

    <?php include 'includes/footer.php'; ?>
    
  </body>
</html>