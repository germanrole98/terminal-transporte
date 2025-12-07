<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/styles.css" />
    
    <title>Terminal de Transporte: Rutas, Horarios y Tiquetes Online</title>
    <meta name="description" content="Consulta y compra tiquetes de bus al mejor precio. Verifica rutas, horarios y disponibilidad de todas las empresas de transporte. ¡Viaja seguro y rápido!">

  </head>
  <body>
    
    <?php include 'includes/nav.php'; ?>

    <main>
      <div class="introduccion">
        <h2>Tu viaje comienza aquí</h2>
        <p>
          Bienvenido a la Terminal de Transporte. Aquí encontrará toda la
          información necesaria para planificar su viaje, incluyendo empresas de
          transporte, vehículos disponibles, rutas, horarios, costos y más.
        </p>
      </div>

      <div class="iconos-container">
        <a href="rutas.php">
          <div class="iconos">
            <img src="../iconos/ruta.svg" alt="Icono de rutas" />
            <h3>Rutas</h3>
          </div>
        </a>

        <a href="empresas.php">
          <div class="iconos">
            <img src="../iconos/empresas.svg" alt="Icono de empresas" />
            <h3>Empresas</h3>
          </div>
        </a>
        <a href="vehiculos.php">
          <div class="iconos">
            <img src="../iconos/bus.svg" alt="Icono de vehículos" />
            <h3>Vehículos</h3>
          </div>
        </a>
      </div>

      <section class="container-info">
        <div class="info-terminal">
          <img src="../iconos/ubicacion.svg" alt="Icono de ubicación" />
          <h4>Ubicación</h4>
          <p>Calle 123 #45-67, Ciudad, Departamento</p>
        </div>

        <div class="info-terminal">
          <img src="../iconos/reloj.svg" alt="Icono de reloj" />
          <h4>Horarios de atención</h4>
          <p>Lunes a domingo: 5:00 a.m. – 10:00 p.m.</p>
        </div>

        <div class="info-terminal">
          <img src="../iconos/telefono.svg" alt="Icono de teléfono" />
          <h4>Teléfonos de contacto</h4>
          <ul>
            <li>+57 300 123 4567</li>
            <li>+57 1 234 5678</li>
          </ul>
        </div>

        <div class="info-terminal">
          <img src="../iconos/servicio.svg" alt="Icono de servicios" />
          <h4>Servicios disponibles</h4>
          <ul>
            <li>Wi-Fi gratuito</li>
            <li>Guarda equipaje</li>
            <li>Restaurantes y cafeterías</li>
            <li>Atención al viajero</li>
          </ul>
        </div>
      </section>
    </main>

    <?php include 'includes/footer.php'; ?>

  </body>
</html>
