<?php
require_once "config.php";
$conn = Config::getConnection();

$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO customers (name,email,password) VALUES (?,?,?)");
    try {
        $stmt->execute([$name, $email, $password]);
        $message = "✅ Registration successful! <a href='login.php'>Login here</a>";
    } catch (PDOException $e) {
        $message = "❌ Error: Email already exists!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <style>
    * { margin:0; padding:0; box-sizing:border-box; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    body {
        background:#f0fdf4;
        display:flex;
        justify-content:center;
        align-items:center;
        height:100vh;
        color:#1b5e20;
    }
    .form-container {
        background:#fff;
        padding:40px;
        border-radius:15px;
        box-shadow:0 10px 25px rgba(0,0,0,0.1);
        width:360px;
        text-align:center;
    }
    h2 { margin-bottom:25px; color:#2e7d32; font-size:1.8rem; }
    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width:100%;
        padding:12px 15px;
        margin:10px 0;
        border:1px solid #c8e6c9;
        border-radius:50px;
        outline:none;
        font-size:1rem;
        transition:0.3s;
    }
    input:focus {
        border-color:#2e7d32;
        box-shadow:0 0 5px rgba(46,125,50,0.4);
    }
    button {
        width:100%;
        padding:12px 0;
        margin-top:15px;
        border:none;
        border-radius:50px;
        background:#2e7d32;
        color:#fff;
        font-size:1rem;
        font-weight:600;
        cursor:pointer;
        transition:0.3s;
    }
    button:hover { background:#145a32; }
    .btn-back {
        display:inline-block;
        margin-top:20px;
        padding:10px 25px;
        background:#2e7d32;
        color:#fff;
        text-decoration:none;
        border-radius:50px;
        font-weight:600;
        transition:0.3s;
    }
    .btn-back:hover { background:#145a32; }
    p { margin-top:20px; font-weight:600; }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Customer Registration</h2>
    <form method="post">
      <input type="text" name="name" placeholder="Full Name" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Register</button>
    </form>
    <a href="index.php" class="btn-back">⬅ Back</a>
    <p><?= $message ?></p>
  </div>
</body>
</html>
