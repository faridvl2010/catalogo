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
        if ($precio < 0 || $cantidad < 0 || !is_numeric($cantidad)) {
            return false;
        }
        $stmt = $this->conn->prepare("INSERT INTO productos (nombre, descripcion, precio, cantidad) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nombre, $descripcion, $precio, $cantidad]);
    }

    public function actualizarProducto($id, $nombre, $descripcion, $precio, $cantidad) {
        if ($precio < 0 || $cantidad < 0 || !is_numeric($cantidad)) {
            return false;
        }
        $stmt = $this->conn->prepare("UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, cantidad = ? WHERE id = ?");
        return $stmt->execute([$nombre, $descripcion, $precio, $cantidad, $id]);
    }

    public function eliminarProducto($id) {
        $stmt = $this->conn->prepare("DELETE FROM productos WHERE id = ?");
        return $stmt->execute([$id]);
    }
}