<?php
session_start();
require_once "../config.php";
$conn = Config::getConnection();

// Fetch current cost
$costRow = $conn->query("SELECT cost_per_sqm FROM cost_settings ORDER BY id DESC LIMIT 1")->fetch();
$current_cost = $costRow ? $costRow['cost_per_sqm'] : "Not set";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background:rgb(226, 219, 202);
            padding: 30px;
            text-align: center;
        }

        h1 {
            color: #b27c00; /* mustard color for heading */
            margin-bottom: 20px;
        }

        .info {
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 30px;
            display: inline-block;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .btn {
            display: inline-block;
            padding: 12px 25px;
            margin: 10px;
            background: #b27c00; /* mustard buttons */
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 20px;
            transition: 0.3s;
        }

        .btn:hover {
            background:rgb(211, 199, 174); /* darker mustard on hover */
        }

        /* Floating Logout Button */
        .logout-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #b27c00; /* mustard color */
            color: #fff;
            padding: 12px 20px;
            font-weight: bold;
            border-radius: 50px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .logout-btn:hover {
            background: #996900; /* darker mustard on hover */
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body>
    <h1>Admin Dashboard</h1>
    
    <div class="info">
        <p><b>Current Cost per SqM:</b> <?= htmlspecialchars($current_cost) ?> LKR</p>
    </div>

    <div>
          
        <a href="cost_settings.php" class="btn">Set Cost per SqM</a>
        <a href="materials.php" class="btn">Material Percentages</a>
        <a href="bookings.php" class="btn">Manage contruction Bookings</a>
        <a href="cons_booking.php" class="btn">Manage consultation Bookings</a>
    </div>

    <!-- Floating Logout Button -->
    <a href="logout.php" class="logout-btn">Logout</a>
     
</body>
</html>
