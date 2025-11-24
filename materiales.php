<?php
// materiales.php - CRUD materiales
session_start();
require_once 'db.php';
if (!isset($_SESSION['user'])) { header('Location: index.php'); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
    mysqli_query($conn, "INSERT INTO materiales (nombre, descripcion) VALUES ('$nombre','$descripcion')");
    header('Location: materiales.php');
    exit;
}

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    mysqli_query($conn, "DELETE FROM materiales WHERE id = $id");
    header('Location: materiales.php');
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM materiales ORDER BY id DESC");
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Materiales</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
  <a href="dashboard.php" class="btn btn-secondary mb-3">&larr; Volver</a>
  <div class="row">
    <div class="col-md-5">
      <h3>Agregar material</h3>
      <form method="post">
        <input type="hidden" name="action" value="add">
        <div class="mb-2"><input name="nombre" class="form-control" placeholder="Nombre" required></div>
        <div class="mb-2"><input name="descripcion" class="form-control" placeholder="Descripción" required></div>
        <button class="btn btn-primary">Agregar</button>
      </form>
    </div>
    <div class="col-md-7">
      <h3>Lista de materiales</h3>
      <table class="table table-sm">
        <thead><tr><th>ID</th><th>Nombre</th><th>Descripción</th><th>Acciones</th></tr></thead>
        <tbody>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['nombre']); ?></td>
            <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
            <td>
              <a class="btn btn-sm btn-warning" href="edit_material.php?id=<?php echo $row['id']; ?>">Editar</a>
              <a class="btn btn-sm btn-danger" href="materiales.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Eliminar?')">Eliminar</a>
            </td>
          </tr>
        <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>
