
<!DOCTYPE html>
<html lang="en">

  <?php include 'includes/head.php'; ?>

<body class="about-page">

  <header id="header" class="header fixed-top">

    <div class="topbar d-flex align-items-center dark-background">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
          <i class="bi bi-envelope d-flex align-items-center"><a href="clinic:clinic@gmail.com">clinic@gmail.com</a></i>
          <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 5589 55488 55</span></i>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
          <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
          <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
          <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
    </div>

    <div class="branding d-flex align-items-cente">

      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="#" class="logo d-flex align-items-center">
          <img src="assets/img/curadesk.png" 
          alt="CuraDesk Logo" 
          class="img-fluid" 
          style="height: 80px; width: auto; max-height: 80px; margin-right: 1px;">
          <h1 class="sitename mb-0 fs-4">CuraDesk</h1>
         </a>
      </div>

    </div>

 </header>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="heading-title">About</h1>
              <p class="mb-0">
                Odio et unde deleniti. Deserunt numquam exercitationem. Officiis quo
                odio sint voluptas consequatur ut a odio voluptatem. Sit dolorum
                debitis veritatis natus dolores. Quasi ratione sint. Sit quaerat
                ipsum dolorem.
              </p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">About</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center">
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
            <div class="about-content">
              <h2>Compassionate Care for Every Family</h2>
              <p class="lead">For over two decades, we have been dedicated to providing exceptional healthcare services to our community. Our commitment goes beyond medical treatment—we believe in building lasting relationships with our patients and their families.</p>
              
              <div class="stats-grid">
                <div class="stat-item">
                  <span class="stat-number" data-purecounter-start="0" data-purecounter-end="15000" data-purecounter-duration="2">15000</span>
                  <span class="stat-label">Patients Treated</span>
              </div>
              <div class="stat-item">
                  <span class="stat-number" data-purecounter-start="0" data-purecounter-end="25" data-purecounter-duration="2">25</span>
                  <span class="stat-label">Years Experience</span>
              </div>
                <div class="stat-item">
                  <span class="stat-number" data-purecounter-start="0" data-purecounter-end="50" data-purecounter-duration="2">50</span>
                  <span class="stat-label">Medical Specialists</span>
                </div>
              </div><!-- End Stats Grid -->
            </div><!-- End About Content -->
          </div>

          <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
            <div class="image-wrapper">
              <img src="assets/img/health/facilities-6.webp" class="img-fluid main-image" alt="Healthcare facility">
              <div class="floating-image" data-aos="zoom-in" data-aos-delay="400">
                <img src="assets/img/health/staff-8.webp" class="img-fluid" alt="Medical team">
              </div>
            </div><!-- End Image Wrapper -->
          </div>
        </div>

        <div class="values-section" data-aos="fade-up" data-aos-delay="300">
          <div class="row">
            <div class="col-lg-12 text-center">
              <h3>Our Core Values</h3>
              <p class="section-description">These principles guide everything we do in our commitment to exceptional healthcare</p>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
              <div class="value-item">
                <div class="value-icon">
                  <i class="bi bi-heart-pulse"></i>
                </div>
                <h4>Compassion</h4>
                <p>Providing care with empathy and understanding for every patient's unique needs and circumstances.</p>
              </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
              <div class="value-item">
                <div class="value-icon">
                  <i class="bi bi-shield-check"></i>
                </div>
                <h4>Excellence</h4>
                <p>Maintaining the highest standards of medical care through continuous learning and innovation.</p>
              </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
              <div class="value-item">
                <div class="value-icon">
                  <i class="bi bi-people"></i>
                </div>
                <h4>Integrity</h4>
                <p>Building trust through honest communication and ethical practices in all our interactions.</p>
              </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
              <div class="value-item">
                <div class="value-icon">
                  <i class="bi bi-lightbulb"></i>
                </div>
                <h4>Innovation</h4>
                <p>Embracing cutting-edge technology and treatments to improve patient outcomes.</p>
              </div>
            </div>
          </div><!-- End Values Row -->
        </div><!-- End Values Section -->


      </div>

    </section><!-- /About Section -->

  </main>

  <?php include 'includes/footer.php'; ?>

</body>

</html>