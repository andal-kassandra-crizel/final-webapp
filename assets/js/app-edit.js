document.addEventListener("DOMContentLoaded", function() {
  const categorySelect = document.getElementById("category");
  const serviceSelect = document.getElementById("service");
  const doctorSelect = document.getElementById("doctor");

  categorySelect.addEventListener("change", function() {
    const categoryId = this.value;

    serviceSelect.innerHTML = '<option value="">Select Service</option>';
    doctorSelect.innerHTML = '<option value="">Select Doctor</option>';

    if (!categoryId) return;

    // Fetch Services
    fetch("get-services.php?category_id=" + categoryId)
      .then(res => res.json())
      .then(data => {
        data.forEach(s => {
          const opt = document.createElement("option");
          opt.value = s.service_id;
          opt.textContent = s.service_name;
          serviceSelect.appendChild(opt);
        });
      });

    // Fetch Doctors
    fetch("get-doctors.php?category_id=" + categoryId)
      .then(res => res.json())
      .then(data => {
        data.forEach(d => {
          const opt = document.createElement("option");
          opt.value = d.doctor_id;
          opt.textContent = d.doctor_name;
          doctorSelect.appendChild(opt);
        });
      });
  });
});