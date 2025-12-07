<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/styles.css" /> 

    <title>Todas las Rutas y Destinos</title>
    <meta name="description" content="Explora todas las rutas de transporte disponibles desde nuestra terminal. 
    Encuentra destinos, horarios y precios para planificar tu viaje con facilidad.">
    
  </head>
  <body>

    <?php 

    include 'includes/nav.php'; 

    include 'includes/connect_db.php'; 

    try {
        $stmt = $pdo->query("SELECT id, origen, destino, precio_por_persona FROM rutas ORDER BY origen");
        $rutas = $stmt->fetchAll();
    } catch (PDOException $e) {
        $rutas = []; 
        echo "<p style='color: red;'>Error al cargar rutas: " . $e->getMessage() . "</p>";
    }
    ?>

    <main>
      <div class="introduccion">
        <h2>Rutas disponibles</h2>
        <p>
          Descubre nuestras rutas más populares y planifica tu próximo viaje con
          facilidad. 
        </p>
      </div>
      
      <section class="container-rutas">
        
        <?php 

        if (count($rutas) > 0) {
            foreach ($rutas as $ruta) {
                $precio_formateado = number_format($ruta['precio_por_persona'], 0, ',', '.');
        ?>
            <article class="ruta">
              <div>
                <h3><?php echo htmlspecialchars($ruta['origen']) . ' – ' . htmlspecialchars($ruta['destino']); ?></h3>
                <p>Precio por persona: $<?php echo $precio_formateado; ?></p>
                </div>
              <a href="compra.php?ruta_id=<?php echo $ruta['id']; ?>"><button>Comprar Ticket</button></a>
            </article>

        <?php 
            } 
        } else {
            
            echo "<p>No se encontraron rutas disponibles en este momento. Por favor, revise la conexión a la base de datos.</p>";
        }
        ?>
        
      </section>
    </main>

    <?php include 'includes/footer.php'; ?>
    
  </body>
</html>