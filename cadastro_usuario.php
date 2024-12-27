<?php
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
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

  $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";

  if ($conn->query($sql) === TRUE) {
    echo "Usuário cadastrado com sucesso!";
  } else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Usuário</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <h1>Cadastro de Usuário</h1>
  <form method="post" action="cadastro_usuario.php">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" required>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <label for="senha">Senha:</label>
    <input type="password" id="senha" name="senha" required>
    <input type="submit" value="Cadastrar">
  </form>
</body>
</html>
