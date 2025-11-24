<?php
session_start();
require_once 'db.php';
if (!isset($_SESSION['user'])) { header('Location: index.php'); exit; }

if (!isset($_GET['id'])) { header('Location: clientes.php'); exit; }
$id = (int)$_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $correo = mysqli_real_escape_string($conn, $_POST['correo']);
    $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
    $direccion = mysqli_real_escape_string($conn, $_POST['direccion']);
    mysqli_query($conn, "UPDATE clientes SET nombre='$nombre', correo='$correo', telefono='$telefono', direccion='$direccion' WHERE id=$id");
    header('Location: clientes.php');
    exit;
}

$res = mysqli_query($conn, "SELECT * FROM clientes WHERE id = $id LIMIT 1");
if (!$res || mysqli_num_rows($res) == 0) { header('Location: clientes.php'); exit; }
$c = mysqli_fetch_assoc($res);
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Editar Cliente</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
  <a href="clientes.php" class="btn btn-secondary mb-3">&larr; Volver</a>
  <h3>Editar cliente #<?php echo $c['id']; ?></h3>
  <form method="post" class="w-50">
    <div class="mb-2"><input name="nombre" class="form-control" value="<?php echo htmlspecialchars($c['nombre']); ?>" required></div>
    <div class="mb-2"><input name="correo" type="email" class="form-control" value="<?php echo htmlspecialchars($c['correo']); ?>" required></div>
    <div class="mb-2"><input name="telefono" class="form-control" value="<?php echo htmlspecialchars($c['telefono']); ?>" required></div>
    <div class="mb-2"><input name="direccion" class="form-control" value="<?php echo htmlspecialchars($c['direccion']); ?>" required></div>
    <button class="btn btn-primary">Guardar</button>
  </form>
</body>
</html>
