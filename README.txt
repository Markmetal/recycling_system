Sistema de gestión - Empresa de reciclaje
---------------------------------------
Instrucciones rápidas (XAMPP + VSCode):
1. Copie la carpeta 'recycling_system' dentro de htdocs (por ejemplo C:\xampp\htdocs\recycling_system)
2. Inicie Apache y MySQL desde XAMPP Control Panel.
3. Abra phpMyAdmin (http://localhost/phpmyadmin) y cree una base de datos llamada 'reciclaje_db'
4. Importe el archivo database.sql (ubicado en la raíz del proyecto) para crear tablas y datos iniciales.
5. Abra en el navegador: http://localhost/recycling_system/index.php
Usuarios de ejemplo:
 - admin@example.com  / admin123   (Administrador)
 - operador@example.com / oper123 (Operador)
Nota: Este proyecto es un modelo didáctico. En producción, mejore la seguridad:
 - use password_hash() / password_verify()
 - prepared statements (mysqli prepared) — en este proyecto se usan consultas simples con escaping mínimo.
 - validación y sanitización adicional.
