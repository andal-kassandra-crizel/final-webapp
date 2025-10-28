<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>
<body>

<style>
  body {
    background: linear-gradient(135deg, #e3f2fd, #bbdefb);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .signup-card {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    padding: 40px;
    max-width: 450px;
    width: 100%;
  }
  .signup-card h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #0d6efd;
    font-weight: 700;
  }
  .form-control {
    border-radius: 10px;
  }
  .btn {
    border-radius: 10px;
    font-weight: 600;
    padding: 10px;
  }
  .btn-primary {
    width: 100%;
  }
  .btn-secondary {
    width: 100%;
    margin-top: 10px;
  }
  .login-link {
    text-align: center;
    margin-top: 15px;
  }
  .login-link a {
    color: #0d6efd;
    text-decoration: none;
    font-weight: 600;
  }
  .login-link a:hover {
    text-decoration: underline;
  }
  .error-message {
    color: red;
    font-size: 0.9rem;
    margin-top: 5px;
    display: none;
  }
</style>

<div class="signup-card">
  <h2>Create an Account</h2>

  <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

  <form action="register.php" method="post" id="signupForm">
    <div class="mb-3">
      <label class="form-label">First Name</label>
      <input type="text" name="firstname" class="form-control" placeholder="Enter your firstname" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Middle Name</label>
      <input type="text" name="middlename" class="form-control" placeholder="Enter your middlename" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Last Name</label>
      <input type="text" name="lastname" class="form-control" placeholder="Enter your lastname" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Email Address</label>
      <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
      <div id="emailError" class="error-message">This email is already registered.</div>
    </div>

    <div class="mb-3">
      <label class="form-label">Password</label>
      <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
      <div id="passwordError" class="error-message">
        Password must be at least 16 characters long and include uppercase, lowercase, number, and special character (!@#$%^&*).
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Confirm Password</label>
      <input type="password" id="confirmPassword" name="confirmpassword" class="form-control" placeholder="Re-enter your password" required>
    </div>

    <button type="submit" class="btn btn-primary">Register</button>
    <a href="index.html" class="btn btn-secondary">Cancel</a>

    <div class="login-link">
      <p>Already have an account? <a href="login.php">Log in here</a></p>
    </div>
  </form>
</div>

<script>
  const form = document.getElementById('signupForm');
  const emailInput = document.getElementById('email');
  const emailError = document.getElementById('emailError');
  const passwordInput = document.getElementById('password');
  const confirmPassword = document.getElementById('confirmPassword');
  const passwordError = document.getElementById('passwordError');

  // Password validation rules
  function validatePassword(password) {
    return (
      password.length >= 16 &&
      /[A-Z]/.test(password) &&
      /[a-z]/.test(password) &&
      /\d/.test(password) &&
      /[!@#$%^&*]/.test(password)
    );
  }

  // Hide error messages on input
  [passwordInput, confirmPassword, emailInput].forEach(input => {
    input.addEventListener('input', () => {
      passwordError.style.display = 'none';
      emailError.style.display = 'none';
    });
  });

  form.addEventListener('submit', async (e) => {
    e.preventDefault(); // prevent immediate submit

    const email = emailInput.value.trim();
    const password = passwordInput.value;
    const confirm = confirmPassword.value;
    let valid = true;

    // Reset error visibility
    passwordError.style.display = 'none';
    emailError.style.display = 'none';

    // Check password strength
    if (!validatePassword(password)) {
      passwordError.textContent = 
        'Password must be at least 16 characters long and include uppercase, lowercase, number, and special character (!@#$%^&*).';
      passwordError.style.display = 'block';
      valid = false;
      return;
    }

    // Check password match
    if (password !== confirm) {
      passwordError.textContent = 'Passwords do not match!';
      passwordError.style.display = 'block';
      valid = false;
      return;
    }

    // Check if email already exists via AJAX
    const response = await fetch('check_email.php?email=' + encodeURIComponent(email));
    const data = await response.json();

    if (data.exists) {
      emailError.style.display = 'block';
      valid = false;
      return;
    }

    // Submit form if everything is valid
    if (valid) form.submit();
  });
</script>

</body>
</html>
