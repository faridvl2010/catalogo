let productos = [];
let orden = { campo: "", asc: true };

function renderTabla(data) {
  const tbody = $("#tablaProductos tbody").empty();
  data.forEach(p => {
    const alerta = p.cantidad < 5 ? 'table-danger' : '';
    tbody.append(`
      <tr data-id="${p.id}" class="${alerta}">
        <td>${p.id}</td>
        <td>${p.nombre}</td>
        <td>${p.descripcion || ""}</td>
        <td>${p.precio}</td>
        <td>${p.cantidad}</td>
        <td>
          <button class="btn btn-sm btn-warning editar">Editar
            <i class="fas fa-edit"></i>
          </button>
          <button class="btn btn-sm btn-danger eliminar">Eliminar
            <i class="fas fa-trash-alt"></i>
          </button>
        </td>
      </tr>
    `);
  });
}

function cargarProductos() {
  $.get("controller/ProductoController.php?action=listar", function(data) {
    productos = JSON.parse(data);
    renderTabla(productos);
  });
}

function aplicarBusquedaOrden() {
  let resultado = productos;
  const filtro = $("#buscar").val().toLowerCase();
  if (filtro) {
    resultado = resultado.filter(p => p.nombre.toLowerCase().includes(filtro));
  }
  if (orden.campo) {
    resultado.sort((a, b) => {
      const valA = a[orden.campo];
      const valB = b[orden.campo];
      return orden.asc ? valA - valB : valB - valA;
    });
  }
  renderTabla(resultado);
}
// Evento para botón de editar
$("#tablaProductos").on("click", ".editar", function () {
  const fila = $(this).closest("tr").children("td");
  $("#id").val(fila.eq(0).text());
  $("#nombre").val(fila.eq(1).text());
  $("#descripcion").val(fila.eq(2).text());
  $("#precio").val(fila.eq(3).text());
  $("#cantidad").val(fila.eq(4).text());
});

// Evento para botón de eliminar
$("#tablaProductos").on("click", ".eliminar", function () {
  const id = $(this).closest("tr").data("id");
  if (confirm("¿Estás seguro de eliminar este producto?")) {
    $.post("controller/ProductoController.php?action=eliminar", { id }, cargarProductos);
  }
});

$("#agregar").click(() => {
  const nombre = $("#nombre").val();
  const descripcion = $("#descripcion").val();
  const precio = parseFloat($("#precio").val());
  const cantidad = parseInt($("#cantidad").val());
  $.post("controller/ProductoController.php?action=agregar", {nombre, descripcion, precio, cantidad}, cargarProductos);
});

$("#actualizar").click(() => {
  const id = $("#id").val();
  const nombre = $("#nombre").val();
  const descripcion = $("#descripcion").val();
  const precio = parseFloat($("#precio").val());
  const cantidad = parseInt($("#cantidad").val());
  $.post("controller/ProductoController.php?action=actualizar", {id, nombre, descripcion, precio, cantidad}, cargarProductos);
});

$("#eliminar").click(() => {
  const id = $("#id").val();
  $.post("controller/ProductoController.php?action=eliminar", {id}, cargarProductos);
});



$("#buscar").on("input", aplicarBusquedaOrden);

$("#ordenarPrecio").click(() => {
  orden.campo = "precio";
  orden.asc = !orden.asc;
  aplicarBusquedaOrden();
});

$("#ordenarCantidad").click(() => {
  orden.campo = "cantidad";
  orden.asc = !orden.asc;
  aplicarBusquedaOrden();
});

$("#exportar").click(() => {
  let csv = "ID,Nombre,Descripción,Precio,Cantidad\n";
  productos.forEach(p => {
    csv += `${p.id},"${p.nombre}","${p.descripcion}",${p.precio},${p.cantidad}\n`;
  });
  const blob = new Blob([csv], { type: "text/csv;charset=utf-8;" });
  const link = document.createElement("a");
  link.href = URL.createObjectURL(blob);
  link.download = "productos.csv";
  link.click();
});


$(document).ready(cargarProductos);