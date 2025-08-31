<?php
session_start();
require_once "config.php";
$conn = Config::getConnection();

$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM customers WHERE email=?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['customer_id'] = $user['id'];
        header("Location: booking.php");
        exit;
    } else {
        $message = "Invalid login details!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #f0fdf4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #1b5e20;
        }

        .form-container {
            background: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            width: 350px;
            text-align: center;
        }

        h2 {
            margin-bottom: 25px;
            color: #1b5e20;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            margin: 10px 0;
            border: 1px solid #1b5e20;
            border-radius: 6px;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #1b5e20;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #2e7d32;
        }

        p {
            margin-top: 15px;
            color: #d32f2f;
            font-weight: bold;
        }

        .back-btn {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background: #1b5e20;
            color:rgb(226, 243, 228);
            border: 2px solid #1b5e20;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s, color 0.3s;
        }

        .back-btn:hover {
            background: #1b5e20;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Customer Login</h2>
        <form method="post">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p><?= $message ?></p>
        <a href="index.php" class="back-btn">⬅ Back</a>
    </div>
</body>
</html>
