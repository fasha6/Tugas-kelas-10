<?php
$servername = "0.0.0.0";
$username = "root";
$password = "root";
$dbname = "user";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Hapus data
if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  $conn->query("DELETE FROM ds WHERE Id = $id");
  header("Location: ".$_SERVER['PHP_SELF']);
  exit();
}

// Ambil data untuk edit
$editMode = false;
$editData = ['Id'=>'','nama'=>'','tipe'=>'','alamat'=>'','telp'=>''];
if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $result = $conn->query("SELECT * FROM ds WHERE Id = $id");
  if ($result->num_rows > 0) {
    $editData = $result->fetch_assoc();
    $editMode = true;
  }
}

// Simpan (insert/update)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama = $_POST['nama'];
  $tipe = $_POST['tipe'];
  $alamat = $_POST['alamat'];
  $telp = $_POST['telp'];

  if (!empty($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "UPDATE ds SET nama='$nama', tipe='$tipe', alamat='$alamat', telp='$telp' WHERE Id=$id";
  } else {
    $sql = "INSERT INTO ds (nama, tipe, alamat, telp) VALUES ('$nama', '$tipe', '$alamat', '$telp')";
  }

  if ($conn->query($sql) === TRUE) {
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$sql = "SELECT * FROM ds";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kelola User</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f1f1f1;
      padding: 20px;
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    form {
      background-color: #ffffff;
      padding: 20px;
      border-radius: 8px;
      max-width: 600px;
      margin: 0 auto 30px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    form label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    form input, form select {
      width: 100%;
      padding: 8px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    form button {
      padding: 10px 20px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin-right: 10px;
    }

    form button:hover {
      background-color: #45a049;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: #fff;
      box-shadow: 0 0 5px rgba(0,0,0,0.1);
    }

    table th, table td {
      padding: 12px;
      border: 1px solid #ddd;
      text-align: left;
    }

    table th {
      background-color: #f2f2f2;
    }

    a {
      color: #007BFF;
      text-decoration: none;
      margin-right: 10px;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <h1>Kelola User</h1>

  <form method="POST">
    <?php if ($editMode): ?>
      <input type="hidden" name="id" value="<?= $editData['Id'] ?>">
    <?php endif; ?>

    <label for="tipe">Tipe User</label>
    <select name="tipe" id="tipe" required>
      <option value="">Pilih Tipe User</option>
      <option value="Toko" <?= $editData['tipe'] == 'Toko' ? 'selected' : '' ?>>Toko</option>
      <option value="Gedung" <?= $editData['tipe'] == 'Gedung' ? 'selected' : '' ?>>Gedung</option>
      <option value="Gudang" <?= $editData['tipe'] == 'Gudang' ? 'selected' : '' ?>>Gudang</option>
    </select>

    <label for="nama">Nama</label>
    <input type="text" name="nama" id="nama" value="<?= $editData['nama'] ?>" required>

    <label for="telp">Telepon</label>
    <input type="text" name="telp" id="telp" value="<?= $editData['telp'] ?>" required>

    <label for="alamat">Alamat</label>
    <input type="text" name="alamat" id="alamat" value="<?= $editData['alamat'] ?>" required>

    <button type="submit"><?= $editMode ? 'Simpan Perubahan' : 'Tambah' ?></button>
    <?php if ($editMode): ?>
      <a href="<?= $_SERVER['PHP_SELF'] ?>"><button type="button">Batal</button></a>
    <?php endif; ?>
  </form>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Tipe</th>
        <th>Alamat</th>
        <th>Telepon</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $row['Id'] ?></td>
          <td><?= $row['nama'] ?></td>
          <td><?= $row['tipe'] ?></td>
          <td><?= $row['alamat'] ?></td>
          <td><?= $row['telp'] ?></td>
          <td>
            <a href="?edit=<?= $row['Id'] ?>">Edit</a>
            <a href="?hapus=<?= $row['Id'] ?>" onclick="return confirm('hapus data ini?')">Hapus</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

</body>
</html>