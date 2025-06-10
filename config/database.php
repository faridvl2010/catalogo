<?php
function conectarBD() {
    try {
        return new PDO("mysql:host=localhost;dbname=catalogo", "root", "admin123", [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
}