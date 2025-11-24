<?php
session_start();
require_once 'db.php';

if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = mysqli_real_escape_string($conn, $_POST['correo']);
    $password = $_POST['password'];

    $sql = "SELECT u.id, u.nombre, u.correo, u.password, r.nombre as role_name FROM usuarios u JOIN roles r ON u.role_id = r.id WHERE u.correo = '$correo' LIMIT 1";
    $res = mysqli_query($conn, $sql);
    if ($res && mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);

        if ($password === $row['password']) {
            $_SESSION['user'] = [
                'id' => $row['id'],
                'nombre' => $row['nombre'],
                'correo' => $row['correo'],
                'role' => $row['role_name']
            ];
            header('Location: dashboard.php');
            exit;
        } else {
            $error = 'Credenciales incorrectas.';
        }
    } else {
        $error = 'Usuario no encontrado.';
    }
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Reciclaje</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow">
        <div class="card-body">
          <h3 class="card-title mb-4">Sistema Reciclaje de la UBE</h3>
          <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
          <?php endif; ?>
          <form method="post">
            <div class="mb-3">
              <label class="form-label">Correo</label>
              <input name="correo" type="email" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Contraseña</label>
              <input name="password" type="password" class="form-control" required>
            </div>
            <button class="btn btn-primary">Entrar</button>
          </form>
          <hr>
          <p class="small text-muted">marco@ube.com / admin1234 | marco@gmail.com / oper1234</p>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
