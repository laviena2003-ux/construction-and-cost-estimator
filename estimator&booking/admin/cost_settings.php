<?php
session_start();
require_once "../config.php";
$conn = Config::getConnection();

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cost_per_sqm = $_POST['cost_per_sqm'];
    $stmt = $conn->prepare("INSERT INTO cost_settings (cost_per_sqm) VALUES (?)");
    $stmt->execute([$cost_per_sqm]);
    $message = "✅ Cost updated successfully!";
}

$latest = $conn->query("SELECT cost_per_sqm FROM cost_settings ORDER BY id DESC LIMIT 1")->fetch();
$current_cost = $latest ? $latest['cost_per_sqm'] : "Not set";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cost Settings - Construction & Estimation</title>
<style>
* { margin:0; padding:0; box-sizing:border-box; }

/* Body */
body {
    font-family: Arial, sans-serif;
    background: #f4f4f4;
    padding-top: 70px;
}

/* Navbar */
.navbar {
    position: fixed;
    top: 0;
    width: 100%;
    background: rgba(172, 150, 103, 0.5);
    backdrop-filter: blur(6px);
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 20px;
    z-index: 1000;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

.navbar .title {
    font-weight: bold;
    font-size: 1.3rem;
    color: #fff;
}

.navbar .nav-links a {
    color: #fff;
    text-decoration: none;
    margin-left: 10px;
    padding: 6px 14px;
    border-radius: 50px;
    background: rgba(238, 220, 220, 0.2);
    transition: 0.3s ease;
    font-weight: bold;
    font-size: 0.9rem;
}

.navbar .nav-links a:hover {
    background: #fff;
    color: #b27c00;
    transform: translateY(-2px);
}

/* Form Container */
.form-container {
    background: #fff;
    padding: 40px 30px;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    text-align: center;
    width: 400px;
    margin: 40px auto;
}

h2 {
    color: #b27c00;
    margin-bottom: 25px;
}

p {
    font-size: 1rem;
    margin-bottom: 20px;
}

input[type="number"] {
    width: 80%;
    padding: 12px;
    margin-bottom: 20px;
    border: 2px solid #b27c00;
    border-radius: 8px;
    font-size: 1rem;
}

button {
    background: #b27c00;
    color: white;
    padding: 12px 30px;
    font-size: 1rem;
    font-weight: bold;
    border: none;
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.3s ease;
}

button:hover {
    background: #996900;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}

.back-btn {
    display: inline-block;
    margin-top: 20px;
    color: #b27c00;
    text-decoration: none;
    font-weight: bold;
    border: 2px solid #b27c00;
    padding: 10px 20px;
    border-radius: 50px;
    transition: all 0.3s ease;
}

.back-btn:hover {
    background: #b27c00;
    color: white;
}

.message {
    font-size: 0.95rem;
    margin-top: 15px;
    color: green;
}

/* Footer */
footer {
    text-align: center;
    padding: 15px;
    margin-top: 20px;
    color: #fff;
    background: rgba(172,150,103,0.7);
    border-radius: 6px;
}
</style>
</head>
<body>

<div class="navbar">
    <div class="title">Cost Settings - Construction & Estimation</div>
    <div class="nav-links">
        <a href="dashboard.php">⬅ Dashboard</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="form-container">
    <h2>Cost Per Sq.m Setting</h2>
    <p>Current Cost: <b><?= htmlspecialchars($current_cost) ?> LKR / sqm</b></p>
    <form method="post">
        <input type="number" step="0.01" name="cost_per_sqm" placeholder="Enter new cost per sqm" required>
        <br>
        <button type="submit">Update</button>
    </form>
    <?php if($message): ?>
        <p class="message"><?= $message ?></p>
    <?php endif; ?>
    <a href="dashboard.php" class="back-btn">⬅ Back to Dashboard</a>
</div>

<footer>
   
</footer>

</body>
</html>
