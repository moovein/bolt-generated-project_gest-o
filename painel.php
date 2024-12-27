<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
  header("Location: login.php");
  exit();
}

// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestao_orcamento";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Conexão falhou: " . $conn->connect_error);
}

// Consultas para obter dados
$sqlUsuarios = "SELECT COUNT(*) as total FROM usuarios";
$resultUsuarios = $conn->query($sqlUsuarios);
$totalUsuarios = $resultUsuarios->fetch_assoc()['total'];

$sqlOrcamentos = "SELECT COUNT(*) as total FROM orcamentos";
$resultOrcamentos = $conn->query($sqlOrcamentos);
$totalOrcamentos = $resultOrcamentos->fetch_assoc()['total'];

$sqlClientes = "SELECT COUNT(*) as total FROM clientes";
$resultClientes = $conn->query($sqlClientes);
$totalClientes = $resultClientes->fetch_assoc()['total'];

$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <h1>Bem-vindo, <?php echo $_SESSION['usuario_nome']; ?>!</h1>
    <h2>Dashboard</h2>
    <div class="dashboard">
      <div class="card">
        <h3>Usuários</h3>
        <p>Total: <?php echo $totalUsuarios; ?></p>
      </div>
      <div class="card">
        <h3>Orçamentos</h3>
        <p>Total: <?php echo $totalOrcamentos; ?></p>
      </div>
      <div class="card">
        <h3>Clientes</h3>
        <p>Total: <?php echo $totalClientes; ?></p>
      </div>
    </div>
    <a href="logout.php" class="logout">Sair</a>
  </div>
</body>
</html>
