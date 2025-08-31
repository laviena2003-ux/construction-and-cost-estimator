<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Smart Construction booking</title>
  <link rel="stylesheet" href="css/style.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

    /* Reset */
    * {margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}

    body {background:#f9fdf7;color:#333;line-height:1.6;overflow-x:hidden;}
    .container {max-width:1200px;margin:0 auto;padding:0 20px;}

   /* Header */
header {
    background: linear-gradient(to bottom,rgb(9, 59, 21) 0%,rgb(45, 126, 62) 100%);
    padding: 20px 0;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    position: sticky;
    top: 0;
    z-index: 1000;
    
}

header .header-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    font-size: 1.8rem;
    font-weight: 800;
    color: #fff;
}

.logo span {
    color: #c4f0a4;
}

nav a {
    color: #fff;
    margin-left: 20px;
    font-weight: 600;
    text-decoration: none;
    
    transition: transform .3s, color .3s;
}

nav a:hover,
nav a.active {
    color: #c4f0a4;
    transform: scale(1.1);
}

nav a.btn-register {
    background: #c4f0a4;
    color:rgb(24, 168, 58);
    padding: 8px 20px;
    border-radius: 25px;
    font-weight: 700;
    transition: .3s;
}

nav a.btn-register:hover {
    background: #a1e07c;
    transform: scale(1.05);
}


    /* Hero */
    .hero {
      position: relative;
      text-align: left;
      padding: 150px 20px;
      color:rgb(11, 238, 64);
      border-radius: 0 0 50px 50px;
      background-image: linear-gradient(
          to right,
          rgba(53, 65, 56, 0.9) 50%,
          rgba(49, 53, 50, 0.2) 100%
        ),
        url('images/1000342904.jpg'); /* local image */
      background-size: cover;
      background-position: center;
      background-blend-mode: overlay;
    }
    .hero-content {max-width:600px;margin-left:50px;}
    .hero-content h1 {font-size:3rem;font-weight:800;margin-bottom:15px;text-shadow:2px 2px 12px rgba(0,0,0,0.4);}
    .hero-content p {font-size:1.3rem;margin-bottom:30px;text-shadow:1px 1px 10px rgba(0,0,0,0.3);}
    .btn-primary {background:#c4f0a4;color:#28a745;padding:16px 40px;font-weight:700;border-radius:50px;text-decoration:none;
      box-shadow:0 8px 20px rgba(40,167,69,0.4);transition:.2s;}
    .btn-primary:hover {background:#a1e07c;color:#fff;box-shadow:0 10px 25px rgba(40,167,69,0.6);transform:translateY(-5px);}

    /* About Company Section */
    .about-company {display:flex;align-items:center;gap:40px;margin:40px 40px;  background:rgb(196, 207, 199); padding: 30px 20px;        
    border-radius: 60px; box-shadow: 0 10px 25px rgba(37, 20, 20, 0.1); border: 1px solid rgb(56, 105, 22);}
    .about-company .company-text h2 {color:#075218;font-size:2rem;margin-bottom:15px;}
    .about-company .company-text p {font-size:1rem;color:#333;line-height:1.6;}
    .about-company .company-image {flex:1;overflow:hidden;border-radius:20px;position:relative;height:300px;}
    .about-company .company-image img {width:100%;height:100%;object-fit:cover;border-radius:20px;}

    /* Services */
    .services {padding:30px 20px;display:flex;flex-wrap:wrap;justify-content:center;gap:30px;background:rgb(253, 253, 253);border-radius:20px;margin:50px auto; padding: 30px 20px;        /* space inside the box */
    border-radius: 60px; box-shadow: 0 10px 25px rgba(37, 20, 20, 0.1); border: 1px solid rgb(56, 105, 22); }
    .services h2 {width:100%;text-align:center;font-size:2rem;font-weight:800;color:#28a745;margin-bottom:40px;}
    .service-box {flex:1 1 280px;background:#e0f8d8;padding:30px 20px;border-radius:25px;text-align:center;
      box-shadow:0 12px 30px rgba(40,167,69,0.2);transition:.4s;}
    .service-box:hover {transform:translateY(-12px);box-shadow:0 20px 50px rgba(40,167,69,0.3);}
    .service-box h3 {font-size:1.5rem;margin-bottom:15px;color:#28a745;}
    .service-box p {font-size:1rem;color:#333;}

    .consultation-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 25px;
  margin-bottom: 50px;
} h2 {width:100%;text-align:center;font-size:2rem;font-weight:800;color:#28a745;margin-bottom:40px;}
   
.card {
  position: relative;
  border-radius: 20px;
  overflow: hidden;
  min-height: 280px;
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  text-align: center;
  color:white;
  box-shadow: 0 10px 25px rgba(0,0,0,0.15);
  transition: transform 0.3s, box-shadow 0.3s;
}
.card::before {
  content: "";
  position: absolute;
  inset: 0;
  background: rgba(0,0,0,0.35);
  transition: background 0.3s;
}
.card:hover::before {
  background: rgba(0,0,0,0.2);
}
.card-content {
  position: relative;
  padding: 20px;
  z-index: 1;
}
.card h2 {
  margin: 10px 0;
  font-size: 1.4rem;
  color:rgb(24, 85, 38);
}
.card p {
  font-size: 0.95rem;
  margin-bottom: 15px;
  font-size: 1.0rem;
  color:rgb(3, 49, 13);
  
}
.book-btn {
  display: inline-block;
  padding: 10px 20px;
  background: #28a745;
  border-radius: 50px;
  text-decoration: none;
  font-weight: 600;
  color: #fff;
  transition: transform 0.2s, box-shadow 0.2s;
}
.book-btn:hover {
  transform: scale(1.05);
  box-shadow: 0 8px 15px rgba(0,0,0,0.2);
}

/* Legacy Section */
.legacy {
  background: #f8f9fa;
  padding: 60px 20px;
  text-align: center;
}

.legacy h2 {
  font-size: 2rem;
  margin-bottom: 30px;
  color: #2e7d32;
}

.slider {
  overflow: hidden;
  position: relative;
  width: 100%;
  height: 220px;
}

.slide-track {
  display: flex;
  width: calc(250px * 12); /* 12 images total */
  animation: scroll 40s linear infinite;
}

.slide {
  width: 250px;
  flex-shrink: 0;
  padding: 10px;
}

.slide img {
  width: 100%;
  height: 180px;
  object-fit: cover;
  border-radius: 15px;
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
  transition: transform 0.3s;
}

.slide img:hover {
  transform: scale(1.05);
}

@keyframes scroll {
  0% { transform: translateX(0); }
  100% { transform: translateX(calc(-250px * 6)); } /* scroll half, rest duplicates */
}

   /* Map Section */
.map-section iframe {
  width: 100%;
  height: 200px;
  border: 0;
  border-radius: 10px;
}

/* Footer */
footer {
   background: linear-gradient(to bottom,rgb(9, 59, 21) 0%,rgb(45, 126, 62) 100%);
  color: #fff;
  text-align: center;
  padding: 10px 20px;
  font-weight: 600;
  font-size: 0.9rem;
  margin-top: 40px;
  border-radius: 25px 15px 0 0;
}

footer h3 {
  font-size: 1.5rem;
  margin-bottom: 8px;
  color: #fff;
}

footer p {
  margin: 5px 0;
  font-size: 1rem;
}

footer .social-icons a {
  display: inline-block;
  color: #fff;
  font-size: 1.3rem;
  margin: 0 10px;
  transition: 0.3s;
}

footer .social-icons a:hover {
  color: #c4f0a4;
  transform: scale(1.2);
}

/* Responsive adjustments for footer and map */
@media (max-width: 600px) {
  .map-section iframe {
    height: 250px;
  }

  footer h3 {
    font-size: 1.2rem;
  }

  footer .social-icons a {
    font-size: 1.1rem;
    margin: 0 8px;
  }
}

    /* Responsive */
    @media(max-width:600px){
      .hero-content h1{font-size:2rem;}
      .hero-content p{font-size:1rem;}
      .btn-primary{padding:12px 28px;font-size:1rem;}
      nav a{margin-left:10px;font-size:.9rem;}
      .about-company {flex-direction:column;}
      .about-company .company-image {height:250px;}
    }
  </style>
</head>
<body>
  <!-- Header -->
  <header>
    <div class="header-container container">
      <div class="logo"><i class="fa-solid fa-building"></i> Smart <span>Construction</span></div>
      <nav>
        <a href="index.php" class="active"><i class="fa-solid fa-house"></i> Home</a>
        <a href="usermanual.php"><i class="fa-solid fa-book"></i> User Manual</a>
        <a href="booking.php"><i class="fa-solid fa-calendar-check"></i> Booking</a>
        <a href="register.php" class="btn-register"><i class="fa-solid fa-user-plus"></i> Register</a>
        <a href="admin/login.php"><i class="fa-solid fa-user-shield"></i> Admin</a>
      </nav>
    </div>
  </header>

  <!-- Hero -->
  <section class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-content container">
      <h1><i class="fa-solid fa-hard-hat"></i> Build Your Dream Project</h1>
      <p><i class="fa-solid fa-hand-holding-dollar"></i> Estimate cost & book your consultation with us today!</p>
      <a href="register.php" class="btn-primary"><i class="fa-solid fa-rocket"></i> Get Started</a>
    </div>
  </section>

  <!-- About Company Section -->
  <section class="about-company container">
    <!-- Left side: text -->
    <div class="company-text" style="flex:1;">
      <h2>About Smart Construction</h2>
      <p>
        Smart Construction Manager provides reliable and innovative construction solutions
        for residential, commercial, and industrial projects. We prioritize quality,
        sustainability, and customer satisfaction in every project we undertake.
      </p>
    </div>

    <!-- Right side: auto-changing image -->
    <div class="company-image" style="flex:1;">
      <img id="companySlider" src="" alt="Company Image">
    </div>
  </section>

  <!-- Services -->
  <section class="services container">
    <h2><i class="fa-solid fa-cogs"></i> Our Other Services</h2>
    <div class="service-box">
      <h3><i class="fa-solid fa-wrench"></i> Renovation</h3>
      <p>High-quality home & office renovation.</p>
    </div>
    <div class="service-box">
      <h3><i class="fa-solid fa-city"></i> Commercial Projects</h3>
      <p>Reliable construction for business spaces.</p>
    </div>
    <div class="service-box">
      <h3><i class="fa-solid fa-house-chimney"></i> Residential Projects</h3>
      <p>Affordable housing solutions.</p>
    </div>
  </section>
<!-- Consultation Cards -->
<section class="consultations container">
  <h2><i class="fa-solid fa-clipboard-check"></i> Consultation Services</h2>
  <p class="section-subtitle" style="text-align:center;color:#555;margin-bottom:30px;">
    Expert guidance for your construction projects
  </p>
  <div class="consultation-grid">
    
    <!-- Card 1 -->
    <div class="card" style="background-image:url('images/1000342898.jpg')">
      <div class="card-content">
        <i class="fa-solid fa-hard-hat" style="font-size:2.5rem;margin-bottom:10px;"></i>
        <h2>Booking Consultation</h2>
        <p>Customers can book a consultation with contractor via call.</p>
        <a href="login.php?consultation=consultation with contractor" class="book-btn">Book</a>
      </div>
    </div>

    <!-- Card 2 -->
    <div class="card" style="background-image:url('images/1000342900.jpg')">
      <div class="card-content">
        <i class="fa-solid fa-magic-wand-sparkles" style="font-size:2.5rem;margin-bottom:10px;"></i>
        <h2>Smart Material Recommendation</h2>
        <p>Suggests eco-friendly, cost-effective, or premium materials based on budget and climate.</p>
        <a href="login.php?consultation=Smart Material Recommendation" class="book-btn">Book</a>
      </div>
    </div>

    <!-- Card 3 -->
    <div class="card" style="background-image:url('images/1000342902.jpg')">
      <div class="card-content">
        <i class="fa-solid fa-file-signature" style="font-size:2.5rem;margin-bottom:10px;"></i>
        <h2>Permit & Documentation Helper</h2>
        <p>Auto-generates municipal construction permit forms with pre-filled data.</p>
        <a href="login.php?consultation=Permit & Documentation Helper" class="book-btn">Book</a>
      </div>
    </div>

    <!-- Card 4 -->
    <div class="card" style="background-image:url('images/1000342898.jpg')">
      <div class="card-content">
        <i class="fa-solid fa-couch" style="font-size:2.5rem;margin-bottom:10px;"></i>
        <h2>Custom Interior Planner</h2>
        <p>Customers try different paint colors, furniture, tiles, and lighting virtually.</p>
        <a href="login.php?consultation=Custom Interior Planner" class="book-btn">Book</a>
      </div>
    </div>

    <!-- Card 5 -->
    <div class="card" style="background-image:url('images/1000342900.jpg')">
      <div class="card-content">
        <i class="fa-solid fa-solar-panel" style="font-size:2.5rem;margin-bottom:10px;"></i>
        <h2>Energy Efficiency Planner</h2>
        <p>Suggests solar panels, insulation, or rainwater harvesting with ROI estimation.</p>
        <a href="login.php?consultation=Energy Efficiency Planner" class="book-btn">Book</a>
      </div>
    </div>

    <!-- Card 6 -->
    <div class="card" style="background-image:url('images/1000342902.jpg')">
      <div class="card-content">
        <i class="fa-solid fa-recycle" style="font-size:2.5rem;margin-bottom:10px;"></i>
        <h2>Waste Management Service</h2>
        <p>Plans for safe disposal and recycling of construction waste.</p>
        <a href="login.php?consultation=Waste Management Service" class="book-btn">Book</a>
      </div>
    </div>

    <!-- Card 7 -->
    <div class="card" style="background-image:url('images/1000342898.jpg')">
      <div class="card-content">
        <i class="fa-solid fa-leaf" style="font-size:2.5rem;margin-bottom:10px;"></i>
        <h2>Green Building Certification Support</h2>
        <p>Helps projects qualify for LEED/Green certifications.</p>
        <a href="login.php?consultation=Green Building Certification Support" class="book-btn">Book</a>
      </div>
    </div>

    <!-- Card 8 - New Innovative -->
    <div class="card" style="background-image:url('images/1000342898.jpg')">
      <div class="card-content">
        <i class="fa-solid fa-cube" style="font-size:2.5rem;margin-bottom:10px;"></i>
        <h2>Virtual 3D Layout Preview</h2>
        <p>Visualize your construction or interior in 3D before starting the project.</p>
        <a href="login.php?consultation=Virtual 3D Layout Preview" class="book-btn">Book</a>
      </div>
    </div>

    <!-- Card 9 - New Innovative -->
    <div class="card" style="background-image:url('images/1000342900.jpg')">
      <div class="card-content">
        <i class="fa-solid fa-lightbulb" style="font-size:2.5rem;margin-bottom:10px;"></i>
        <h2>Smart Material Optimization</h2>
        <p>Get expert suggestions on optimal materials based on durability, cost, and climate.</p>
        <a href="login.php?consultation=Smart Material Optimization" class="book-btn">Book</a>
      </div>
    </div>

  </div>
</section>

<!-- Our Legacy & Achievements Section -->
<section class="legacy">
  <h2><i class="fa-solid fa-building-circle-check"></i> Our Legacy & Achievements</h2>
  <div class="slider">
    <div class="slide-track">
      <!-- Repeat images (for infinite effect) -->
      <div class="slide"><img src="images/1000342906.jpg" alt="Completed Project 1"></div>
      <div class="slide"><img src="images/1000342907.jpg" alt="Completed Project 2"></div>
      <div class="slide"><img src="images/3.jpg" alt="Completed Project 3"></div>
      <div class="slide"><img src="images/4.jpg" alt="Completed Project 4"></div>
      <div class="slide"><img src="images/1.jpg" alt="Completed Project 5"></div>
      <div class="slide"><img src="images/2.jpg" alt="Completed Project 6"></div>

      <!-- Duplicate again for seamless scroll -->
      <div class="slide"><img src="images/3.jpg" alt="Completed Project 1"></div>
      <div class="slide"><img src="images/4.jpg" alt="Completed Project 2"></div>
      <div class="slide"><img src="images/5.jpg" alt="Completed Project 3"></div>
      <div class="slide"><img src="images/6.jpg" alt="Completed Project 4"></div>
      <div class="slide"><img src="images/7.jpg" alt="Completed Project 5"></div>
      <div class="slide"><img src="images/10000342909.jpg" alt="Completed Project 6"></div>
    </div>
  </div>
</section>


<!-- Map Section (before footer) -->
  <section class="map-section container" style="margin:50px 0;">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3162.9123456789!2d79.861243!3d6.927079!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae259d2e5f3bb0d%3A0x9a0b3c4a0b0c0d0e!2sColombo%2C%20Sri%20Lanka!5e0!3m2!1sen!2sus!4v1692984650000" 
      width="100%" height="300" style="border:0; border-radius:10px;" allowfullscreen="" loading="lazy"></iframe>
  </section>

  <!-- Footer with social media and contact info -->
  <footer>
    <h3>Contact Us</h3>
    <p>📞 +94 712 345 678 | ✉ info@smartconstruction.com</p>
    <div class="social-icons" style="margin:20px 0;">
      <a href="#"><i class="fab fa-facebook-f"></i></a>
      <a href="#"><i class="fab fa-instagram"></i></a>
      <a href="#"><i class="fab fa-twitter"></i></a>
    </div>
    <p>© <?php echo date("Y"); ?> Smart Construction Manager. All rights reserved.</p>
  </footer>

  <!-- Slider Script -->
  <script>
    const images = [
      'images/1000342868.jpg',
      'images/1000342872.jpg',
      'images/1000333216.jpg'
    ];
    let current = 0;
    const slider = document.getElementById('companySlider');
    setInterval(() => {
      current = (current + 1) % images.length;
      slider.src = images[current];
    }, 3000);
  </script>
</body>
</html>
