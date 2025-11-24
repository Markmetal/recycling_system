<?php
session_start();
require_once 'db.php';
if (!isset($_SESSION['user'])) { header('Location: index.php'); exit; }

if (!isset($_GET['id'])) { header('Location: materiales.php'); exit; }
$id = (int)$_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
    mysqli_query($conn, "UPDATE materiales SET nombre='$nombre', descripcion='$descripcion' WHERE id=$id");
    header('Location: materiales.php');
    exit;
}

$res = mysqli_query($conn, "SELECT * FROM materiales WHERE id = $id LIMIT 1");
if (!$res || mysqli_num_rows($res) == 0) { header('Location: materiales.php'); exit; }
$m = mysqli_fetch_assoc($res);
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Editar Material</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
  <a href="materiales.php" class="btn btn-secondary mb-3">&larr; Volver</a>
  <h3>Editar material #<?php echo $m['id']; ?></h3>
  <form method="post" class="w-50">
    <div class="mb-2"><input name="nombre" class="form-control" value="<?php echo htmlspecialchars($m['nombre']); ?>" required></div>
    <div class="mb-2"><input name="descripcion" class="form-control" value="<?php echo htmlspecialchars($m['descripcion']); ?>" required></div>
    <button class="btn btn-primary">Guardar</button>
  </form>
</body>
</html>
