<?php
session_start();

// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestao_orcamento";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $senha = $_POST['senha'];

  $sql = "SELECT * FROM usuarios WHERE email='$email'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($senha, $row['senha'])) {
      $_SESSION['usuario_id'] = $row['id'];
      $_SESSION['usuario_nome'] = $row['nome'];
      header("Location: painel.php");
    } else {
      echo "Senha incorreta!";
    }
  } else {
    echo "Usuário não encontrado!";
  }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <h1>Login</h1>
  <form method="post" action="login.php">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <label for="senha">Senha:</label>
    <input type="password" id="senha" name="senha" required>
    <input type="submit" value="Entrar">
  </form>
</body>
</html>
