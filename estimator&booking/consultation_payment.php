<?php
session_start();
require_once "config.php";
$conn = Config::getConnection();

$message = "";
$consultation_id = $_GET['consultation_id'] ?? null;
$customer_id = $_SESSION['customer_id'] ?? null;

if (!$consultation_id || !$customer_id) {
    die("❌ Consultation ID is missing or user session is invalid.");
}

// Fetch consultation info
$stmt = $conn->prepare("SELECT * FROM consultation_bookings WHERE id=? AND customer_id=?");
$stmt->execute([$consultation_id, $customer_id]);
$consultation = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$consultation) {
    die("❌ Consultation not found.");
}

// Amount for consultation
$amount = 1500;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $card_number = trim($_POST['card_number']);
    $card_holder = trim($_POST['card_holder']);
    $expiry_date = trim($_POST['expiry_date']);
    $cvv = trim($_POST['cvv']);

    if ($card_number && $card_holder && $expiry_date && $cvv) {
        try {
            $stmt = $conn->prepare("
                INSERT INTO payments
                (consultation_id, customer_id, card_number, card_holder, expiry_date, cvv, amount, payment_date, status)
                VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), 'Paid')
            ");
            $stmt->execute([$consultation_id, $customer_id, $card_number, $card_holder, $expiry_date, $cvv, $amount]);

            $update = $conn->prepare("UPDATE consultation_bookings SET status='Paid' WHERE id=?");
            $update->execute([$consultation_id]);

            $message = "✅ Payment successful! Your consultation is confirmed.";
        } catch (PDOException $e) {
            $message = "❌ Payment failed: " . $e->getMessage();
        }
    } else {
        $message = "❌ Please complete all fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Consultation Payment</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
* { margin:0; padding:0; box-sizing:border-box; font-family:'Segoe UI', sans-serif; }

body { background:#f5f5f5; }

/* Navbar */
.navbar {
    background:#f59e0b;
    color:white;
    padding:15px 20px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    position:fixed;
    top:0;
    width:100%;
    z-index:1000;
}
.navbar a {
    color:white;
    text-decoration:none;
    margin-left:10px;
    padding:6px 12px;
    border-radius:50px;
    border:1px solid white;
    transition:0.3s;
}
.navbar a:hover { background:white; color:#f59e0b; }

/* Form container */
.form-container {
    background:#fff;
    padding:40px 25px;
    border-radius:15px;
    box-shadow:0 15px 35px rgba(0,0,0,0.15);
    max-width:450px;
    margin:120px auto 50px auto;
    text-align:center;
}

/* Heading */
.form-container h2 { color:#f59e0b; margin-bottom:25px; font-weight:700; }

/* Card Logos */
.card-logos {
    display:flex;
    justify-content:center;
    gap:20px;
    margin-bottom:20px;
}
.card-logo { height:35px; width:auto; }

/* Input fields with icons */
.input-field { position:relative; margin-bottom:15px; }
.input-field input {
    width:100%;
    padding:14px 45px 14px 15px;
    border:1px solid #fde68a;
    border-radius:50px;
    font-size:1rem;
    outline:none;
    transition:0.3s;
}
.input-field input:focus { border-color:#f59e0b; }
.input-field i {
    position:absolute;
    right:15px;
    top:50%;
    transform:translateY(-50%);
    color:#f59e0b;
    font-size:18px;
}

/* Button */
button {
    width:100%;
    padding:15px;
    border:none;
    border-radius:50px;
    background:#f59e0b;
    color:#fff;
    font-size:1.1rem;
    font-weight:500;
    cursor:pointer;
    transition:0.3s;
}
button:hover { background:#b45309; }

p { margin-top:20px; font-weight:600; }

/* Responsive */
@media(max-width:480px){
    .form-container { margin:100px 15px 30px 15px; padding:30px 20px; }
    .card-logo { height:30px; }
    .input-field input, button { font-size:.95rem; padding:12px; }
    .navbar { flex-direction: column; align-items:flex-start; padding:15px; }
    .navbar a { margin:5px 5px 0 0; }
}
</style>
</head>
<body>

<div class="navbar">
    <div>Consultation Payment</div>
    <div>
        <a href="index.php">Home</a>
        <a href="logout.php"><i class="fa fa-sign-out-alt"></i>Logout</a>
        <a href="book_consultation.php">back</a>

    </div>
</div>

<div class="form-container">
<h2>Pay Rs. <?= number_format($amount,2) ?></h2>

<!-- Card Logos -->
<div class="card-logos">
    <img src="https://upload.wikimedia.org/wikipedia/commons/4/41/Visa_Logo.png" alt="Visa" class="card-logo">
    <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Mastercard-logo.png" alt="MasterCard" class="card-logo">
</div>

<form method="post">
    <div class="input-field">
        <input type="text" name="card_number" placeholder="Card Number" required>
        <i class="fas fa-credit-card"></i>
    </div>
    <div class="input-field">
        <input type="text" name="card_holder" placeholder="Card Holder Name" required>
        <i class="fas fa-user"></i>
    </div>
    <div class="input-field">
        <input type="text" name="expiry_date" placeholder="MM/YY" required>
        <i class="fas fa-calendar-alt"></i>
    </div>
    <div class="input-field">
        <input type="text" name="cvv" placeholder="CVV" required>
        <i class="fas fa-lock"></i>
    </div>
    <button type="submit">Pay Now</button>
</form>
<p><?= htmlspecialchars($message) ?></p>
</div>

</body>
</html>
