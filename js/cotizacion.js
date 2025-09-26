document.addEventListener("DOMContentLoaded", () => {
  const formulario = document.getElementById("formulario-cotizacion");
  const tipo = document.getElementById("tipo");
  const ruta = document.getElementById("ruta");
  const personas = document.getElementById("personas");
  const resultadoCotizacion = document.getElementById("resultado-cotizacion");

  const costosVehiculos = {
    microbus: 100000,
    "bus-intermunicipal": 200000,
    "bus-turistico": 300000,
    "bus-ejecutivo": 400000,
  };

  const capacidadesMaximas = {
    microbus: 12,
    "bus-intermunicipal": 40,
    "bus-turistico": 60,
    "bus-ejecutivo": 30,
  };

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

    const tipoVehiculo = tipo.value;
    const rutaSeleccionada = ruta.value;
    const cantidadPersonas = parseInt(personas.value);

    if (isNaN(cantidadPersonas) || cantidadPersonas < 1) {
      alert("Por favor, ingresa una cantidad de personas válida.");
      return;
    }

    const capacidadMaxima = capacidadesMaximas[tipoVehiculo];
    if (parseInt(cantidadPersonas) > capacidadMaxima) {
      alert(
        `Lo sentimos, el ${tipoVehiculo} solo tiene capacidad para ${capacidadMaxima} personas.`
      );
      resultadoCotizacion.textContent = "Costo estimado: $0";
      return;
    }

    const costoBase = costosVehiculos[tipoVehiculo];
    const factorRuta = costosRutas[rutaSeleccionada];
    const costoTotal = costoBase + factorRuta * cantidadPersonas;

    resultadoCotizacion.textContent = `Costo estimado: $${costoTotal.toLocaleString(
      "es-CO"
    )}`;
  });
});
