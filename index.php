<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E-Prep</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-image: url('img/monochrome bg.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
      color: #333;
      font-family: 'Arial', sans-serif;
    }

    .overlay {
      background: rgba(255, 255, 255, 0.9);
      padding: 3rem;
      border-radius: 10px;
    }

    .btn-primary {
      background-color: #6c757d;
      border: none;
      color: #fff;
    }

    .btn-primary:hover {
      background-color: #343a40;
    }

    .custom-title {
      font-size: 3rem;
      color: #343a40;
    }

    .leadHead {
      color: white;
    }

    .lead {
      color: black;
    }


    footer {
      background: rgba(255, 255, 255, 0.8);
      padding: 1.5rem 0;
      margin-top: 3rem;
      color: #777;
    }

    .icon-box {
      font-size: 2.5rem;
      color: #6c757d;
    }

    .section-title {
      font-size: 2rem;
      margin-bottom: 1rem;
      color: #343a40;
      font: arial black;
    }

    /* Sticky Navbar */
    .sticky-top {
      background: rgba(255, 255, 255, 0.95);
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      z-index: 1000;
    }

      /* Navbar Styling */
  nav.navbar {
    background: linear-gradient(45deg, rgba(255, 255, 255, 0.9), rgba(250, 250, 250, 0.8));
    z-index: 1000;
    transition: background 0.3s ease-in-out;
  }

  /* Navbar Logo Styling */
  .navbar-brand img {
    max-height: 50px;
    width: auto;
  }

  /* Navbar Link Styling */
  .nav-link {
    transition: color 0.3s ease;
  }

  .nav-link:hover {
    color: #ffc107;
  }

  /* Login Button */
  .btn-outline-secondary {
    border-color: #6c757d;
    color: #6c757d;
  }

  .btn-outline-secondary:hover {
    background-color: #6c757d;
    color: #fff;
  }

  /* Create Account Button */
  .btn-warning {
    color: #fff;
    background-color: #ffc107;
    border: none;
  }

  .btn-warning:hover {
    background-color: #e0a800;
    color: #000;
  }


    /* Animation for scrolling */
    .reveal {
      opacity: 0;
      transform: translateY(20px);
      transition: all 0.6s ease-out;
    }

    .reveal.visible {
      opacity: 1;
      transform: translateY(0);
    }

      /* Background Rotation Animation */
  @keyframes rotate {
    from {
      transform: translate(-50%, -50%) rotate(0deg);
    }
    to {
      transform: translate(-50%, -50%) rotate(360deg);
    }
  }

  .custom-title {
    font-size: 4rem;
    letter-spacing: 2px;
    text-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
  }

  .btn-warning:hover {
    background-color: #e0a800;
    color: #000;
  }

  .btn-outline-light:hover {
    background-color: #fff;
    color: #000;
  }

 /* Base Styles for Feature Boxes */
 .feature-box {
    background-color: #ffffff;
    transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
    padding: 20px;
    border-radius: 10px;
  }

  .feature-box:hover {
    background-color: #f8f9fa; /* Light gray background on hover */
    transform: translateY(-5px); /* Subtle lift effect */
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1); /* Shadow effect */
  }

  /* Icon Styling */
  .icon-box {
    font-size: 3rem;
    color: #ffc107; /* Gold color for icons */
    margin-bottom: 15px;
    transition: color 0.3s ease;
  }

  .feature-box:hover .icon-box {
    color: #e0a800; /* Darker gold on hover */
  }

  /* Heading Styling */
  .feature-box h3 {
    font-family: Arial, sans-serif;
    font-weight: bold;
    transition: color 0.3s ease;
  }

  .feature-box:hover h3 {
    color: #333333; /* Darker text color on hover */
  }

  /* Paragraph Styling */
  .feature-box p {
    transition: color 0.3s ease;
  }

  .feature-box:hover p {
    color: #555555; /* Slightly darker text color on hover */
  }

  </style>
</head>

<body>
<!-- Sticky Navbar -->
<nav class="navbar navbar-expand-lg sticky-top shadow-sm">
  <div class="container">
    <!-- Brand Name -->
    <a class="navbar-brand" href="#">
      <img src="img/e-prep-logo.png" alt="E-Prep Logo" class="img-fluid" style="height: 50px;">
    </a>
    
    <!-- Mobile Toggler -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <!-- Navbar Links -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link text-dark fw-semibold px-3" href="#about">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark fw-semibold px-3" href="#features">Features</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-secondary me-2 fw-semibold" href="login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-warning fw-semibold shadow-sm" href="register.php">Create Account</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Header Section -->
<div class="container-fluid vh-100 d-flex justify-content-center align-items-center position-relative text-center" style="overflow: hidden;">
  <!-- Background Overlay -->
  <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(45deg, rgba(0,0,0,0.7), rgba(0,0,0,0.3)); z-index: 1;"></div>

  <!-- Animated Decorative Elements -->
  <div class="position-absolute top-50 start-50 translate-middle" style="z-index: 0; opacity: 0.5;">
    <img src="img/E-favicon.png" alt="Circle" class="img-fluid" style="width: 400px; animation: rotate 20s linear infinite;">
  </div>

  <!-- Header Content -->
  <div class="text-light position-relative z-2">
    <h1 class="custom-title display-3 fw-bold mb-3">
      <span style="color: white;">E-Prep</span>
    </h1>
    <p class="leadHead fs-4 mb-4" style="max-width: 600px; margin: 0 auto;">Your gateway to supplementary knowledge for culinary excellence at Siena College.</p>
    <a href="#about" class="btn btn-lg btn-warning text-dark fw-semibold shadow-lg me-2">Learn More</a>
    <a href="login.php" class="btn btn-lg btn-outline-light fw-semibold">Get Started</a>
  </div>
</div>

<!-- About Section -->
<section id="about" class="py-5">
  <div class="container text-center reveal">
    <h2 class="section-title" style="font-family: 'Arial Black', sans-serif;">About E-Prep</h2>
    <p class="lead" style="font-family: Arial, sans-serif;">E-Prep is designed to provide culinary students at Siena College with supplementary knowledge, from recipe fundamentals to advanced kitchen techniques. Whether you’re mastering pastries or other key aspects of culinary arts, we’re here to support your journey.</p>
  </div>
</section>

<!-- Features Section -->
<section id="features" class="py-5 bg-light">
  <div class="container text-center">
    <h2 class="section-title reveal" style="font-family: 'Arial Black', sans-serif;">Features</h2>
    <div class="row g-4">
      <!-- Feature Box 1 -->
      <div class="col-md-4 reveal">
        <div class="feature-box p-3 border rounded">
          <i class="bi bi-book icon-box"></i>
          <h3 style="font-family: Arial, sans-serif; font-weight: bold;">Comprehensive Guides</h3>
          <p>Access detailed guides on culinary topics, from beginner to advanced levels.</p>
        </div>
      </div>
      <!-- Feature Box 2 -->
      <div class="col-md-4 reveal">
        <div class="feature-box p-3 border rounded">
          <i class="bi bi-mouse2 icon-box"></i>
          <h3 style="font-family: Arial, sans-serif; font-weight: bold;">2D Virtual Laboratory</h3>
          <p>Engage in a point-and-click virtual lab that simulates real-world culinary tasks.</p>
        </div>
      </div>
      <!-- Feature Box 3 -->
      <div class="col-md-4 reveal">
        <div class="feature-box p-3 border rounded">
          <i class="bi bi-award icon-box"></i>
          <h3 style="font-family: Arial, sans-serif; font-weight: bold;">Progress Tracking</h3>
          <p>Complete the course and earn a certificate of completion to showcase your skills.</p>
        </div>
      </div>
    </div>
  </div>
</section>

  <!-- Footer -->
  <footer>
    <div class="container text-center">
      <span>Copyright &copy; E-Prep 2024</span>
    </div>
  </footer>

  <!-- Bootstrap Icons (Optional) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- JavaScript for Scroll Animations -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const reveals = document.querySelectorAll(".reveal");

      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add("visible");
          } else {
            entry.target.classList.remove("visible");
          }
        });
      });

      reveals.forEach(reveal => observer.observe(reveal));
    });
  </script>
</body>

</html>
