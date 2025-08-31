<?php
session_start();
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking</title>
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background:rgb(216, 238, 221);
            color: #2e7d32;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 400px;
        }

        .form-container h2 {
            margin-bottom: 30px;
            font-size: 2rem;
        }

        .btn {
            display: inline-block;
            background: #2e7d32;
            color: #fff;
            padding: 17px 30px;
            margin: 10px 0;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            transition: background 0.3s, transform 0.3s;
        }

        .btn:hover {
            background: #1b5e20;
            transform: translateY(-3px);
        }

        .logout-btn {
            display: block;
            margin-top: 20px;
            background: #fff;
            color: #2e7d32;
            border: 2px solid #2e7d32;
        }

        .logout-btn:hover {
            background: #2e7d32;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Booking Options</h2>
        <a href="cost_estimator.php" class="btn"><i class="fa-solid fa-calculator"></i> Cost Estimator & Booking</a>
        <a href="book_consultation.php" class="btn"><i class="fa-solid fa-calendar-check"></i> Book Consultation</a>
        <a href="status.php" class="btn logout-btn"><i class="fa-solid fa-list-check"></i> View Booking Status</a>
        <a href="index.php" class="btn logout-btn"><i class="fa-solid fa-arrow-left"></i> Back</a>
        <a href="logout.php" class="btn logout-btn"><i class="fa-solid fa-sign-out-alt"></i> Logout</a>
    </div>
</body>
</html>
