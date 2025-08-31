<?php
session_start();
require_once "config.php";

$customer_id = $_SESSION['customer_id'] ?? null;
if (!$customer_id) {
    header("Location: login.php");
    exit();
}

$conn = Config::getConnection();

// Fetch Cost Estimator bookings
$costStmt = $conn->prepare("SELECT * FROM bookings WHERE customer_id=? ORDER BY created_at DESC");
$costStmt->execute([$customer_id]);
$costBookings = $costStmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch Consultation bookings
$consultStmt = $conn->prepare("SELECT * FROM consultation_bookings WHERE customer_id=? ORDER BY created_at DESC");
$consultStmt->execute([$customer_id]);
$consultBookings = $consultStmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Bookings Status</title>
<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f0fdf4;
    margin:0;
    padding:0;
}
/* Navbar */
.navbar {
    position: fixed;
    top:0;
    width: 97%;
    background: #2e7d32;
    color: #fff;
    display:flex;
    justify-content: space-between;
    align-items:center;
    padding:12px 20px;
    z-index:1000;
    box-shadow:0 3px 6px rgba(0,0,0,0.2);
}
.navbar .logo { font-weight: bold; font-size:1.3rem; }
.navbar .nav-links a {
    color:#fff;
    text-decoration:none;
    margin-left:10px;
    padding:6px 14px;
    border-radius:50px;
    background: rgba(255,255,255,0.2);
    font-weight:bold;
    transition:0.3s;
}
.navbar .nav-links a:hover { background:#fff; color:#2e7d32; transform:translateY(-2px); }

.container { padding:100px 20px 20px 20px; max-width:100%; overflow-x:auto; }
h1 { text-align:center; color:#2e7d32; margin:25px 0; }

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 40px;
    background: #fff;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
th, td {
    padding: 12px 10px;
    border-bottom: 1px solid #ddd;
    text-align: center;
}
th { background: #2e7d32; color: #fff; font-weight:600; }
tr:hover { background: #e6f4e6; }

/* Status styles */
.status {
    font-weight: bold;
    padding: 4px 10px;
    border-radius: 20px;
    display: inline-block;
}
.status.Pending { background: #facc15; color: #713f12; }
.status.Confirmed { background: #2e7d32; color: #d1fae5; }
.status.Paid { background: #1d4ed8; color: #bfdbfe; }

/* Responsive */
@media(max-width:768px){
    th, td { padding:8px 6px; font-size:0.85rem; }
    .navbar { flex-direction: column; align-items:flex-start; }
    .navbar .nav-links { margin-top:8px; }
}
@media(max-width:480px){
    table { display:block; overflow-x:auto; }
}
</style>
</head>
<body>

<div class="navbar">
    <div class="logo">My Bookings</div>
    <div class="nav-links">
        <a href="index.php">🏠 Home</a>
        <a href="booking.php">back</a>
        <a href="logout.php"><i class="fa fa-sign-out-alt"></i>Logout</a>
    </div>
</div>

<div class="container">

<h1>My Cost Estimator Bookings</h1>
<?php if ($costBookings): ?>
<table>
<tr>
    <th>ID</th>
    <th>Area (sqft)</th>
    <th>Total Cost (LKR)</th>
    <th>Phone</th>
    <th>NIC</th>
    <th>Address</th>
    <th>Start Date</th>
    <th>Status</th>
    <th>Created At</th>
</tr>
<?php foreach ($costBookings as $b): ?>
<tr>
    <td><?= $b['id'] ?></td>
    <td><?= $b['area_sqft'] ?: '-' ?></td>
    <td><?= $b['total_cost'] ? number_format($b['total_cost'],2) : '-' ?></td>
    <td><?= htmlspecialchars($b['phone']) ?></td>
    <td><?= htmlspecialchars($b['nic']) ?></td>
    <td><?= htmlspecialchars($b['address']) ?></td>
    <td><?= htmlspecialchars($b['start_date'] ?? '-') ?></td>
    <td class="status <?= $b['status'] ?>"><?= $b['status'] ?></td>
    <td><?= date("d-m-Y H:i", strtotime($b['created_at'])) ?></td>
</tr>
<?php endforeach; ?>
</table>
<?php else: ?>
<p style="text-align:center; color:#555;">No Cost Estimator bookings found.</p>
<?php endif; ?>

<h1>My Consultation Bookings</h1>
<?php if ($consultBookings): ?>
<table>
<tr>
    <th>ID</th>
    <th>Consultation Type</th>
    <th>Phone</th>
    <th>NIC</th>
    <th>Address</th>
    <th>Start Date</th>
    <th>Status</th>
    <th>Created At</th>
</tr>
<?php foreach ($consultBookings as $c): ?>
<tr>
    <td><?= $c['id'] ?></td>
    <td><?= htmlspecialchars($c['consultation_type']) ?></td>
    <td><?= htmlspecialchars($c['phone'] ?? '-') ?></td>
    <td><?= htmlspecialchars($c['nic'] ?? '-') ?></td>
    <td><?= htmlspecialchars($c['address'] ?? '-') ?></td>
    <td><?= htmlspecialchars($c['start_date'] ?? '-') ?></td>
    <td class="status <?= $c['status'] ?>"><?= $c['status'] ?></td>
    <td><?= date("d-m-Y H:i", strtotime($c['created_at'])) ?></td>
</tr>
<?php endforeach; ?>
</table>
<?php else: ?>
<p style="text-align:center; color:#555;">No Consultation bookings found.</p>
<?php endif; ?>

</div>

</body>
</html>
