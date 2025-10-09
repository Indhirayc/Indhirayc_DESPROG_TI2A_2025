<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Array 2</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #e6f0ff; /* biru muda */
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 100vh;
      margin: 0;
      padding: 40px;
    }
    h2 {
      color: #004080; /* biru tua */
      margin-bottom: 20px;
      text-align: center;
    }
    table {
      border-collapse: collapse;
      width: 60%;
      max-width: 600px;
      background-color: #ffffff;
      box-shadow: 0 4px 8px rgba(0, 0, 50, 0.2);
      border-radius: 8px;
      overflow: hidden;
    }
    th, td {
      padding: 12px 15px;
      border-bottom: 1px solid #cce0ff;
      border-right: 1px solid #cce0ff; /* garis pembatas tengah */
      text-align: left; 
    }
    th:last-child, td:last-child {
      border-right: none; /* hilangkan garis di kolom terakhir */
    }
    th {
      background-color: #0066cc; /* biru utama */
      color: white;
      text-align: center; /* header tengah */
    }
    tr:hover {
      background-color: #f0f8ff; /* biru muda buat hover */
    }
    tr:last-child td {
      border-bottom: none;
    }
  </style>
</head>
<body>
  <h2>Data Dosen</h2>
  <?php
    $Dosen = [
      'Nama' => 'Elok Nur Hamdana',
      'Domisili' => 'Malang',
      'Jenis Kelamin' => 'Perempuan'
    ];

    echo "<table>";
    echo "<tr><th>Biodata</th><th>Informasi</th></tr>";
    foreach ($Dosen as $key => $value) {
      echo "<tr><td>$key</td><td>$value</td></tr>";
    }
    echo "</table>";
  ?>
</body>
</html>
