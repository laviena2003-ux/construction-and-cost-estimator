<?php
session_start();
require_once "config.php";
$conn = Config::getConnection();

$message = "";
$customer_id = $_SESSION['customer_id'] ?? null;
$consultation_type = $_GET['consultation'] ?? '';

if (!$customer_id) {
    die("❌ User not logged in.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phone = trim($_POST['phone']);
    $nic = trim($_POST['nic']);
    $address = trim($_POST['address']);
    $start_date = $_POST['start_date'];

    if ($consultation_type && $phone && $nic && $address && $start_date) {
        // Insert consultation booking
        $stmt = $conn->prepare("
           INSERT INTO consultation_bookings
           (customer_id, consultation_type, status, phone, nic, address, start_date, created_at) 
           VALUES (?, ?, 'Pending', ?, ?, ?, ?, NOW())
        ");
        $stmt->execute([$customer_id, $consultation_type, $phone, $nic, $address, $start_date]);

        // Get the newly created consultation ID
        $consultation_id = $conn->lastInsertId();

        // Redirect to consultation payment page with consultation_id
        header("Location: consultation_payment.php?consultation_id=$consultation_id");
        exit;
    } else {
        $message = "❌ Please complete all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Book Consultation</title>
<!-- FontAwesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
/* Reset */
* {margin:0; padding:0; box-sizing:border-box; font-family:'Segoe UI', sans-serif;}

/* Body */
body { background:#f4f9f6; padding-top:80px; color:#333; line-height:1.5; }

/* Navbar */
.navbar {
  background: linear-gradient(90deg, #0d3b1f, #2e7d32);
  color:white;
  padding:15px 20px;
  display:flex;
  justify-content:space-between;
  align-items:center;
  position:fixed;
  top:0;
  width:100%;
  z-index:1000;
  box-shadow: 0 3px 8px rgba(0,0,0,0.15);
}
.navbar a {
  color:white;
  text-decoration:none;
  margin-left:12px;
  padding:6px 14px;
  border-radius:50px;
  border:1px solid rgba(255,255,255,0.6);
  font-size:0.95rem;
  transition: all 0.3s ease;
}
.navbar a:hover { background:white; color:#2e7d32; border-color:white; }
.navbar h1 { font-weight:700; font-size:1.3rem; letter-spacing:0.5px; }

/* Form Container */
.form-container {
  background: #fff;
  padding: 40px 35px;
  border-radius: 20px;
  box-shadow: 0 12px 30px rgba(0,0,0,0.1);
  max-width: 480px;
  margin: 60px auto;
  text-align: center;
  transition: transform 0.3s ease;
}
.form-container:hover { transform: translateY(-4px); }
.form-container h2 {
  margin-bottom: 25px;
  color: #2e7d32;
  font-size: 1.6rem;
  font-weight:700;
}

/* Input Group */
.input-group { position: relative; margin: 12px 0; }
.input-group i { position: absolute; top:50%; left:15px; transform:translateY(-50%); color:#2e7d32; font-size:1rem; }
.input-group input {
  width:100%;
  padding:14px 14px 14px 42px;
  border:1px solid #c8e6c9;
  border-radius:50px;
  font-size:1rem;
  outline:none;
  transition:border-color 0.3s ease, box-shadow 0.3s ease;
}
.input-group input:focus {
  border-color:#2e7d32;
  box-shadow:0 0 6px rgba(46,125,50,0.3);
}

/* Button */
button {
  width:100%;
  padding:14px;
  margin-top:18px;
  border:none;
  border-radius:50px;
  background: linear-gradient(90deg,#2e7d32,#43a047);
  color:#fff;
  font-weight:600;
  font-size:1rem;
  cursor:pointer;
  transition: all 0.3s ease;
}
button:hover { background: linear-gradient(90deg,#145a32,#2e7d32); transform: scale(1.02); }

/* Back Button */
.btn-back {
  display:inline-block;
  margin-top:22px;
  padding:10px 25px;
  background:#2e7d32;
  color:#fff;
  text-decoration:none;
  border-radius:50px;
  font-weight:500;
  transition: all 0.3s ease;
}
.btn-back:hover { background:#145a32; transform: scale(1.05); }

/* Message */
p { margin-top:20px; font-weight:600; color:#d32f2f; }

/* Responsive */
@media(max-width:600px){
  .navbar{ flex-direction:column; align-items:flex-start; padding:12px 15px; }
  .navbar div{ margin-top:8px; }
  .form-container{ padding:30px 20px; margin:25px; }
}
@media(max-width:400px){
  .form-container{ padding:20px 15px; margin:15px; }
  input[type="text"], input[type="date"], button{ font-size:0.9rem; padding:12px; }
  .btn-back{ font-size:0.9rem; padding:8px 20px; }
}
</style>
</head>
<body>

<div class="navbar">
  <h1><i class="fa-solid fa-handshake-simple"></i> Book Consultation</h1>
  <div>
    <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
    <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
  </div>
</div>

<div class="form-container">
<h2><i class="fa-solid fa-calendar-plus"></i> Book: <?= htmlspecialchars($consultation_type) ?></h2>
<form method="post">
  <div class="input-group">
    <i class="fa-solid fa-phone"></i>
    <input type="text" name="phone" placeholder="Phone Number" required>
  </div>
  <div class="input-group">
    <i class="fa-solid fa-id-card"></i>
    <input type="text" name="nic" placeholder="NIC" required>
  </div>
  <div class="input-group">
    <i class="fa-solid fa-location-dot"></i>
    <input type="text" name="address" placeholder="Address" required>
  </div>
  <div class="input-group">
    <i class="fa-solid fa-calendar"></i>
    <input type="date" name="start_date" required>
  </div>
  <button type="submit"><i class="fa-solid fa-check"></i> Book Consultation</button>
</form>
<a href="booking.php" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Back</a>
<p><?= $message ?></p>
</div>

</body>
</html>
