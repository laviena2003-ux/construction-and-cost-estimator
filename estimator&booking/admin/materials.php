<?php
session_start();
require_once "../config.php";
$conn = Config::getConnection();

// Handle update
$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST['percentage'] as $id => $percentage) {
        $stmt = $conn->prepare("UPDATE material_percentages SET percentage = ? WHERE id = ?");
        $stmt->execute([$percentage, $id]);
    }
    $message = "✅ Percentages updated successfully!";
}

// Fetch materials
$materials = $conn->query("SELECT * FROM material_percentages")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Material Percentages - Construction & Estimation</title>
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
    background: rgba(172, 150, 103, 0.5); /* transparent mustard */
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
    width: 450px;
    margin: 40px auto;
}

h2 {
    color: #b27c00;
    margin-bottom: 25px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

th, td {
    padding: 12px;
    border: 1px solid #b27c00;
    text-align: center;
}

th {
    background: #b27c00;
    color: #fff;
}

input[type="number"] {
    width: 80px;
    padding: 8px;
    border: 2px solid #b27c00;
    border-radius: 6px;
    text-align: center;
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

/* Responsive */
@media (max-width: 768px) {
    .form-container { width: 90%; padding: 30px 20px; }
    .navbar { flex-direction: column; align-items: flex-start; }
    .navbar .nav-links { margin-top: 8px; }
}
</style>
</head>
<body>

<div class="navbar">
    <div class="title">Material Percentages - Construction & Estimation</div>
    <div class="nav-links">
        <a href="dashboard.php">⬅ Dashboard</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="form-container">
    <h2>Material Percentages</h2>
    <form method="post">
        <table>
            <tr><th>Material</th><th>Percentage (%)</th></tr>
            <?php foreach ($materials as $m): ?>
            <tr>
                <td><?= htmlspecialchars($m['material_name']) ?></td>
                <td>
                    <input type="number" step="0.1" name="percentage[<?= $m['id'] ?>]" value="<?= htmlspecialchars($m['percentage']) ?>" required>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <button type="submit">Update Percentages</button>
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
