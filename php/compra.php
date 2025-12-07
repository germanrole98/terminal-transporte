<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/styles.css" />
    
    <title>Pago Seguro y Compra de Tiquetes de Bus Online</title>
    <meta name="description" content="Compra tus tiquetes de bus de forma segura y rápida. Elige tu ruta, cantidad de tiquetes y método de pago preferido. ¡Viaja con confianza!">
    
    <script src="js/compra.js"></script>
  </head>
  <body>

    <?php include 'includes/nav.php'; ?>

    <main>
      <div class="cotizacion">
      <h2>Compra tu tiquete</h2>
      <form id="formulario-compra">
        <label for="nombre">Nombre completo</label>
        <input type="text" id="nombre" name="nombre" required/>

        <label for="ruta">Ruta</label>
        <select id="ruta" name="ruta" required>
          <option value="bogota-girardot">Bogotá – Girardot</option>
          <option value="ibague-neiva">Ibagué – Neiva</option>
          <option value="cali-popayan">Cali – Popayán</option>
          <option value="medellin-manizales">Medellín – Manizales</option>
          <option value="barranquilla-cartagena">
            Barranquilla – Cartagena
          </option>
          <option value="bucaramanga-cucuta">Bucaramanga – Cúcuta</option>
          <option value="pasto-tumaco">Pasto – Tumaco</option>
        </select>

        <label for="cantidad">Cantidad de tiquetes</label>
        <input type="number" id="cantidad" name="cantidad" min="1" required/>

        <label for="pago">Método de pago</label>
        <select id="pago" name="pago" required>
          <option value="efectivo">PSE</option>
          <option value="tarjeta">Tarjeta de crédito</option>
          <option value="nequi">Nequi</option>
          <option value="daviplata">Daviplata</option>
        </select>

        <button type="submit">Comprar</button>
      </form>
      </div>
    </main>

    <?php include 'includes/footer.php'; ?>
    
  </body>
</html>
