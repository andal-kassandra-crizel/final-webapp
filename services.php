<!DOCTYPE html>
<html lang="en">


  <?php include 'includes/head.php'; ?>

<body class="services-page">


  <?php include 'includes/header.php'; ?>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="heading-title">Services</h1>
              <p class="mb-0">
                Discover our comprehensive health services dedicated to keeping you and your
               loved ones safe, healthy, and cared for every step of the way
              </p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="home.php">Home</a></li>
            <li class="current">Services</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <!-- Services Section -->
    <section id="services" class="services section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

           <!-- General Service -->
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item">
              <div class="service-image">
                <img src="assets/img/health/cardiology-1.webp" alt="Cardiology Services" class="img-fluid">
                <div class="service-overlay">
                  <i class="fas fa-heartbeat"></i>
                </div>
              </div>
              <div class="service-content">
                <h3>General Services</h3>
               <p>Available in most primary care or family clinics, providing day-to-day health care and consultations for common illnesses and wellness checks.</p>
                <div class="service-features">
                  <span class="feature-item"><i class="fas fa-check"></i> Consultation and Check-ups</span>
                  <span class="feature-item"><i class="fas fa-check"></i> Physical Examinations</span>
                  <span class="feature-item"><i class="fas fa-check"></i> Vital Signs Monitoring</span>
                </div>
                <a href="general-details.php" class="service-btn">
                  <span>Learn More</span>
                  <i class="fas fa-arrow-right"></i>
                </a>
              </div>
            </div>
          </div><!-- End Service Item -->

           <!-- Dental Service -->
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
            <div class="service-item">
              <div class="service-image">
                <img src="assets/img/health/dental-care.webp" alt="Neurology Services" class="img-fluid">
                <div class="service-overlay">
                  <i class="fas fa-brain"></i>
                </div>
              </div>
              <div class="service-content">
                <h3>Dental Services</h3>
                 <p>Comprehensive oral health services including prevention, restoration, and cosmetic treatments.</p>
                <div class="service-features">
                  <span class="feature-item"><i class="fas fa-check"></i> Cleaning & Check-ups</span>
                  <span class="feature-item"><i class="fas fa-check"></i> Tooth Extraction & Fillings</span>
                  <span class="feature-item"><i class="fas fa-check"></i> Braces, Dentures, & Crowns</span>
                </div>
                <a href="dental-details.php" class="service-btn">
                  <span>Learn More</span>
                  <i class="fas fa-arrow-right"></i>
                </a>
              </div>
            </div>
          </div><!-- End Service Item -->
           
          <!-- Preventive & Emergency Service -->
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item">
              <div class="service-image">
                <img src="assets/img/health/emergency-care.webp" alt="Orthopedics Services" class="img-fluid">
                <div class="service-overlay">
                  <i class="fas fa-bone"></i>
                </div>
              </div>
              <div class="service-content">
                <h3>Preventive & Emergency Care</h3>
                 <p>Health programs and emergency procedures ensuring wellness and readiness in urgent situations.</p>
                <div class="service-features">
                  <span class="feature-item"><i class="fas fa-check"></i> Vaccination & Health Counseling</span>
                  <span class="feature-item"><i class="fas fa-check"></i> Minor Procedures & Suturing</span>
                  <span class="feature-item"><i class="fas fa-check"></i> 24/7 Emergency Assistance</span>
                </div>
                <a href="preventive-details.php" class="service-btn">
                  <span>Learn More</span>
                  <i class="fas fa-arrow-right"></i>
                </a>
              </div>
            </div>
          </div><!-- End Service Item -->

         


        </div>

      </div>

    </section><!-- /Services Section -->

  </main>

  
  <?php include 'includes/footer.php'; ?>

</body>

</html>