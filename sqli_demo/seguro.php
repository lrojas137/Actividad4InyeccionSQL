<?php
require_once "db.php";

$resultado = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $usuario = $_POST["usuario"] ?? "";

  // ✅ SEGURO: consulta preparada (evita SQL injection)
  $stmt = $conn->prepare("SELECT id, usuario, nombre FROM usuarios WHERE usuario = ?");
  $stmt->bind_param("s", $usuario);
  $stmt->execute();
  $resultado = $stmt->get_result();
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Seguro - SQLi Demo</title>
</head>
<body>
  <h2>Formulario SEGURO (Mitigación SQL Injection)</h2>

  <form method="post">
    <label>Usuario:</label>
    <input type="text" name="usuario" required>
    <button type="submit">Buscar</button>
  </form>

  <hr>

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

  <p><a href="vulnerable.php">Volver al formulario vulnerable</a></p>
</body>
</html>