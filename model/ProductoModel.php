<?php
require_once __DIR__ . '/../config/database.php';

class ProductoModel {
    private $conn;

    public function __construct() {
        $this->conn = conectarBD();
    }

    public function obtenerProductos() {
        $stmt = $this->conn->prepare("SELECT * FROM productos");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function agregarProducto($nombre, $descripcion, $precio, $cantidad) {
    if ($precio < 0 || $cantidad < 0 || !is_numeric($precio) || !is_numeric($cantidad)) {
        return ["success" => false, "mensaje" => "Precio o cantidad inválidos"];
    }

    if (strlen($nombre) > 100) {
        return ["success" => false, "mensaje" => "Nombre demasiado largo"];
    }

    if (strlen($descripcion) > 255) {
        return ["success" => false, "mensaje" => "Descripción demasiado larga"];
    }

    $stmt = $this->conn->prepare("INSERT INTO productos (nombre, descripcion, precio, cantidad) VALUES (?, ?, ?, ?)");
    $resultado = $stmt->execute([$nombre, $descripcion, $precio, $cantidad]);

    return ["success" => $resultado];
}


    public function actualizarProducto($id, $nombre, $descripcion, $precio, $cantidad) {
    if ($precio < 0 || $cantidad < 0 || !is_numeric($precio) || !is_numeric($cantidad)) {
        return ["success" => false, "mensaje" => "Precio o cantidad inválidos"];
    }

    if (strlen($nombre) > 100) {
        return ["success" => false, "mensaje" => "Nombre demasiado largo"];
    }

    if (strlen($descripcion) > 255) {
        return ["success" => false, "mensaje" => "Descripción demasiado larga"];
    }

    $stmt = $this->conn->prepare("UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, cantidad = ? WHERE id = ?");
    $resultado = $stmt->execute([$nombre, $descripcion, $precio, $cantidad, $id]);

    return ["success" => $resultado];
}


    public function eliminarProducto($id) {
        $stmt = $this->conn->prepare("DELETE FROM productos WHERE id = ?");
        return $stmt->execute([$id]);
    }
}