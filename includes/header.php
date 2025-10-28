
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
    </div><!-- End Top Bar -->
      
    

    <div class="branding d-flex align-items-cente">

      <div class="container position-relative d-flex align-items-center justify-content-between">
         <a href="home.php" class="logo d-flex align-items-center">
          <img src="assets/img/curadesk.png" 
          alt="CuraDesk Logo" 
          class="img-fluid" 
          style="height: 80px; width: auto; max-height: 80px; margin-right: 1px;">
          <h1 class="sitename mb-0 fs-4">CuraDesk</h1>
         </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="home.php" class="active">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="doctors.php">Doctors</a></li>
            <li><a href="contact.php">Contact</a></li>
            
      
            <li class="nav-item dropdown">
             <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Profile
             </a>
              <ul class="dropdown-menu" aria-labelledby="profileDropdown">
              <li><a class="dropdown-item" href="profile.php">Manage Account</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item text-danger" href="logout.php">Log Out</a></li>
              </ul>
              </li>
              <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
       
             </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>

          <script>
              document.addEventListener('DOMContentLoaded', function() {
  
                 document.querySelectorAll('.dropdown-toggle').forEach(function(dropdown) {
                  dropdown.addEventListener('click', function (e) {
                   e.preventDefault();
                   const menu = this.nextElementSibling;
                   menu.classList.toggle('show');
                  });
                });
              });
          </script>


        </nav>
             
             



    

      </div>

    </div>
     
</header>
