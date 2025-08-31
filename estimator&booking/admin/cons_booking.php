<?php
session_start();
require_once "../config.php";

$conn = Config::getConnection();

// Handle Delete
if (isset($_GET['delete_id'])) {
    $delete_id = (int)$_GET['delete_id'];
    $stmt = $conn->prepare("DELETE FROM consultation_bookings WHERE id=?");
    $stmt->execute([$delete_id]);
    header("Location: cons_booking.php");
    exit();
}

// Fetch consultation bookings with customer info and payment status
try {
    $bookings = $conn->query("
        SELECT cb.*, c.name AS customer_name, c.email,
               (CASE WHEN p.id IS NOT NULL THEN 'Paid' ELSE cb.status END) AS display_status
        FROM consultation_bookings cb
        JOIN customers c ON cb.customer_id = c.id
        LEFT JOIN payments p ON p.booking_id = cb.id
        ORDER BY cb.id DESC
    ")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("DB Error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Consultation Bookings - Construction & Estimation</title>
<style>
* { margin:0; padding:0; box-sizing:border-box; }

/* Body */
body { font-family: Arial, sans-serif; background: #fdfdfd; padding-top:70px; }

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

/* Table */
.container { padding: 20px; max-width: 100%; overflow-x:auto; }
h1 { text-align: center; color: #b27c00; margin-bottom: 20px; }

table { width: 100%; border-collapse: collapse; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
th, td { padding: 12px 10px; border-bottom: 1px solid #ddd; text-align: center; }
th { background: #b27c00; color: #fff; }
tr:hover { background: rgb(240, 238, 229); }

.status-paid { color: #2e7d32; font-weight: bold; }   /* green */
.status-pending { color: #b27c00; font-weight: bold; } /* orange */

.btn-delete { background: #c62828; padding: 6px 12px; border: none; border-radius: 5px; color: #fff; font-weight: bold; cursor: pointer; transition: 0.3s; }
.btn-delete:hover { background: #8e1f1f; }

/* Footer */
footer { text-align: center; padding: 15px; margin-top: 20px; color: #fff; background: rgba(236, 233, 224, 0.7); border-radius: 6px; }

/* Responsive */
@media (max-width: 768px) {
    table { font-size: 0.85rem; }
    .navbar { flex-direction: column; align-items: flex-start; }
    .navbar .nav-links { margin-top: 8px; }
}
</style>
<script>
function confirmDelete(id) {
    if(confirm("Are you sure you want to delete this booking?")) {
        window.location.href = "cons_booking.php?delete_id=" + id;
    }
}
</script>
</head>
<body>

<div class="navbar">
    <div class="title">Consultation Bookings</div>
    <div class="nav-links">
        <a href="dashboard.php">⬅ Dashboard</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="container">
    <h1>Consultation Bookings</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Type</th>
            <th>Email</th>
            <th>Phone</th>
            <th>NIC</th>
            <th>Address</th>
            <th>Start Date</th>
            <th>Created At</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php if ($bookings): ?>
            <?php foreach ($bookings as $b): ?>
                <tr>
                    <td><?= $b['id'] ?></td>
                    <td><?= htmlspecialchars($b['customer_name']) ?></td>
                    <td><?= htmlspecialchars($b['consultation_type']) ?></td>
                    <td><?= htmlspecialchars($b['email']) ?></td>
                    <td><?= htmlspecialchars($b['phone'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($b['nic'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($b['address'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($b['start_date'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($b['created_at'] ?? 'N/A') ?></td>
                    <td class="<?= ($b['display_status'] === 'Paid') ? 'status-paid' : 'status-pending' ?>">
                        <?= $b['display_status'] ?>
                    </td>
                    <td>
                        <button onclick="confirmDelete(<?= $b['id'] ?>)" class="btn-delete">❌ Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="11">No consultation bookings found.</td></tr>
        <?php endif; ?>
    </table>
</div>

<footer>
   
</footer>

</body>
</html>
