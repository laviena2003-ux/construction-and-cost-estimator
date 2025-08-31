<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Manual - Construction Booking</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
* { margin:0; padding:0; box-sizing:border-box; font-family:'Segoe UI', sans-serif; }
body { background:#f0f4f8; padding-bottom:50px; }
.navbar {
    background: linear-gradient(to bottom,rgb(9, 59, 21) 0%,rgb(45, 126, 62) 100%);; color:white; display:flex; justify-content:space-between; align-items:center;
    padding:15px 20px; position:fixed; top:0; width:100%; z-index:1000; box-shadow:0 3px 10px rgba(0,0,0,0.2);
}
.navbar .title { font-weight:700; font-size:1.2rem; }
.navbar .links a {
    color:white; text-decoration:none; margin-left:12px; padding:6px 12px; border-radius:50px;
    border:1px solid white; transition:0.3s;
}
.navbar .links a:hover { background:white; color:#f59e0b; }

.container { max-width:900px; margin:100px auto 50px auto; padding:0 20px; }
h1 { text-align:center; color:rgb(9, 59, 21); margin-bottom:30px; }
.step { background:white; border-radius:15px; padding:20px; margin-bottom:20px; box-shadow:0 8px 20px rgba(0,0,0,0.1); display:flex; gap:15px; }
.step-icon { font-size:2rem; color:#f59e0b; flex-shrink:0; }
.step-content h3 { margin-bottom:8px; color:#333; }
.step-content p { color:#555; line-height:1.5; }

.progress-bar { display:flex; margin-bottom:30px; justify-content:space-between; }
.progress-bar div {
    width:18%; height:8px; background:#ddd; border-radius:4px; position:relative;
}
.progress-bar div.active { background:#f59e0b; }

.faq { margin-top:40px; }

.faq-item { background:white; border-radius:10px; margin-bottom:10px; box-shadow:0 5px 15px rgba(0,0,0,0.05); }
.faq-item button { width:100%; text-align:left; padding:15px; border:none; background:none; cursor:pointer; font-weight:bold; display:flex; justify-content:space-between; align-items:center; }
.faq-item button i { transition:0.3s; }
.faq-item .answer { display:none; padding:0 15px 15px 15px; color:#555; }
.faq-item.active .answer { display:block; }
.faq-item.active button i { transform:rotate(45deg); }

@media(max-width:600px){ .step { flex-direction:column; text-align:center; } .step-icon { margin:0 auto; } }
</style>
</head>
<body>

<div class="navbar">
    <div class="title">User Manual</div>
    <div class="links">
        <a href="index.php"><i class="fas fa-home"></i> Home</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</div>

<div class="container">
<h1>How to Use Construction & Booking Website</h1>

<!-- Progress Bar -->
<div class="progress-bar">
    <div class="active"></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
</div>

<!-- Steps -->
<div class="step">
    <div class="step-icon"><i class="fas fa-user-plus"></i></div>
    <div class="step-content">
        <h3>Step 1: Register an Account</h3>
        <p>Click on the “Register” button on the home page. Fill in your details like name, email, phone, NIC, and create a password. Submit to create your account.</p>
    </div>
</div>

<div class="step">
    <div class="step-icon"><i class="fas fa-sign-in-alt"></i></div>
    <div class="step-content">
        <h3>Step 2: Login</h3>
        <p>Use your registered email and password to log in. After login, you can access your dashboard and manage bookings.</p>
    </div>
</div>

<div class="step">
    <div class="step-icon"><i class="fas fa-calculator"></i></div>
    <div class="step-content">
        <h3>Step 3: Cost Estimator Booking</h3>
        <p>Click “Cost Estimator” to enter area (sqft). The system will calculate approximate construction cost. Proceed to payment to confirm your booking.</p>
    </div>
</div>

<div class="step">
    <div class="step-icon"><i class="fas fa-comments"></i></div>
    <div class="step-content">
        <h3>Step 4: Consultation Booking</h3>
        <p>Click “Book Consultation”, select type, date, and fill in your details. Submit to create a consultation booking.</p>
    </div>
</div>

<div class="step">
    <div class="step-icon"><i class="fas fa-credit-card"></i></div>
    <div class="step-content">
        <h3>Step 5: Make Payment</h3>
        <p>For cost estimator bookings, enter your card details and pay. Your booking status will update to “Paid” after successful payment.</p>
    </div>
</div>

<div class="step">
    <div class="step-icon"><i class="fas fa-eye"></i></div>
    <div class="step-content">
        <h3>Step 6: View Booking Status</h3>
        <p>Go to “My Status” page to view all your bookings and payment statuses.</p>
    </div>
</div>

<!-- FAQ Section -->
<div class="faq">
<h2 style="text-align:center; color:#b27c00; margin-bottom:20px;">Frequently Asked Questions</h2>

<div class="faq-item">
    <button>How can I reset my password? <i class="fas fa-plus"></i></button>
    <div class="answer">Click “Forgot Password” on the login page and follow the instructions sent to your email.</div>
</div>

<div class="faq-item">
    <button>Can I edit a booking after submission? <i class="fas fa-plus"></i></button>
    <div class="answer">Yes, you can cancel or reschedule bookings from the “My Status” page if allowed.</div>
</div>

<div class="faq-item">
    <button>Which payment methods are supported? <i class="fas fa-plus"></i></button>
    <div class="answer">Currently, we support Visa and MasterCard for online payments.</div>
</div>

</div>

</div>

<script>
// FAQ toggle
document.querySelectorAll('.faq-item button').forEach(btn=>{
    btn.addEventListener('click', ()=>{
        const parent = btn.parentElement;
        parent.classList.toggle('active');
    });
});
</script>

</body>
</html>
