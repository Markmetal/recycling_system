<?php
session_start();
require_once 'db.php';
if (!isset($_SESSION['user'])) { header('Location: index.php'); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $correo = mysqli_real_escape_string($conn, $_POST['correo']);
    $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
    $direccion = mysqli_real_escape_string($conn, $_POST['direccion']);
    $sql = "INSERT INTO clientes (nombre, correo, telefono, direccion) VALUES ('$nombre','$correo','$telefono','$direccion')";
    mysqli_query($conn, $sql);
    header('Location: clientes.php');
    exit;
}

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    mysqli_query($conn, "DELETE FROM clientes WHERE id = $id");
    header('Location: clientes.php');
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM clientes ORDER BY id DESC");
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Clientes - Reciclaje</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
  <a href="dashboard.php" class="btn btn-secondary mb-3">&larr; Volver</a>
  <div class="row">
    <div class="col-md-6">
      <h3>Agregar cliente</h3>
      <form method="post">
        <input type="hidden" name="action" value="add">
        <div class="mb-2"><input name="nombre" class="form-control" placeholder="Nombre" required></div>
        <div class="mb-2"><input name="correo" type="email" class="form-control" placeholder="Correo" required></div>
        <div class="mb-2"><input name="telefono" class="form-control" placeholder="Teléfono" required></div>
        <div class="mb-2"><input name="direccion" class="form-control" placeholder="Dirección" required></div>
        <button class="btn btn-primary">Agregar</button>
      </form>
    </div>
    <div class="col-md-6">
      <h3>Lista de clientes</h3>
      <table class="table table-sm">
        <thead><tr><th>ID</th><th>Nombre</th><th>Correo</th><th>Teléfono</th><th>Dirección</th><th>Acciones</th></tr></thead>
        <tbody>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['nombre']); ?></td>
            <td><?php echo htmlspecialchars($row['correo']); ?></td>
            <td><?php echo htmlspecialchars($row['telefono']); ?></td>
            <td><?php echo htmlspecialchars($row['direccion']); ?></td>
            <td>
              <a class="btn btn-sm btn-warning" href="edit_cliente.php?id=<?php echo $row['id']; ?>">Editar</a>
              <a class="btn btn-sm btn-danger" href="clientes.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Eliminar este cliente?')">Eliminar</a>
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
