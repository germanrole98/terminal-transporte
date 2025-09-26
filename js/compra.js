document.addEventListener("DOMContentLoaded", () => {
  const formulario = document.getElementById("formulario-compra");
  const nombre = document.getElementById("nombre");
  const ruta = document.getElementById("ruta");
  const cantidad = document.getElementById("cantidad");


  const costosRutas = {
    "bogota-girardot": 37000,
    "ibague-neiva": 52000,
    "cali-popayan": 25000,
    "medellin-manizales": 63000,
    "barranquilla-cartagena": 28000,
    "bucaramanga-cucuta": 18000,
    "pasto-tumaco": 60000,
  };

  formulario.addEventListener("submit", (event) => {
    event.preventDefault();

    const nombreCliente = nombre.value;
    const rutaSeleccionada = ruta.value;
    const cantidadTickets = parseInt(cantidad.value);

    if (isNaN(cantidadTickets) || cantidadTickets < 1) {
      alert("Por favor, ingresa una cantidad de personas válida.");
      return;
    }

    const costoRuta = costosRutas[rutaSeleccionada];
    const costoTotal = costoRuta * cantidadTickets;

    alert("Gracias por tu compra, " + nombreCliente + "! El costo total es de $" + costoTotal.toLocaleString("es-CO"));

  });
});
