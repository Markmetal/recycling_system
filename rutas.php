<?php
// rutas.php - Página básica para rutas (lista y agregar). Mejore según necesidad.
session_start();
require_once 'db.php';
if (!isset($_SESSION['user'])) { header('Location: index.php'); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $origen = mysqli_real_escape_string($conn, $_POST['origen']);
    $destino = mysqli_real_escape_string($conn, $_POST['destino']);
    $distancia = (int)$_POST['distancia'];
    mysqli_query($conn, "INSERT INTO rutas (origen, destino, distancia) VALUES ('$origen','$destino',$distancia)");
    header('Location: rutas.php');
    exit;
}
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    mysqli_query($conn, "DELETE FROM rutas WHERE id = $id");
    header('Location: rutas.php');
    exit;
}
$res = mysqli_query($conn, "SELECT * FROM rutas ORDER BY id DESC");
?>
<!doctype html>
<html lang="es"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Rutas</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="p-4">
<a href="dashboard.php" class="btn btn-secondary mb-3">&larr; Volver</a>
<h3>Rutas</h3>
<form method="post" class="mb-3 w-50">
  <input type="hidden" name="action" value="add">
  <input name="origen" class="form-control mb-2" placeholder="Origen" required>
  <input name="destino" class="form-control mb-2" placeholder="Destino" required>
  <input name="distancia" type="number" class="form-control mb-2" placeholder="Distancia (km)" required>
  <button class="btn btn-primary">Agregar ruta</button>
</form>
<table class="table table-sm">
  <thead><tr><th>ID</th><th>Origen</th><th>Destino</th><th>Distancia</th><th>Acciones</th></tr></thead>
  <tbody>
  <?php while($r = mysqli_fetch_assoc($res)): ?>
    <tr>
      <td><?php echo $r['id']; ?></td>
      <td><?php echo htmlspecialchars($r['origen']); ?></td>
      <td><?php echo htmlspecialchars($r['destino']); ?></td>
      <td><?php echo htmlspecialchars($r['distancia']); ?></td>
      <td><a class="btn btn-sm btn-danger" href="rutas.php?delete=<?php echo $r['id']; ?>" onclick="return confirm('Eliminar?')">Eliminar</a></td>
    </tr>
  <?php endwhile; ?>
  </tbody>
</table>
</body></html>
