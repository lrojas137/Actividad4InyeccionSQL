<?php
require_once "db.php";

$resultado = null;
$error = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $usuario = $_POST["usuario"] ?? "";

  // ❌ VULNERABLE: concatenación directa (permite SQL injection)
  $sql = "SELECT id, usuario, nombre FROM usuarios WHERE usuario = '$usuario'";

  $resultado = $conn->query($sql);
  if (!$resultado) {
    $error = $conn->error;
  }
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Vulnerable - SQLi Demo</title>
</head>
<body>
  <h2>Formulario VULNERABLE (SQL Injection)</h2>

  <form method="post">
    <label>Usuario:</label>
    <input type="text" name="usuario" required>
    <button type="submit">Buscar</button>
  </form>

  <hr>

  <?php if ($error): ?>
    <p style="color:red;"><b>Error SQL:</b> <?= htmlspecialchars($error) ?></p>
  <?php endif; ?>

  <?php if ($resultado && $resultado->num_rows > 0): ?>
    <h3>Resultados</h3>
    <ul>
      <?php while ($row = $resultado->fetch_assoc()): ?>
        <li>ID: <?= htmlspecialchars($row["id"]) ?> |
            Usuario: <?= htmlspecialchars($row["usuario"]) ?> |
            Nombre: <?= htmlspecialchars($row["nombre"]) ?></li>
      <?php endwhile; ?>
    </ul>
  <?php elseif ($resultado): ?>
    <p>No se encontraron registros.</p>
  <?php endif; ?>

  <p><a href="seguro.php">Ir al formulario seguro</a></p>
</body>
</html>