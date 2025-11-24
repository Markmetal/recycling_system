<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}
$user = $_SESSION['user'];
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard - Reciclaje</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Reciclaje</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="clientes.php">Clientes</a></li>
        <li class="nav-item"><a class="nav-link" href="materiales.php">Materiales</a></li>
        <li class="nav-item"><a class="nav-link" href="rutas.php">Rutas</a></li>
        <li class="nav-item"><a class="nav-link" href="residuos.php">Residuos</a></li>
      </ul>
      <span class="navbar-text text-white me-3">Usuario: <?php echo htmlspecialchars($user['nombre']); ?> (<?php echo htmlspecialchars($user['role']); ?>)</span>
      <a class="btn btn-outline-light" href="logout.php">Cerrar sesión</a>
    </div>
  </div>
</nav>
<div class="container py-4">
  <div class="text-center mt-5">
  <h1>Bienvenido, <?php echo htmlspecialchars($user['nombre']); ?></h1>
  <p class="lead"><h2> Un mundo sin basura en un mundo Sano.</h2></p>
<div class="text-center mt-5">
    <img src="resiclaje.png" class="img-fluid rounded-4 shadow-lg" style="max-width: 600px;" alt="Imagen de acceso">
</div>


  <p  > <h5>El sistema de reciclaje de la UBE está diseñado para gestionar eficientemente la recolección, clasificación y procesamiento de materiales reciclables. Nuestro objetivo es minimizar el impacto ambiental y promover prácticas sostenibles dentro de la comunidad universitaria. A través de este sistema, facilitamos la participación activa de estudiantes, profesores y personal administrativo en iniciativas ecológicas, fomentando una cultura de responsabilidad ambiental y conciencia ecológica. Juntos, podemos contribuir a un futuro más verde y saludable para todos.</h5></p>
</div>
</body>
</html>
