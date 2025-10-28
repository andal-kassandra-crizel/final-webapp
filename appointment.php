<!DOCTYPE html>
<html lang="en">

<?php include 'includes/head.php'; ?>

<body class="appointment-page">

<?php include 'includes/header.php'; ?>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="heading-title">Appointment</h1>
              <p class="mb-0">
                Book your appointment easily with our clinic’s online scheduling system. We provide convenient and reliable healthcare 
                services to meet your needs. Our dedicated team ensures that every patient receives professional care and attention.
                Schedule your visit today and experience quality medical service tailored for you.
              </p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="home.php">Home</a></li>
            <li class="current">Appointment</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <!-- Appointmnet Section -->
    <section id="appointmnet" class="appointmnet section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          <div class="col-lg-8 mx-auto">
            <div class="booking-wrapper">
              <div class="booking-header text-center" data-aos="fade-up" data-aos-delay="200">
                <h2>Schedule Your Appointment</h2>
                <p>Book your medical appointment in just a few simple steps. Our experienced healthcare professionals are ready to provide you with the best care possible.</p>
              </div>

              <div class="booking-steps" data-aos="fade-up" data-aos-delay="300">
                <div class="step">
                  <div class="step-icon">
                    <i class="bi bi-calendar-check"></i>
                  </div>
                  <div class="step-content">
                    <h4>Select Service</h4>
                    <p>Choose the medical service you need</p>
                  </div>
                </div>
                <div class="step">
                  <div class="step-icon">
                    <i class="bi bi-clock"></i>
                  </div>
                  <div class="step-content">
                    <h4>Pick Date &amp; Time</h4>
                    <p>Select your preferred appointment slot</p>
                  </div>
                </div>
                <div class="step">
                  <div class="step-icon">
                    <i class="bi bi-person-check"></i>
                  </div>
                  <div class="step-content">
                    <h4>Confirm Details</h4>
                    <p>Provide your information and confirm</p>
                  </div>
                </div>
              </div>

            <div class="appointment-form" data-aos="fade-up" data-aos-delay="400">
              <form action="book-appointment.php" method="post" class="php-email-form">
                 <div class="row gy-4">
                  <div class="col-md-6">
                  <input type="text" name="firstname" class="form-control" placeholder="Enter your Firstname" required>
                  </div>
                  <div class="col-md-6">
                  <input type="text" name="middlename" class="form-control" placeholder="Enter your Middlename" required>
                  </div>
                  <div class="col-md-6">
                  <input type="text" name="lastname" class="form-control" placeholder="Enter your Lastname" required>
                  </div>
                  <div class="col-md-6">
                  <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                  </div>
                  <div class="col-md-6">
                  <input type="text" name="age" class="form-control" placeholder="Age" required>
                  </div>

                 <!-- Category Dropdown -->
                 <div class="col-md-6">
                    <select id="category" name="category_id" class="form-select" required>
                     <option value="">Select Category</option>
                    </select>
                 </div>

                <!-- Service Dropdown -->
                <div class="col-md-6">
                    <select id="service" name="service_id" class="form-select" required>
                    <option value="">Select Service</option>
                    </select>
                </div>

                <!-- Doctor Dropdown -->
                <div class="col-md-6">
                    <select id="doctor" name="doctor_id" class="form-select" required>
                    <option value="">Select Doctor</option>
                    </select>
                </div>

               <div class="col-md-6">
                   <input type="date" name="date" class="form-control" required>
               </div>

               <div class="col-12">
                  <textarea name="message" class="form-control" rows="4" placeholder="Additional notes or symptoms (optional)"></textarea>
                </div>

                <div class="col-12">
                   <button type="submit" class="btn-book">Book Appointment Now</button>
                </div>
             </form>
           </div>

              <div class="emergency-info" data-aos="fade-up" data-aos-delay="500">
                <p><i class="bi bi-exclamation-triangle"></i> For medical emergencies, please call <strong>911</strong> or go to the nearest emergency room.</p>
              </div>

            </div>
          </div>
        </div>

      </div>

    </section><!-- /Appointmnet Section -->

  </main>
      <script>
        fetch("get-categories.php")
           .then(response => response.json())
           .then(data => {
               const categorySelect = document.getElementById("category");
               categorySelect.innerHTML = '<option value="">Select Category</option>';
              data.forEach(cat => {
                  const option = document.createElement("option");
                  option.value = cat.category_id;
                  option.textContent = cat.category_name;
                  categorySelect.appendChild(option);
              });
            })
              .catch(error => console.error("Failed to fetch categories:", error));
      </script>
      
  <?php include 'includes/footer.php'; ?>
  
</body>

</html>