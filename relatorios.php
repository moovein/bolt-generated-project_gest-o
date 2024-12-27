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

// Consulta para obter dados dos orçamentos
$sql = "SELECT status, COUNT(*) as total FROM orcamentos GROUP BY status";
$result = $conn->query($sql);

$statusData = [];
$statusLabels = [];

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $statusLabels[] = $row["status"];
    $statusData[] = $row["total"];
  }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Relatórios de Orçamentos</title>
  <link rel="stylesheet" href="styles.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <h1>Relatórios de Orçamentos</h1>
  <div class="chart-container">
    <canvas id="statusChart" width="400" height="200"></canvas>
  </div>
  <script>
    const ctx = document.getElementById('statusChart').getContext('2d');
    const statusChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: <?php echo json_encode($statusLabels); ?>,
        datasets: [{
          label: 'Quantidade de Orçamentos por Status',
          data: <?php echo json_encode($statusData); ?>,
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
</body>
</html>
