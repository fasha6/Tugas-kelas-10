<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Penjumlahan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .calculator {
            background: #f4f4f4;
            color: #333;
            padding: 20px 30px;
            border-radius: 10px;
            width: 300px;
            text-align: center;
        }
        .calculator h2 {
            margin-bottom: 20px;
            color: black;
        }
        input[type="number"], input[type="submit"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 20px;
        }
        input[type="submit"] {
            background: #ffffff;
            color: black;
            border: none;
            cursor: pointer;
        }
        .result {
            margin-top: 20px;
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="calculator">
        <h2>Kalkulator Perkalian</h2>
        <form method="POST">
            <input type="number" name="number1" placeholder="  Masukkan angka pertama" required>
            <input type="number" name="number2" placeholder="  Masukkan angka kedua" required>
            <input type="submit" value="Hitung">
        </form>
        <div class="result">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $angka1 = $_POST['number1'];
                $angka2 = $_POST['number2'];
                $hasil = $angka1 * $angka2;
                echo "Hasil penjumlahan: $angka1 * $angka2 = $hasil";
            }
            ?>
        </div>
    </div>
</body>
</html>
