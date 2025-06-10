<?php
require_once '../model/ProductoModel.php';

$model = new ProductoModel();

switch ($_GET['action']) {
    case 'listar':
        echo json_encode($model->obtenerProductos());
        break;

    case 'agregar':
        echo json_encode($model->agregarProducto($_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $_POST['cantidad']));
        break;

    case 'actualizar':
        echo json_encode($model->actualizarProducto($_POST['id'], $_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $_POST['cantidad']));
        break;

    case 'eliminar':
        echo json_encode($model->eliminarProducto($_POST['id']));
        break;
}