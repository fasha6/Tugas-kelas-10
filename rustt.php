<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Text Transformer</title>
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
        input[type="text"], input[type="submit"], select {
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
        <h2>Text Transformer</h2>
        <form method="POST">
            <input type="text" name="n1" placeholder="Masukkan text" required>
            <select name="operation">
                <option value="1">UPPERCASE</option>
                <option value="2">lowercase</option>
                <option value="3">String Length</option>
            </select>
            <input type="submit" value="Submit">
        </form>
        <div class="result">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $text = $_POST['n1'];
                $operation = $_POST['operation'];
                
                if ($operation == "1") {
                    echo strtoupper($text);
                } elseif ($operation == "2") {
                    echo strtolower($text);
                } elseif ($operation == "3") {
                    echo strlen($text);
                }
            }
            ?>
        </div>
    </div>
</body>
</html>