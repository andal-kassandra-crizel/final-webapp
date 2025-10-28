/**
* Template Name: Clinic
* Template URL: https://bootstrapmade.com/clinic-bootstrap-template/
* Updated: Jul 23 2025 with Bootstrap v5.3.7
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/

(function() {
  "use strict";

  /**
   * Apply .scrolled class to the body as the page is scrolled down
   */
  function toggleScrolled() {
    const selectBody = document.querySelector('body');
    const selectHeader = document.querySelector('#header');
    if (!selectHeader.classList.contains('scroll-up-sticky') && !selectHeader.classList.contains('sticky-top') && !selectHeader.classList.contains('fixed-top')) return;
    window.scrollY > 100 ? selectBody.classList.add('scrolled') : selectBody.classList.remove('scrolled');
  }

  document.addEventListener('scroll', toggleScrolled);
  window.addEventListener('load', toggleScrolled);

  /**
   * Mobile nav toggle
   */
  const mobileNavToggleBtn = document.querySelector('.mobile-nav-toggle');

  function mobileNavToogle() {
    document.querySelector('body').classList.toggle('mobile-nav-active');
    mobileNavToggleBtn.classList.toggle('bi-list');
    mobileNavToggleBtn.classList.toggle('bi-x');
  }
  if (mobileNavToggleBtn) {
    mobileNavToggleBtn.addEventListener('click', mobileNavToogle);
  }

  /**
   * Hide mobile nav on same-page/hash links
   */
  document.querySelectorAll('#navmenu a').forEach(navmenu => {
    navmenu.addEventListener('click', () => {
      if (document.querySelector('.mobile-nav-active')) {
        mobileNavToogle();
      }
    });

  });

  /**
   * Toggle mobile nav dropdowns
   */
  document.querySelectorAll('.navmenu .toggle-dropdown').forEach(navmenu => {
    navmenu.addEventListener('click', function(e) {
      e.preventDefault();
      this.parentNode.classList.toggle('active');
      this.parentNode.nextElementSibling.classList.toggle('dropdown-active');
      e.stopImmediatePropagation();
    });
  });

  /**
   * Preloader
   */
  const preloader = document.querySelector('#preloader');
  if (preloader) {
    window.addEventListener('load', () => {
      preloader.remove();
    });
  }

  /**
   * Scroll top button
   */
  let scrollTop = document.querySelector('.scroll-top');

  function toggleScrollTop() {
    if (scrollTop) {
      window.scrollY > 100 ? scrollTop.classList.add('active') : scrollTop.classList.remove('active');
    }
  }
  scrollTop.addEventListener('click', (e) => {
    e.preventDefault();
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });

  window.addEventListener('load', toggleScrollTop);
  document.addEventListener('scroll', toggleScrollTop);

  /**
   * Animation on scroll function and init
   */
  function aosInit() {
    AOS.init({
      duration: 600,
      easing: 'ease-in-out',
      once: true,
      mirror: false
    });
  }
  window.addEventListener('load', aosInit);

  /**
   * Initiate glightbox
   */
  const glightbox = GLightbox({
    selector: '.glightbox'
  });

  /**
   * Initiate Pure Counter
   */
  new PureCounter();

  /**
   * Init swiper sliders
   */
//   function initSwiper() {
//     document.querySelectorAll(".init-swiper").forEach(function(swiperElement) {
//       let config = JSON.parse(
//         swiperElement.querySelector(".swiper-config").innerHTML.trim()
//       );

//       if (swiperElement.classList.contains("swiper-tab")) {
//         initSwiperWithCustomPagination(swiperElement, config);
//       } else {
//         new Swiper(swiperElement, config);
//       }
//     });
//   }

//   window.addEventListener("load", initSwiper);

// assets/js/main.js



 document.addEventListener("DOMContentLoaded", function() {
  const categorySelect = document.getElementById("category");
  const serviceSelect = document.getElementById("service");
  const doctorSelect = document.getElementById("doctor");
  
  categorySelect.addEventListener("change", function() {
    const categoryId = this.value;

    // Reset dropdowns
    serviceSelect.innerHTML = '<option value="">Select Service</option>';
    doctorSelect.innerHTML = '<option value="">Select Doctor</option>';

    if (!categoryId) return;

    // Fetch related services
    fetch("get-services.php?category_id=" + categoryId)
      .then(response => response.json())
      .then(data => {
        data.forEach(service => {
          const option = document.createElement("option");
          option.value = service.service_id;
          option.textContent = service.service_name;
          serviceSelect.appendChild(option);
        });
      });

    // Fetch related doctors
    fetch("get-doctors.php?category_id=" + categoryId)
      .then(response => response.json())
      .then(data => {
        data.forEach(doctor => {
          const option = document.createElement("option");
          option.value = doctor.doctor_id;
          option.textContent = doctor.doctor_name;
          doctorSelect.appendChild(option);
        });
      });
  });
    
  const form = document.querySelector(".php-email-form");
  const messageBox = document.createElement("div");
  messageBox.style.marginTop = "15px";
  messageBox.style.padding = "10px";
  messageBox.style.borderRadius = "5px";
  messageBox.style.display = "none";
  form.appendChild(messageBox);

  form.addEventListener("submit", function(e) {
    e.preventDefault(); // stop default form reload

    fetch("book-appointment.php", {
      method: "POST",
      body: new FormData(form)
    })
    .then(response => response.json())
    .then(data => {
      // Show message box
      messageBox.style.display = "block";
      messageBox.textContent = data.message;

      if (data.status === "success") {
        // ✅ Green background for success
        messageBox.style.backgroundColor = "#4CAF50";
        messageBox.style.color = "white";
      } else {
        // ❌ Red background for errors
        messageBox.style.backgroundColor = "#f44336";
        messageBox.style.color = "white";
      }
    })
    .catch(error => {
      messageBox.style.display = "block";
      messageBox.style.backgroundColor = "#f44336";
      messageBox.style.color = "white";
      messageBox.textContent = "Unexpected error occurred. Please try again.";
    });
  });
   
  


 });











const cancelModal = document.getElementById('cancelModal');
  cancelModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const appointmentId = button.getAttribute('data-id');
    document.getElementById('cancelId').value = appointmentId;
  });


function initSwiper() {
    document.querySelectorAll(".init-swiper").forEach(function(swiperElement) {
      let config = JSON.parse(
        swiperElement.querySelector(".swiper-config").innerHTML.trim()
      );

      if (swiperElement.classList.contains("swiper-tab")) {
        initSwiperWithCustomPagination(swiperElement, config);
      } else {
        new Swiper(swiperElement, config);
      }
    });
  }

  window.addEventListener("load", initSwiper);

  
  /**
   * Frequently Asked Questions Toggle
   */
  document.querySelectorAll('.faq-item h3, .faq-item .faq-toggle, .faq-item .faq-header').forEach((faqItem) => {
    faqItem.addEventListener('click', () => {
      faqItem.parentNode.classList.toggle('faq-active');
    });
  });

})();