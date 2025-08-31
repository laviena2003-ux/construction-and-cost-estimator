<?php
session_start();
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit;
}

require_once "config.php";

$total_cost = null;
$area = null;

// Material percentages
$materials = [
    'Cement' => ['percent' => 16.4, 'note' => 'Amount of cement per 1 ft² = 0.4 bags'],
    'Sand' => ['percent' => 12.3, 'note' => 'Amount of sand per 1 ft² = 0.816 ton'],
    'Aggregate' => ['percent' => 7.4, 'note' => 'Amount of aggregate per 1 ft² = 0.608 ton'],
    'Steel' => ['percent' => 24.6, 'note' => 'Amount of steel per 1 ft² = 4 ton'],
    'Finishers' => ['percent' => 16.5, 'note' => 'Paint (4.1 %), Tiles (8.0 %), Bricks (4.4 %)'],
    'Fittings' => ['percent' => 22.8, 'note' => 'Window (3.0 %), Doors (3.4 %), Plumbing (5.5 %), Electrical (6.8 %), Sanitary (4.1 %)']
];

// Installment percentages
$installments = [
    "1st Month" => 21.9,
    "2nd Month" => 18.4,
    "3rd Month" => 11.1,
    "4th Month" => 16.9,
    "5th Month" => 17.8,
    "6th Month" => 13.9
];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['area'])) {
    $area = floatval($_POST['area']);
    $conn = Config::getConnection();
    $costRow = $conn->query("SELECT cost_per_sqm FROM cost_settings ORDER BY id DESC LIMIT 1")->fetch();
    $cost_per_sqm = $costRow ? $costRow['cost_per_sqm'] : 0;

    $total_cost = ($area / 10.764) * $cost_per_sqm;

    $_SESSION['area'] = $area;
    $_SESSION['total_cost'] = $total_cost;
    $_SESSION['booking_type'] = 'cost_estimator';
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['book_now'])) {
    header("Location: book.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Cost Estimator  & construction bokking</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- FontAwesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
body { font-family: Arial, sans-serif; background: rgb(216, 238, 221); padding: 0; margin: 0; }
.navbar { background: linear-gradient(to bottom,rgb(9, 59, 21) 0%,rgb(45, 126, 62) 100%); color: white; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; }
.navbar h1 { font-size: 1.5rem; margin: 0; }
.navbar .nav-links a { color: white; text-decoration: none; padding: 8px 15px; border: 1px solid white; border-radius: 10px; margin-left: 10px; transition: background 0.3s; }
.navbar .nav-links a:hover { background: white; color: #2e7d32; }
.form-container { max-width: 1100px; margin: 30px auto; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
input, button { padding: 10px; margin: 10px 0; width: 100%; font-size: 1rem; }
button { background: #2e7d32; color: #fff; border: none; cursor: pointer; }
button:hover { background: #1b5e20; }
table { width: 100%; border-collapse: collapse; margin-top: 20px; }
th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
th { background: #2e7d32; color: #fff; }
.book-btn { margin-top: 20px; text-align: center; }
.book-btn form button { width: auto; padding: 10px 30px; }
.note { font-size: 0.9rem; color: #555; }
.flex-charts { display: flex; gap: 20px; margin-top: 30px; flex-wrap: wrap; }
.flex-item { flex: 1; min-width: 300px; }
.total-row { font-weight: bold; background: #f0f0f0; }
</style>
</head>
<body>

<div class="navbar">
    <h1><i class="fa-solid fa-calculator"></i> Cost Estimator & construction booking</h1>
    <div class="nav-links">
        <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
        <a href="usermanual.php"><i class="fa-solid fa-book"></i> User Manual</a>
        <a href="booking.php"><i class="fa-solid fa-arrow-left"></i> Back</a>
        <a href="logout.php"><i class="fa-solid fa-sign-out-alt"></i> Logout</a>
    </div>
</div>

<div class="form-container">
    <form method="post">
        <input type="number" name="area" placeholder="🏠 Enter Area (sqft)" required value="<?= htmlspecialchars($area) ?>">
        <button type="submit"><i class="fa-solid fa-calculator"></i> Estimate</button>
    </form>

    <?php if ($total_cost !== null): ?>
        <h3><i class="fa-solid fa-coins"></i> Total Estimated Cost: LKR <?= number_format($total_cost, 2) ?></h3>
        
        <h3><i class="fa-solid fa-cubes"></i> Approximate cost on various work of materials</h3>
        <table>
            <tr>
                <th>Material</th>
                <th>Percentage (%)</th>
                <th>Amount (LKR)</th>
                <th>Note</th>
            </tr>
            <?php 
            $material_total = 0;
            foreach ($materials as $material => $info): 
                $amount = ($info['percent'] / 100) * $total_cost;
                $material_total += $amount;
            ?>
                <tr>
                    <td><i class="fa-solid fa-box"></i> <?= $material ?></td>
                    <td><?= $info['percent'] ?></td>
                    <td><?= number_format($amount, 2) ?></td>
                    <td class="note"><?= $info['note'] ?></td>
                </tr>
            <?php endforeach; ?>
            <tr class="total-row">
                <td colspan="2">Total</td>
                <td><?= number_format($material_total, 2) ?></td>
                <td></td>
            </tr>
        </table>

        <h3><i class="fa-solid fa-calendar"></i> Installment Payment Thumb Rule</h3>
        <div class="flex-charts">
            <div class="flex-item">
                <canvas id="installmentChart"></canvas>
            </div>
            <div class="flex-item">
                <table>
                    <tr>
                        <th>Month</th>
                        <th>Percentage (%)</th>
                        <th>Amount (LKR)</th>
                    </tr>
                    <?php 
                    $inst_labels = [];
                    $inst_amounts = [];
                    $installment_total = 0;
                    foreach ($installments as $month => $percent): 
                        $amt = ($percent / 100) * $total_cost;
                        $inst_labels[] = $month;
                        $inst_amounts[] = $amt;
                        $installment_total += $amt;
                    ?>
                        <tr>
                            <td><i class="fa-solid fa-calendar-check"></i> <?= $month ?></td>
                            <td><?= $percent ?></td>
                            <td><?= number_format($amt, 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr class="total-row">
                        <td colspan="2">Total</td>
                        <td><?= number_format($installment_total, 2) ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <script>
        // Installment chart
        new Chart(document.getElementById('installmentChart'), {
            type: 'bar',
            data: {
                labels: <?= json_encode($inst_labels) ?>,
                datasets: [{
                    label: 'Installment Amount (LKR)',
                    data: <?= json_encode($inst_amounts) ?>,
                    backgroundColor: [
                        '#FFB3BA','#FFDFBA','#FFFFBA','#BAFFC9','#BAE1FF','#E6BAFF'
                    ],
                    borderColor: '#666',
                    borderWidth: 1
                }]
            },
            options: { responsive: true, scales: { y: { beginAtZero: true } } }
        });
        </script>

        <div class="book-btn">
            <form method="post">
                <button type="submit" name="book_now"><i class="fa-solid fa-handshake"></i> Book Now</button>
            </form>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
