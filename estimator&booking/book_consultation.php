<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Consultation Booking</title>
<!-- FontAwesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
body { background:#f9f9f9; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin:0; padding:0; }

/* Navbar */
.navbar {
    background: linear-gradient(to bottom, rgb(9, 59, 21) 0%, rgb(45, 126, 62) 100%);
    color:white; 
    padding:15px 20px;
    display:flex; 
    justify-content:space-between; 
    align-items:center;
    flex-wrap:wrap; 
    position: sticky; 
    top:0; 
    z-index:1000;
}
.navbar h1 { margin:0; font-size:1.5rem; }
.navbar .nav-links {
    display:flex; 
    gap:10px; 
    align-items:center;
}
.navbar .nav-links a {
    color:white; 
    text-decoration:none; 
    padding:8px 15px; 
    border:1px solid white;
    border-radius:50px; 
    display:flex;
    align-items:center;
    gap:5px;
    transition:0.3s;
}
.navbar .nav-links a:hover { background:white; color:#2e7d32; }

/* Page title */
h1.page-title { text-align:center; margin:30px 0 20px 0; color:#2e7d32; }

/* Grid layout */
.grid {
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(320px,1fr));
    gap:25px;
    max-width:1200px;
    margin:0 auto 40px auto;
    padding:0 20px;
}

/* Card style */
.card {
    background:#fff;
    border-radius:20px;
    padding:35px 25px;
    box-shadow:0 10px 25px rgba(0,0,0,0.15);
    transition:transform 0.3s;
    text-align:center;
}
.card:hover { transform:translateY(-6px); }

.card i { font-size:3rem; color:#2e7d32; margin-bottom:15px; display:block; }

.card h2 { margin-bottom:15px; font-size:1.4rem; color:#1b5e20; }
.card p { margin-bottom:20px; font-size:1rem; color:#333; }

/* Book button */
.book-btn {
    display:inline-block;
    padding:12px 25px;
    background:#2e7d32;
    color:#fff;
    border-radius:50px;
    text-decoration:none;
    font-weight:600;
    transition:0.3s;
}
.book-btn:hover { background:#145a32; }

/* Responsive */
@media(max-width:600px){
    .grid { gap:20px; }
    .card { padding:30px 20px; }
}
@media(max-width:400px){
    .card { padding:25px 15px; }
    .book-btn { padding:10px 20px; }
}
</style>
</head>
<body>

<!-- Navbar -->
<div class="navbar">
    <h1>Consultations</h1>
    <div class="nav-links">
        <a href="index.php"><i class="fa fa-home"></i>Home</a>
        <a href="usermanual.php"><i class="fa fa-book"></i>User Manual</a>
        <a href="booking.php"><i class="fa fa-arrow-left"></i>Back</a>
        <a href="logout.php"><i class="fa fa-sign-out-alt"></i>Logout</a>
    </div>
</div>

<h1 class="page-title">Choose Your Consultation</h1>

<div class="grid">

    <!-- Engineers/Architects -->
    <div class="card">
      <i class="fa-solid fa-hard-hat"></i>
      <h2>Booking Consultation</h2>
      <p>Customers can book a consultation with contractor via call.</p>
      <a href="consultation_book.php?consultation=consultation with contractor" class="book-btn">Book</a>
    </div>

    <!-- Smart Material Recommendation -->
    <div class="card">
      <i class="fa-solid fa-magic-wand-sparkles"></i>
      <h2>Smart Material Recommendation</h2>
      <p>Suggests eco-friendly, cost-effective, or premium materials based on budget and climate.</p>
      <a href="consultation_book.php?consultation=Smart Material Recommendation" class="book-btn">Book</a>
    </div>

    <!-- Permit Helper -->
    <div class="card">
      <i class="fa-solid fa-file-signature"></i>
      <h2>Permit & Documentation Helper</h2>
      <p>Auto-generates municipal construction permit forms with pre-filled data.</p>
      <a href="consultation_book.php?consultation=Permit & Documentation Helper" class="book-btn">Book</a>
    </div>

    <!-- Interior Planner -->
    <div class="card">
      <i class="fa-solid fa-couch"></i>
      <h2>Custom Interior Planner</h2>
      <p>Customers try different paint colors, furniture, tiles, and lighting virtually.</p>
      <a href="consultation_book.php?consultation=Custom Interior Planner" class="book-btn">Book</a>
    </div>

    <!-- Energy Efficiency Planner -->
    <div class="card">
      <i class="fa-solid fa-solar-panel"></i>
      <h2>Energy Efficiency Planner</h2>
      <p>Suggests solar panels, insulation, or rainwater harvesting with ROI estimation.</p>
      <a href="consultation_book.php?consultation=Energy Efficiency Planner" class="book-btn">Book</a>
    </div>

    <!-- Waste Management -->
    <div class="card">
      <i class="fa-solid fa-recycle"></i>
      <h2>Waste Management Service</h2>
      <p>Plans for safe disposal and recycling of construction waste.</p>
      <a href="consultation_book.php?consultation=Waste Management Service" class="book-btn">Book</a>
    </div>

    <!-- Green Building -->
    <div class="card">
      <i class="fa-solid fa-leaf"></i>
      <h2>Green Building Certification Support</h2>
      <p>Helps projects qualify for LEED/Green certifications.</p>
      <a href="consultation_book.php?consultation=Green Building Certification Support" class="book-btn">Book</a>
    </div>
<!-- Virtual 3D Layout & Interior Preview -->
<div class="card">
  <i class="fa-solid fa-vr-cardboard"></i>
  <h2>Virtual 3D Layout Preview</h2>
  <p>Visualize your construction or interior in 3D. Try different furniture, paint, flooring, and lighting before starting the project.</p>
  <a href="consultation_book.php?consultation=Virtual 3D Layout Preview" class="book-btn">Book</a>
</div>

<!-- Smart Material Optimization -->
<div class="card">
  <i class="fa-solid fa-wrench"></i>
  <h2>Smart Material Optimization</h2>
  <p>Get expert suggestions on optimal materials based on durability, cost, and climate, including eco-friendly options.</p>
  <a href="consultation_book.php?consultation=Smart Material Optimization" class="book-btn">Book</a>
</div>

</div>

</body>
</html>
