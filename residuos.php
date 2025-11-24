<?php
// residuos.php - Registro de residuos: selección de cliente y material
session_start();
require_once 'db.php';
if (!isset($_SESSION['user'])) { header('Location: index.php'); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $cliente_id = (int)$_POST['cliente_id'];
    $material_id = (int)$_POST['material_id'];
    $cantidad = (int)$_POST['cantidad'];
    $fecha = mysqli_real_escape_string($conn, $_POST['fecha']);
    mysqli_query($conn, "INSERT INTO residuos (cliente_id, material_id, cantidad, fecha) VALUES ($cliente_id,$material_id,$cantidad,'$fecha')");
    header('Location: residuos.php');
    exit;
}

$list = mysqli_query($conn, "SELECT r.id, c.nombre as cliente, m.nombre as material, r.cantidad, r.fecha FROM residuos r JOIN clientes c ON r.cliente_id=c.id JOIN materiales m ON r.material_id=m.id ORDER BY r.id DESC");
$clientes = mysqli_query($conn, "SELECT id, nombre FROM clientes ORDER BY nombre");
$materiales = mysqli_query($conn, "SELECT id, nombre FROM materiales ORDER BY nombre");
?>
<!doctype html>
<html lang="es"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Residuos</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="p-4">
<a href="dashboard.php" class="btn btn-secondary mb-3">&larr; Volver</a>
<h3>Registrar residuo</h3>
<form method="post" class="mb-3 w-50">
  <input type="hidden" name="action" value="add">
  <select name="cliente_id" class="form-select mb-2" required>
    <option value="">Seleccione cliente</option>
    <?php while($c = mysqli_fetch_assoc($clientes)): ?>
      <option value="<?php echo $c['id']; ?>"><?php echo htmlspecialchars($c['nombre']); ?></option>
    <?php endwhile; ?>
  </select>
  <select name="material_id" class="form-select mb-2" required>
    <option value="">Seleccione material</option>
    <?php while($m = mysqli_fetch_assoc($materiales)): ?>
      <option value="<?php echo $m['id']; ?>"><?php echo htmlspecialchars($m['nombre']); ?></option>
    <?php endwhile; ?>
  </select>
  <input name="cantidad" type="number" class="form-control mb-2" placeholder="Cantidad (kg)" required>
  <input name="fecha" type="date" class="form-control mb-2" required>
  <button class="btn btn-primary">Registrar</button>
</form>
<h4>Listado de residuos</h4>
<table class="table table-sm">
  <thead><tr><th>ID</th><th>Cliente</th><th>Material</th><th>Cantidad</th><th>Fecha</th></tr></thead>
  <tbody>
    <?php while($row = mysqli_fetch_assoc($list)): ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo htmlspecialchars($row['cliente']); ?></td>
        <td><?php echo htmlspecialchars($row['material']); ?></td>
        <td><?php echo htmlspecialchars($row['cantidad']); ?></td>
        <td><?php echo htmlspecialchars($row['fecha']); ?></td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>
</body></html>
