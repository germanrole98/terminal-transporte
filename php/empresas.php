<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/styles.css" />
    <title>Terminal de Transporte</title>
  </head>
  <body>

    <?php include 'includes/nav.php'; ?>

    <main>
      <div class="introduccion">
        <h2>Empresas de transporte</h2>
        <p>
          Conoce las principales empresas de transporte que operan en nuestra
          terminal. Cada empresa ofrece una variedad de servicios y rutas para
          satisfacer tus necesidades de viaje. Selecciona una empresa para
          obtener más información y contactar directamente.
        </p>
      </div>

      <section class="container-empresas">
        <article class="info-empresa">
          <img src="../imagenes/empresa1.webp" alt="Logo Transportes El Rápido" />
          <h3>Transportes El Rápido</h3>
          <p>Tel: +57 310 456 7890</p>
          <p>Email: contacto@elrapido.com</p>
        </article>

        <article class="info-empresa">
          <img src="../imagenes/empresa2.webp" alt="Logo Expreso del Sur" />
          <h3>Expreso del Sur</h3>
          <p>Tel: +57 320 987 6543</p>
          <p>Email: info@expresodelsur.com</p>
        </article>

        <article class="info-empresa">
          <img src="../imagenes/empresa3.webp" alt="Logo Viajes Andes" />
          <h3>Viajes Andes</h3>
          <p>Tel: +57 300 123 4567</p>
          <p>Email: info@</p>
        </article>
      </section>
    </main>

    <?php include 'includes/footer.php'; ?>
    
  </body>
</html>
