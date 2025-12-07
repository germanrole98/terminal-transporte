<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/styles.css" />
    <title>Terminal de Transporte - Vehículos</title>
  </head>
  <body>

    <?php
    include 'includes/connect_db.php'; 

    try {
        $stmt = $pdo->query("SELECT id, tipo, capacidad, descripcion FROM vehiculos ORDER BY capacidad DESC");
        $vehiculos = $stmt->fetchAll();
    } catch (PDOException $e) {
        $vehiculos = []; 
        echo "<p style='color: red;'>Error al cargar vehículos: " . $e->getMessage() . "</p>";
    }
    
    include 'includes/nav.php'; 
    ?>

    <main>
      <div class="introduccion">
        <h2>Tipos de vehículos disponibles</h2>
        <p>Explora nuestra variedad de vehículos diseñados para adaptarse a cada necesidad de transporte. Desde opciones compactas hasta buses de alta capacidad, elige el tipo ideal y solicita tu cotización personalizada con un solo clic.</p>
      </div>
      
      <section class="container-empresas"> 
        
        <?php 
        if (count($vehiculos) > 0) {
            foreach ($vehiculos as $vehiculo) {
        ?>
            <article class="info-empresa">
              
              <?php
                $imagen_file = strtolower(str_replace([' ', ' de '], ['-', '-'], $vehiculo['tipo'])); 
              ?>
              
              <img src="../imagenes/<?php echo $imagen_file; ?>.webp" alt="<?php echo htmlspecialchars($vehiculo['tipo']); ?>">
              
              <h3><?php echo htmlspecialchars($vehiculo['tipo']); ?></h3>
              <p>Capacidad: <?php echo htmlspecialchars($vehiculo['capacidad']); ?> pasajeros</p>
              
              <p><?php echo htmlspecialchars($vehiculo['descripcion']); ?></p>

              <a href="cotizacion.php?vehiculo_id=<?php echo $vehiculo['id']; ?>"><button>Solicitar cotización</button></a>
            </article>

        <?php 
            } 
        } else {
            echo "<p>No se encontraron tipos de vehículos disponibles en este momento.</p>";
        }
        ?>
        
      </section>
    </main>

    <?php include 'includes/footer.php'; ?>
    
  </body>
</html>