─────────────────────────────────────────────
Catálogo de Productos – Prueba Técnica
─────────────────────────────────────────────

Aplicación web básica para gestionar un catálogo de productos.
Tecnologías utilizadas: PHP, MySQL, HTML, jQuery.
Arquitectura basada en el patrón MVC (Modelo - Vista - Controlador).

─────────────────────────────────────────────
REQUISITOS
─────────────────────────────────────────────

Tener instalado XAMPP (Apache + PHP + MySQL)

Navegador moderno (Chrome, Firefox, etc.)

Editor de texto o IDE (Visual Studio Code recomendado)

─────────────────────────────────────────────
INSTALACIÓN
─────────────────────────────────────────────

Instala XAMPP 

Inicia los servicios Apache y MySQL desde el panel de XAMPP.

Copia la carpeta del proyecto en:

C:\xampp\htdocs\catalogo

Crea una base de datos llamada:

catalogo

Importa el archivo SQL de la base de datos:

/catalogo/db/catalogo.sql

Puedes hacerlo desde phpMyAdmin:
http://localhost/phpmyadmin

Configura los datos de conexión a la base de datos en el archivo:

/catalogo/config/database.php

Asegúrate de editar estos valores según tu entorno:

host: 127.0.0.1
puerto: 3307 En mi caso
usuario: root
contraseña: (colócala si tienes una)
nombreBD: catalogo

─────────────────────────────────────────────
USO
─────────────────────────────────────────────

Abre tu navegador y visita:

http://localhost/catalogo/

Desde la aplicación podrás:

Añadir productos (nombre, descripción, precio, cantidad)

Ver la lista de productos

Actualizar y eliminar registros

Buscar productos por nombre

Ordenar por precio o cantidad

Exportar el listado a archivo CSV
